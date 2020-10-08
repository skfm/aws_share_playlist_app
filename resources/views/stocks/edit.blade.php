@extends('app')

@section('title', '編集')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('stocks.update', ['stock' => $stock]) }}">
                @method('PATCH')
                @include('stocks.form')
                <button type="submit" class="btn _submit">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
