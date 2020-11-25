@extends('app')

@section('title', 'SPY')

@section('content')
  @include('nav')

  <div class="container copy">
    <h2 class="copy-title">
      <p>
        SPYはみんなにみて欲しいYouTube動画のプレイリストを共有するサービスです。
      </p>
    </h2>

    <p class="copy-text">
      <p>実はあなたしか知らないオススメのYouTube動画を紹介しよう！</p>
      <p>YouTubeの検索では上位にヒットしにくい隠れた名動画を探してみせんか？</p>
    </p>

    @guest
    <div class="btn-wrap">
      <a href="{{ route('register') }}" class="copy-btn btn">
        新規登録
      </a>
    </div>
    @endguest

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
        <a href="{{ route('categories.show', ['title' => 'プログラミング']) }}">
          <i class="fas fa-tablet-alt"></i>
          <span>プログラミング</span>
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <a href="{{ route('categories.show', ['title' => '副業']) }}">
          <i class="fas fa-coins"></i>
          <span>副業</span>
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <a href="{{ route('categories.show', ['title' => '健康']) }}">
          <i class="far fa-hospital"></i>
          <span>健康</span>
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <a href="{{ route('categories.show', ['title' => '美容']) }}">
          <i class="fas fa-vial"></i>
          <span>美容</span>
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <a href="{{ route('categories.show', ['title' => 'トレーニング']) }}">
          <i class="fas fa-dumbbell"></i>
          <span>トレーニング</span>
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <a href="{{ route('categories.show', ['title' => '投資']) }}">
          <i class="fas fa-money-bill-wave-alt"></i>
          <span>投資</span>
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <a href="{{ route('categories.show', ['title' => '恋愛']) }}">
          <i class="fas fa-heart"></i>
          <span>恋愛</span>
        </a>
      </li>
      <li class="categories-item col-6 col-md-3">
        <a href="{{ route('categories.show', ['title' => 'オモシロ動画']) }}">
          <i class="far fa-grin-squint"></i>
          <span>オモシロ動画</span>
        </a>
      </li>
    </ul>
  </div>
@endsection
