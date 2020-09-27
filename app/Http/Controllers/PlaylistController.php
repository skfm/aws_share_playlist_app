<?php

namespace App\Http\Controllers;
use App\Playlist;
use App\Tag;
use App\Http\Requests\PlaylistRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Playlist::class, 'playlist');
    }

    public function create()
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('playlists.create', [
            'allTagNames' => $allTagNames,
        ]);
    }

    public function store(PlaylistRequest $request, Playlist $playlist)
    {
        $playlist->fill($request->all());
        $playlist->user_id = $request->user()->id;
        $playlist->save();

        $request->tags->each(function ($tagName) use ($playlist) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $playlist->tags()->attach($tag);
        });

        return redirect()->route('playlists.index');
    }

    public function edit(Playlist $playlist)
    {
        $tagNames = $playlist->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('playlists.edit',[
            'playlist' => $playlist,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function update(PlaylistRequest $request, Playlist $playlist)
    {
        $playlist->fill($request->all())->save();

        $playlist->tags()->detach();
        $request->tags->each(function ($tagName) use ($playlist) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $playlist->tags()->attach($tag);
        });

        return redirect()->route('playlists.index');
    }

    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        return redirect()->route('playlists.index');
    }

    public function show(Playlist $playlist)
    {
        $category_name = $playlist->category->title;
        return view('playlists.show', [
            'playlist' => $playlist,
            'category_name' => $category_name,
        ]);
    }

    public function stock(Request $request, Playlist $playlist)
    {
        $playlist->stocks()->detach($request->user()->id);
        $playlist->stocks()->attach($request->user()->id);

        return [
            'id' => $playlist->id,
            'countStocks' => $playlist->count_stocks,
        ];
    }

    public function deleteStock(Request $request, Playlist $playlist)
    {
        $playlist->stocks()->detach($request->user()->id);

        return [
            'id' => $playlist->id,
            'countStocks' => $playlist->count_stocks,
        ];
    }
}
