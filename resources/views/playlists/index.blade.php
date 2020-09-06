@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($playlists as $playlist)
      <div class="card mt-3">
        <div class="card-body d-flex flex-row">
          <i class="fas fa-user-circle fa-3x mr-1"></i>
          <div>
            <div class="font-weight-bold">
              {{ $name }}
            </div>
            <div class="font-weight-lighter">
              {{ $playlist->created_at->format('Y/m/d H:i') }}
            </div>
          </div>
        </div>
        <div class="card-body pt-0 pb-2">
          <h3 class="h4 card-title">
            {{ $playlist->title }}
          </h3>
          <div class="card-text">

          </div>
          <div class="card-text">
            {!! nl2br(e( $playlist->description )) !!}
          </div>
          <div class="card-text">
            {{ $playlist->url }}
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
