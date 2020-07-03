<?php

namespace App\Http\Controllers;

use App\Song;

class SongsController extends Controller
{
    public function index()
    {
        $song = Song::has('dates')
            ->searchByNum(request()->only(['num', 'recueil']))
            ->with(['dates', 'songbooks'])
            ->withCount('dates')
            ->first();

        return view('songs.index', compact('song'));
    }
}
