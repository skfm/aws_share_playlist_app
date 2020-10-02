@csrf
@if ($icon === 1)
<div class="md-form">
  <input type="hidden" name="name" class="form-control" required value="{{ $user->name ?? old('name') }}">
</div>
<div class="md-form">
  <input type="file" name="image_path">
</div>
@else
<div class="md-form">
  <label>名前</label>
  <input type="text" name="name" class="form-control" required value="{{ $user->name ?? old('name') }}">
</div>
<div class="form-group">
  <label>プロフィール文章</label>
  <textarea name="description"  class="form-control" rows="16" placeholder="本文">{{ $user->description ?? old('description') }}</textarea>
</div>
<div class="md-form">
  <label>Instagram URL</label>
  <input type="text" name="insta_url" class="form-control" value="{{ $user->insta_url ?? old('insta_url') }}">
</div>
<div class="md-form">
  <label>YouTube URL</label>
  <input type="text" name="youtube_url" class="form-control" value="{{ $user->youtube_url ?? old('youtube_url') }}">
</div>
<div class="md-form">
  <label>Twitter URL</label>
  <input type="text" name="twitter_url" class="form-control" value="{{ $user->twitter_url ?? old('twitter_url') }}">
</div>
@endif
