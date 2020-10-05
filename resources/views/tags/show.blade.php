@extends('app')

@section('title', $tag->hashtag)

@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body d-flex align-items-center justify-content-between">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="card-text text-right">
          {{ $tag->playlists->count() }}件
        </div>
      </div>
    </div>
    @foreach($tag->playlists as $playlist)
      @include('playlists.card')
    @endforeach
  </div>
@endsection
