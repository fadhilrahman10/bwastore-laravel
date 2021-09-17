<nav
    class="
        navbar navbar-expand-lg navbar-light navbar-store
        fixed-top
        navbar-fixed-top
    "
    data-aos="fade-down">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/images/logo.svg" alt="" />
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('categories*')  ? 'active' : ''}}" href="/categories"
                        >Categories</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Rewards</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/register"
                            >Sign Up</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="btn btn-success nav-link px-4 text-white"
                            href="/login"
                            >Sign In</a
                        >
                    </li>
                @endguest
            </ul>
            @auth
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <img
                            src="/images/icon-user.png"
                            alt=""
                            class="rounded-circle mr-2 profile-picture"
                            />
                            Hi, {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/dashboard">Dashboard</a>
                            <a class="dropdown-item" href="/dashboard/settings"
                            >Settings</a
                            >
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        @php
                            $carts = \App\Models\Cart::where('user_id', auth()->user()->id)->count();
                        @endphp
                        <a class="nav-link d-inline-block mt-2" href="/cart">
                            @if ($carts > 0)
                            <img src="/images/icon-cart-filled.svg" alt="" />
                            <div class="cart-badge">{{ $carts }}</div>
                            @else
                            <img src="/images/icon-cart-empty.svg" alt="" />
                            @endif
                        </a>
                    </li>
                </ul>
            @endauth

        </div>
    </div>
</nav>
