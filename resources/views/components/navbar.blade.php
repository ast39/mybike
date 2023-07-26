<section class="ppss-navbar" data-risk_navbar>
    <!-- Логотип -->
    <a href="{{ url('/') }}" class="ppss-navbar__one logoico">
        <svg class=""><use xlink:href="#site-logo2"></use></svg>
    </a>

    <div class="ppss-navbar__one">
        <!-- Меню -->
        <div class="ppss-navbar__plank ppss-navbar__sandwichlist" data-risk_navbar_sandwichlist_child>
            @auth
                <div class="ppss-navbar__list">
                    <a class="ppss-navbar__plank__link {{ (request()->route()->getName() == 'client.show') ? 'select' : '' }}" href="{{ route('client.show') }}">{{ __('Мой профиль') }}</a>
                </div>

                <div class="ppss-navbar__list">
                    <a class="ppss-navbar__plank__link {{ (request()->route()->getName() == 'bike.show') ? 'select' : '' }}" href="{{ route('bike.index') }}">{{ __('Мой гараж') }}</a>
                </div>

                <div class="ppss-navbar__list">
                    <a class="ppss-navbar__plank__link {{ (request()->route()->getName() == 'catalog.show') ? 'select' : '' }}" href="{{ route('catalog.index') }}">{{ __('Запчасти') }}</a>
                </div>

                <div class="ppss-navbar__list">
                    <a class="ppss-navbar__plank__link {{ (request()->route()->getName() == 'notes.show') ? 'select' : '' }}" href="{{ route('notes.index') }}">{{ __('Мой блокнот') }}</a>
                </div>
            @else
                <div class="ppss-navbar__list">
                    <a class="ppss-navbar__plank__link {{ (request()->route()->getName() == 'login') ? 'select' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                </div>
            @endguest
        </div>

        <div class="ppss-navbar__plank">
            <!-- Бутерброд -->
            <div class="ppss-navbar__list menu">
                <div class="ppss-navbar__plank__link" data-risk_navbar_sandwichlist_parent><svg class="ppss-navbar__menu ppss-navbar__ico"><use xlink:href="#site-menu"></use></svg></div>
            </div>

            <!-- Authentication Links -->
            @auth
                <div class="ppss-navbar__list" data-risk_navbar_one>
                    <div class="ppss-navbar__plank__link usericopoint" href="#" data-risk_navbar_parent>
                        <svg class="ppss-navbar__user"><use xlink:href="#site-user"></use></svg>
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="ppss-navbar__arrow ppss-navbar__ico"><use xlink:href="#site-arrow"></use></svg>
                    </div>

                    <div class="ppss-navbar__list__child userico right hide" data-risk_navbar_child>
                        <a href="{{ route('logout') }}" class="ppss-navbar__list__child__one" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</section>
