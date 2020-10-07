@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')

  <div class="container copy">
    <h2 class="copy-title">
      <p>
        SharePlaylitはみんなにみて欲しいYouTube動画のプレイリストを共有するサービスです。
      </p>
    </h2>

    <p class="copy-text">
      <p>実はあなたしか知らないオススメのYouTube動画を紹介しよう！</p>
      <p>YouTubeの検索では上位にヒットしにくい隠れた名動画を探してみせんか？</p>
    </p>

    <div class="btn-wrap">
      <a href="{{ route('register') }}" class="copy-btn btn">
        新規登録
      </a>
    </div>

  </div>

  <div class="container playlists">
    <h3 class="playlists-title">
      人気のプレイリスト
    </h3>
    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach
  </div>
  <div class="container categories">
    <h3 class="categories-title">
      カテゴリー別にみる
    </h3>
    <ul class="categories-list d-flex justify-content-between flex-wrap p-0">
      <li class="categories-item col-6">
        <a href="{{ route('categories.show', ['title' => 'プログラミング']) }}">
          プログラミング
        </a>
      </li>
      <li class="categories-item col-6 col-sm-3">
        <a href="{{ route('categories.show', ['title' => 'お金']) }}">
          お金
        </a>
      </li>
      <li class="categories-item col-6 col-sm-3">
        <a href="{{ route('categories.show', ['title' => '美容']) }}">
          美容
        </a>
      </li>
      <li class="categories-item col-6 col-sm-3">
        <a href="{{ route('categories.show', ['title' => '健康']) }}">
          健康
        </a>
      </li>
      <li class="categories-item col-6 col-sm-3">
        <a href="{{ route('categories.show', ['title' => 'プログラミング']) }}">
          プログラミング
        </a>
      </li>
      <li class="categories-item col-6 col-sm-3">
        <a href="{{ route('categories.show', ['title' => 'お金']) }}">
          お金
        </a>
      </li>
      <li class="categories-item col-6 col-sm-3">
        <a href="{{ route('categories.show', ['title' => '美容']) }}">
          美容
        </a>
      </li>
      <li class="categories-item col-6 col-sm-3">
        <a href="{{ route('categories.show', ['title' => '健康']) }}">
          健康
        </a>
      </li>
    </ul>
  </div>
@endsection
