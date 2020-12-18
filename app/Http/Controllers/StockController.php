<?php

namespace App\Http\Controllers;
use App\Stock;
use Illuminate\Http\Request;
use App\Http\Requests\StockRequest;
use App\StockFolder;
use Illuminate\Support\Facades\Auth;
use App\Services\StockServices;

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
}
