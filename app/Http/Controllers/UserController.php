<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        $user->name = $request->name;
        if ($request->file('image_path'))
        {
            $path = $request->file('image_path')->store('public/avatar');
            $user->image_path = basename($path);
        } else {
            $user->image_path = '';
        }
        $user->save();

        $playlists = $user->playlists->sortByDesc('created_at')->take(3);

        return redirect()->route('users.show', [
            'name' => $user->name,
            'user' => $user,
            'playlists' => $playlists,
        ]);
    }

    public function stocks(string $name)
    {
        $user = User::where('name', $name)->first();

        $playlists = $user->stocks->sortByDesc('created_at');

        return view('users.stocks', [
            'user' => $user,
            'playlists' => $playlists,
        ]);
    }
}
