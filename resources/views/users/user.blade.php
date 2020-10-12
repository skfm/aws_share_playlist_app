<div class="card mt-3 pl-3 pr-3 userCard">
  <div class="card-body">
    <div class="d-flex flex-row align-items-center justify-content-between">
      <div class="title-wrap d-flex flex-row align-items-center">
        @if ($user->image_path)
        <img src="{{ asset('storage/avatar/' . $user->image_path) }}">
        @else
        <i class="fas fa-user-circle fa-3x"></i>
        @endif
        <h2 class="h5 card-title mb-0 ml-2">
          <a href="{{ route('users.show', ['name' => $user->name]) }}">
            {{ $user->name }}
          </a>
        </h2>
      </div>
      <div class="sns-wrap d-flex flex-row align-items-center">
        <a href="{{ $user->insta_url }}" type="button" class="btn-floating btn-small btn-insta" target="_blank"><i class="fab fa-instagram"></i></a>

        <a href="{{ $user->twitter_url }}" type="button" class="btn-floating btn-small btn-tw" target="_blank"><i class="fab fa-twitter"></i></a>

        <a href="{{ $user->youtube_url }}" type="button" class="btn-floating btn-small btn-youtube" target="_blank"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
    <p class="card-text mt-2">
      {{ $user->description }}
    </p>
  </div>
</div>
