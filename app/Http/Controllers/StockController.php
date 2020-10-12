<?php

namespace App\Http\Controllers;
use App\Stock;
use Illuminate\Http\Request;
use App\Http\Requests\StockRequest;
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

        foreach ($playlists as $playlist) {
            $stock_id = $playlist->stocks_id->where('user_id', $userId)->pluck('id');
            $stockIds->push($stock_id);
        }

        return view('users.allstocks', [
          'user' => $user,
          'playlists' => $playlists,
          'stock_folders' => $stockFolders,
          'stock_ids' => $stockIds,
      ]);
    }
}
