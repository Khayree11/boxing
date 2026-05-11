<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            COMBAT <span class="text-danger">ARENA</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('events*') ? 'active' : '' }}" href="#">EVENTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('fighters*') ? 'active' : '' }}" href="#">FIGHTERS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('fighters*') ? 'active' : '' }}" href="#">ABOUT</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-outline-danger btn-sm px-3" href="{{ route('admin.login') }}">ADMIN</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        background-color: rgba(10, 10, 10, 0.95);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding: 15px 0;
        backdrop-filter: blur(10px); /* Efek blur transparan modern */
    }
    .navbar-brand {
        font-family: 'Oswald', sans-serif;
        font-size: 1.5rem;
        letter-spacing: 1px;
    }
    .nav-link {
        font-family: 'Oswald', sans-serif;
        font-size: 1.1rem;
        margin: 0 10px;
        color: #bbb !important;
        transition: 0.3s;
    }
    .nav-link:hover, .nav-link.active {
        color: #fff !important;
        text-shadow: 0 0 8px rgba(255, 0, 0, 0.6);
    }
    .btn-outline-danger {
        font-family: 'Oswald', sans-serif;
        border-width: 2px;
        letter-spacing: 1px;
    }
</style>