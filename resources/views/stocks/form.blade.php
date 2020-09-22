@csrf
<div class="md-form">
  <label>フォルダー</label>
  <select name="stock_folder_id" class="form-control">
    @foreach($stock_folders as $stock_folder)
      <option value="{{ $stock_folder->id }}">{{ $stock_folder->name }}</option>
    @endforeach

  </select>
</div>
