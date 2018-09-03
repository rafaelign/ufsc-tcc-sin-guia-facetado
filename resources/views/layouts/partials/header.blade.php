<nav class="navbar is-white">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item brand-text" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Guia facetado logo" style="max-width: 120px;">
            </a>
            <div class="navbar-burger burger" data-target="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="{{ route('home') }}">
                    {{ __('Dashboard') }}
                </a>
                <a class="navbar-item" href="{{ route('classifications') }}">
                    {{ __('Classifications') }}
                </a>
                <a class="navbar-item" href="{{ route('users') }}">
                    {{ __('Users') }}
                </a>
                <a class="navbar-item" href="/app" target="_blank">
                    {{ __('Go to aplication') }}
                </a>
            </div>
            <div class="navbar-end">
                <a class="navbar-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>