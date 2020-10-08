@extends('app')

@section('title', 'ユーザー編集')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-3 userEdit">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('users.update', ['name' => $user->name]) }}" enctype='multipart/form-data'>
                @method('PATCH')
                @include('users.form')
                <button type="submit" class="btn _submit">更新する</button>
              </form>
            </div>
            <!-- dropdown -->
            <div class="ml-auto card-text userEdit-dropdown">
              <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $user->id }}">
                    <i class="fas fa-trash-alt mr-1"></i>退会する
                  </a>
                </div>
              </div>
            </div>
            <!-- dropdown -->

            <!-- modal -->
            <div id="modal-delete-{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="{{ route('users.destroy', ['name' => $user->name]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                      退会します。よろしいですか？
                    </div>
                    <div class="modal-footer justify-content-between">
                      <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                      <button type="submit" class="btn btn-danger">退会する</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- modal -->
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
