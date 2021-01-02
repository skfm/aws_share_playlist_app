<div class="folderLink-wrap d-flex flex-row mt-3">
  <a href="{{ route('users.all_stocks', [
        'playlists' => $user->stocks,
        'name' => $user->name,
    ]) }}">
        ストック一覧
  </a>
  <a href="{{ route('stock_folders.create') }}">
    フォルダ作成
  </a>
  <a href="{{ route('stock_folders.index') }}">
    フォルダ一覧
  </a>
</div>
