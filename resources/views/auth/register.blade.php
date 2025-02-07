<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @php
            // Получаем список городов
            $cities = DB::table('cities')->get();

            // Получаем все категории услуг
            $categories = DB::table('services_category')->get();

            // Получаем все услуги и группируем их по id категории
            $allServices = DB::table('services')->get();
            $servicesByCategory = [];
            foreach ($allServices as $service) {
                $servicesByCategory[$service->services_category_id][] = $service;
            }
        @endphp

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Поле для имени -->
            <div>
                <x-label for="name" value="{{ __('Як до вас звертатися?') }}" />
                <x-input id="name" class="block mt-1 w-full border-none shadow-md"
                         type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Поле для email -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full border-none shadow-md"
                         type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Поле для пароля -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Пароль') }}" />
                <x-input id="password" class="block mt-1 w-full border-none shadow-md"
                         type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Поле для подтверждения пароля -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Підтвердіть пароль') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full border-none shadow-md"
                         type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Поле для города -->
            <div class="mt-4">
                <x-label for="city" value="{{ __('Місто') }}" />
                <select id="city" name="city" class="block mt-1 w-full border-none shadow-md" required>
                    <option value="">{{ __('Оберіть місто') }}</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->name }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Поле для загрузки изображения (аватар) -->
            <div class="mt-4">
                <x-label for="profile_photo_path" value="{{ __('Завантажте фото профілю') }}" />
                <x-input id="profile_photo_path" class="block mt-1 w-full border-none shadow-md"
                         type="file" name="avatar" accept="image/*" />
            </div>

            <!-- Вибір ролі -->
            <div class="mt-4">
                <x-label for="role" value="{{ __('Виберіть вашу роль') }}" />
                <select id="role" name="role" class="block mt-1 w-full border-none shadow-md" required>
                    <option value="">{{ __('Виберіть роль') }}</option>
                    <option value="customer">{{ __('Замовник') }}</option>
                    <option value="executor">{{ __('Виконавець') }}</option>
                </select>
            </div>

            <!-- Поле для компанії (для замовника) -->
            <div id="company-name-group" class="mt-4" style="display: none;">
                <x-label for="company_name" value="{{ __('Назва компанії, діяльність, посада або працюєте самі') }}" />
                <x-input id="company_name" class="block mt-1 w-full" type="text"
                         name="company_name" :value="old('company_name')" />
            </div>

            <!-- Поле для навичок (для виконавця) -->
            <div id="skills-group" class="mt-4" style="display: none;">
                <x-label for="skills" value="{{ __('Ваші навички') }}" />
                <textarea id="skills" name="skills" class="block mt-1 w-full border-none shadow-md">{{ old('skills') }}</textarea>
            </div>

            <!-- Выбор категории услуг -->
            <div class="mt-4">
                <x-label for="services-category" value="{{ __('Вибір категорії послуг') }}" />
                <select id="services-category" name="services_category" class="block mt-1 w-full border-none shadow-md" required>
                    <option value="">{{ __('Вибір категорії') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Выбор услуг (чекбоксы) -->
            <div class="mt-4" id="services-container" style="display: none;">
                <x-label for="services" value="{{ __('Вибір послуги') }}" />
                <div id="services-checkboxes" class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                    <!-- Чекбоксы будут динамически добавляться через JavaScript -->
                </div>
            </div>

            <!-- Кнопка регистрации -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md
                          focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('login') }}">
                    {{ __('Вже зареєстровані?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Зареєструватися') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    <script>
        // Элементы формы
        const roleSelect = document.getElementById('role');
        const companyNameGroup = document.getElementById('company-name-group');
        const skillsGroup = document.getElementById('skills-group');
        const servicesCategory = document.getElementById('services-category');
        const servicesContainer = document.getElementById('services-container');
        const servicesCheckboxes = document.getElementById('services-checkboxes');

        // Обработка изменения роли: для замовника показываем поле компании, для виконавця – поле навичок
        roleSelect.addEventListener('change', function () {
            const role = this.value;
            if (role === 'customer') {
                companyNameGroup.style.display = 'block';
                skillsGroup.style.display = 'none';
            } else if (role === 'executor') {
                companyNameGroup.style.display = 'none';
                skillsGroup.style.display = 'block';
            } else {
                companyNameGroup.style.display = 'none';
                skillsGroup.style.display = 'none';
            }
        });

        // Получаем данные об услугах из PHP (группировка по id категории)
        const servicesData = @json($servicesByCategory);

        // При выборе категории формируем чекбоксы с услугами
        servicesCategory.addEventListener('change', function () {
            const categoryId = this.value;
            servicesCheckboxes.innerHTML = '';

            if (categoryId && servicesData[categoryId]) {
                servicesData[categoryId].forEach(service => {
                    const checkboxWrapper = document.createElement('div');
                    checkboxWrapper.classList.add('flex', 'items-center', 'gap-2');

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'services[]';
                    checkbox.value = service.id;
                    checkbox.id = `service-${service.id}`;

                    const label = document.createElement('label');
                    label.htmlFor = `service-${service.id}`;
                    label.textContent = service.name;

                    checkboxWrapper.appendChild(checkbox);
                    checkboxWrapper.appendChild(label);
                    servicesCheckboxes.appendChild(checkboxWrapper);
                });
                servicesContainer.style.display = 'block';
            } else {
                servicesContainer.style.display = 'none';
            }
        });

        // Инициализация: сброс видимости полей при загрузке страницы
        roleSelect.dispatchEvent(new Event('change'));
        servicesCategory.dispatchEvent(new Event('change'));
    </script>
</x-guest-layout>
