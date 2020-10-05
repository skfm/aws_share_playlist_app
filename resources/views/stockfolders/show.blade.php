@extends('app')

@section('title', 'ストックフォルダー詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')

    <div class="card mt-3">
      <div class="card-body d-flex align-items-center justify-content-between">
        <h2 class="h4 card-title m-0">フォルダ：{{ $stockfolder->name }}</h2>
        <div class="card-text text-right">
          {{ $count }}件
        </div>
      </div>
    </div>

    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach
  </div>
@endsection
