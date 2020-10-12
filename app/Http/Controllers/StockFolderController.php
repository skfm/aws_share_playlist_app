<?php

namespace App\Http\Controllers;
use App\StockFolder;
use App\Http\Requests\StockFolderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockFolderController extends Controller
{
    public function index(StockFolder $stockFolder)
    {

        $user = Auth::user();
        $userId = Auth::user()->id;

        $stockFolders = $stockFolder::where('user_id', $userId)->paginate(10);

        return view('stock_folders.index', [
            'stockFolders' => $stockFolders,
            'user' => $user,
        ]);
    }

    public function show(StockFolder $stockFolder)
    {
        $user = Auth::user();
        $userId = $user->id;
        $stockFolders = $user->stock_folders->all();
        $playlistIds = $stockFolder->stocks->pluck('playlist_id')->all();
        $playlists = $user->stocks->whereIn('id', $playlistIds)->all();
        $stockIds = collect([]);

        foreach ($playlists as $playlist) {
            $stockId = $playlist->stocks_id->where('user_id', $userId)->pluck('id');
            $stockIds->push($stockId);
        }

        $count = 0;

        foreach ($playlists as $playlist) {
            $count = ++$count;
        }

        return view('stock_folders.show', [
            'playlists' => $playlists,
            'stockFolder' => $stockFolder,
            'user' => $user,
            'count' => $count,
            'stockFolders' => $stockFolders,
            'stockIds' => $stockIds,
        ]);
    }

    public function edit(StockFolder $stockFolder)
    {
        return view('stock_folders.edit',[
            'stockFolder' => $stockFolder,
        ]);
    }

    public function update(StockFolderRequest $request, StockFolder $stockFolder)
    {
        $stockFolder->fill($request->all())->save();

        return redirect()->route('stock_folders.index');
    }

    public function destroy(StockFolder $stockFolder)
    {
        $stockFolder->delete();
        return redirect()->route('stock_folders.index');
    }

    public function create()
    {
        return view('stock_folders.create');
    }

    public function store(StockFolderRequest $request, StockFolder $stockFolder)
    {
        $stockFolder->fill($request->all());
        $stockFolder->user_id = $request->user()->id;
        $stockFolder->save();

        $user = Auth::user();
        $userId = Auth::user()->id;

        $stockFolders = $stockFolder::where('user_id', $userId)->get();

        return view('stock_folders.index', [
            'user' => $user,
            'stockFolders' => $stockFolders,
        ]);
    }
}
