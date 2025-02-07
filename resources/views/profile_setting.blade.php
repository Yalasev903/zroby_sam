@extends('layouts.app')

@php
    // Текущий пользователь
    $user = auth()->user();

    // Получаем данные для селектов и чекбоксов (можно передать из контроллера)
    $cities = DB::table('cities')->get();
    $categories = DB::table('services_category')->get();
    $allServices = DB::table('services')->get();
    $servicesByCategory = [];
    foreach ($allServices as $service) {
        $servicesByCategory[$service->services_category_id][] = $service;
    }
    // Если у пользователя уже выбраны услуги (хранятся в JSON)
    $userServices = json_decode($user->services, true) ?? [];
@endphp

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Боковое меню кабинета -->
        <div class="col-md-3 mb-4">
            <div class="list-group">
                {{-- <a href="{{ route('account.index') }}" class="list-group-item list-group-item-action active">Мой аккаунт</a>
                <a href="{{ route('profile.settings') }}" class="list-group-item list-group-item-action">Настройки профиля</a> --}}
                <!-- Можно добавить дополнительные пункты меню -->
            </div>
        </div>

        <!-- Основной контент кабинета -->
        <div class="col-md-9">
            <!-- Блок с базовой информацией пользователя -->
            <div class="card mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        @if($user->profile_photo_path)
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Аватар" class="rounded" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-avatar.webp') }}" alt="Аватар" class="rounded" style="width: 120px; height: 120px; object-fit: cover;">
                        @endif
                    <div>
                        <h4 class="mb-0">{{ $user->name }}</h4>
                        <p class="mb-0 text-muted">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Форма для изменения настроек аккаунта (только: роль, город, категория, услуги) -->
            <div class="card">
                <div class="card-header">
                    <h5>Налаштування акаунта</h5>
                </div>
                <div class="card-body">
                    <x-validation-errors class="mb-3" />

                    {{-- <form action="{{ route('account.update') }}" method="POST"> --}}
                        @csrf
                        @method('PUT')

                        <!-- Роль -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Роль</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="customer" @if(old('role', $user->role) === 'customer') selected @endif>Заказчик</option>
                                <option value="executor" @if(old('role', $user->role) === 'executor') selected @endif>Исполнитель</option>
                            </select>
                        </div>

                        <!-- Город -->
                        <div class="mb-3">
                            <label for="city" class="form-label">Місто</label>
                            <select name="city" id="city" class="form-select" required>
                                <option value="">Выберіть місто</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->name }}" @if(old('city', $user->city) == $city->name) selected @endif>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Категория услуг -->
                        <div class="mb-3">
                            <label for="services_category" class="form-label">Категория услуг</label>
                            <select name="services_category" id="services_category" class="form-select" required>
                                <option value="">Выберіть категорію</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @if(old('services_category', $user->services_category) == $cat->id) selected @endif>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Услуги (динамически формируемые чекбоксы) -->
                        <div class="mb-3" id="services-container" style="display: none;">
                            <label class="form-label">Послуги</label>
                            <div id="services-checkboxes" class="row">
                                <!-- Здесь будут добавлены чекбоксы через JavaScript -->
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранити змінення</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Скрипт для динамического формирования списка услуг по выбранной категории -->
<script>
    // Элемент выбора категории услуг
    const servicesCategory = document.getElementById('services_category');
    const servicesContainer = document.getElementById('services-container');
    const servicesCheckboxes = document.getElementById('services-checkboxes');

    // Данные об услугах, сгруппированные по категории (переданы из PHP)
    const servicesData = @json($servicesByCategory);
    // Услуги, выбранные пользователем (массив id)
    const userServices = @json($userServices);

    function updateServicesCheckboxes() {
        const categoryId = servicesCategory.value;
        servicesCheckboxes.innerHTML = '';

        if (categoryId && servicesData[categoryId]) {
            servicesData[categoryId].forEach(service => {
                // Создаем колонку для чекбокса (для сетки)
                const colDiv = document.createElement('div');
                colDiv.classList.add('col-md-4', 'mb-2');

                const checkboxWrapper = document.createElement('div');
                checkboxWrapper.classList.add('form-check');

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'services[]';
                checkbox.value = service.id;
                checkbox.classList.add('form-check-input');
                checkbox.id = `service-${service.id}`;
                if (userServices.includes(service.id)) {
                    checkbox.checked = true;
                }

                const label = document.createElement('label');
                label.classList.add('form-check-label');
                label.htmlFor = `service-${service.id}`;
                label.textContent = service.name;

                checkboxWrapper.appendChild(checkbox);
                checkboxWrapper.appendChild(label);
                colDiv.appendChild(checkboxWrapper);
                servicesCheckboxes.appendChild(colDiv);
            });
            servicesContainer.style.display = 'block';
        } else {
            servicesContainer.style.display = 'none';
        }
    }

    // Обработка события изменения выбранной категории
    servicesCategory.addEventListener('change', updateServicesCheckboxes);

    // Инициализация формы при загрузке страницы
    updateServicesCheckboxes();
</script>
@endsection
