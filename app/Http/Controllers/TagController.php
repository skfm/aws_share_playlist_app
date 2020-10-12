<?php

namespace App\Http\Controllers;

use App\Playlist;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        $playlists = $tag->playlists()->paginate(10);

        return view('tags.show',
        [
            'tag' => $tag,
            'playlists' => $playlists,
        ]);
    }
}
