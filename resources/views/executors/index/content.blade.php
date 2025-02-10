<div class="container">
    <!-- Заголовок страницы -->
    {{-- <div class="row items-center pt-5 mb-4">
    </div> --}}
    <div class="row items-center pt-5">
        @foreach($executors as $executor)
            <!-- Оборачиваем карточку в блок с классом executor-card и скрываем, если индекс >= 6 -->
            <div class="col-md-4 col-sm-6 mb-4 animation-element executor-card" style="{{ $loop->index >= 6 ? 'display: none;' : '' }}">
                <div class="card lqd-lp relative lqd-lp-style-6 lqd-lp-hover-img-zoom lqd-lp-animate-onhover rounded-4 overflow-hidden text-start">
                    <div class="lqd-lp-img overflow-hidden">
                        <figure>
                            <img src="{{ $executor->profile_photo_path ? asset('storage/' . $executor->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                 alt="{{ $executor->name }}'s photo"
                                 class="w-full"
                                 style="object-fit: cover; height: 200px;">
                        </figure>
                    </div>
                    <div class="lqd-lp-meta uppercase font-bold relative z-3">
                        <span class="screen-reader-text">Роль</span>
                        <ul class="lqd-lp-cat lqd-lp-cat-shaped lqd-lp-cat-solid reset-ul inline-ul font-bold uppercase tracking-0/1em">
                            <li>
                                <a class="rounded-full" href="#" rel="category">{{ $executor->role }}</a>
                            </li>
                        </ul>
                    </div>
                    <header class="lqd-lp-header pt-1/5em px-1em">
                        <div class="lqd-lp-meta lqd-lp-meta-dot-between flex flex-wrap items-center">
                            <div class="lqd-lp-author relative z-3">
                                <!-- Обновлённая ссылка: переходим по маршруту /profile/{id} -->
                                <h3 class="ld-fh-element mb-0/5em inline-block relative text-40 text-gray-600">
                                    <a href="{{ route('my_profile.show', ['user' => $executor->id]) }}">
                                        {{ $executor->name }}
                                    </a>
                                </h3>
                            </div>
                            <time class="lqd-lp-date" datetime="{{ $executor->created_at }}">
                                {{ $executor->created_at->diffForHumans() }}
                            </time>
                        </div>
                        <h2 class="entry-title lqd-lp-title mt-0/5em mb-0 h5">
                            Рейтинг: ⭐{{ $executor->rating }}
                        </h2>
                    </header>
                    <div class="lqd-lp-excerpt pt-1em pb-1/5em px-1em">
                        <p class="ld-fh-element mb-0/5em inline-block relative text-20 text-gray-600">
                            <strong>Місто:</strong> {{ $executor->city }}
                        </p>
                        <p class="ld-fh-element mb-0/5em inline-block relative text-20 text-gray-600">
                            <strong>Навички:</strong> {{ $executor->skills }}
                        </p>
                    </div>
                    <style>
                        .btn {
                            display: inline-block;
                            position: relative;
                            padding: 12px 25px;
                            font-size: 16px;
                            font-weight: bold;
                            text-transform: uppercase;
                            border: none;
                            border-radius: 50px; /* Полностью скругленные кнопки */
                            cursor: pointer;
                            transition: all 0.3s ease;
                            background: linear-gradient(45deg, #007bff, #0056b3);
                            color: white;
                            overflow: hidden;
                        }
                    </style>
                    <div class="card-footer text-center">
                        <button class="btn btn-sm blue" data-text="Подрібніше" data-split-text="true"
                                data-split-options='{"type": "chars, words"}' data-bs-toggle="modal"
                                data-bs-target="#executorModal{{ $executor->id }}">
                            Подрібніше
                        </button>
                    </div>
                </div>
            </div>
<!-- Popup Modal -->
<div class="modal fade" id="executorModal{{ $executor->id }}" tabindex="-1" aria-labelledby="executorModalLabel{{ $executor->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <h5 class="modal-title" id="executorModalLabel{{ $executor->id }}">
                    {{ $executor->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Тело модального окна с информацией об исполнителе -->
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img src="{{ $executor->profile_photo_path ? asset('storage/' . $executor->profile_photo_path) : asset('images/default-avatar.webp') }}"
                         alt="{{ $executor->name }}'s photo"
                         class="rounded"
                         style="object-fit: cover; width: 100%; height: 300px;">
                </div>
                <p><strong>Місто:</strong> {{ $executor->city }}</p>
                <p><strong>Навички:</strong> {{ $executor->skills }}</p>
                <p><strong>Категорія:</strong> {{ $executor->services_category }}</p>
                <p>
                    <strong>Послуги:</strong>
                    {{ implode(', ', json_decode($executor->services, true) ?: []) }}
                </p>
                <p><strong>Рейтинг:</strong> ⭐{{ $executor->rating }}</p>

                <!-- Блок комментариев -->
                <hr>
                <div class="comments-section mt-4">
                    <h5>Коментарі</h5>

                    <!-- Список комментариев -->
                <div class="comments-list mb-3">
                    @forelse($executor->receivedComments as $comment)
                        <div class="comment border-bottom mb-2 pb-2">
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
                            <p class="mb-0 mt-1">{{ $comment->content }}</p>
                        </div>
                    @empty
                        <p>Коментарів поки що немає.</p>
                    @endforelse
                </div>


                    <!-- Форма добавления нового комментария -->
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <!-- Передаём идентификатор и тип комментарируемой модели -->
                        <input type="hidden" name="commentable_id" value="{{ $executor->id }}">
                        <input type="hidden" name="commentable_type" value="App\Models\User">

                        <div class="mb-3">
                            <textarea class="form-control" name="content" rows="3" placeholder="Залишіть коментар" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Залишити коментар</button>
                    </form>
                </div>
                <!-- /Блок комментариев -->
            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                                Закрити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Кнопка "Більше", если карточек больше 6 -->
    @if(count($executors) > 6)
        <div class="text-center mt-4">
            <button id="loadMoreExecutors" class="btn btn-sm blue">
                Більше
            </button>
        </div>
    @endif
</div>

<!-- Стили для анимации появления карточек -->
<style>
    .fadeIn {
        animation: fadeIn 0.5s ease-in forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- Скрипт для реализации функционала "Load More" для исполнителей -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const executorCards = document.querySelectorAll('.executor-card');
    const loadMoreButton = document.getElementById('loadMoreExecutors');
    let currentIndex = 6;
    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', function() {
            for (let i = currentIndex; i < currentIndex + 6 && i < executorCards.length; i++) {
                executorCards[i].style.display = 'block';
                executorCards[i].classList.add('fadeIn');
            }
            currentIndex += 6;
            if (currentIndex >= executorCards.length) {
                loadMoreButton.style.display = 'none';
            }
        });
    }
});
</script>

