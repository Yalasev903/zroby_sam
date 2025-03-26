<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Логотип" class="h-20 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Дошка оголошень') }}
                    </x-nav-link>
                    @if (Auth::user()->role === 'customer')
                        <x-nav-link href="{{ route('ads.create') }}" :active="request()->routeIs('ads.create')">
                            {{ __('Створити оголошення') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('ads.my') }}" :active="request()->routeIs('ads.my')">
                            {{ __('Мої оголошення') }}
                        </x-nav-link>
                    @endif
                    <x-nav-link href="{{ route('orders.index') }}" :active="request()->routeIs('orders.index')">
                        {{ __('Мої замовлення') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}
                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>
                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @php
                                // Явно формируем путь к фото из БД
                                $userPhoto = Auth::user()->profile_photo_path
                                    ? asset('storage/' . Auth::user()->profile_photo_path)
                                    : asset('images/default-avatar.webp');
                            @endphp
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="size-8 rounded-full object-cover" src="{{ $userPhoto }}" alt="{{ Auth::user()->name }}" />
                                <span class="ms-2 text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                            </button>
                        </x-slot>

                        @php
                            $unreadMessages = \App\Models\ChMessage::where('to_id', Auth::id())
                                ->where('seen', 0)
                                ->count();
                        @endphp

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Менеджер') }}
                            </div>

                            <x-dropdown-link href="{{ route('home') }}">
                                <i class="bi bi-house-door mr-2"></i>
                                {{ __('Головна') }}
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('notifications.index') }}">
                                <i class="bi bi-bell mr-2"></i>
                                {{ __('Повідомлення') }}
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                <i class="bi bi-person-circle mr-2"></i>
                                {{ __('Налаштування Профілю') }}
                            </x-dropdown-link>

                            <!-- Профиль пользователя с добавлением ID -->
                            <x-dropdown-link href="{{ route('my_profile.show', auth()->user()->id) }}">
                                <i class="bi bi-person mr-2"></i>
                                {{ __('Мій профіль') }}
                            </x-dropdown-link>

                            <!-- Страница настроек профиля -->
                            <x-dropdown-link href="{{ url('/my_profile/settings', auth()->user()->id) }}">
                                <i class="bi bi-gear mr-2"></i>
                                {{ __('Змінити Налаштування Послуг') }}
                            </x-dropdown-link>

                            @if (auth()->user()->role === 'customer')
                                <x-dropdown-link href="{{ route('executors.index') }}">
                                    <i class="bi bi-person-workspace mr-2"></i>
                                    {{ __('Виконавці') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Ссылка на чат с иконкой и бейджем непрочитанных сообщений -->
                            <x-dropdown-link href="{{ url('/chat') }}">
                                <i class="bi bi-chat-dots mr-2"></i>
                                {{ __('Чат') }}
                                @if($unreadMessages > 0)
                                    <span class="ml-1 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">
                                        {{ $unreadMessages }}
                                    </span>
                                @endif
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    <i class="bi bi-box-arrow-right mr-2"></i>
                                    {{ __('Вийти') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500
                               hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500
                               transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Дошка оголошень') }}
            </x-responsive-nav-link>
            @if (Auth::user()->role === 'customer')
                <x-responsive-nav-link href="{{ route('ads.create') }}" :active="request()->routeIs('ads.create')">
                    {{ __('Додати оголошення') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('ads.my') }}" :active="request()->routeIs('ads.my')">
                    {{ __('Мої оголошення') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link href="{{ route('orders.index') }}" :active="request()->routeIs('orders.index')">
                {{ __('Мої замовлення') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @php
                    // Формируем путь к аватарке и fallback
                    $responsivePhoto = Auth::user()->profile_photo_path
                        ? asset('storage/' . Auth::user()->profile_photo_path)
                        : asset('images/default-avatar.webp');
                @endphp

                <div class="shrink-0 me-3">
                    <img class="size-8 rounded-full object-cover"
                         src="{{ $responsivePhoto }}"
                         alt="{{ Auth::user()->name }}" />
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Менеджер') }}
                </div>

                <x-dropdown-link href="{{ route('home') }}">
                    <i class="bi bi-house-door mr-2"></i>
                    {{ __('Головна') }}
                </x-dropdown-link>

                <x-dropdown-link href="{{ route('notifications.index') }}">
                    <i class="bi bi-bell mr-2"></i>
                    {{ __('Повідомлення') }}
                </x-dropdown-link>

                <x-dropdown-link href="{{ route('profile.show') }}">
                    <i class="bi bi-person-circle mr-2"></i>
                    {{ __('Налаштування Профілю') }}
                </x-dropdown-link>

                <!-- Профиль пользователя -->
                <x-dropdown-link href="{{ route('my_profile.show', auth()->user()->id) }}">
                    <i class="bi bi-person mr-2"></i>
                    {{ __('Мій профіль') }}
                </x-dropdown-link>

                <!-- Страница настроек профиля -->
                <x-dropdown-link href="{{ url('/my_profile/settings', auth()->user()->id) }}">
                    <i class="bi bi-gear mr-2"></i>
                    {{ __('Змінити Налаштування Послуг') }}
                </x-dropdown-link>

                @if (auth()->user()->role === 'customer')
                    <x-dropdown-link href="{{ route('executors.index') }}">
                        <i class="bi bi-person-workspace mr-2"></i>
                        {{ __('Виконавці') }}
                    </x-dropdown-link>
                @endif

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-dropdown-link>
                @endif

                <div class="border-t border-gray-200"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        <i class="bi bi-box-arrow-right mr-2"></i>
                        {{ __('Вийти') }}
                    </x-dropdown-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>
                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>
                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan
                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>
                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
