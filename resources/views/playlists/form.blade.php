@csrf
<div class="md-form">
  <input type="text" name="title" class="form-control" required value="{{ $playlist->title ?? old('title') }}">
  <label>タイトル</label>
</div>
<div class="form-group">
  <playlist-tags-input
  :initial-tags='@json($tagNames ?? [])'
  :autocomplete-items='@json($allTagNames ?? [])'
  >
  </playlist-tags-input>
</div>
<div class="form-group">
  <label>プレイリストの説明</label>
  <textarea name="description" required class="form-control" rows="10">{{ $playlist->description ?? old('description') }}</textarea>
</div>
<div class="md-form">
  <input type="text" name="url" class="form-control" required value="{{ $playlist->url ?? old('url') }}">
  <label>youtubeのプレイリストURL</label>
</div>
<div class="mb-3 category-form">
  <label>カテゴリー(該当するものがなければ未選択可)</label>
  <select name="category_id" class="form-control">
    <option value=""></option>
    <option value="1">プログラミング</option>
    <option value="2">副業</option>
    <option value="3">健康</option>
    <option value="4">美容</option>
    <option value="5">トレーニング</option>
    <option value="6">投資</option>
    <option value="7">恋愛</option>
    <option value="8">オモシロ動画</option>
  </select>
</div>
