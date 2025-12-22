<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'User Dashboard')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<!-- Topbar -->
<div class="topbar py-2">
  <div class="container d-flex justify-content-between align-items-center">
    <div>
      <select>
        <option>Language</option>
        <option>English</option>
        <option>Bangla</option>
      </select>
      <select class="ms-2">
        <option>Currency</option>
        <option>USD</option>
        <option>BDT</option>
      </select>
    </div>

    <div>
      <i class="bi bi-twitter"></i>
      <i class="bi bi-google"></i>
      <i class="bi bi-instagram"></i>
      <i class="bi bi-facebook"></i>
    </div>
  </div>
</div>

<!-- Header Middle -->
<div class="header-middle">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-lg-2 text-center text-lg-start">
        <div class="logo">Safira</div>
      </div>

      <div class="col-lg-6">
        <form class="d-flex search-box mx-auto">
          <input type="text" class="form-control" placeholder="Search here...">
          <button class="btn"><i class="bi bi-search text-white"></i></button>
        </form>
      </div>

      <div class="col-lg-4">
        <div class="d-flex justify-content-lg-end align-items-center header-icons gap-3">

          {{-- Guest --}}
          @guest
            <a href="{{ route('login') }}">LOGIN</a>
            <a href="{{ route('register') }}">REGISTER</a>
          @endguest

          {{-- Auth User --}}
          @auth
            <div class="dropdown">
              <a class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-person-circle"></i>
                {{ Auth::user()->name }}
              </a>

              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2 me-1"></i> Dashboard
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <i class="bi bi-person me-1"></i> Profile
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger">
                      <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          @endauth

          <i class="bi bi-heart"></i>
          <i class="bi bi-cart"></i>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg main-nav">
  <div class="container align-items-end">

    <button class="category-btn me-4">
      <i class="bi bi-list"></i> All Categories
    </button>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mainMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainMenu">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Pages</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
      </ul>
    </div>

    <div class="support-box d-none d-lg-flex align-items-center ms-auto">
      <i class="bi bi-telephone me-2"></i>
      <div>
        <strong>(08) 23 456 789</strong><br>
        Customer Support
      </div>
    </div>

  </div>
</nav>

<!-- Main Content -->
<main class="py-4">
  @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
