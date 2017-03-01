<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

use App\Models\Message;
use App\Models\Member;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
        $this->middleware('verifyrole:admin', ['except' => 'index']);
    }

    public function index()
    {
        $messages = Message::with('speaker')->orderBy('date', 'desc')->orderBy('created_at', 'desc')->paginate(4);

        return view('messages.main', compact('messages'));
    }

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

    public function store(Request $r)
    {
        $filename = str_random(15);

        $data = [
            'member_id' => $r->speaker,
            'title'     => $r->title,
            'passage'   => $r->input('message-passage'),
            'url'       => $filename,
            'date'      => $r->input('message-file'),
            'created_by'=> $r->user()->id,
            'updated_by'=> $r->user()->id
        ];

        if (Message::create($data)) {
            foreach (['mp3', 'ogg'] as $ext) {
                Storage::move('tmp/'.$r->input('message-file').'.'.$ext, 'audio/'.$filename.'.'.$ext);
            }
        }

        return $this->create();
    }
}
