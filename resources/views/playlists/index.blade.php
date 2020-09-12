@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($playlists as $playlist)
      <div class="card mt-3">
        <div class="card-body d-flex flex-row">
          @if ($img)
            <img src="{{ asset('storage/avatar/' . $img) }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
          @else
            <i class="fas fa-user-circle fa-3x"></i>
          @endif
          <div>
            <div class="font-weight-bold">
              {{ $name }}
            </div>
            <div class="font-weight-lighter">
              {{ $playlist->created_at->format('Y/m/d H:i') }}
            </div>
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



        <div class="card-body pt-0 pb-2">
          <h3 class="h4 card-title">
            {{ $playlist->title }}
          </h3>
          <div class="card-text">
            {{ $playlist->category->title ?? ''}}
          </div>
          <div class="card-text">
            {!! nl2br(e( $playlist->description )) !!}
          </div>
          <a class="card-text">
            {{ $playlist->url }}
          </a>
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
    @endforeach
  </div>
@endsection
