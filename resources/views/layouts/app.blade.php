<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <link rel="icon" type="image/ico" sizes="32x32" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/ico" sizes="16x16" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">


        <!-- Шаблон стили -->
        {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/liquid-icon/lqd-essentials/lqd-essentials.min.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/utility.min.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/demo/start-hub-4/base.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/demo/start-hub-4/start-hub-4.css') }}">


		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700&family=DM+Serif+Text:ital@1&family=Rubik:wght@600&display=swap" rel="stylesheet">

        <script src="./assets/vendors/jquery.min.js"></script>
		<script src="./assets/vendors/jquery-ui/jquery-ui.min.js"></script>
		<script src="./assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="./assets/vendors/gsap/minified/gsap.min.js"></script>
		<script src="./assets/vendors/gsap/minified/DrawSVGPlugin.min.js"></script>
		<script src="./assets/vendors/gsap/utils/SplitText.min.js"></script>
		<script src="./assets/vendors/gsap/minified/ScrollTrigger.min.js"></script>
		<script src="./assets/vendors/fastdom/fastdom.min.js"></script>
		<script src="./assets/vendors/draw-shape/liquidDrawShape.min.js"></script>
		<script src="./assets/vendors/isotope/isotope.pkgd.min.js"></script>
		<script src="./assets/vendors/isotope/packery-mode.pkgd.min.js"></script>
		<script src="./assets/vendors/flickity/flickity.pkgd.min.js"></script>
		<script src="./assets/vendors/imagesloaded.pkgd.min.js"></script>
		<script src="./assets/vendors/draggabilly.pkgd.min.js"></script>
		<script src="./assets/vendors/fontfaceobserver.js"></script>
		<script src="./assets/vendors/particles.min.js"></script>
		<script src="./assets/vendors/lity/lity.min.js"></script>
		<script src="./assets/vendors/lottie/lottie.min.js"></script>
		<script src="./assets/js/liquid-gdpr.min.js"></script>
		<script src="./assets/js/theme.min.js"></script>
		<script src="./assets/js/liquid-ajax-contact-form.min.js"></script>
		<script src="./assets/js/demo/start-hub-4.js"></script>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @if(isset($slot))
                {{ $slot }}  <!-- Поддержка Jetstream -->
            @else
                @yield('content')  <!-- Для обычных страниц -->
            @endif
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
