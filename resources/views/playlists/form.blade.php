@csrf
<div class="form-group">
  <label>URL ID<span>(必須)</span></label>
  <input type="text" name="url" class="form-control" required value="{{ $playlist->url ?? old('url') }}">
  <small>※プレイリストの場合「https://www.youtube.com/playlist?list=PLB1PuqtbwVQnHvT_x4qkbTxSPa5」の「playlist?list=PLB1PuqtbwVQnHvT_x4qkbTxSPa5」</small><br>
  <small>※動画の場合「https://www.youtube.com/watch?v=MPbUaIZAaeA」の「watch?v=MPbUaIZAaeA」</small><br>
  <small>※いずれかのIDを入力してください</small>
</div>
<div class="form-group">
  <label>説明<span>(任意)</span></label>
  <textarea name="description" class="form-control" rows="6">{{ $playlist->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
  <playlist-tags-input
  :initial-tags='@json($tagNames ?? [])'
  :autocomplete-items='@json($allTagNames ?? [])'
  >
  </playlist-tags-input>
</div>
<div class="mb-3 category-form">
  <label>カテゴリー(該当するものがあれば選択)</label>
  <select name="category_id" class="form-control">
    <option value=""></option>
    <option value="1">プログラミング</option>
    <option value="2">副業</option>
    <option value="3">健康</option>
    <option value="4">美容</option>
    <option value="5">トレーニング</option>
    <option value="6">投資</option>
    <option value="7">恋愛</option>
    <option value="8">オモシロ動画</option>
  </select>
</div>
