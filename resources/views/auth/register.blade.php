<x-guest-layout>
     <x-authentication-card>
         <x-slot name="logo">
             <x-authentication-card-logo />
         </x-slot>

         <x-validation-errors class="mb-4" />

         <form method="POST" action="{{ route('register') }}">
             @csrf

             <!-- Поле для имени -->
             <div>
                 <x-label for="name" value="{{ __('Як до вас звертатися?') }}" />
                 <x-input id="name" class="block mt-1 w-full border-none shadow-md" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
             </div>

             <!-- Поле для email -->
             <div class="mt-4">
                 <x-label for="email" value="{{ __('Email') }}" />
                 <x-input id="email" class="block mt-1 w-full border-none shadow-md" type="email" name="email" :value="old('email')" required autocomplete="username" />
             </div>

             <!-- Поле для пароля -->
             <div class="mt-4">
                 <x-label for="password" value="{{ __('Пароль') }}" />
                 <x-input id="password" class="block mt-1 w-full border-none shadow-md" type="password" name="password" required autocomplete="new-password" />
             </div>

             <!-- Поле для подтверждения пароля -->
             <div class="mt-4">
                 <x-label for="password_confirmation" value="{{ __('Підтвердіть пароль') }}" />
                 <x-input id="password_confirmation" class="block mt-1 w-full border-none shadow-md" type="password" name="password_confirmation" required autocomplete="new-password" />
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

             <!-- Поле для компанії/посади -->
             <div id="company-name-group" class="mt-4" style="display: none;">
                 <x-label for="company_name" value="{{ __('Назва компанії, діяльність, посада або працюєте самі') }}" />
                 <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" />
             </div>

             <!-- Поле для навичок -->
             <div id="skills-group" class="mt-4" style="display: none;">
                 <x-label for="skills" value="{{ __('Ваші навички') }}" />
                 <textarea id="skills" name="skills" class="block mt-1 w-full border-none shadow-md">{{ old('skills') }}</textarea>
             </div>

             <!-- Выбор категории услуг -->
             <div class="mt-4">
                 <x-label for="services-category" value="{{ __('Вибір категорії послуг') }}" />
                 <select id="services-category" name="services_category" class="block mt-1 w-full border-none shadow-md">
                     <option value="">{{ __('Вибір категорії') }}</option>
                     <option value="construction">{{ __('Будівництво/Ремонт') }}</option>
                     <option value="beauty">{{ __('Краса') }}</option>
                 </select>
             </div>

             <!-- Выбор услуг (чекбоксы) -->
             <div class="mt-4" id="services-container" style="display: none;">
                 <x-label for="services" value="{{ __('Вибір послуги') }}" />
                 <div id="services-checkboxes" class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                     <!-- Чекбоксы добавляются динамически через JS -->
                 </div>
             </div>

             <!-- Кнопка регистрации -->
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
     const roleSelect = document.getElementById('role');
     const companyNameGroup = document.getElementById('company-name-group');
     const skillsGroup = document.getElementById('skills-group');
     const servicesCategory = document.getElementById('services-category');
     const servicesContainer = document.getElementById('services-container');
     const servicesCheckboxes = document.getElementById('services-checkboxes');

     const servicesData = {
         construction: [
             'Будівництво', 'Ремонт', 'Муж на годину', 'Електромонтаж', 'Сантехніка', 'Укладка плитки', 'Гіпсокартон', 'Малярні роботи'
         ],
         beauty: [
             'Перукар', 'Манікюр', 'Педикюр', 'Ресниці', 'Брови', 'Татуаж', 'Масаж', 'Косметологія', 'Чистка обличчя', 'SPA-процедури'
         ]
     };

     // Обработка изменения роли
     roleSelect.addEventListener('change', function () {
         const role = this.value;

         companyNameGroup.style.display = role === 'customer' ? 'block' : 'none';
         skillsGroup.style.display = role === 'executor' ? 'block' : 'none';
     });

     // Обработка изменения категории услуг
     servicesCategory.addEventListener('change', function () {
         const category = this.value;
         servicesCheckboxes.innerHTML = '';

         if (category && servicesData[category]) {
             servicesData[category].forEach(service => {
                 const checkboxWrapper = document.createElement('div');
                 checkboxWrapper.classList.add('flex', 'items-center', 'gap-2');

                 const checkbox = document.createElement('input');
                 checkbox.type = 'checkbox';
                 checkbox.name = 'services[]';
                 checkbox.value = service;
                 checkbox.id = `service-${service}`;

                 const label = document.createElement('label');
                 label.htmlFor = `service-${service}`;
                 label.textContent = service;

                 checkboxWrapper.appendChild(checkbox);
                 checkboxWrapper.appendChild(label);

                 servicesCheckboxes.appendChild(checkboxWrapper);
             });
             servicesContainer.style.display = 'block';
         } else {
             servicesContainer.style.display = 'none';
         }
     });

     // Инициализация ролей и услуг при загрузке страницы
     roleSelect.dispatchEvent(new Event('change'));
     servicesCategory.dispatchEvent(new Event('change'));
 </script>
