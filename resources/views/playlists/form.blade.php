@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $playlist->title ?? old('title') }}">
</div>
<div class="form-group">
  <label></label>
  <textarea name="description" required class="form-control" rows="16" placeholder="本文">{{ $playlist->description ?? old('description') }}</textarea>
</div>
<div class="md-form">
  <label>YouTubeのプレイリストURL</label>
  <input type="text" name="url" class="form-control" required value="{{ $playlist->url ?? old('url') }}">
</div>
<div class="md-form">
  <label>カテゴリー</label>
  <select name="category_id" class="form-control">
    <option value="">選択肢</option>
    <option value="1">プログラミング</option>
    <option value="2">お金</option>
    <option value="3">健康</option>
    <option value="4">美容</option>
  </select>
</div>
