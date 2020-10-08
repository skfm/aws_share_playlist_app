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
        $user_id = $user->id;
        $stock_folders = $user->stock_folders->all();
        $playlist_ids = $stockfolder->stocks->pluck('playlist_id')->all();
        $playlists = $user->stocks->whereIn('id', $playlist_ids)->all();
        $stock_ids = collect([]);

        foreach ($playlists as $playlist) {
            $stock_id = $playlist->stocks_id->where('user_id', $user_id)->pluck('id');
            $stock_ids->push($stock_id);
        }

        $count = 0;

        foreach ($playlists as $playlist) {
            $count = ++$count;
        }

        return view('stockfolders.show', [
            'playlists' => $playlists,
            'stockfolder' => $stockfolder,
            'user' => $user,
            'count' => $count,
            'stock_folders' => $stock_folders,
            'stock_ids' => $stock_ids,
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

        $stock_folders = $stock_folder::where('user_id', $user_id)->get();

        return view('stockfolders.index', [
            'user' => $user,
            'stock_folders' => $stock_folders,
        ]);
    }


}
