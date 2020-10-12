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

    public function index()
    {
        $playlists = playlist::withCount('stocks')->orderBy('stocks_count', 'desc')->paginate(5);

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('playlists.index', [
            'playlists' => $playlists,
            'allTagNames' => $allTagNames,
        ]);
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
        return view('playlists.show', [
            'playlist' => $playlist,
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

    public function searchTitle(Request $request)
    {
        $keyword = $request->keyword;

        $sort = $request->input('sort');

        $query = playlist::query();
        $query = $query->where('title','like', "%$keyword%");

        switch ($sort) {
            case "new":
                $playlists = $query->orderBy('created_at','desc')->paginate(10);
                break;

            case "old":
                $playlists = $query->orderBy('created_at','desc')->paginate(10);
                break;

            case "allStock":
                $playlists = playlist::withCount('stocks')->where('title','like', "%$keyword%")->orderBy('stocks_count', 'desc')->paginate(10);
                break;

            default:
                $playlists = $query->orderBy('created_at','desc')->paginate(10);

        }

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('playlists.search.title', [
            'playlists' => $playlists,
            'allTagNames' => $allTagNames,
            'keyword' => $keyword,
        ]);

    }

    public function searchTag(Request $request)
    {
        $keyword = $request->keyword;

        $sort = $request->input('sort');

        $playlists = playlist::whereHas('tags', function($query) use ($keyword) {
            $query->where('tags.name','like', "%$keyword%");
        });

        switch ($sort) {
            case "new":
                $playlists = $playlists->orderBy('created_at','desc')->paginate(10);
                break;

            case "old":
                $playlists = $playlists->orderBy('created_at','asc')->paginate(10);
                break;

            case "allStock":
                $playlists = playlist::whereHas('tags', function($query) use ($keyword) {
                    $query->where('tags.name','like', "%$keyword%");
                })->withCount('stocks')
                ->orderby('stocks_count', 'desc')->paginate(10);
                break;

            default:
                $playlists = $playlists->orderBy('created_at','desc')->paginate(10);

        }

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('playlists.search.tag', [
            'playlists' => $playlists,
            'allTagNames' => $allTagNames,
            'keyword' => $keyword,
        ]);
    }
}
