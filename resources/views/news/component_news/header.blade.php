<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> Digital Market Place HTML Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/news/assets/css/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/news/assets/css/fontawesome-all.min.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('assets/news/assets/css/slick.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('assets/news/assets/css/magnific-popup.cs') }}s">
    <!-- line awesome -->
    <link rel="stylesheet" href="{{ asset('assets/news/assets/css/line-awesome.min.css') }}">
    <!-- Main css -->
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
    <li class="nav-menu__item">
        <a href="contact.html" class="nav-menu__link">Contact</a>
    </li>
</ul>
            <div class="header-right__inner d-lg-none my-3 gap-1 d-flex flx-align">

    <a href="register.html" class="btn btn-main pill">
        <span class="icon-left icon">
            <img src="assets/images/icons/user.svg" alt="">
        </span>Create Account
    </a>
    <div class="language-select flx-align select-has-icon">
        <img src="assets/images/icons/globe.svg" alt="" class="globe-icon">
        <select class="select py-0 ps-2 border-0 fw-500">
            <option value="1">Eng</option>
            <option value="2">Bn</option>
            <option value="3">Eur</option>
            <option value="4">Urd</option>
        </select>
    </div>
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
    <li class="nav-menu__item">
        <a href="contact.html" class="nav-menu__link">Contact</a>
    </li>
</ul>
            </div>
            <!-- Menu End  -->

            <!-- Header Right start -->
            <div class="header-right flx-align">
    <a href="cart.html" class="header-right__button cart-btn position-relative">
        <img src="assets/images/icons/cart.svg" alt="">
        <span class="qty-badge font-12">0</span>
    </a>
    <div class="header-right__inner gap-3 flx-align d-lg-flex d-none">

    <a href="register.html" class="btn btn-main pill">
        <span class="icon-left icon">
            <img src="assets/images/icons/user.svg" alt="">
        </span>Create Account
    </a>
    <div class="language-select flx-align select-has-icon">
        <img src="assets/images/icons/globe.svg" alt="" class="globe-icon">
        <select class="select py-0 ps-2 border-0 fw-500">
            <option value="1">Eng</option>
            <option value="2">Bn</option>
            <option value="3">Eur</option>
            <option value="4">Urd</option>
        </select>
    </div>
    </div>
    <button type="button" class="toggle-mobileMenu d-lg-none"> <i class="las la-bars"></i> </button>
</div>
            <!-- Header Right End  -->
        </nav>
    </div>
</header>
<!-- ==================== Header End Here ==================== -->
