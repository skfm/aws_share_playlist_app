@extends('app')

@section('title', $user->name . 'のフォルダ一覧')

@section('content')
  @include('nav')

  <div class="container pb-3 stockfolder">
    @include('users.user')

    @include('stock_folders.nav')

    @foreach($stockFolders as $stockFolder)
      @include('stock_folders.card')
    @endforeach
    {{ $stockFolders->links() }}
  </div>
@endsection
