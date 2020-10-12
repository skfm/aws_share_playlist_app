@extends('app')

@section('title', '記事一覧')

@section('content')
  <div class="container errorPage">
    <h2 class="errorPage-title">
      <p>
        500
      </p>
    </h2>

    <div class="errorPage-text">
      <p>
        システム上で何らかの<br>
        エラーが発生しました。
      </p>
      <p>
        しばらく時間をおいてから<br>
        再度アクセスを試してください。
      </p>
    </ぢ>

    <div class="btn-wrap">
      <a href="{{ route('playlists.index') }}" class="copy-btn btn">
        トップページへ戻る
      </a>
    </div>

  </div>
@endsection
