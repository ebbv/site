<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;

class SongsController extends Controller
{
    public function create()
    {
        return view('songs.form');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $song = Song::firstOrCreate(['title' => $request->title]);
        $song->songbooks()->attach(1, ['number' => $request->number]);

        return back();
    }

    public function search()
    {
        $song = Song::has('dates')
            ->searchByNum(request()->only(['num', 'recueil']))
            ->with(['dates', 'songbooks'])
            ->withCount('dates')
            ->first();

        return view('songs.search', compact('song'));
    }
}
