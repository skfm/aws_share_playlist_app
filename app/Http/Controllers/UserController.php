<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Services\PlaylistServices;
use App\Services\StockServices;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['playlists.user', 'playlists.stocks', 'playlists.tags']);

        if (is_null($user)) {
            abort(404);
        }

        $playlists = PlaylistServices::getPlaylistsOfUser($user,3);

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

        return view('users.icon_edit', ['user' => $user,
         'icon' => 1]);
    }

    public function update(UserRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();
        $user->name = $request->name;
        $user->description = $request->description;
        $user->insta_url = $request->insta_url;
        $user->youtube_url = $request->youtube_url;
        $user->twitter_url = $request->twitter_url;

        if ($request->file('image_path'))
        {
            $disk = Storage::disk('s3');
            $fileName = $disk->put('', $request->file('image_path'));
            $user->image_path = $fileName;
        }

        $user->save();

        $playlists = PlaylistServices::getPlaylistsOfUser($user,3);

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
        $user = User::where('name', $name)->first()
        ->load(['stocks.user', 'stocks.stocks', 'stocks.tags']);

        $playlists = PlaylistServices::getPlaylistsOfUser($user,3);

        return view('users.stocks', [
            'user' => $user,
            'playlists' => $playlists,
        ]);
    }

    public function allStocks(string $name)
    {
        $user = User::where('name', $name)->first();
        $playlists = $user->stocks->sortByDesc('created_at');

        $getStockDates = StockServices::getStockDates($playlists, $user);
        $stockFolders = $getStockDates[0];
        $stockIds = $getStockDates[1];
        $stockFolderIds = $getStockDates[2];
        $stockNames = $getStockDates[3];

        return view('users.all_stocks', [
            'user' => $user,
            'playlists' => $playlists,
            'stockFolders' => $stockFolders,
            'stockIds' => $stockIds,
            'stockFolderIds' => $stockFolderIds,
            'stockNames' => $stockNames,
        ]);
    }

    public function allPlaylists(string $name)
    {
        $user = User::where('name', $name)->first();
        $playlists = $user->playlists()->paginate(10);
        $allTagNames = PlaylistServices::getAllTags();

        return view('users.all_playlists', [
            'playlists' => $playlists,
            'allTagNames' => $allTagNames,
            'user' => $user,
        ]);
    }
}
