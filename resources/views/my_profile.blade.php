@extends('layouts.app')

@section('content')
@php
    // Получаем текущего пользователя
    $user = auth()->user();
    // Декодирование JSON со списком услуг (если они хранятся в виде JSON)
    $userServices = json_decode($user->services, true) ?? [];
    // Получаем выбранную категорию услуг (предполагается, что переменная $categories передана из контроллера)
    $userCategory = $categories->firstWhere('id', $user->services_category);
@endphp

<!-- Start Profile Section -->
<section class="lqd-section new-features py-30" id="profile-section" data-custom-animations="true" data-ca-options='{
    "animationTarget": ".animation-element",
    "duration": 500,
    "startDelay": 500,
    "ease": "expo.inOut",
    "initValues": {"scaleX": 0.75, "scaleY": 0.75, "opacity": 0},
    "animations": {"scaleX": 1, "scaleY": 1, "opacity": 1}
}'>
    <div class="container">
        <!-- Flex-контейнер: на мобильных элементы выводятся в колонку, на десктопе — в ряд -->
        <div class="flex flex-col md:flex-row items-start">
            <!-- Блок с аватаром: на мобильных (order-1) отображается сверху, на десктопе (md:order-2) справа -->
            <div class="md:w-25percent order-1 md:order-2 flex items-start justify-center sm:w-full animation-element" data-custom-animations="true" data-ca-options='{
                "animationTarget": "img",
                "duration": 1000,
                "ease": "expo.out",
                "initValues": {"y": "100px"},
                "animations": {"y": "0px"}
            }'>
                <figure style="width: 350px; height: 350px;">
                    @if($user->profile_photo_path)
                        <img class="object-cover rounded-full" style="width: 350px; height: 350px;" src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}">
                    @else
                        <img class="object-cover rounded-full" style="width: 350px; height: 350px;" src="{{ asset('images/default-avatar.webp') }}" alt="{{ $user->name }}">
                    @endif
                </figure>
            </div>
            <!-- Блок с информацией о пользователе: на мобильных (order-2) отображается ниже аватара, на десктопе (md:order-1) слева -->
            <div class="md:w-75percent order-2 md:order-1 relative flex flex-col bg-white rounded-12 shadow-md transition-all p-8 sm:w-full animation-element" data-custom-animations="true" data-ca-options='{
                "animationTarget": ".ld-fancy-heading",
                "duration": 650,
                "startDelay": 1000,
                "delay": 100,
                "ease": "expo.out",
                "initValues": {"y": "70px", "opacity": 0},
                "animations": {"y": "0px", "opacity": 1}
            }'>
                <!-- Приветствие -->
                <div class="ld-fancy-heading relative mb-4">
                    <h2 class="ld-fh-element inline-block relative h1">Ласкаво просимо!<br> {{ $user->name }}!</h2>
                </div>
                <!-- Рейтинг -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-2">Ваш рейтинг</h3>
                    <p class="text-gray-700 text-xl font-bold">
                        ⭐ {{ $user->rating ?? 0 }} / 5
                    </p>
                </div>
                <!-- Контактные данные -->
                <div class="space-y-3 mb-6">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Місто:</strong> {{ $user->city ?? 'Не указан' }}</p>
                    <p>ID користувача: {{ $user->id }}</p>
                </div>
                <!-- Блок: Роль -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3">Роль</h3>
                    <div class="flex">
                        <div class="ld-fancy-heading relative">
                            <h6 class="ld-fh-element m-0 inline-block relative text-15 font-normal text-primary py-5 px-15 bg-green-100 rounded-100" id="info">
                                {{ $user->role }}
                            </h6>
                        </div>
                    </div>
                </div>
                <!-- Блок: Навички / Компанія -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3">
                        @if($user->role === 'executor')
                            Навички
                        @elseif($user->role === 'customer')
                            Компанія
                        @endif
                    </h3>
                    <div class="flex flex-wrap">
                        @if($user->role === 'executor')
                            @if($user->skills)
                                @php
                                    $skills = is_array($user->skills) ? $user->skills : explode(',', $user->skills);
                                @endphp
                                @foreach($skills as $skill)
                                    <div class="transition-bg border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6 ld-fancy-heading relative">
                                        <h6 class="transition-color text-16 font-medium m-0 text-black-40 ld-fh-element inline-block relative">
                                            {{ trim($skill) }}
                                        </h6>
                                    </div>
                                @endforeach
                            @else
                                <div class="transition-bg border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6 ld-fancy-heading relative">
                                    <h6 class="transition-color text-16 font-medium m-0 text-black-40 ld-fh-element inline-block relative">
                                        Навички не указані
                                    </h6>
                                </div>
                            @endif
                        @elseif($user->role === 'customer')
                            <div class="transition-bg border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6 ld-fancy-heading relative">
                                <h6 class="transition-color text-16 font-medium m-0 text-black-40 ld-fh-element inline-block relative">
                                    {{ $user->company_name ?? 'Не указана' }}
                                </h6>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Блок: Категорія послуг та послуги -->
                <div>
                    <h3 class="text-lg font-semibold mb-3">Категорія послуг та послуги</h3>
                    <div class="flex flex-wrap">
                        @if($userCategory)
                            <div class="transition-bg border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6 ld-fancy-heading relative">
                                <h6 class="transition-color text-16 font-medium m-0 text-black-40 ld-fh-element inline-block relative">
                                    {{ $userCategory->name }}
                                </h6>
                            </div>
                        @else
                            <div class="transition-bg border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6 ld-fancy-heading relative">
                                <h6 class="transition-color text-16 font-medium m-0 text-black-40 ld-fh-element inline-block relative">
                                    Категорія не вказана
                                </h6>
                            </div>
                        @endif

                        @if(count($userServices))
                            @foreach($userServices as $service)
                                <div class="transition-bg border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6 ld-fancy-heading relative">
                                    <h6 class="transition-color text-16 font-medium m-0 text-black-40 ld-fh-element inline-block relative">
                                        {{ $service }}
                                    </h6>
                                </div>
                            @endforeach
                        @else
                            <div class="transition-bg border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6 ld-fancy-heading relative">
                                <h6 class="transition-color text-16 font-medium m-0 text-black-40 ld-fh-element inline-block relative">
                                    Послуги не вказані
                                </h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Profile Section -->
@endsection
