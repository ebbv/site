<?php

/**
 * Messages Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the messages.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('speaker')->latest('date')->get();

        return view('messages.index', compact('messages'));
    }

    /**
     * Display the specified message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for creating a new message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Message::class);
        $files = [];

        foreach ((Storage::files('tmp')) ? : [] as $file) {
            if (strpos($file, '.mp3') !== false) {
                $files[] = str_replace(['tmp/', '.mp3'], '', $file);
            }
        }

        return view('messages.create')->with([
            'speakers'  => User::has('speaker')->orderBy('last_name', 'asc')->get(),
            'files'     => $files
        ]);
    }

    /**
     * Store the newly created message in storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Message::class);

        $this->validate($request, [
            'user_id'   => 'required|exists:users,id',
            'title'     => 'required',
            'passage'   => 'required'
        ]);

        $fileName = str_random(15);

        if ($message = Message::create([
            'user_id'   => $request->user_id,
            'title'     => $request->title,
            'passage'   => $request->passage,
            'url'       => $fileName,
            'date'      => $request->date,
            'created_by'=> auth()->id(),
            'updated_by'=> auth()->id()
        ])) {
            $this->move_audio_files($request->date, $fileName);
        }

        return redirect($message->path());
    }

    /**
     * Show the form for editing the specified message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $this->authorize('update', $message);
        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified message in storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \Illuminate\Http\Request $request
     * @param \App\Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Message $message)
    {
        $this->authorize('update', $message);

        $this->validate($request, [
            'title'     => 'required',
            'passage'   => 'required'
        ]);

        $message->title     = $request->title;
        $message->passage   = $request->passage;
        $message->updated_by= auth()->id();
        $message->save();

        return redirect($message->path());
    }

    /**
     * Remove the specified message from storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \App\Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);

        $message->delete();

        return redirect()->route('messages.index');
    }

    private function move_audio_files($oldFileName, $newFileName)
    {
        foreach (['mp3', 'ogg'] as $ext) {
            $oldFileName = 'tmp/'.$oldFileName.'.'.$ext;

            if (Storage::exists($oldFileName)) {
                Storage::move($oldFileName, 'audio/'.$newFileName.'.'.$ext);
            }
        }
    }
}
