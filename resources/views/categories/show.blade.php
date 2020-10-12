@extends('app')

@section('title', $category->title)

@section('content')
  @include('nav')
  <div class="container mt-3 pb-3">
    <div class="card resultNumber">
      <div class="card-body d-flex align-items-center justify-content-between">
        <h2 class="card-title m-0 resultNumber-title">カテゴリー：{{ $category->title }}</h2>
        <div class="card-text text-right resultNumber-number">
          {{ $category->playlists->count() }}件
        </div>
      </div>
    </div>

    <div class="formResult mt-3">
      <form action="{{ url("/categories/$category->title")}}">
      {{ csrf_field()}}
      <div class="form-group">
        <label>並び順</label>
        <select name="sort" class="browser-default custom-select">
          <option value=""></option>
          <option value="new">新しい順</option>
          <option value="old">古い順</option>
          <option value="allStock">ストックが多い順</option>
        </select>
      </div>
      <button type="submit" class="btn btn-search">並び替え</button>
      </form>
    </div>

    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach
    {{ $playlists->links() }}
  </div>
@endsection
