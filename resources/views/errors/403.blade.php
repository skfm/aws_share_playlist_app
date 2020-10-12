@extends('app')

@section('title', '記事一覧')

@section('content')
  <div class="container errorPage">
    <h2 class="errorPage-title">
      <p>
        403
      </p>
    </h2>

    <p class="errorPage-text">
      お探しのページに<br>
      アクセスする権限がありません。
    </p>

    <div class="btn-wrap">
      <a href="{{ route('playlists.index') }}" class="copy-btn btn">
        トップページへ戻る
      </a>
    </div>

  </div>
@endsection
