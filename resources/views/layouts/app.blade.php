<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SimpleNote') }}</title>

    <!-- Scripts -->
    <script src="{{ '/js/app.js' }}" defer></script>
    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ '/css/app.css' }}" rel="stylesheet">
    <link href="{{ '/css/utility.css' }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- ↑を追加したらCSSが適応された -->
    <!-- vite(ビルドツール)を使用する宣言らしい・・・(laravel 6.0×) -->


    <!-- create.blade.phpのズレ調整用に設定 -->
    <style>
        .for-padding-ajustment {
            padding-left: 0 !important;
        }

        #delete-button {
            color: white;
        }
    </style>

    @yield('css')
</head>

<body>
    <div id="app" class="bg-dark bg-gradient text-white">
        <nav class="navbar navbar-expand-md navbar-light bg-primary bg-gradient shadow-sm">
            <div class="container">
                <a class="navbar-brand text-light " href="{{ url('/create') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler btn-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else

                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </ul>
                        </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main">
            <!-- 削除した時のアラート -->
            @if(session('success'))
            <div class="alert alert-danger" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="row" style='height: 92vh;'>
                <div class="col-md-2 p-0">
                    <div class="card  bg-dark text-white bg-gradient h-100">
                        <div class="card-header">タグ一覧</div>
                        <div class="card-body py-2 px-4">
                            <a class='d-block' href='/'>全て表示</a>
                            @foreach($tags AS $tag)
                            <div class="card mt-2 mb-2 bg-light bg-gradient">
                                <div class="card-body">
                                    <h5 class="card-title">{{$tag['created_at']}}</h5>
                                    <a href="/?tag={{$tag['name']}}">{{$tag['name']}}</a>
                                </div>
                            </div>
                            @endforeach
                            　　
                        </div>
                    </div>
                    　　
                </div>
                <div class="col-md-4  for-padding-ajustment">
                    <div class="card  bg-dark text-white bg-gradient h-100">
                        <!-- divの親をd-flex、子をms-auto、me-autoで両端に子要素を配置 -->
                        <div class="card-header d-flex">メモ一覧 <a class='ms-auto' href='/create'><i class="fas fa-plus-circle"></i></a></div>
                        <div class="card-body p-2">
                            <!-- 一覧の内容表示 -->
                            <!-- タイムスタンプ＋内容 -->
                            @foreach($memos AS $memo)
                            <div class="card mt-2 mb-2 bg-light bg-gradient">
                                <div class="card-body">
                                    <h5 class="card-title">{{$memo['created_at']}}</h5>
                                    <a href="/edit/{{$memo['id']}}">{{$memo['content']}}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> <!-- col-md-3 -->
                <div class="col-md-6 p-0">
                    @yield('content')
                </div>
            </div> <!-- row justify-content-center -->
        </main>
    </div>
    @yield('footer')
</body>

</html>