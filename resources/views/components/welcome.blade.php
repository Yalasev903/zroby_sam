@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\ServiceCategory;
    use App\Models\Ad;
    use App\Models\User;

    $user = Auth::user();
@endphp

<div class="container mx-auto p-4 flex flex-col lg:flex-row">
    <!-- Основной контент -->
    <div class="lg:w-2/3 w-full bg-white border-b border-gray-200 p-4">
        @if(!$user)
            <p>Пожалуйста, войдите в систему, чтобы увидеть контент.</p>
        @elseif($user->role === 'executor')
        @php
        $categoryFilter = request('category');
        $categories = ServiceCategory::all();
        // Выбираем объявления, исключая те, у которых заказ находится в активном состоянии или уже выполнен.
        $adsQuery = Ad::with(['user', 'comments.user', 'order'])
            ->whereDoesntHave('order', function ($q) {
                $q->whereIn('status', ['waiting', 'in_progress', 'pending_confirmation', 'completed']);
            })
            ->orderBy('posted_at', 'desc');

        if (!empty($categoryFilter)) {
            $adsQuery->where('services_category_id', $categoryFilter);
        }

        $ads = $adsQuery->limit(6)->get();
    @endphp
            <form method="GET" action="{{ url()->current() }}" class="mb-4">
                <label for="category" class="font-semibold">Фильтр по категории:</label>
                <select name="category" id="category" onchange="this.form.submit()" class="ml-2 border rounded p-1">
                    <option value="">Все категории</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            @include('components_ads.content', ['ads' => $ads])

            <div class="text-center mt-4">
                <a href="{{ route('ads.index') }}" class="btn btn-primary">Показать все объявления</a>
            </div>
        @elseif($user->role === 'customer')
            @php
                $categoryFilter = request('category');
                $executorsQuery = User::where('role', 'executor');

                if (!empty($categoryFilter)) {
                    $executorsQuery->where('services_category', $categoryFilter);
                }

                $executors = $executorsQuery->orderBy('created_at', 'desc')->limit(6)->get();
                $categories = ServiceCategory::all();
            @endphp

            <form method="GET" action="{{ url()->current() }}" class="mb-4">
                <label for="category" class="font-semibold">Фільтр по категории:</label>
                <select name="category" id="category" onchange="this.form.submit()" class="ml-2 border rounded p-1">
                    <option value="">Все категории</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            @include('executors.index.content', ['executors' => $executors])

            <div class="text-center mt-4">
                <a href="{{ route('executors.index') }}" class="btn btn-primary">Усі виконавці</a>
            </div>
        @elseif($user->role === 'admin')
            <div class="p-4">
                <h3>Добро пожаловать, {{ $user->name }}! Вы — администратор.</h3>
                <p>Это панель администратора. Можете перейти на <a href="{{ route('admin.dashboard') }}">/admin/dashboard</a>.</p>
            </div>
        @else
            <p>Ваша роль: {{ $user->role }}. Контент не предусмотрен.</p>
        @endif
    </div>

    <!-- Правая колонка (Данные пользователя) -->
    <aside class="lg:w-1/3 w-full bg-gray-100 p-4 mt-4 lg:mt-0">
        @if($user)
            <div class="text-center">
                <figure style="width: 250px; height: 250px;">
                    @if(!empty($user->profile_photo_path))
                        <img class="object-cover rounded-full" style="width: 250px; height: 250px;"
                             src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}">
                    @else
                        <img class="object-cover rounded-full" style="width: 250px; height: 250px;"
                             src="{{ asset('images/default-avatar.webp') }}" alt="{{ $user->name }}">
                    @endif
                </figure>

                <h3 class="mt-2 text-xl font-semibold">{{ $user->name }}</h3>
                <p class="text-gray-700">Місто: {{ $user->city ?? 'Не указано' }}</p>
                <p class="text-gray-700">Рейтинг: ⭐ {{ $user->rating ?? 0 }}</p>
                <p>
                    <strong>ID користувача:</strong>
                    <a href="{{ url('/user/' . $user->id) }}" target="_blank">
                        <i class="fas fa-link"></i> {{ $user->id }}
                    </a>
                </p>

                <!-- Кнопка для копирования ссылки -->
                <button onclick="copyToClipboard('{{ url('/user/' . $user->id) }}')" class="btn btn-secondary mt-2">
                    <i class="fas fa-share-alt"></i> Поділитися
                </button>
            </div>

            <!-- Данные для исполнителя -->
            @if($user->role === 'executor')
                @php
                    $skills = !empty($user->skills) ? explode(',', $user->skills) : [];
                @endphp
                <div class="mt-4">
                    <h4 class="font-semibold">Навички</h4>
                    @if(!empty($skills))
                        <div class="flex flex-wrap">
                            @foreach($skills as $skill)
                                <div class="border border-gray-300 rounded-lg px-3 py-1 m-1">
                                    {{ trim($skill) }}
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Навички не вказані.</p>
                    @endif
                </div>
            @endif

            <!-- Данные для заказчика -->
            @if($user->role === 'customer')
                <div class="mt-4">
                    <h4 class="font-semibold">Компанія</h4>
                    <div class="border border-gray-300 rounded-lg px-3 py-1 m-1">
                        {{ $user->company_name ?? 'Не вказана' }}
                    </div>
                </div>
            @endif

            <!-- Категория услуг -->
            @php
                $userCategory = ServiceCategory::find($user->services_category);
            @endphp
            <div class="mt-4">
                <h4 class="font-semibold">Категорія послуг</h4>
                <div class="border border-gray-300 rounded-lg px-3 py-1 m-1">
                    {{ $userCategory->name ?? 'Категорія не вказана' }}
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ url('/chat/' . $user->id) }}" class="btn btn-primary">Почати чат</a>
            </div>
        @endif
    </aside>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Ссылка скопирована в буфер обмена!');
        }).catch(function(err) {
            alert('Ошибка при копировании: ' + err);
        });
    }
</script>
