@extends('app')

@section('title', $tag->hashtag)

@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body d-flex align-items-center justify-content-between">
        <h2 class="card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="card-text text-right">
          {{ $playlists->count() }}件
        </div>
      </div>
    </div>

    <div class="formResult mt-3">
      <form action="{{ route('tags.sort', [$tag->name])}}" method="post">
        {{ csrf_field()}}
        <input type="hidden" name="tag" value="{{ $tag->name }}">
        <div class="form-group">
          <label>並び順</label>
          <select name="sort" class="browser-default custom-select">
            <option value="" selected></option>
            <option value="new">新しい順</option>
            <option value="old">古い順</option>
            <option value="allstock">ストックが多い順</option>
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
