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
             href="{{ route('users.allplaylists', [
              'name' => $user->name,
          ]) }}">
        プレイリスト一覧
      </a>
    </div>
  </div>
@endsection
