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
        $stock_folders = Auth::user()->stock_folders;

        return view('stocks.edit',[
            'stock' => $stock,
            'stock_folders' => $stock_folders,
        ]);
    }

    public function update(StockRequest $request, Stock $stock)
    {

        $stock->fill($request->all())->save();

        $user = Auth::user();
        $user_id = Auth::user()->id;

        $playlists = $user->stocks->sortByDesc('created_at');

        $stock_folders = $user->stock_folders->all();

        $stock_ids = collect([]);

        foreach ($playlists as $playlist) {
            $stock_id = $playlist->stocks_id->where('user_id', $user_id)->pluck('id');
            $stock_ids->push($stock_id);
        }

        return view('users.allstocks', [
          'user' => $user,
          'playlists' => $playlists,
          'stock_folders' => $stock_folders,
          'stock_ids' => $stock_ids,
      ]);
    }
}
