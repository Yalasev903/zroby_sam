@php
    $user = Auth::user();
@endphp

<div class="pt-0 lg:p-8 bg-white border-b border-gray-200">
    @if(!$user)
        {{-- Если пользователь не авторизован --}}
        <p>Пожалуйста, войдите в систему, чтобы увидеть контент.</p>

    @elseif($user->role === 'executor')
        @php
            // Получаем выбранный фильтр по категории из GET-параметров
            $categoryFilter = request('category');
            // Получаем список всех категорий для фильтра
            $categories = \App\Models\ServiceCategory::all();

            // Формируем запрос для получения объявлений, у которых нет связанного заказа
            $adsQuery = \App\Models\Ad::whereDoesntHave('order')
                        ->orderBy('posted_at', 'desc');
            if ($categoryFilter) {
                // Фильтруем по полю services_category_id (в таблице ads)
                $adsQuery->where('services_category_id', $categoryFilter);
            }
            $ads = $adsQuery->limit(6)->get();
        @endphp

        {{-- Форма фильтра для объявлений --}}
        <form method="GET" action="{{ url()->current() }}" class="mb-4">
            <label for="category" class="font-semibold">Фільтр за категорією:</label>
            <select name="category" id="category" onchange="this.form.submit()" class="ml-2 border rounded p-1">
                <option value="">Усі категорії</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Вывод объявлений через общий компонент --}}
        @include('components_ads.content', ['ads' => $ads])

        {{-- Ссылка на страницу со всеми объявлениями --}}
        <div class="text-center mt-4">
            <a href="{{ route('ads.index') }}" class="btn btn-primary">
                Показать все объявления
            </a>
        </div>

    @elseif($user->role === 'customer')
        @php
            // Получаем выбранный фильтр по категориям из GET-параметров
            $categoryFilter = request('category');

            // Формируем запрос для получения исполнителей
            $executorsQuery = \App\Models\User::where('role', 'executor');
            if ($categoryFilter) {
                $executorsQuery->where('services_category', $categoryFilter);
            }
            $executors = $executorsQuery->orderBy('created_at', 'desc')->limit(6)->get();

            // Получаем список категорий для фильтра
            $categories = \App\Models\ServiceCategory::all();
        @endphp

        {{-- Форма фильтра для исполнителей --}}
        <form method="GET" action="{{ url()->current() }}" class="mb-4">
            <label for="category" class="font-semibold">Фільтр у категорії:</label>
            <select name="category" id="category" onchange="this.form.submit()" class="ml-2 border rounded p-1">
                <option value="">Усі категорії</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Вывод исполнителей --}}
        @include('executors.index.content', ['executors' => $executors])

        <div class="text-center mt-4">
            <a href="{{ route('executors.index') }}" class="btn btn-primary">
                Всі виконавці
            </a>
        </div>

    @elseif($user->role === 'admin')
        <div class="p-4">
            <h3>Добро пожаловать, {{ $user->name }}! Вы — администратор.</h3>
            <p>Это панель администратора. Можете перейти на
                <a href="{{ route('admin.dashboard') }}">/admin/dashboard</a>.
            </p>
        </div>

    @else
        {{-- Если роль иная, выводим сообщение --}}
        <p>Ваша роль: {{ $user->role }}. Контент не предусмотрен.</p>
    @endif
</div>
