@extends('layouts.app')

@section('content')

<section class="lqd-section new-features py-30" id="profile-section">
    <div class="container">
        <div class="flex flex-col md:flex-row items-start">
            <!-- Аватар пользователя -->
            <div class="md:w-25percent order-1 md:order-2 flex items-start justify-center sm:w-full">
                <figure style="width: 350px; height: 350px;">
                    @if($user->profile_photo_path)
                        <img class="object-cover rounded-full" style="width: 350px; height: 350px;"
                             src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}">
                    @else
                        <img class="object-cover rounded-full" style="width: 350px; height: 350px;"
                             src="{{ asset('images/default-avatar.webp') }}" alt="{{ $user->name }}">
                    @endif
                </figure>
            </div>

            <!-- Информация о пользователе -->
            <div class="md:w-75percent order-2 md:order-1 flex flex-col bg-white rounded-12 shadow-md p-8">
                <div class="mb-4">
                    <h2>Ласкаво просимо! {{ $user->name }}!</h2>
                </div>

                <div class="mb-4">
                    <h3>Ваш рейтинг</h3>
                    <p>⭐ {{ $user->rating ?? 0 }} / 5</p>
                </div>

                <div class="mb-6">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Телефон:</strong> {{ $user->phone ?? 'Не вказан' }}</p>
                    <p><strong>Місто:</strong> {{ $user->city ?? 'Не вказан' }}</p>
                    <p><strong>ID користувача:</strong> {{ $user->id }}</p>
                </div>

                <div class="mb-6">
                    <h3>Роль</h3>
                    <p>{{ $user->role }}</p>
                </div>

                <!-- Навыки или компания -->
                <div class="mb-6">
                    <h3>
                        @if($user->role === 'executor')
                            Навички
                        @elseif($user->role === 'customer')
                            Компанія
                        @endif
                    </h3>
                    <div class="flex flex-wrap">
                        @if($user->role === 'executor' && !empty($userServices))
                            @foreach($userServices as $service)
                                <div class="border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6">
                                    <h6>{{ $service }}</h6>
                                </div>
                            @endforeach
                        @elseif($user->role === 'customer')
                            <div class="border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6">
                                <h6>{{ $user->company_name ?? 'Не указана' }}</h6>
                            </div>
                        @else
                            <p>Информация отсутствует</p>
                        @endif
                    </div>
                </div>

                <!-- Категория услуг -->
                <div>
                    <h3>Категорія послуг та послуги</h3>
                    <div class="flex flex-wrap">
                        @if(isset($userCategory) && $userCategory)
                            <div class="border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6">
                                <h6>{{ $userCategory->name }}</h6>
                            </div>
                        @else
                            <div class="border-1 border-black-10 mb-10 mr-10 py-10 px-15 rounded-6">
                                <h6>Категорія не вказана</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
