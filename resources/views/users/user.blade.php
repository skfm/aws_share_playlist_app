<div class="card mt-3 pl-3 pr-3">
  <div class="card-body pb-0">
    <div class="d-flex flex-row align-items-center justify-content-between">
      <div class="title-wrap d-flex flex-row align-items-center">
        @if ($user->image_path)
        <img src="{{ asset('storage/avatar/' . $user->image_path) }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
        @else
        <i class="fas fa-user-circle fa-3x"></i>
        @endif
        <h2 class="h5 card-title mb-0 ml-2">
          <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            {{ $user->name }}
          </a>
        </h2>
      </div>
      <div class="sns-wrap d-flex flex-row align-items-center">
        <a href="{{ $user->insta_url }}" type="button" class="btn-floating btn-small btn-instas"><i class="fab fa-instagram"></i></a>

        <a href="{{ $user->twitter_url }}" type="button" class="btn-floating btn-small btn-tw"><i class="fab fa-twitter"></i></a>

        <a href="{{ $user->youtube_url }}" type="button" class="btn-floating btn-small btn-youtube"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
    <p class="card-text mt-2">
      {{ $user->description }}
    </p>
  </div>
</div>
