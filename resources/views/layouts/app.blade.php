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
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/demo/start-hub-4/start-hub-4.css') }}"> --}}
		{{-- <link rel="stylesheet" href="./assets/css/demo/start-hub-2.css"> --}}

		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700&family=DM+Serif+Text:ital@1&family=Rubik:wght@600&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <!-- Vite manual include -->
        {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-CyiPxqEv.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/app-BgfknelF.css') }}">
        <script type="module" src="{{ asset('build/assets/app-DFP44zVe.js') }}"></script> --}}
        @vite(['resources/js/app.js'])

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
