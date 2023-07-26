<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">

        <!-- PWA  -->
        <meta name="theme-color" content="#6777ef"/>
        <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        @php
            include_once public_path() . '/images/site_sprite.svg';
        @endphp

        <!-- CSS grubber -->
        @stack('css')

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- Fa Icons CSS (CDN) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('css/app.css?v=' . time()) }}" />
    </head>

    <body>
        <div id="app" class="newdesign">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm newdesign-nav">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="me-2 mb-2" src="{{ asset('/images/logo.png') }}" width="30" height="30" />
                        {{ config('app.name', 'MyMoto') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('bike.index') }}">{{ __('Мой гараж') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('service.index') }}">{{ __('История ТО') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('article.index') }}">{{ __('Запчасти') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('note.index') }}">{{ __('Блокнот') }}</a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('client.index') }}">{{ __('Мой профиль') }}</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        <!-- Footer -->
        <footer class="text-center text-lg-start bg-light text-muted">
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </section>

            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <div class="row mt-3">
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">
                                MyMoto
                            </h6>
                            <p>
                                Это персональное приложение для ведения истории мотоцикла, разработанное как PWA
                                (Progressive Web Application) на основе Laravel.
                                <br /><br />
                                Актуальная версия приложения 1.0.1
                            </p>
                        </div>

                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">
                                Доступные модули
                            </h6>
                            <p>Мой гараж</p>
                            <p>История обслуживания</p>
                            <p>Каталог запчастей</p>
                            <p>Блокнот</p>
                        </div>

                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">
                                О хранении данных
                            </h6>
                            <p>Вы добровольно указываете свои персональные данные и данные технических средств</p>
                            <p>Вы согласны на хранение этих данных в БД сервиса</p>
                        </div>

                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">Контакты</h6>
                            <p><i class="fas fa-home me-3">Адрес: </i> Россия, Калининград, 236048</p>
                            <p><i class="fas fa-envelope me-3">Email:</i> alexandr.status@gmail.com</p>
                            <p><i class="fas fa-phone me-3">Тел.:</i> +7 911 487 7251</p>
                            <p><i class="fas fa-phone me-3">Trlrgram:</i> <a target="_blank" href="https://t.me/ASt39">@ASt39</a></p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2022-{{ date('Y', time()) }} Copyright:
                <a class="text-reset fw-bold" href="#">ASt Group</a>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

        <script>
            var token = '{{ csrf_token() }}';
        </script>

        <script type="text/javascript" src="{{ asset('/js/dselect.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/app.js?v=' . time()) }}"></script>

        <!-- JS grubber -->
        @stack('js')

        <script src="{{ asset('/sw.js') }}"></script>
        <script>
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/sw.js").then(function (reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
        </script>
    </body>
</html>
