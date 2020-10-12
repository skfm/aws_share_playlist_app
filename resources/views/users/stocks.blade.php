@extends('app')

@section('title', $user->name . 'のストックした記事')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasPlaylists' => false, 'hasStocks' => true])
    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach

    <div class="btn-allstocks">
      <a type="button" class="btn"
      href="{{ route('users.all_stocks', [
        'playlists' => $playlists,
        'name' => $user->name,
    ]) }}">
          ストック一覧
      </a>
    </div>
  </div>
@endsection
