@extends('app')

@section('title', 'ストックフォルダー詳細')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach
  </div>
@endsection
