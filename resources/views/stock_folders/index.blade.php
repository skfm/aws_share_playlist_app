@extends('app')

@section('title', $user->name . 'のフォルダ一覧')

@section('content')
  @include('nav')

  <div class="container pb-3 stockfolder">
    @include('users.user')

    <div class="flderLink-wrap d-flex flex-row mt-3">
      <a href="{{ route('stock_folders.create') }}">
        フォルダを作成する
      </a>
      <a href="{{ route('stock_folders.index') }}">
        フォルダ一覧
      </a>
    </div>

    @foreach($stockFolders as $stockFolder)
      @include('stock_folders.card')
    @endforeach
    {{ $stockFolders->links() }}
  </div>
@endsection
