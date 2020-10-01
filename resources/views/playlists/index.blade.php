@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')

  <div class="container copy">
    <h2 class="copy-title">
      タイトルが入ります
    </h2>

    <p class="copy-title">
      リード文章が入ります
    </p>

    <a href="" class="copy-btn btn">
      新規登録をする
    </a>

  </div>

  <div class="container playlists">
    <h3 class="">
      人気のプレイリスト
    </h3>
    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach
  </div>
  <div class="container categories">
    <ul class="categories-list">
      <li class="categories-item">
        <a href="{{ route('categories.show', ['title' => 'プログラミング']) }}" class="card-title">
          プログラミング
        </a>
      </li>
      <li class="categories-item">
        <a href="{{ route('categories.show', ['title' => 'お金']) }}" class="card-title">
          お金
        </a>
      </li>
      <li class="categories-item">
        <a href="{{ route('categories.show', ['title' => '美容']) }}" class="card-title">
          美容
        </a>
      </li>
      <li class="categories-item">
        <a href="{{ route('categories.show', ['title' => '健康']) }}" class="card-title">
          健康
        </a>
      </li>
    </ul>
  </div>
@endsection
