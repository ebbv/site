<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
    return view('messages.main')->withMessages($messages);
  }

  public function create()
  {
    $files = array();
    foreach((Storage::files('tmp')) ? : array() as $file)
    {
      if(strpos($file, '.mp3') !== false)
      {
        $files[]= str_replace(array('tmp/', '.mp3'), '', $file);
      }
    }
    return view('messages.create')->withSpeakers(Member::has('speaker')->orderBy('last_name', 'asc')->get())->withFiles($files);
  }

  public function store(Request $request)
  {
    $filename = str_random(15);
    $data = array(
      'member_id' => $request->speaker,
      'title'     => $request->title,
      'passage'   => $request->input('message-passage'),
      'url'       => $filename,
      'date'      => $request->input('message-file'),
      'created_by'=> $request->user()->id,
      'updated_by'=> $request->user()->id
    );
    if(Message::create($data))
    {
      foreach(array('mp3', 'ogg') as $ext)
      {
        Storage::move('tmp/'.$request->input('message-file').'.'.$ext, 'public/audio/'.$filename.'.'.$ext);
      }
    }

    return $this->create();
  }
}