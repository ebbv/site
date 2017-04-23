<?php

/**
 * Messages Controller
 *
 * @author Robert Doucette <rice8204@gmail.com>
 */

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @author Robert Doucette <rice8204@gmail.com>
 */
class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('speaker')->orderBy('date', 'desc')->orderBy('created_at', 'desc')->paginate(4);

        return view('messages.main', compact('messages'));
    }

    /**
     * Display the specified resource.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        $remote_url = Storage::url('audio/'.$message->url.'.mp3');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="'.$message->title.'.mp3"');
        header('Content-Type: audio/mpeg');
        header('Content-Length: '.get_headers($remote_url, 1)['Content-Length']);
        return readfile($remote_url);
    }

    /**
     * Show the form for creating a new resource.
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
            'speakers'  => Member::has('speaker')->orderBy('last_name', 'asc')->get(),
            'files'     => $files
        ]);
    }

    /**
     * Store the newly created resource in storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \Illuminate\Http\Request $r
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $r)
    {
        $filename = str_random(15);

        $data = [
            'member_id' => $r->speaker,
            'title'     => $r->title,
            'passage'   => $r->passage,
            'url'       => $filename,
            'date'      => $r->file,
            'created_by'=> $r->user()->id,
            'updated_by'=> $r->user()->id
        ];

        if (Message::create($data)) {
            foreach (['mp3', 'ogg'] as $ext) {
                Storage::move('tmp/'.$r->file.'.'.$ext, 'audio/'.$filename.'.'.$ext);
            }
        }

        return $this->create();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $this->authorize('update', $message);
        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param \Illuminate\Http\Request $r
     * @param App\Models\Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $r, Message $message)
    {
        $message->title     = $r->title;
        $message->passage   = $r->passage;
        $message->updated_by= $r->user()->id;
        $message->save();
        return redirect()->route('messages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Robert Doucette <rice8204@gmail.com>
     * @param App\Models\Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index');
    }
}
