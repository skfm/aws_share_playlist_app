<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    @if ($playlist->user->image_path)
      <img src="{{ asset('storage/avatar/'. $playlist->user->image_path) }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
    @else
      <i class="fas fa-user-circle fa-3x"></i>
    @endif
    <div>
      <div class="font-weight-bold">{{ $playlist->user->name }}</div>
      <div class="font-weight-lighter">{{ $playlist->created_at->format('Y/m/d H:i') }}</div>
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

    @if(isset( $stock_folders ))
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ route("stocks.edit", ['stock' => $playlist]) }}">
        <i class="fas fa-pen mr-1"></i>ストックのフォルダ分けをする
      </a>
    @endif

  </div>
  <div class="card-body pt-0">
    <h3 class="h4 card-title">
      <a class="text-dark" href="{{ route('playlists.show', ['playlist' => $playlist]) }}">
        {{ $playlist->title }}
      </a>
    </h3>
    <a href="{{ route('categories.show', ['title' => $playlist->category->title]) }}" class="card-title">
      {{ $playlist->category->title ?? ''}}
    <a/>
    <div class="card-text">
      {{ $playlist->description }}
    </div>
    <a href="{{ $playlist->url }}" class="card-text" target="_blank">
      {{ $playlist->url }}
    </a>
    <playlist-stock
      :initial-is-stocked-by='@json($playlist->isStockedBy(Auth::user()))'
      :initial-count-stocks='@json($playlist->count_stocks)'
      :authorized='@json(Auth::check())'
      endpoint="{{ route('playlists.stock', ['playlist' => $playlist]) }}"
    >
    </playlist-stock>
    @foreach($playlist->tags as $tag)
    @if($loop->first)
      <div class="card-body pt-0 pb-4 pl-3">
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
