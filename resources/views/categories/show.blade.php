@extends('app')

@section('title', $category->title)

@section('content')
  @include('nav')
  <div class="container">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <form action="{{ url("/categories/$category->title")}}">
      <select name="sort">
        <option value="new">新しい順</option>
        <option value="old">古い順</option>
        <option value="allsotck">ストックが多い順</option>
      </select>
      <button type="submit" class="btn btn-primary col-md-5">並び替え</button>
      </form>
    </div>
    <div class="card mt-3">
      <div class="card-body d-flex align-items-center justify-content-between">
        <h2 class="h4 card-title m-0">カテゴリー：{{ $category->title }}</h2>
        <div class="card-text text-right">
          {{ $category->playlists->count() }}件
        </div>
      </div>
    </div>
    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach
  </div>
@endsection
