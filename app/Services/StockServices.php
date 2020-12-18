<?php

namespace App\Services;

class StockServices
{
    public static function getStockDates($playlists, $user)
    {
        $stockIds = collect([]);
        $stockFolderIds = collect([]);
        $stockNames = collect([]);
        $userId = $user->id;

        foreach ($playlists as $playlist) {
            $stockId = $playlist->stocks_id->where('user_id', $userId)->pluck('id');
            $stockIds->push($stockId);

            $stockFolderId = $playlist->stocks_id->where('user_id', $userId)->pluck('stock_folder_id');
            $stockFolderIds->push($stockFolderId);

            $stockName = $user->stock_folders->where('id', $stockFolderId[0])->pluck('name');
            $stockNames->push($stockName);
        }

        $stockFolders = $user->stock_folders->all();
        return [$stockFolders, $stockIds, $stockFolderIds, $stockNames];
    }

    public static function getStockFolders($stockFolder, $userId)
    {
      $stockFolders = $stockFolder::where('user_id', $userId)->paginate(10);
      return $stockFolders;
    }
}
