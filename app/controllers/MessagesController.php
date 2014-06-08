<?php

class MessagesController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('messages.main');//->with('messages', Message::with('speaker')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $files = array();
        foreach((File::glob('../tmp/*.mp3')) ? : array() as $file)
        {
            $files[]= trim($file, '\.\.\/tmp\.mp3');
        }
        return View::make('messages.create')->with('speakers', Member::has('speaker')->get())->withFiles($files);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $filename = Str::random(15);
        $message = new Message;
        $message->member_id = Input::get('speaker');
        $message->title     = Input::get('title');
        $message->url       = $filename;
        $message->date      = Input::get('message-date');
        $message->created_by= Auth::user()->id;
        $message->updated_by= Auth::user()->id;
        if($message->save())
        {
            foreach(array('mp3', 'ogg', 'wav') as $ext)
            {
                File::move('../tmp/'.Input::get('message-file').'.'.$ext, public_path().'/audio/'.$filename.'.'.$ext);
            }
        }

        return Redirect::route('messages.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}