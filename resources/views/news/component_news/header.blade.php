<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- SEO --}}
        <title>{{ $title }}</title>
        <meta name="description" content="{{ $description }}">
        <meta name="keywords" content="майстри, замовники, ремонт, будівництво, послуги, портфоліо, Zroby_Sam">
        <meta name="author" content="Zroby_Sam">

        {{-- Open Graph --}}
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ $description }}">
        <meta property="og:image" content="{{ asset('images/logo.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="Zroby_Sam">

        {{-- Twitter Card --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="{{ $description }}">
        <meta name="twitter:image" content="{{ asset('images/logo.png') }}">

        {{-- JSON-LD Structured Data --}}
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "Zroby_Sam",
          "url": "{{ url('/') }}",
          "logo": "{{ asset('images/logo.png') }}",
          "sameAs": [
            "https://facebook.com/yourpage",
            "https://twitter.com/yourpage",
            "https://github.com/yourpage"
          ]
        }
        </script>

        {{-- CSRF --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Favicon --}}
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
        <meta name="theme-color" content="#ffffff">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('assets/news/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/news/assets/css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/news/assets/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/news/assets/css/magnific-popup.css') }}"> {{-- тут было .cs --}}
        <link rel="stylesheet" href="{{ asset('assets/news/assets/css/line-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/news/assets/css/main.css') }}">
    </head>
<body>

<!--==================== Preloader Start ====================-->
 {{-- <div class="loader-mask">
  <div class="loader">
      <div></div>
      <div></div>
  </div>
</div> --}}
<!--==================== Preloader End ====================-->

<!--==================== Overlay Start ====================-->
<div class="overlay"></div>
<!--==================== Overlay End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

<!-- ==================== Scroll to Top End Here ==================== -->
<div class="progress-wrap">
  <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
  </svg>
</div>
<!-- ==================== Scroll to Top End Here ==================== -->

<!-- ==================== Mobile Menu Start Here ==================== -->
<div class="mobile-menu d-lg-none d-block">
    <button type="button" class="close-button"> <i class="las la-times"></i> </button>
    <div class="mobile-menu__inner">
        <a href="index.html" class="mobile-menu__logo">
            <img src="images/logo.png" alt="Logo">
        </a>
        <div class="mobile-menu__menu">

<ul class="nav-menu flx-align nav-menu--mobile">
    <li class="nav-menu__item has-submenu">
        <a href="javascript:void(0)" class="nav-menu__link">Головна</a>
        <ul class="nav-submenu">
            <li class="nav-submenu__item">
                <a href="{{ route('home') }}" class="nav-submenu__link"> Головна</a>
            </li>
            <li class="nav-submenu__item">
                <a href="{{ route('dashboard') }}" class="nav-submenu__link"> Дошка оголошень</a>
            </li>
        </ul>
    </li>
    {{-- <li class="nav-menu__item has-submenu">
        <a href="javascript:void(0)" class="nav-menu__link">Products</a>
         <ul class="nav-submenu">
            <li class="nav-submenu__item">
                <a href="all-product.html" class="nav-submenu__link"> All Products</a>
            </li>
            <li class="nav-submenu__item">
                <a href="product-details.html" class="nav-submenu__link"> Product Details</a>
            </li>
        </ul>
    </li> --}}
    {{-- <li class="nav-menu__item has-submenu">
        <a href="javascript:void(0)" class="nav-menu__link">Pages</a>
         <ul class="nav-submenu">
            <li class="nav-submenu__item">
                <a href="profile.html" class="nav-submenu__link"> Profile</a>
            </li>
            <li class="nav-submenu__item">
                <a href="cart.html" class="nav-submenu__link"> Shopping Cart</a>
            </li>
            <li class="nav-submenu__item">
                <a href="cart-personal.html" class="nav-submenu__link"> Mailing Address</a>
            </li>
            <li class="nav-submenu__item">
                <a href="cart-payment.html" class="nav-submenu__link"> Payment Method</a>
            </li>
            <li class="nav-submenu__item">
                <a href="cart-thank-you.html" class="nav-submenu__link"> Preview Order</a>
            </li>
            <li class="nav-submenu__item">
                <a href="dashboard.html" class="nav-submenu__link"> Dashboard</a>
            </li>
        </ul>
    </li> --}}
    <li class="nav-menu__item has-submenu">
        <a href="javascript:void(0)" class="nav-menu__link">Новини</a>
         <ul class="nav-submenu">
            <li class="nav-submenu__item">
                <a href="/news?category=1" class="nav-submenu__link"> Будівництво та ремонт</a>
            </li>
            <li class="nav-submenu__item">
                <a href="/news?category=2" class="nav-submenu__link"> Краса</a>
            </li>
        </ul>
    </li>
</ul>
            <div class="header-right__inner d-lg-none my-3 gap-1 d-flex flx-align">

    @if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        @auth
            <a
                href="{{ url('/dashboard') }}"
                class="btn btn-main pill"
            >
                Дошка оголошень
            </a>
        @else
            <a
                href="{{ route('login') }}"
                class="btn btn-main pill"
            >
                Увійти
            </a>

            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="btn btn-main pill"
                >
                    Зареєструватись
                </a>
            @endif
        @endauth
    </nav>
