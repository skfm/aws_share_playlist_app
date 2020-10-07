<ul class="userTab nav nav-tabs nav-justified mt-3">
  <li class="nav-item">
    <a class="nav-link {{ $hasPlaylists ? 'active' : '' }}"
       href="{{ route('users.show', ['name' => $user->name]) }}">
      記事
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $hasStocks ? 'active' : '' }}"
       href="{{ route('users.stocks', ['name' => $user->name]) }}">
      いいね
    </a>
  </li>
</ul>
