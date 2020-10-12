@extends('app')

@section('title', '記事一覧')

@section('content')
  <div class="container errorPage">
    <h2 class="errorPage-title">
      <p>
        404
      </p>
    </h2>

    <p class="errorPage-text">
      お探しのページは<br>
      見つかりませんでした。
    </p>

    <div class="btn-wrap">
      <a href="{{ route('playlists.index') }}" class="copy-btn btn">
        トップページへ戻る
      </a>
    </div>

  </div>
@endsection
