@extends('app')

@section('title', $user->name . 'のストックした記事')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($playlists as $playlist)
        @include('playlists.card')
    @endforeach
  </div>
  @foreach($stock_folders as $stock_folder)
    <a href="{{ route('stockfolders.show', ['stockfolder' => $stock_folder]) }}">
      {{ $stock_folder->name }}
    </a>
  @endforeach
  <a class="nav-link text-muted active"
             href="{{ route('stockfolders.create') }}">
    フォルダを作成する
  </a>
  <a class="nav-link text-muted active"
             href="{{ route('stockfolders.index') }}">
    フォルダ一覧
  </a>
@endsection
