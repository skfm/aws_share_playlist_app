@extends('app')

@section('title', $user->name . 'のフォルダ一覧')

@section('content')
  @include('nav')

  <div class="container pb-3">
    @include('users.user')

    <div class="flderLink-wrap d-flex flex-row mt-3">
      <a class="text-muted active" href="{{ route('stockfolders.create') }}">
        フォルダを作成する
      </a>
      <a class="text-muted active" href="{{ route('stockfolders.index') }}">
        フォルダ一覧
      </a>
    </div>

    @foreach($stock_folders as $stock_folder)
      @include('stockfolders.card')
    @endforeach
  </div>
@endsection
