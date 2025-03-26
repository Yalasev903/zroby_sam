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
                    <h2>{{ $user->name }}</h2>
                </div>

                <div class="mb-4">
                    <h3>Ваш рейтинг</h3>
                    <p>⭐ {{ $user->rating ?? 0 }}</p>
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

                <!-- Кнопка для чата -->
                <a href="{{ url('/chat/' . $user->id) }}" class="btn btn-primary mb-3">
                    Почати чат
                </a>

                <!-- Кнопка Відгуки с иконкой для исполнителей и заказчиков -->
                @if(in_array($user->role, ['executor', 'customer']))
                    <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#reviewsModal">
                        <i class="fas fa-star"></i> Відгуки
                    </button>
                @endif

                <!-- Остальные данные (навыки, компания, категория) -->
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
                                <div class="border border-gray-300 rounded p-2 m-1">
                                    <h6>{{ $service }}</h6>
                                </div>
                            @endforeach
                        @elseif($user->role === 'customer')
                            <div class="border border-gray-300 rounded p-2 m-1">
                                <h6>{{ $user->company_name ?? 'Не указана' }}</h6>
                            </div>
                        @else
                            <p>Информация отсутствует</p>
                        @endif
                    </div>
                </div>

                <div>
                    <h3>Категорія послуг та послуги</h3>
                    <div class="flex flex-wrap">
                        @if(isset($userCategory) && $userCategory)
                            <div class="border border-gray-300 rounded p-2 m-1">
                                <h6>{{ $userCategory->name }}</h6>
                            </div>
                        @else
                            <div class="border border-gray-300 rounded p-2 m-1">
                                <h6>Категорія не вказана</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Секция комментариев -->
        <div class="comments-section mt-4">
            <h5>Коментарі</h5>
            <div class="comments-list mb-3">
                @forelse($user->receivedComments as $comment)
                    <div class="comment border-bottom mb-2 pb-2 d-flex flex-column">
                        <div class="d-flex align-items-center">
                            @if(auth()->check())
                                <a href="{{ route('my_profile.show', ['user' => $comment->user->id]) }}" class="d-flex align-items-center text-decoration-none">
                                    <img src="{{ $comment->user->profile_photo_path ? asset('storage/' . $comment->user->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                        alt="{{ $comment->user->name }}'s avatar"
                                        class="rounded-circle me-2"
                                        style="width: 30px; height: 30px; object-fit: cover;">
                                    <strong class="text-dark">{{ $comment->user->name }}</strong>
                                </a>
                            @else
                                <strong>{{ $comment->user->name }}</strong>
                            @endif
                            <small class="text-muted ms-2"> — {{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-0 mt-1">{{ $comment->content }}</p>
                    </div>
                @empty
                    <p>Коментарів поки що немає.</p>
                @endforelse
            </div>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="commentable_id" value="{{ $user->id }}">
                <input type="hidden" name="commentable_type" value="App\Models\User">
                <div class="mb-3">
                    <textarea class="form-control" name="content" rows="3" placeholder="Залишіть коментар" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Залишити коментар</button>
            </form>
        </div>
    </div>
</section>

<!-- Модальное окно для отображения отзывов в профиле для исполнителей и заказчиков -->
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
                // Отзывы для исполнителя: отзыв оставлен заказчиком (review_by = 'customer')
                $reviews = $user->reviewsReceived()->where('review_by', 'customer')->latest()->get();
            } else {
                // Для заказчика: выбираем отзывы, где заказчик является объектом (customer_id) и отзыв оставлен исполнителем
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
@endsection
