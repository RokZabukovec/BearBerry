<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,900&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto  navbar-flex">
                    <div class="stores-nav-items">
                        @foreach(App\Store::all() as $store)
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" href="{{route('store', ['store'=> $store->id])}}"> {{ $store->name }}</a>
                            </li>
                        @endforeach
                    </div>
                <!-- Authentication Links -->
                    @guest
                        <div class="registration-nav-items">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </div>
                    @else
                        <div class="registration-nav-items">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="far fa-user-circle"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('cart')}}" class="nav-link"><i class="fas fa-shopping-cart"></i>
                                    ({{count(Auth::user()->cart->items)}})
                                </a>
                            </li>
                        </div>
                </ul>
                    </div>
                @endguest
            </div>
        </nav>
        @if(Auth::user() && Auth::user()->hasRole('administrator'))
            <nav class="navbar-admin">
                <ul id="admin-nav">
                    <a href="{{ route('store.create') }}"><li>Add store</li></a>
                    <a href="{{ route('item.create') }}"><li>Add items</li></a>
                    <a href="{{ route('categories.create') }}"><li>Add category</li></a>
                </ul>
            </nav>
        @endif
        <main class="py-5">
            @if(Session::has('message'))
                <div  class="alert alert-black alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 footer-brand">
                    <h5>{{ config('app.name', 'Laravel') }}</h5>
                </div>
                <div class="col-md-6 footer-links">
                    <ul>
                        <li>Contact us</li>
                        <li>Stores</li>
                        <li>Social networks</li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/de721581dd.js" crossorigin="anonymous"></script>
</body>
</html>
