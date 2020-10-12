@csrf
<div class="md-form">
  <label>フォルダー</label>
  <select name="stock_folder_id" class="form-control">
    @foreach($stockFolders as $stockFolder)
      <option value="{{ $stockFolder->id }}">{{ $stockFolder->name }}</option>
    @endforeach

  </select>
</div>
