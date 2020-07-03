<?php

namespace App\Http\Controllers;

use App\Song;

class SongsController extends Controller
{
    public function index()
    {
        $songs = Song::has('dates')
            ->searchByNum(request()->only(['num', 'recueil']))
            ->with(['dates', 'songbooks'])
            ->withCount('dates')
            ->get();

        return view('songs.index', compact('songs'));
    }
}
