@extends('app')

@section('title', 'パスワード再設定')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="card-title text-center mt-2">パスワード再設定</h2>

            @include('error_card_list')

            @if (session('status'))
              <div class="card-text alert alert-success">
                {{ session('status') }}
              </div>
            @endif

            <div class="card-text">
              <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required>
                </div>

                <button class="btn mt-2 mb-2" type="submit">メール送信</button>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
