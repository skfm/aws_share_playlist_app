@csrf
<div class="md-form">
  <input type="text" name="title" class="form-control" required value="{{ $playlist->title ?? old('title') }}" placeholder="タイトルを入力してください">
</div>
<div class="form-group">
  <playlist-tags-input
  :initial-tags='@json($tagNames ?? [])'
  :autocomplete-items='@json($allTagNames ?? [])'
  >
  </playlist-tags-input>
</div>
<div class="form-group">
  <label></label>
  <textarea name="description" required class="form-control" rows="10" placeholder="本文">{{ $playlist->description ?? old('description') }}</textarea>
</div>
<div class="md-form">
  <input type="text" name="url" class="form-control" required value="{{ $playlist->url ?? old('url') }}" placeholder="youtubeのプレイリストURLを入力してください">
</div>
<div class="mb-3 category-form">
  <label>カテゴリー(該当するものがなければ未選択可)</label>
  <select name="category_id" class="form-control">
    <option value=""></option>
    <option value="1">プログラミング</option>
    <option value="2">お金</option>
    <option value="3">健康</option>
    <option value="4">美容</option>
  </select>
</div>
