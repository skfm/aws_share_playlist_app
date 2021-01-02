@extends('app')

@section('title', 'ストックフォルダー詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')

    @include('stock_folders.nav')

    <div class="card mt-3">
      <div class="card-body d-flex align-items-center justify-content-between">
        <h2 class="card-title m-0">フォルダ：{{ $stockFolder->name }}</h2>
        <div class="card-text text-right">
          {{ $count }}件
        </div>
      </div>
    </div>

    <?php $i = 0; ?>
    @foreach($playlists as $playlist)
      @include('playlists.card')
      <?php $i =  ++$i; ?>
    @endforeach
  </div>
@endsection
