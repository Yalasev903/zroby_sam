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

                <button onclick="copyToClipboard('{{ url('/user/' . $user->id) }}')" class="btn btn-secondary mt-2">
                    <i class="fas fa-share-alt"></i> Поділитися
                </button>

                <!-- Кнопка Відгуки с иконкой для исполнителей и заказчиков -->
                @if(in_array($user->role, ['executor', 'customer']))
                    <button type="button" class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#reviewsModal">
                        <i class="fas fa-star"></i> Відгуки
                    </button>
                @endif
            </div>
            <!-- Остальные блоки данных пользователя ... -->
        @endif
    </aside>
</div>

<!-- Модальное окно для отображения отзывов -->
@if($user && in_array($user->role, ['executor', 'customer']))
<div class="modal fade" id="reviewsModal" tabindex="-1" aria-labelledby="reviewsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reviewsModalLabel">Ваші відгуки</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрити"></button>
      </div>
      <div class="modal-body">
        @php
            if($user->role === 'executor'){
                $reviews = $user->reviewsReceived()->where('review_by', 'customer')->latest()->get();
            } else {
                $reviews = \App\Models\Review::where('customer_id', $user->id)
                            ->where('review_by', 'executor')
                            ->latest()
                            ->get();
            }
        @endphp

        @if($reviews->isEmpty())
            <p>Відгуки відсутні.</p>
        @else
            <ul class="list-group">
                @foreach($reviews as $review)
                    <li class="list-group-item d-flex align-items-start">
                        <!-- Аватар автора отзыва -->
                        @if($review->review_by === 'customer')
                            <img src="{{ $review->customer->profile_photo_path ? asset('storage/' . $review->customer->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                 alt="{{ $review->customer->name }}"
                                 class="rounded-circle me-2"
                                 style="width:40px; height:40px; object-fit: cover;">
                        @else
                            <img src="{{ $review->executor->profile_photo_path ? asset('storage/' . $review->executor->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                 alt="{{ $review->executor->name }}"
                                 class="rounded-circle me-2"
                                 style="width:40px; height:40px; object-fit: cover;">
                        @endif
                        <div>
                            @if($review->review_by === 'customer')
                                <strong>Замовник:</strong> {{ $review->customer->name }}<br>
                            @else
                                <strong>Виконавець:</strong> {{ $review->executor->name }}<br>
                            @endif
                            <strong>Оцінка:</strong> {{ $review->rating }}<br>
                            @if($review->comment)
                                <strong>Коментар:</strong> {{ $review->comment }}<br>
                            @endif
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
      </div>
    </div>
  </div>
</div>
@endif

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Ссылка скопирована в буфер обмена!');
        }).catch(function(err) {
            alert('Ошибка при копировании: ' + err);
        });
    }
</script>
