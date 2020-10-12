@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')
  <div class="container pb-3">
    @include('users.user')

    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach

    {{ $playlists->links() }}
  </div>
@endsection
