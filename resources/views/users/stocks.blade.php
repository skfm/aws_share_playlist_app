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
  </div>
  <a class="nav-link text-muted active"
          href="{{ route('stockfolders.index') }}">
    ストック一覧
  </a>
@endsection
