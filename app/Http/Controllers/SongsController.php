<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;

class SongsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['search']);
    }

    public function create()
    {
        return view('songs.form');
    }

    public function store(Request $request)
    {
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
