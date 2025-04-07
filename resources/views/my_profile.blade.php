@extends('layouts.app')

@section('content')
<section class="lqd-section new-features py-30" id="profile-section">
    <div class="container">
        <div class="row align-items-start">
            <!-- Левая колонка: Аватар + Слайдер -->
            <div class="col-md-4 text-center mb-4">
                <!-- Аватар -->
                <figure class="mx-auto mb-4" style="width: 230px; height: 230px;">
                    @if($user->profile_photo_path)
                        <img class="img-fluid rounded-circle object-fit-cover" style="width: 100%; height: 100%;"
                             src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}">
                    @else
                        <img class="img-fluid rounded-circle object-fit-cover" style="width: 100%; height: 100%;"
                             src="{{ asset('images/default-avatar.webp') }}" alt="{{ $user->name }}">
                    @endif
                </figure>

                <!-- 🎨 Слайдер портфолио -->
                @if($user->portfolioProjects->count())
                    <div class="mb-3">
                        <h5 class="text-start"><span class="me-1">🎨</span>Портфоліо</h5>
                        <div id="portfolioCarousel" class="carousel slide shadow rounded" data-bs-ride="carousel">
                            <div class="carousel-inner rounded">
                                @foreach($user->portfolioProjects as $key => $project)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#portfolioModal{{ $project->id }}">
                                            <img src="{{ asset('storage/' . $project->image) }}"
                                                 class="d-block w-100 rounded"
                                                 style="height: 200px; object-fit: cover;"
                                                 alt="{{ $project->title }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#portfolioCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#portfolioCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
                            </button>
                        </div>
                    </div>
                @endif

                <!-- ➕ Кнопка "Добавить проект" -->
                @if(auth()->check() && auth()->id() === $user->id && in_array($user->role, ['executor', 'customer']))
                    <a href="{{ route('portfolio.create') }}" class="btn btn-success w-100 mb-3">
                        ➕ Додати проект у портфоліо
                    </a>
                @endif

                <!-- 📩 Чат и ⭐ Відгуки -->
                <a href="{{ url('/chat/' . $user->id) }}" class="btn btn-primary w-100 mb-2">
                    Почати чат
                </a>

                @if(in_array($user->role, ['executor', 'customer']))
                    <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#reviewsModal">
                        ⭐ Відгуки
                    </button>
                @endif
            </div>

            <!-- Правая колонка: Инфо о пользователе -->
            <div class="col-md-8 bg-white rounded shadow p-5 text-md-end text-start">
                <h2 class="mb-3">{{ $user->name }}</h2>
                <p><strong>Ваш рейтинг:</strong> ⭐ {{ $user->rating ?? 0 }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Телефон:</strong> {{ $user->phone ?? 'Не вказан' }}</p>
                <p><strong>Місто:</strong> {{ $user->city ?? 'Не вказан' }}</p>
                <p><strong>ID користувача:</strong> {{ $user->id }}</p>
                <hr>
                <p><strong>Роль:</strong> {{ $user->role }}</p>

                <div class="mt-3">
                    <h5>
                        @if($user->role === 'executor') Навички
                        @elseif($user->role === 'customer') Компанія
                        @endif
                    </h5>
                    @if($user->role === 'executor' && !empty($userServices))
                        @foreach($userServices as $service)
                            <span class="badge bg-secondary me-1 mb-1">{{ $service }}</span>
                        @endforeach
                    @elseif($user->role === 'customer')
                        <p class="mb-0">{{ $user->company_name ?? 'Не указана' }}</p>
                    @else
                        <p class="text-muted">Інформація відсутня</p>
                    @endif
                </div>

                <div class="mt-3">
                    <h5>Категорія послуг та послуги</h5>
                    @if(isset($userCategory) && $userCategory)
                        <p class="mb-0">{{ $userCategory->name }}</p>
                    @else
                        <p class="text-muted">Категорія не вказана</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Модалки для просмотра проектов -->
        @foreach($user->portfolioProjects as $project)
            <div class="modal fade" id="portfolioModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content bg-black text-white">
                        <div class="modal-body position-relative p-0">
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                            <img src="{{ asset('storage/' . $project->image) }}"
                                class="w-100"
                                style="max-height: 85vh; object-fit: contain;" alt="{{ $project->title }}">
                            @if($project->title || $project->description)
                                <div class="p-4">
                                    <h4>{{ $project->title }}</h4>
                                    <p>{{ $project->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- 💬 Комментарии -->
        <div class="comments-section mt-5">
            <h5>Коментарі</h5>
            <div class="comments-list mb-3">
                @forelse($user->receivedComments as $comment)
                    <div class="comment border-bottom mb-2 pb-2 d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('my_profile.show', ['user' => $comment->user->id]) }}" class="d-flex align-items-center text-decoration-none">
                                <img src="{{ $comment->user->profile_photo_path ? asset('storage/' . $comment->user->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                     alt="{{ $comment->user->name }}'s avatar"
                                     class="rounded-circle me-2"
                                     style="width: 30px; height: 30px; object-fit: cover;">
                                <strong class="text-dark">{{ $comment->user->name }}</strong>
                            </a>
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

<!-- Модалка отзывов -->
@if($user && in_array($user->role, ['executor', 'customer']))
<div class="modal fade" id="reviewsModal" tabindex="-1" aria-labelledby="reviewsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ваші відгуки</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрити"></button>
      </div>
      <div class="modal-body">
        @php
            $reviews = $user->role === 'executor'
                ? $user->reviewsReceived()->where('review_by', 'customer')->latest()->get()
                : \App\Models\Review::where('customer_id', $user->id)->where('review_by', 'executor')->latest()->get();
        @endphp

        @if($reviews->isEmpty())
            <p>Відгуки відсутні.</p>
        @else
            <ul class="list-group">
                @foreach($reviews as $review)
                    <li class="list-group-item d-flex align-items-start">
                        <img src="{{ $review->review_by === 'customer' ? asset('storage/' . $review->customer->profile_photo_path) : asset('storage/' . $review->executor->profile_photo_path) }}"
                             alt="avatar"
                             class="rounded-circle me-2"
                             style="width:40px; height:40px; object-fit: cover;">
                        <div>
                            <strong>{{ $review->review_by === 'customer' ? 'Замовник' : 'Виконавець' }}:</strong>
                            {{ $review->review_by === 'customer' ? $review->customer->name : $review->executor->name }}<br>
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
