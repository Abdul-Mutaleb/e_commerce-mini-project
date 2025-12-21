<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Commerce</title>
    <link href="{{ asset('Admin/assets/vendor/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/assets/vendor/fontawesome/css/solid.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/assets/vendor/fontawesome/css/brands.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/assets/css/master.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/assets/vendor/flagiconcss/css/flag-icon.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <h2 class="text-secondary ">E-commerce</h2>
            </div>
            <ul class="list-unstyled components text-secondary">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" @class(['nav-link', 'active' => request()->routeIs('dashboard'), 'text-secondary'])>
                        <i class="fas fa-home"></i>Admin Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" href="#categoryMenu">
                        <span><i class="fas fa-table"></i> Category</span>
                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse {{ request()->routeIs('Admin.category*') ? 'show' : '' }}" id="categoryMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a href="{{ route('Admin.category') }}" @class(['nav-link', 'active' => request()->routeIs('Admin.category'), 'text-secondary'])>
                                    <i class="fas fa-plus"></i> Add Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('Admin.categoryList') }}" @class(['nav-link', 'active' => request()->routeIs('Admin.categoryList'), 'text-secondary'])>
                                    <i class="fas fa-list-ul"></i> Category List
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Product  -->
                <li class="nav-item">
                    <a class="nav-link text-secondary d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" href="#productMenu">
                        <span><i class="fas fa-box"></i> Product</span>
                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse {{ request()->routeIs('Admin.addProduct*') || request()->routeIs('Admin.productList*') ? 'show' : '' }}"
                        id="productMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a href="{{ route('Admin.addProduct') }}" @class(['nav-link', 'active' => request()->routeIs('Admin.addProduct'), 'text-secondary'])>
                                    <i class="fas fa-plus"></i> Add Product
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('Admin.productList') }}" @class(['nav-link', 'active' => request()->routeIs('Admin.productList'), 'text-secondary'])>
                                    <i class="fas fa-list-ul"></i> Product List
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div id="body" class="active">
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary"
                                    data-bs-toggle="dropdown">
                                    <i class="fas fa-user"></i> <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                                    <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        <div class="dropdown-divider"></div>
                                        <!-- Logout -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="container py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('Admin/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/vendor/chartsjs/Chart.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/dashboard-charts.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/script.js') }}"></script>
</body>

</html>