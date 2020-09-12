<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        @if ($user->image_path)
        <img src="{{ asset('storage/avatar/' . $user->image_path) }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
        @else
        <i class="fas fa-user-circle fa-3x"></i>
        @endif
      </a>
    </div>
    <h2 class="h5 card-title m-0">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        {{ $user->name }}
      </a>
    </h2>
  </div>
</div>
