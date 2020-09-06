<?php

namespace App\Http\Controllers;
use App\Playlist;
use App\Http\Requests\PlaylistRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Playlist::class, 'playlist');
    }

    public function index(Playlist $playlist)
    {
        $user_id = Auth::user()->id;
        $playlists = $playlist::where('user_id', $user_id)->get()->sortByDesc('created_at');
        $user_name = Auth::user()->name;
        return view('playlists.index', [
            'playlists' => $playlists,
            'name' => $user_name,
        ]);
    }

    public function create()
    {
        return view('playlists.create');
    }

    public function store(PlaylistRequest $request, Playlist $playlist)
    {
        $playlist->fill($request->all());
        $playlist->user_id = $request->user()->id;
        $playlist->save();
        return redirect()->route('playlists.index');
    }

    public function edit(Playlist $playlist)
    {
        return view('playlists.edit', ['playlist' => $playlist]);
    }

    public function update(PlaylistRequest $request, Playlist $playlist)
    {
        $playlist->fill($request->all())->save();
        return redirect()->route('playlists.index');
    }

    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        return redirect()->route('playlists.index');
    }

    public function show(Playlist $playlist)
    {
        return view('playlists.show', ['playlist' => $playlist]);
    }
}
