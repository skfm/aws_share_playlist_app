@extends('app')

@section('title', $category->title)

@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $category->title }}</h2>
        <div class="card-text text-right">
          {{ $category->playlists->count() }}件
        </div>
      </div>
    </div>
    @foreach($category->playlists as $playlist)
      @include('playlists.card')
    @endforeach
  </div>
@endsection
