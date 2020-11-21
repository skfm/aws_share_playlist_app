@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')

  <div class="container mt-3 pb-3">
    <div class="card resultNumber">
      <div class="card-body d-flex align-items-center justify-content-between">
        <h2 class="card-title m-0 resultNumber-tilte">タグ検索結果：<span>{{ $keyword }}</span></h2>
        <div class="card-text text-right resultNumber-number">
          {{ $playlists->count() }}件
        </div>
      </div>
    </div>

    <div class="formResult mt-3">
      <form action="{{ url('/playlists/search/tag')}}">
        {{ csrf_field()}}
        {{method_field('get')}}
        <div class="form-group">
          <label>名前</label>
          <input type="text" value="{{ $keyword }}" class="form-control" placeholder="タグで検索" name="keyword">
        </div>
        <div class="form-group">
          <label>並び順</label>
          <select name="sort" class="browser-default custom-select">
            <option value="" selected></option>
            <option value="new">新しい順</option>
            <option value="old">古い順</option>
            <option value="allstock">ストックが多い順</option>
          </select>
        </div>
        <button type="submit" class="btn btn-search">検索</button>
      </form>
    </div>

    @foreach($playlists as $playlist)
      @include('playlists.card')
    @endforeach
    {{ $playlists->links() }}
  </div>
@endsection
