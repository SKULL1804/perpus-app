<header id="header" class="fixed-top py-3">
    <div class="container d-flex align-items-center justify-content-lg-between">
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
            <li><a href="#about" class="nav-link scrollto active">About</a></li>
            <li class="dropdown">
                <a href="#"><span>Book</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                <li><a class="nav-link scrollto" href="#new">New Book Seller</a></li>
                <li><a class="nav-link scrollto" href="#best">Best Book Populer</a></li>
                </ul>
            </li>
            <li><a href="#kegiatan" class="nav-link scrollto">Kegiatan</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <h1 class="logo me-md-auto me-lg-0 me-auto">
            <a href="{{ url('/') }}">Perpustakaan <span>Nuris</span> <i class="bi bi-book-half"></i></a>
        </h1>
        <a href="{{ route('login') }}" class="login-btn mx-2">Login</a>
    </div>
</header>
