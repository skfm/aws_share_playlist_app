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
