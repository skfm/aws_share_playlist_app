@csrf
<div class="md-form">
  <input type="text" name="name" class="form-control" required value="{{ $stockfolder->name ?? old('name') }}" placeholder="フォルダ名を入力してください">
</div>
