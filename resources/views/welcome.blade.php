<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'E-Commerce')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
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
  <div class="header-middle">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-lg-2 text-center text-lg-start">
          <div class="logo">E-Commerce</div>
        </div>

        <div class="col-lg-6">
          <form class="d-flex search-box mx-auto">
            <input type="text" class="form-control" placeholder="Search here...">
            <button class="btn"><i class="bi bi-search text-white"></i></button>
          </form>
        </div>

        <div class="col-lg-4">
          <div class="d-flex justify-content-lg-end align-items-center header-icons">
            <a href="{{ route('login') }}" class="me-2"> LOGIN</a>
            <a href="{{ route('register') }}" class="me-2">REGISTER</a>
            <i class="bi bi-heart"></i>
            <i class="bi bi-cart"></i>
          </div>
        </div>

      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg main-nav">
    <div class="container align-items-end">
      <div class="dropdown me-4">
        <button class="btn category-btn dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="bi bi-list"></i> All Categories
        </button>
        <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
          @foreach($categoryList as $category)
            <li>
              <select class="form-control" name="" id="">
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
              </select>
          
            </li>
          @endforeach
        </ul>
      </div>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mainMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainMenu">
        <ul class="navbar-nav gap-3">
          <li class="nav-item"><a class="nav-link" href="">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="">Shop</a></li>
          <li class="nav-item"><a class="nav-link" href="">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="">Pages</a></li>
          <li class="nav-item"><a class="nav-link" href="">Contact Us</a></li>
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
  <main class="py-4">
    <div class="container">
      <h1 class="text-center m-3">New Products</h1>


      <div class="row">
        @foreach($products as $product)
          <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 d-flex flex-column">

              <!-- Product Images -->
              @if($product->getMedia('product_images')->isNotEmpty())
                <div id="carousel-{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    @foreach($product->getMedia('product_images') as $key => $image)
                      <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ $image->getUrl() }}" class="d-block w-100 product-img"
                          alt="{{ $product->product_name }}">
                      </div>
                    @endforeach
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $product->id }}"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $product->id }}"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              @else
                <img src="https://via.placeholder.com/300x200" alt="No Image" class="product-img">
              @endif

              <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $product->product_name }}</h5>

                <div class="price-block mb-2">
                  <span class="current-price fw-bold text-danger">${{ $product->price }}</span>
                  @if($product->previous_price)
                    <span
                      class="previous-price text-muted text-decoration-line-through">${{ $product->previous_price }}</span>
                  @endif
                </div>

                <p class="mt-auto category-text">{{ $categories[$product->id]->category_name ?? 'Uncategorized' }}</p>
              </div>

              <div class="d-flex justify-content-center m-3">
                <a href="#" class="btn btn-success rounded-pill px-5">
                  <i class="bi bi-cart-plus me-1"></i> Add to Cart
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </main>

  <footer class="bg-dark text-light pt-5 pb-4">
    <div class="container">
      <div class="row">

        <div class="col-12 col-md-3 mb-4">
          <h5 class="text-uppercase mb-3">MyShop</h5>
          <p>Your one-stop shop for all products. Quality items at best prices.</p>
        </div>

        <div class="col-6 col-md-2 mb-4">
          <h6 class="text-uppercase mb-3">Quick Links</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light text-decoration-none">Home</a></li>
            <li><a href="#" class="text-light text-decoration-none">Shop</a></li>
            <li><a href="#" class="text-light text-decoration-none">About Us</a></li>
            <li><a href="#" class="text-light text-decoration-none">Contact</a></li>
          </ul>
        </div>
        <div class="col-6 col-md-3 mb-4">
          <h6 class="text-uppercase mb-3">Customer Service</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light text-decoration-none">FAQ</a></li>
            <li><a href="#" class="text-light text-decoration-none">Returns</a></li>
            <li><a href="#" class="text-light text-decoration-none">Shipping</a></li>
            <li><a href="#" class="text-light text-decoration-none">Terms & Conditions</a></li>
          </ul>
        </div>
        <div class="col-12 col-md-4 mb-4">
          <h6 class="text-uppercase mb-3">Contact Us</h6>
          <p><i class="bi bi-geo-alt-fill me-2"></i>123 Main Street, Dhaka, Bangladesh</p>
          <p><i class="bi bi-telephone-fill me-2"></i>+880 XXXXXXXXX</p>
          <p><i class="bi bi-envelope-fill me-2"></i>support@myshop.com</p>
          <div class="mt-3">
            <a href="#" class="text-light me-3"><i class="bi bi-facebook fs-5"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-twitter fs-5"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-instagram fs-5"></i></a>
            <a href="#" class="text-light"><i class="bi bi-youtube fs-5"></i></a>
          </div>
        </div>

      </div>
      <hr class="mt-4 mb-3 border-light">

      <div class="row">
        <div class="col-12 text-center">
          <p class="mb-0">&copy; 2025 E-Commerce. All rights reserved.</p>
        </div>
      </div>

    </div>
  </footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>