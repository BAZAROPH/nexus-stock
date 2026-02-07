<!--
=========================================================
* Soft UI Dashboard 3 - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/js/app.js', 'resources/css/app.css'])
        @endif
        <title>@yield("title", " - ". env('APP_NAME'))</title>
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://demos.creative-tim.com/test/soft-ui-dashboard-pro/assets/css/soft-ui-dashboard.min.css?v=1.0.0">
        <!-- Font Awesome Icons -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/brands.min.js" integrity="sha512-1oGeXc5l4herTE3V53KHlBbraV/KLHfpqCNjqhT/A6xcxXXhZa+TaXRKDMn/cCXWfWyo+JheaQDcd0n1HTLkkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.1.0') }}" rel="stylesheet" />
        <!-- Nepcha Analytics (nepcha.com) -->
        <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
        <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    </head>

    <body class="g-sidenav-show bg-gray-100">
        <aside
            class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
            id="sidenav-main"
        >
            <div class="sidenav-header">
                <i
                    class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                    aria-hidden="true"
                    id="iconSidenav"
                ></i>
                <a
                    class="navbar-brand m-0"
                    href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html "
                    target="_blank"
                >
                    <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo" />
                    <span class="ms-1 font-weight-bold">{{ env('APP_NAME') }}</span>
                </a>
            </div>
            <hr class="horizontal dark mt-0" />
            <div class="w-auto" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{route('dashboard')}}">
                            <div
                                class="text-center icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                                <i class="fa-solid fa-gauge-high text-sm @if(request()->routeIs('dashboard')) text-white @else text-dark @endif"></i>
                            </div>
                            <span class="nav-link-text ms-1">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('users.index')) active @endif" href="{{route('users.index')}}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                                <i class="fa-solid fa-users text-sm @if(request()->routeIs('users.index')) text-white @else text-dark @endif"></i>
                            </div>
                            <span class="nav-link-text ms-1">Utilisateurs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('stocks.index')) active @endif" href="{{route('stocks.index')}}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                                <i class="fa-solid fa-layer-group text-sm @if(request()->routeIs('stocks.index')) text-white @else text-dark @endif"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestion de stock</span>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('stock_types.index')) active @endif" href="{{route('stock_types.index')}}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                                <i class="fa-solid fa-tags text-sm @if(request()->routeIs('stock_types.index')) text-white @else text-dark @endif"></i>
                            </div>
                            <span class="nav-link-text ms-1">Catégories de stock</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('allocations.index')) active @endif" href="{{ route('allocations.index') }}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                                <i class="fa-solid fa-person-walking-luggage text-sm @if(request()->routeIs('allocations.index')) text-white @else text-dark @endif"></i>
                            </div>
                            <span class="nav-link-text ms-1">Dotations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('workers.index')) active @endif" href="{{route('workers.index')}}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                                <i class="fa-solid fa-children text-sm @if(request()->routeIs('workers.index')) text-white @else text-dark @endif"></i>
                            </div>
                            <span class="nav-link-text ms-1">Effectif</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Paramètres</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('worker_types.index')) active @endif" href="{{route('worker_types.index')}}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                                <i class="fa-solid fa-person-burst text-sm text-dark @if(request()->routeIs('worker_types.index')) text-white @else text-dark @endif"></i>
                            </div>
                            <span class="nav-link-text ms-1">Types d'agent</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('roles.index')) active @endif" href="{{route('roles.index')}}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                                <i class="fa-solid fa-user-shield text-sm @if(request()->routeIs('roles.index')) text-white @else text-dark @endif"></i>
                            </div>
                            <span class="nav-link-text ms-1">Rôles</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('permissions.index')) active @endif" href="{{route('permissions.index')}}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                                <i class="fa-solid fa-key text-sm @if(request()->routeIs('permissions.index')) text-white @else text-dark @endif"></i>
                            </div>
                            <span class="nav-link-text ms-1">Permissions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('sites.index')) active @endif" href="{{route('sites.index')}}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center"
                            >
                                <i class="fa-solid fa-train text-sm @if(request()->routeIs('sites.index')) text-white @else text-dark @endif"></i>
                            </div>
                            <span class="nav-link-text ms-1">Sites</span>
                        </a>
                    </li>

                </ul>
            </div>
        </aside>

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
            <!-- Navbar -->
            <nav
                class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
                id="navbarBlur"
                navbar-scroll="true"
            >
                <div class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            @yield("breadcrumbs")
                        </ol>
                        <h6 class="font-weight-bolder mb-0">@yield("title")</h6>
                    </nav>
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"
                                    ><i class="fas fa-search" aria-hidden="true"></i
                                ></span>
                                <input type="text" class="form-control" placeholder="Type here..." />
                            </div>
                        </div>
                        <ul class="navbar-nav justify-content-end">
                            <li class="nav-item d-flex align-items-center">
                                <a
                                    class="btn btn-outline-danger btn-sm mb-0 me-3"
                                    href="{{route('logout')}}"
                                    >Déconnexion</a
                                >
                            </li>
                            <li class="nav-item d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                                    <i class="fa fa-user me-sm-1"></i>
                                    <span class="d-sm-inline d-none">{{ Auth::user()->first_name }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </main>

        <!--   Core JS Files   -->
        <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
        <script>
            var win = navigator.platform.indexOf("Win") > -1;
            if (win && document.querySelector("#sidenav-scrollbar")) {
                var options = {
                    damping: "0.5",
                };
                Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
            }
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{asset('assets/js/soft-ui-dashboard.min.js?v=1.1.0')}}"></script>
    </body>
</html>
