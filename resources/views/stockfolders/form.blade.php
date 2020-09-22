@csrf
<div class="md-form">
  <label>フォルダ名</label>
  <input type="text" name="name" class="form-control" required value="{{ $stockfolder->name ?? old('name') }}">
</div>
