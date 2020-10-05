@csrf
<div class="md-form">
  <input type="text" name="name" class="form-control" required value="{{ $stockfolder->name ?? old('name') }}">
</div>
