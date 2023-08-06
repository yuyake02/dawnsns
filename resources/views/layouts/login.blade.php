<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!-- reset.css destyle -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!-- jQueryの読み込み -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <header>
        <div id="head">
            <h1><a href="/top"><img src="{{ asset('images/main_logo.png') }} "></a></h1>
            <img class="user_img" src="{{ asset('images/dawn.png') }}">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">{{ auth()->user()->username }}さん</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('top') }}">HOME</a>
                    <a class="dropdown-item" href="{{ route('profile') }}">プロフィール編集</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                </div>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>{{ auth()->user()->username }}さんの</p>
                <div class="following-count">
                    <p>フォロー数</p>
                    <p>{{ Auth::user()->getFollowingCount() }}名</p>
                </div>
                <p class="btn"><a href="{{ route('follow-list') }}">フォローリスト</a></p>
                <div class="followers-count">
                    <p>フォロワー数</p>
                    <p>{{ Auth::user()->getFollowersCount() }}名</p>
                </div>
                <div class="search">
                    <p class="btn"><a href="{{ route('follower-list') }}">フォロワーリスト</a></p>
                </div>
            </div>
            <p><a href="{{ route('users.search') }}">ユーザー検索</p>
        </div>
    </div>
    <footer>
    </footer>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
