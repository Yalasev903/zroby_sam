@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Профiль</h1>

    @php
        // Получаем текущего пользователя
        $user = auth()->user();

        // Если в базе для выбранных услуг хранится JSON с id услуг, преобразуем его в массив.
        $userServices = json_decode($user->services, true) ?? [];
    @endphp

            {{-- Отображение рейтинга пользователя --}}
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-2">{{ __('Ваш рейтинг') }}</h3>
                <p class="text-gray-700 text-xl font-bold">
                    ⭐ {{ auth()->user()->rating ?? 0 }} / 5
                </p>
            </div>

    <!-- Карточка с информацией о пользователе -->
    <div class="card mb-4">
        <div class="card-body d-flex align-items-center">
            <div class="me-3">
                @if($user->profile_photo_path)
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Аватар" class="rounded" style="width: 120px; height: 120px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/default-avatar.webp') }}" alt="Аватар" class="rounded" style="width: 120px; height: 120px; object-fit: cover;">
                @endif
            </div>
            <div>
                <h3>{{ $user->name }}</h3>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Місто:</strong> {{ $user->city ?? 'Не указан' }}</p>
                <p><strong>Роль:</strong> {{ $user->role }}</p>
                @if($user->role === 'executor')
                    <p><strong>Навички:</strong> {{ $user->skills ?? 'Не указаны' }}</p>
                @elseif($user->role === 'customer')
                    <p><strong>Компанія:</strong> {{ $user->company_name ?? 'Не указана' }}</p>
                @endif

                <p>
                    <strong>Категорія послуг:</strong>
                    @php
                        // Ищем категорию, выбранную пользователем. Предполагается, что $categories переданы из контроллера.
                        $userCategory = $categories->firstWhere('id', $user->services_category);
                    @endphp
                    {{ $userCategory ? $userCategory->name : 'Не указана' }}
                </p>
                <p>
                    <strong>Послуги:</strong>
                    @if(count($userServices))
                        {{ implode(', ', $userServices) }}
                    @else
                        Не вказані
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
