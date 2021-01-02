<?php

namespace App\Http\Controllers;
use App\Stock;
use App\StockFolder;
use App\Http\Requests\StockFolderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StockServices;

class StockFolderController extends Controller
{
    public function index(StockFolder $stockFolder)
    {
        $user = Auth::user();
        $userId = Auth::user()->id;
        $stockFolders = StockServices::getStockFolders($stockFolder, $userId);

        return view('stock_folders.index', [
            'stockFolders' => $stockFolders,
            'user' => $user,
        ]);
    }

    public function show(StockFolder $stockFolder)
    {
        $user = Auth::user();
        $playlistIds = $stockFolder->stocks->pluck('playlist_id')->all();
        $playlists = $user->stocks->whereIn('id', $playlistIds)->all();
        $getStockDates = StockServices::getStockDates($playlists, $user);
        $stockFolders = $getStockDates[0];
        $stockIds = $getStockDates[1];
        $stockFolderIds = $getStockDates[2];
        $stockNames = $getStockDates[3];

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
            'stockFolderIds' => $stockFolderIds,
            'stockNames' => $stockNames,
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
        $stocks = $stockFolder->stocks->all();
        foreach ($stocks as $stock) {
            $stock->update(['stock_folder_id' => null]);
        }
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
        $stockFolders = StockServices::getStockFolders($stockFolder, $userId);

        return view('stock_folders.index', [
            'user' => $user,
            'stockFolders' => $stockFolders,
        ]);
    }
}
