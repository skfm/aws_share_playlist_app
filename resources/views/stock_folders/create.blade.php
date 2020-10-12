@extends('app')

@section('title', 'ストックフォルダ作成')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('stock_folders.store') }}">
                @include('stock_folders.form')
                <button type="submit" class="btn _submit">フォルダを作成する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
