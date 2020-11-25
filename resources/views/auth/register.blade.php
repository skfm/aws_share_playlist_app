@extends('app')

@section('title', 'ユーザー登録')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body">
            <h2 class="card-title text-center mt-2">ユーザー登録</h2>

            <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn btn-danger">
              <i class="fab fa-google mr-1"></i>Googleで登録
            </a>

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="md-form">
                  <label for="name">ユーザー名</label>
                  <input class="form-control" type="text" id="name" name="name" required value="{{ old('name') }}">
                  <small>英数字3〜16文字(登録後の変更はできません)</small>
                </div>
                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}" >
                </div>
                <div class="md-form">
                  <label for="password">パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>
                <div class="md-form">
                  <label for="password_confirmation">パスワード(確認)</label>
                  <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                  <small>パスワードは8文字以上で入力してください</small>
                </div>
                <button class="btn mt-2 mb-2" type="submit">ユーザー登録</button>
              </form>

              <div class="mt-0 text-center">
                <a href="{{ route('login') }}" class="otherLink">ログインはこちら</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
