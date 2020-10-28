<?php

namespace App\Http\Controllers;
use App\Stock;
use Illuminate\Http\Request;
use App\Http\Requests\StockRequest;
use App\StockFolder;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
  public function edit(Stock $stock)
    {
        $stockFolders = Auth::user()->stock_folders;

        return view('stocks.edit',[
            'stock' => $stock,
            'stockFolders' => $stockFolders,
        ]);
    }

    public function update(StockRequest $request, Stock $stock)
    {

        $stock->fill($request->all())->save();

        $user = Auth::user();
        $userId = Auth::user()->id;

        $playlists = $user->stocks->sortByDesc('created_at');

        $stockFolders = $user->stock_folders->all();

        $stockIds = collect([]);

        $stockFolderIds = collect([]);
        $stockNames = collect([]);

        foreach ($playlists as $playlist) {
            $stockId = $playlist->stocks_id->where('user_id', $userId)->pluck('id');
            $stockIds->push($stockId);

            $stockFolderId = $playlist->stocks_id->where('user_id', $userId)->pluck('stock_folder_id');
            $stockFolderIds->push($stockFolderId);

            $stockName = $user->stock_folders->where('id', $stockFolderId[0])->pluck('name');;
            $stockNames->push($stockName);
        }

        $stockFolders = $user->stock_folders->all();

        return view('users.all_stocks', [
        'user' => $user,
        'playlists' => $playlists,
        'stockFolders' => $stockFolders,
        'stockIds' => $stockIds,
        'stockFolderIds' => $stockFolderIds,
        'stockNames' => $stockNames,
      ]);
    }
}
