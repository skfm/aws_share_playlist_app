@if ($errors->any())
  <div class="card-text text-left alert alert-danger mt-3 validation">
    <ul class="mb-0 validation-list">
      @foreach($errors->all() as $error)
        <li class="validation-item">{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
