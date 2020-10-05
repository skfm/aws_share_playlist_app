<?php

namespace App\Http\Controllers;
use App\User;
use App\Tag;
use App\Http\Requests\UserRequest;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();

        $playlists = $user->playlists->sortByDesc('created_at')->take(3);

        return view('users.show', [
            'user' => $user,
            'playlists' => $playlists,
        ]);
    }

    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();

        return view('users.edit',
        ['user' => $user,
         'icon' => 0]);
    }

    public function iconEdit(string $name)
    {
        $user = User::where('name', $name)->first();

        return view('users.icon-edit', ['user' => $user,
         'icon' => 1]);
    }

    public function update(UserRequest $request, string $name)
    {

        $user = User::where('name', $name)->first();

        $user->name = $request->name;

        if ($request->description)
        {
            $user->description = $request->description;
        }

        if ($request->insta_url)
        {
            $user->insta_url = $request->insta_url;
        }

        if ($request->youteb_url)
        {
            $user->youtube_url = $request->youtube_url;
        }

        if ($request->twitter_url)
        {
            $user->twitter_url = $request->twitter_url;
        }

        if ($request->file('image_path'))
        {
            $path = $request->file('image_path')->store('public/avatar');
            $user->image_path = basename($path);
        }

        $user->save();

        $playlists = $user->playlists->sortByDesc('created_at')->take(3);

        return redirect()->route('users.show', [
            'name' => $user->name,
            'user' => $user,
            'playlists' => $playlists,
        ]);
    }

    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();
        $user->playlists()->delete();
        $user->delete();
        return redirect("/");
    }

    public function stocks(string $name)
    {
        $user = User::where('name', $name)->first();

        $playlists = $user->stocks->sortByDesc('created_at')->take(3);

        return view('users.stocks', [
            'user' => $user,
            'playlists' => $playlists,
        ]);
    }

    public function allstocks(string $name)
    {
        $user = User::where('name', $name)->first();

        $user_id = $user->id;

        $playlists = $user->stocks->sortByDesc('created_at');

        $stock_ids = collect([]);

        foreach ($playlists as $playlist) {
            $stock_id = $playlist->stocks_id->where('user_id', $user_id)->pluck('id');
            $stock_ids->push($stock_id);
        }

        $stock_folders = $user->stock_folders->all();

        return view('users.allstocks', [
            'user' => $user,
            'playlists' => $playlists,
            'stock_folders' => $stock_folders,
            'stock_ids' => $stock_ids,
        ]);
    }

    public function allplaylists(string $name)
    {

        $user = User::where('name', $name)->first();

        $playlists = $user->playlists()->paginate(10);

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('users.allplaylists', [
            'playlists' => $playlists,
            'allTagNames' => $allTagNames,
            'user' => $user,
        ]);
    }
}
