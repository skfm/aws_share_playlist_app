<?php

namespace App\Http\Controllers;
use App\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function create()
    {
        return view('playlists.create');
    }
}
