<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();

        $playlists = $user->playlists->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'playlists' => $playlists,
        ]);
    }
}
