<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

use App\Models\Message;
use App\Models\Member;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('verifyrole:admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
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
     * @param App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return $message;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param \Illuminate\Http\Request $r
     * @return \Illuminate\Http\Response
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
     * @param App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $r
     * @param App\Models\Message $message
     * @return \Illuminate\Http\Response
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
     * @param App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index');
    }
}
