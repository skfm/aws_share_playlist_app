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

    public function sortTag(Request $request)
    {
        $tagName = $request->input('tag');

        $tag = Tag::where('name', $tagName)->first();

        $playlists = $tag->playlists();

        $sort = $request->input('sort');

        switch ($sort) {
            case "new":
                $playlists = $playlists->orderBy('created_at','desc')->paginate(10);
                break;

            case "old":
                $playlists = $playlists->orderBy('created_at','asc')->paginate(10);
                break;

            case "allstock":
                $playlists = $playlists->withCount('stocks')->orderby('stocks_count', 'desc')->paginate(10);
                break;
            default:
                $playlists = $playlists->orderBy('created_at','desc')->paginate(10);

        }

        return view('tags.show',
        [
            'tag' => $tag,
            'playlists' => $playlists,
        ]);
    }
}
