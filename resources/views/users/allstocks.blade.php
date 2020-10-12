@extends('app')

@section('title', $user->name . 'のストックした記事')

@section('content')
  @include('nav')

  <div class="container pb-3">
    @include('users.user')

    <div class="stocks-wrap mt-3">
      <div class="flderLink-wrap d-flex flex-row">
        <a href="{{ route('stock_folders.create') }}">
          フォルダを作成する
        </a>
        <a href="{{ route('stock_folders.index') }}">
          フォルダ一覧
        </a>
      </div>

      <?php $i = 0; ?>
      @foreach($playlists as $playlist)
          @include('playlists.card')
          <?php $i =  ++$i; ?>
      @endforeach
    </div>
  </div>
@endsection
