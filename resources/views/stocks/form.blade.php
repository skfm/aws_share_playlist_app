@csrf
<div class="form-group mt-3">
  <label>フォルダー</label>
  <select name="stock_folder_id" class="form-control">
    <option value="">フォルダを選んでください</option>
    @foreach($stockFolders as $stockFolder)
      <option value="{{ $stockFolder->id }}">{{ $stockFolder->name }}</option>
    @endforeach
  </select>
</div>
