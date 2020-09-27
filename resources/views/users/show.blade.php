@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
      <div class="card-body">
        <div class="card-text">
          <a class="nav-link" href="{{ route("users.edit", ['name' => $user->name]) }}">
            ユーザー編集ページ
          </a>
        </div>
      </div>
      @include('users.tabs', ['hasPlaylists' => true, 'hasStocks' => false])
      @foreach($playlists as $playlist)
        @include('playlists.card')
      @endforeach
    <div class="">
      <a class="nav-link text-muted active"
             href="{{ route('users.allplaylists', [
              'name' => $user->name,
          ]) }}">
        プレイリスト一覧
      </a>
    </div>
  </div>
@endsection
