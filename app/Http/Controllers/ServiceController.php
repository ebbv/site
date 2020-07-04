<?php

namespace App\Http\Controllers;

use App\DateSong;
use App\Songbook;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $songs = Songbook::first()->songs;

        return view('services.form', compact('songs'));
    }

    public function store(Request $request)
    {
        foreach (array_filter($request->songs) as $id) {
            DateSong::create(['date' => $request->date, 'song_id' => $id]);
        }

        return redirect('recherche-chants');
    }
}
