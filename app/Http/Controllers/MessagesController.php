<?php

/**
 * Messages Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

use App\Message;
use App\Role;
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
        $messages = Message::with('speaker')
            ->select('id', 'user_id', 'title', 'slug', 'passage', 'date', 'url')
            ->latest('date')
            ->paginate(5);

        return view('messages.index', compact('messages'));
    }

    /**
     * Display the specified message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\Message $message
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
        $ext   = collect(Message::AUDIO_FORMATS)->first();

        foreach ((Storage::files('tmp')) ?: [] as $file) {
            if (strpos($file, $ext) !== false) {
                $files[] = str_replace(['tmp/', $ext], '', $file);
            }
        }

        return view('messages.create')->with([
            'speakers'  => Role::speaker()->users,
            'files'     => $files
        ]);
    }

    /**
     * Store the newly created message in storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \Illuminate\Http\Request $request
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
            'date'      => $request->date
        ])) {
            $this->move_audio_files($request->date, $fileName);
        }

        return redirect($message->path());
    }

    /**
     * Show the form for editing the specified message.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $this->authorize('update', $message);
        return view('messages.edit', compact('message'))->withSpeakers(Role::speaker()->users);
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

        $message->user_id   = $request->user_id;
        $message->title     = $request->title;
        $message->passage   = $request->passage;
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

        foreach (Message::AUDIO_FORMATS as $ext) {
            Storage::delete('audio/'.$message->url.$ext);
        }

        $message->delete();

        return redirect()->route('messages.index');
    }

    private function move_audio_files($oldFileName, $newFileName)
    {
        foreach (Message::AUDIO_FORMATS as $ext) {
            $tmpFilePath = 'tmp/'.$oldFileName.$ext;

            if (Storage::exists($tmpFilePath)) {
                Storage::move($tmpFilePath, 'audio/'.$newFileName.$ext);
            }
        }
    }
}
