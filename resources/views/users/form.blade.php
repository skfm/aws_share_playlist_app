@csrf
<div class="md-form">
  <label>名前</label>
  <input type="text" name="name" class="form-control" required value="{{ $user->name ?? old('name') }}">
</div>
<div class="md-form">
  <input type="file" name="image_path">
</div>

