@extends('app')

@section('title', $user->name . 'のストックした記事')

@section('content')
  @include('nav')

  <div class="container pb-3">
    @include('users.user')

    <div class="stocks-wrap mt-3">
      <div class="flderLink-wrap d-flex flex-row">
        <a class="text-muted active" href="{{ route('stockfolders.create') }}">
          フォルダを作成する
        </a>
        <a class="text-muted active" href="{{ route('stockfolders.index') }}">
          フォルダ一覧
        </a>
      </div>

      @if($stock_folders)
        <div class="folders-wrap d-flex flex-row">
          @foreach($stock_folders as $stock_folder)
            <a href="{{ route('stockfolders.show', ['stockfolder' => $stock_folder]) }}">
              {{ $stock_folder->name }}
            </a>
          @endforeach
        </div>
      @endif

      <?php $i = 0; ?>
      @foreach($playlists as $playlist)
          @include('playlists.card')
          <?php $i =  ++$i; ?>
      @endforeach
    </div>
  </div>
@endsection
