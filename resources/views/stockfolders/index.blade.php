@extends('app')

@section('title', $user->name . 'のストックした記事')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach
  </div>
  <div>
  @foreach($stock_folder_names as $stock_folder_name)
    <a href="">
      {{ $stock_folder_name }}
    </a>
  @endforeach
  </div>
  <a class="nav-link text-muted active"
             href="{{ route('stockfolders.create') }}">
    フォルダを作成する
  </a>
@endsection
