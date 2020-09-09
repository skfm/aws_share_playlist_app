@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <div class="d-flex flex-row">
          <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            @if ($user->image_path)
            <img src="{{ asset('storage/avatar/' . $user->image_path) }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
            @else
            <i class="fas fa-user-circle fa-3x"></i>
            @endif
          </a>
        </div>
        <h2 class="h5 card-title m-0">
          <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            {{ $user->name }}
          </a>
        </h2>
      </div>
      <div class="card-body">
        <div class="card-text">
          <a class="nav-link" href="{{ route("users.edit", ['name' => $user->name]) }}">
            ユーザー編集ページ
          </a>
        </div>
      </div>
      <ul class="nav nav-tabs nav-justified mt-3">
        <li class="nav-item">
          <a class="nav-link text-muted active"
             href="{{ route('users.show', ['name' => $user->name]) }}">
            記事
          </a>
        </li>
      </ul>
      @foreach($playlists as $playlist)
        @include('playlists.card')
      @endforeach
    </div>
    <div class="">
      <a class="nav-link text-muted active"
             href="{{ route('playlists.index', [
              'playlists' => $playlists,
              'name' => $user->name,
          ]) }}">
        プレイリスト一覧
      </a>
    </div>
  </div>
@endsection
