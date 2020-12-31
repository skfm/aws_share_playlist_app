@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')

    @include('users.tabs', ['hasPlaylists' => true, 'hasStocks' => false])

    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach

    <div class="btn-playlists">
      <a type="button" class="btn"
             href="{{ route('users.all_playlists', [
              'name' => $user->name,
          ]) }}">
        投稿動画一覧
      </a>
    </div>
  </div>
@endsection
