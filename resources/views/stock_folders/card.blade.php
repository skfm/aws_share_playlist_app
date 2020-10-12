<div class="card mt-3 mb-3">
  <div class="card-body d-flex flex-row">
    <h3 class="h5 card-title mb-0 stockfolder-title">
      <a href="{{ route("stock_folders.show", ['stock_folder' => $stockFolder]) }}">
        {{ $stockFolder->name }}
      </a>
    </h3>

    <!-- dropdown -->
      <div class="ml-auto card-text">
        <div class="dropdown">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route("stock_folders.edit", ['stock_folder' => $stockFolder]) }}">
              <i class="fas fa-pen mr-1"></i>フォルダ名を変更する
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $stockFolder->id }}">
              <i class="fas fa-trash-alt mr-1"></i>フォルダを削除する
            </a>
          </div>
        </div>
      </div>
      <!-- dropdown -->

      <!-- modal -->
      <div id="modal-delete-{{ $stockFolder->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('stock_folders.destroy', ['stock_folder' => $stockFolder]) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ $stockFolder->name }}を削除します。よろしいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
  </div>
</div>
