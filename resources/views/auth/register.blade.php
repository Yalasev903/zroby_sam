<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Поле для введення імені -->
            <div>
                <x-label for="name" value="{{ __('Як до вас звертатися?') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Поле для введення email -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Поле для введення пароля -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Пароль') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Поле для підтвердження пароля -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Підтвердіть пароль') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Вибір ролі -->
            <div class="mt-4">
                <x-label for="role" value="{{ __('Виберіть вашу роль') }}" />
                <select id="role" name="role" class="block mt-1 w-full" required>
                    <option value="">{{ __('Виберіть роль') }}</option>
                    <option value="customer">{{ __('Замовник') }}</option>
                    <option value="executor">{{ __('Виконавець') }}</option>
                </select>
            </div>

            <!-- Поле для компанії/посади, яке буде показано для 'customer' -->
            <div id="company-name-group" class="mt-4" style="display: none;">
                <x-label for="company_name" value="{{ __('Назва компанії, діяльність, посада або працюєте самі') }}" />
                <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" />
            </div>

            <!-- Поле для навичок, яке буде показано для 'executor' -->
            <div id="skills-group" class="mt-4" style="display: none;">
                <x-label for="skills" value="{{ __('Ваші навички') }}" />
                <textarea id="skills" name="skills" class="block mt-1 w-full">{{ old('skills') }}</textarea>
            </div>

            <!-- Вибір категорії послуг -->
            <div class="mt-4">
                <x-label for="services-category" value="{{ __('Вибір категорії послуг') }}" />
                <select id="services-category" name="services_category" class="block mt-1 w-full">
                    <option value="">{{ __('Вибір категорії') }}</option>
                    <option value="construction">{{ __('Будівництво/Ремонт') }}</option>
                    <option value="beauty">{{ __('Краса') }}</option>
                </select>
            </div>

            <!-- Вибір послуг, який змінюється залежно від категорії -->
            <div class="mt-4">
                <x-label for="services" value="{{ __('Вибір послуги') }}" />
                <select id="services" name="services[]" class="block mt-1 w-full" multiple>
                    <!-- Опції будуть додаватися динамічно -->
                </select>
            </div>

            <!-- Кнопка для реєстрації та посилання на логін -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Вже зареєстровані?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Зареєструватися') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<script>
    // Динамічне оновлення списку послуг в залежності від категорії
    const servicesCategory = document.getElementById('services-category');
    const servicesSelect = document.getElementById('services');

    const servicesData = {
        construction: [
            { value: 'Будівництво', text: 'Будівництво' },
            { value: 'Ремонт', text: 'Ремонт' },
            { value: 'Муж на годину', text: 'Муж на годину' },
        ],
        beauty: [
            { value: 'Перукар', text: 'Перукар' },
            { value: 'Манікюр', text: 'Манікюр' },
            { value: 'Педикюр', text: 'Педикюр' },
            { value: 'Ресниці', text: 'Ресниці' },
            { value: 'Брови', text: 'Брови' },
            { value: 'Татуаж', text: 'Татуаж' },
            { value: 'Масаж', text: 'Масаж' },
        ]
    };

    servicesCategory.addEventListener('change', function () {
        const category = this.value;
        servicesSelect.innerHTML = ''; // Очищаємо попередні опції

        if (category && servicesData[category]) {
            servicesData[category].forEach(service => {
                const option = document.createElement('option');
                option.value = service.value;
                option.textContent = service.text;
                servicesSelect.appendChild(option);
            });
        }
    });

    // Обробка зміни ролі (показ/приховування полів)
    document.getElementById('role').addEventListener('change', function () {
        const role = this.value;
        const companyNameGroup = document.getElementById('company-name-group');
        const skillsGroup = document.getElementById('skills-group');

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

    // Ініціалізація для початкового стану
    document.getElementById('role').dispatchEvent(new Event('change'));
</script>