@endif
    {{-- <div class="language-select flx-align select-has-icon">
        <img src="assets/images/icons/globe.svg" alt="" class="globe-icon">
        <select class="select py-0 ps-2 border-0 fw-500">
            <option value="1">Eng</option>
            <option value="2">Bn</option>
            <option value="3">Eur</option>
            <option value="4">Urd</option>
        </select>
    </div> --}}
            </div>
        </div>
    </div>
</div>
<!-- ==================== Mobile Menu End Here ==================== -->

<!-- ==================== Header Start Here ==================== -->
<header class="header">
    <div class="container container-full">
        <nav class="header-inner flx-between">
            <!-- Logo Start -->
            <div class="logo">
                <a href="index.html" class="link">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" width="90" height="90">
                </a>
            </div>
            <!-- Logo End  -->

            <!-- Menu Start  -->
            <div class="header-menu d-lg-block d-none">

<ul class="nav-menu flx-align ">
    <li class="nav-menu__item has-submenu">
        <a href="javascript:void(0)" class="nav-menu__link">Головна</a>
        <ul class="nav-submenu">
            <li class="nav-submenu__item">
                <a href="{{ route('home') }}" class="nav-submenu__link"> Головна</a>
            </li>
            <li class="nav-submenu__item">
                <a href="{{ route('dashboard') }}" class="nav-submenu__link"> Дошка оголошень</a>
            </li>
        </ul>
    </li>
    {{-- <li class="nav-menu__item has-submenu">
        <a href="javascript:void(0)" class="nav-menu__link">Products</a>
         <ul class="nav-submenu">
            <li class="nav-submenu__item">
                <a href="all-product.html" class="nav-submenu__link"> All Products</a>
            </li>
            <li class="nav-submenu__item">
                <a href="product-details.html" class="nav-submenu__link"> Product Details</a>
            </li>
        </ul>
    </li>
    <li class="nav-menu__item has-submenu">
        <a href="javascript:void(0)" class="nav-menu__link">Pages</a>
         <ul class="nav-submenu">
            <li class="nav-submenu__item">
                <a href="profile.html" class="nav-submenu__link"> Profile</a>
            </li>
            <li class="nav-submenu__item">
                <a href="cart.html" class="nav-submenu__link"> Shopping Cart</a>
            </li>
            <li class="nav-submenu__item">
                <a href="cart-personal.html" class="nav-submenu__link"> Mailing Address</a>
            </li>
            <li class="nav-submenu__item">
                <a href="cart-payment.html" class="nav-submenu__link"> Payment Method</a>
            </li>
            <li class="nav-submenu__item">
                <a href="cart-thank-you.html" class="nav-submenu__link"> Preview Order</a>
            </li>
            <li class="nav-submenu__item">
                <a href="dashboard.html" class="nav-submenu__link"> Dashboard</a>
            </li>
        </ul>
    </li> --}}
    <li class="nav-menu__item has-submenu">
        <a href="javascript:void(0)" class="nav-menu__link">Категорії</a>
         <ul class="nav-submenu">
            <li class="nav-submenu__item">
                <a href="/news?category=1" class="nav-submenu__link"> Будівництво та ремонт</a>
            </li>
            <li class="nav-submenu__item">
                <a href="/news?category=2" class="nav-submenu__link"> Краса</a>
            </li>
        </ul>
    </li>
</ul>
            </div>
            <!-- Menu End  -->

            <!-- Header Right start -->
            <div class="header-right flx-align">
    {{-- <a href="cart.html" class="header-right__button cart-btn position-relative">
        <img src="assets/images/icons/cart.svg" alt="">
        <span class="qty-badge font-12">0</span>
    </a> --}}
    <div class="header-right__inner gap-3 flx-align d-lg-flex d-none">

    @if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        @auth
            <a
                href="{{ url('/dashboard') }}"
                class="btn btn-main pill"
            >
                Дошка оголошень
            </a>
        @else
            <a
                href="{{ route('login') }}"
                class="btn btn-main pill"
            >
                Увійти
            </a>

            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="btn btn-main pill"
                >
                    Зареєструватись
                </a>
            @endif
        @endauth
    </nav>
@endif
    {{-- <div class="language-select flx-align select-has-icon">
        <img src="assets/images/icons/globe.svg" alt="" class="globe-icon">
        <select class="select py-0 ps-2 border-0 fw-500">
            <option value="1">Eng</option>
            <option value="2">Bn</option>
            <option value="3">Eur</option>
            <option value="4">Urd</option>
        </select>
    </div> --}}
    </div>
    <button type="button" class="toggle-mobileMenu d-lg-none"> <i class="las la-bars"></i> </button>
</div>
            <!-- Header Right End  -->
        </nav>
    </div>
</header>
<!-- ==================== Header End Here ==================== -->
