<?php

namespace App\Http\Controllers;
use App\StockFolder;
use App\Stock;
use App\Http\Requests\StockFolderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockFolderController extends Controller
{
    public function index(StockFolder $stockFolder)
    {

        $user = Auth::user();
        $user_id = Auth::user()->id;

        $stock_folders = $stockFolder::where('user_id', $user_id)->get();

        return view('stockfolders.index', [
            'stock_folders' => $stock_folders,
            'user' => $user,
        ]);
    }

    public function show(StockFolder $stockfolder)
    {
        $user = Auth::user();
        $playlist_ids = $stockfolder->stocks->pluck('playlist_id')->all();
        $playlists = $user->stocks->whereIn('id', $playlist_ids)->all();

        return view('stockfolders.show', [
            'playlists' => $playlists,
            '$stockfolder' => $stockfolder,
        ]);
    }

    public function edit(StockFolder $stockfolder)
    {
        return view('stockfolders.edit',[
            'stockfolder' => $stockfolder,
        ]);
    }

    public function update(StockFolderRequest $request, StockFolder $stockfolder)
    {
        $stockfolder->fill($request->all())->save();

        return redirect()->route('stockfolders.index');
    }

    public function destroy(StockFolder $stockfolder)
    {
        $stockfolder->delete();
        return redirect()->route('stockfolders.index');
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

        $playlists = $user->stocks->sortByDesc('created_at');

        $stock_folders = $stock_folder::where('user_id', $user_id)->get();

        return view('users.allstocks', [
            'user' => $user,
            'playlists' => $playlists,
            'stock_folders' => $stock_folders,
        ]);
    }


}
