<nav class="navbar navbar-expand navbar-dark">

  <a class="navbar-brand" href="/"><i class="fab fa-creative-commons-share mr-1"></i>SPY</a>

  <ul class="navbar-nav ml-auto">

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    @endguest

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest

    @auth
    <li class="nav-item">
      <a class="nav-link" href="{{ route('playlists.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li>
    @endauth

    <div class="search nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search"></i>
      </a>
      <div class="search-wrap dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <form action="{{ url('/playlists/search/tag')}}" method="post">
          {{ csrf_field()}}
          {{method_field('get')}}
          <div class="form-group p-3 search-tag">
            <label>タグ検索</label>
            <input type="text" class="form-control" placeholder="タグで検索" name="keyword">
            <select name="sort" class="browser-default custom-select">
              <option value="" selected></option>
              <option value="new">新しい順</option>
              <option value="old">古い順</option>
              <option value="allstock">ストックが多い順</option>
            </select>
          </div>
          <button type="submit" class="btn">検索</button>
        </form>

        <form action="{{ url('/playlists/search/title')}}" method="post">
          {{ csrf_field()}}
          {{method_field('get')}}
          <div class="form-group p-3 search-title">
            <label>タイトル検索</label>
            <input type="text" class="form-control" placeholder="タイトルで検索" name="keyword">
            <select name="sort" class="browser-default custom-select">
              <option value="" selected></option>
              <option value="new">新しい順</option>
              <option value="old">古い順</option>
              <option value="allstock">ストックが多い順</option>
            </select>
          </div>
          <button type="submit" class="btn">検索</button>
          </form>
      </div>
    </div>

    @auth
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("users.edit", ['name' => Auth::user()->name]) }}'">
          プロフィール編集
        </button>
        <div class="dropdown-divider"></div>
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("users.icon_edit", ['name' => Auth::user()->name]) }}'">
          アイコン編集
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
    <!-- Dropdown -->
    @endauth

  </ul>

</nav>
