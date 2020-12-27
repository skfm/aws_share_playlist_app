<div class="card mt-4 mb-3 playlistsCard">
  <div class="card-body d-flex flex-row align-items-center pb-2">
    @if ($playlist->user->image_path)
      <img src="{{ Storage::disk('s3')->url($playlist->user->image_path) }}">
    @else
      <i class="fas fa-user-circle fa-2x"></i>
    @endif
    <div>
      <a href="{{ route('users.show', ['name' => $playlist->user->name]) }}" class="playlistsCard-name">
        {{ $playlist->user->name }}
      </a>
    </div>

  @if( Auth::id() === $playlist->user_id )
    <!-- dropdown -->
      <div class="ml-auto card-text">
        <div class="dropdown">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route("playlists.edit", ['playlist' => $playlist]) }}">
              <i class="fas fa-pen mr-1"></i>プレイリストを更新する
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $playlist->id }}">
              <i class="fas fa-trash-alt mr-1"></i>プレイリストを削除する
            </a>
          </div>
        </div>
      </div>
      <!-- dropdown -->

      <!-- modal -->
      <div id="modal-delete-{{ $playlist->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('playlists.destroy', ['playlist' => $playlist]) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ $playlist->title }}を削除します。よろしいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
    @endif
  </div>

  @if(isset( $stockFolders ) && Auth::id() === $user->id)
    <div class="stockFolders card-body pt-0 pb-2">
      <div class="stockFolders-linkWrap">
        <a class="stockFolders-link" href="{{ route("stocks.edit", ['stock' => $stockIds[$i][0]]) }}">
          <i class="fas fa-pen mr-1"></i>
          フォルダを選択する
        </a>
      </div>
      @if(!($stockFolderIds[$i][0] === null))
      <div class="d-flex align-items-center stockFolders-currentFolder">
        <p>
          フォルダー：
        </p>
        <a class="stockFolders-currentFolderLink" href="{{ route("stock_folders.show", ['stock_folder' => $stockFolderIds[$i][0]]) }}">
          {{ $stockNames[$i][0] }}
        </a>
      </div>
      @endif
    </div>
  @endif

  <div class="card-body pt-0">
    <h3 class="card-title mb-1">
      <a href="{{ route('playlists.show', ['playlist' => $playlist]) }}">
        {{ $playlist->title }}
      </a>
    </h3>
    @if(!($playlist->category === null))
      <div class="d-flex align-items-center category-wrap">
        <p class="mb-0">
          カテゴリー：
        </p>
        <a class="text-muted" href="{{ route('categories.show', ['title' => $playlist->category->title]) }}" class="card-title">
          {{ $playlist->category->title ?? ''}}
        </a>
      </div>
    @endif

    <playlist-stock
      :initial-is-stocked-by='@json($playlist->isStockedBy(Auth::user()))'
      :initial-count-stocks='@json($playlist->count_stocks)'
      :authorized='@json(Auth::check())'
      endpoint="{{ route('playlists.stock', ['playlist' => $playlist]) }}"
    ></playlist-stock>

    @foreach($playlist->tags as $tag)
    @if($loop->first)
      <div class="tags pt-1">
        <div class="card-text line-height">
    @endif
          <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
            {{ $tag->hashtag }}
          </a>
    @if($loop->last)
        </div>
      </div>
    @endif
    @endforeach
  </div>
</div>
