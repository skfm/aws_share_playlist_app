@extends('app')

@section('title', 'フォルダ更新')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('stock_folders.update', ['stock_folder' => $stockFolder]) }}">
                @method('PATCH')
                @include('stock_folders.form')
                <button type="submit" class="btn _submit">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
