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
    {{ $playlists->links() }}
  </div>
  <div class="container categories">
    <h3 class="categories-title">
      カテゴリー別にみる
    </h3>
    <ul class="categories-list d-flex justify-content-around flex-wrap p-0">
      <li class="categories-item col-6 col-sm-3">
        <i class="fas fa-tablet-alt"></i>
        <a href="{{ route('categories.show', ['title' => 'プログラミング']) }}">
          プログラミング
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <i class="fas fa-coins"></i>
        <a href="{{ route('categories.show', ['title' => '副業']) }}">
          副業
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <i class="far fa-hospital"></i>
        <a href="{{ route('categories.show', ['title' => '健康']) }}">
          健康
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <i class="fas fa-vial"></i>
        <a href="{{ route('categories.show', ['title' => '美容']) }}">
          美容
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <i class="fas fa-dumbbell"></i>
        <a href="{{ route('categories.show', ['title' => 'トレーニング']) }}">
          トレーニング
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <i class="fas fa-money-bill-wave-alt"></i>
        <a href="{{ route('categories.show', ['title' => '投資']) }}">
          投資
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <i class="fas fa-heart"></i>
        <a href="{{ route('categories.show', ['title' => '恋愛']) }}">
          恋愛
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <i class="far fa-grin-squint"></i>
        <a href="{{ route('categories.show', ['title' => 'オモシロ動画']) }}">
          オモシロ動画
        </a>
      </li>
    </ul>
  </div>
@endsection
