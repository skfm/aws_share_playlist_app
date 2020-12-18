<?php

namespace App\Services;
use App\Tag;
use Google_Client;
use Google_Service_YouTube;

class PlaylistServices
{
    public static function getAllTags()
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
        return $allTagNames;
    }

    public static function createAndAttachTags($request,$playlist)
    {
        $request->tags->each(function ($tagName) use ($playlist) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $playlist->tags()->attach($tag);
        });
    }

    public static function getPlaylistsOfUser($user,$num)
    {
        $playlists = $user->playlists->sortByDesc('created_at')->take($num);
        return $playlists;
    }

    public static function getPlaylistsSortTitle($keyword,$sort,$query)
    {
        $query = $query->where('title','like', "%$keyword%");

        switch ($sort) {
            case "new":
                $playlists = $query->orderBy('created_at','desc')->paginate(10);
                return $playlists;
                break;

            case "old":
                $playlists = $query->orderBy('created_at','desc')->paginate(10);
                return $playlists;
                break;

            case "allstock":
                $playlists = playlist::withCount('stocks')->where('title','like', "%$keyword%")->orderBy('stocks_count', 'desc')->paginate(10);
                return $playlists;
                break;

            default:
                $playlists = $query->orderBy('created_at','desc')->paginate(10);
                return $playlists;
                break;
        }
    }

    public static function getPlaylistsSortTag($keyword,$sort,$playlists)
    {
        switch ($sort) {
            case "new":
                $playlists = $playlists->orderBy('created_at','desc')->paginate(10);
                return $playlists;
                break;

            case "old":
                $playlists = $playlists->orderBy('created_at','asc')->paginate(10);
                return $playlists;
                break;

            case "allstock":
                $playlists = playlist::whereHas('tags', function($query) use ($keyword) {
                    $query->where('tags.name','like', "%$keyword%");
                })->withCount('stocks')
                ->orderby('stocks_count', 'desc')->paginate(10);
                return $playlists;
                break;

            default:
                $playlists = $playlists->orderBy('created_at','desc')->paginate(10);
                return $playlists;
                break;
        }
    }

    public static function getYoutubeVideoDate($url)
    {
        $client = new Google_Client();
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));
        $youtube = new Google_Service_YouTube($client);

        $url = str_replace('watch?v=', '', $url);

        $items = $youtube->videos->listVideos('snippet', [
            'id' => $url,
        ]);

        $snippets = collect($items->getItems())->pluck('snippet')->all();

        return $snippets;
    }

    public static function getYoutubeListDate($url)
    {
        $client = new Google_Client();
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));
        $youtube = new Google_Service_YouTube($client);

        $url = str_replace('playlist?list=', '', $url);

        $items = $youtube->playlists->listPlaylists('snippet', [
            'id' => $url,
        ]);

        $snippets = collect($items->getItems())->pluck('snippet')->all();

        return $snippets;
    }
}
