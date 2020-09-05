<?php

namespace App\Http\Controllers;
use App\Playlist;
use App\Http\Requests\PlaylistRequest;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function create()
    {
        return view('playlists.create');
    }

    public function store(PlaylistRequest $request, Playlist $playlist)
    {
        $playlist->fill($request->all());
        $playlist->user_id = $request->user()->id;
        $playlist->save();
        return redirect()->route('home');
    }
}
