<?php

namespace App\Http\Controllers;
use App\StockFolder;
use App\Http\Requests\StockFolderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockFolderController extends Controller
{
    public function index(StockFolder $stock_folder)
    {
        $user = Auth::user();

        $playlists = $user->stocks->sortByDesc('created_at');

        $user_id = Auth::user()->id;

        $stock_folder_names = $stock_folder::where('user_id', $user_id)->pluck('name');

        return view('stockfolders.index', [
            'user' => $user,
            'playlists' => $playlists,
            'stock_folder_names' => $stock_folder_names,
        ]);
    }

    public function create()
    {
        return view('stockfolders.create');
    }

    public function store(StockFolderRequest $request, StockFolder $stock_folder)
    {
        $stock_folder->fill($request->all());
        $stock_folder->user_id = $request->user()->id;
        $stock_folder->save();

        $user = Auth::user();
        $user_id = Auth::user()->id;

        $stock_folder_names = $stock_folder::where('user_id', $user_id)->pluck('name');

        return view('stockfolders.index', [
            'user' => $user,
            'playlists' => $playlists,
            '$stock_folder_names' => $stock_folder_names,
        ]);
    }
}
