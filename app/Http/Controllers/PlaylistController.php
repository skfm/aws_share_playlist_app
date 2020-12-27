<?php

namespace App\Http\Controllers;
use App\Playlist;
use App\Http\Requests\PlaylistRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PlaylistServices;
class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Playlist::class, 'playlist');
    }

    public function index()
    {
        $playlists = playlist::withCount('stocks')->orderBy('stocks_count', 'desc')->take(5)->get();
        $allTagNames = PlaylistServices::getAllTags();

        return view('playlists.index', [
            'playlists' => $playlists,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function create()
    {
        $allTagNames = PlaylistServices::getAllTags();

        return view('playlists.create', [
            'allTagNames' => $allTagNames,
        ]);
    }

    public function store(PlaylistRequest $request, Playlist $playlist)
    {
        $playlist->fill($request->all());
        $playlist->user_id = $request->user()->id;

        $url = $request->url;

        if(strpos($url,'watch?v=') !== false) {
            $snippets = PlaylistServices::getYoutubeVideoDate($url);

            if (empty($snippets[0]->title)) {
                $error = "正しくURL IDが設定されていませんでした。再度、確認して入力してください。";
                return redirect()->back()->withInput()->withErrors($error);
            } else {
                $playlist->title = $snippets[0]->title;
            }

        } elseif(strpos($url,'playlist?list=') !== false) {
            $snippets = PlaylistServices::getYoutubeListDate($url);

            if (empty($snippets[0]->title)) {
                $error = "正しくURL IDが設定されていませんでした。再度、確認して入力してください。";
                return redirect()->back()->withInput()->withErrors($error);
            } else {
                $playlist->title = $snippets[0]->title;
                $playlist->thumbnail_url = $snippets[0]->thumbnails->maxres->url;

                if (empty($request->description)) {
                    $playlist->description = $snippets[0]->description;
                }
            }
        }

        $playlist->save();

        PlaylistServices::createAndAttachTags($request,$playlist);

        $user = Auth::user();
        $playlists = PlaylistServices::getPlaylistsOfUser($user,3);

        return view('users.show', [
            'user' => $user,
            'playlists' => $playlists,
        ]);
    }

    public function edit(Playlist $playlist)
    {
        $tagNames = $playlist->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = PlaylistServices::getAllTags();

        return view('playlists.edit',[
            'playlist' => $playlist,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function update(PlaylistRequest $request, Playlist $playlist)
    {
        $playlist->fill($request->all());
        $playlist->user_id = $request->user()->id;

        $url = $request->url;

        if(strpos($url,'watch?v=') !== false) {
            $snippets = PlaylistServices::getYoutubeVideoDate($url);

            if (empty($snippets[0]->title)) {
                $error = "正しくURL IDが設定されていませんでした。再度、確認して入力してください。";
                return redirect()->back()->withInput()->withErrors($error);
            } else {
                $playlist->title = $snippets[0]->title;
            }

        } elseif(strpos($url,'playlist?list=') !== false) {
            $snippets = PlaylistServices::getYoutubeListDate($url);

            if (empty($snippets[0]->title)) {
                $error = "正しくURL IDが設定されていませんでした。再度、確認して入力してください。";
                return redirect()->back()->withInput()->withErrors($error);
            } else {
                $playlist->title = $snippets[0]->title;
                $playlist->thumbnail_url = $snippets[0]->thumbnails->maxres->url;

                if (empty($request->description)) {
                    $playlist->description = $snippets[0]->description;
                }
            }
        }

        $playlist->save();

        $playlist->tags()->detach();
        PlaylistServices::createAndAttachTags($request,$playlist);

        $user = Auth::user();
        $playlists = PlaylistServices::getPlaylistsOfUser($user,3);

        return view('users.show', [
            'user' => $user,
            'playlists' => $playlists,
        ]);
    }

    public function destroy(Playlist $playlist)
    {
        $playlist->delete();

        $user = Auth::user();
        $playlists = PlaylistServices::getPlaylistsOfUser($user,3);

        return view('users.show', [
            'user' => $user,
            'playlists' => $playlists,
        ]);
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
        $playlists = PlaylistServices::getPlaylistsSortTitle($keyword,$sort,$query);
        $allTagNames = PlaylistServices::getAllTags();

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
        $playlists = PlaylistServices::getPlaylistsSortTag($keyword,$sort,$playlists);
        $allTagNames = PlaylistServices::getAllTags();

        return view('playlists.search.tag', [
            'playlists' => $playlists,
            'allTagNames' => $allTagNames,
            'keyword' => $keyword,
        ]);
    }
}
