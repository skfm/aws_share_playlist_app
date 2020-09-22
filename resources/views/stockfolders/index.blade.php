@extends('app')

@section('title', $user->name . 'のフォルダ一覧')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($stock_folders as $stock_folder)
      @include('stockfolders.card')
    @endforeach
  </div>
  <a class="nav-link text-muted active"
             href="{{ route('stockfolders.create') }}">
    フォルダを作成する
  </a>
@endsection
