<div class="container">
    <!-- Заголовок страницы -->
    {{-- <div class="row items-center pt-5 mb-4">
        <div class="col-12">
            <div class="ld-fancy-heading relative"></div>
            <h6 class="text-center mb-0/5em relative text-25 text-white-600 btn-sm tracking-1 font-bold bg-blue-700 py-3 px-5 rounded-100">
                Останні оголошення
            </h6>
            <p class="text-center text-18 text-gray-500">
                Переглядайте актуальні оголошення на нашій платформі.
            </p>
        </div>
    </div> --}}

    <!-- Карточки оголошень -->
    <div class="row">
        @foreach($ads as $ad)
            <!-- Добавляем класс "ad-card" и скрываем карточки, начиная с 7-й -->
            <div class="col-md-4 col-sm-6 mb-4 animation-element ad-card" style="{{ $loop->index >= 6 ? 'display: none;' : '' }}">
                <div class="card lqd-lp relative lqd-lp-style-6 lqd-lp-hover-img-zoom lqd-lp-animate-onhover rounded-4 overflow-hidden text-start">
                    <!-- Изображение объявления -->
                    <div class="lqd-lp-img overflow-hidden">
                        <figure>
                            <img src="{{ $ad->photo_path ? asset('storage/' . $ad->photo_path) : asset('images/default-avatar.webp') }}"
                                 alt="{{ $ad->title }}"
                                 class="w-full"
                                 style="object-fit: cover; height: 200px;">
                        </figure>
                    </div>

                    <!-- Метаданные (город) -->
                    <div class="lqd-lp-meta uppercase font-bold relative z-3">
                        @if($ad->city)
                            <ul class="lqd-lp-cat lqd-lp-cat-shaped lqd-lp-cat-solid reset-ul inline-ul font-bold uppercase tracking-0/1em">
                                <li>
                                    <a class="rounded-full" href="#" rel="category">{{ $ad->city }}</a>
                                </li>
                            </ul>
                        @endif
                    </div>

                    <header class="lqd-lp-header pt-1/5em px-1em">
                        <!-- Блок с автором и датой (дата справа) -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="lqd-lp-author d-flex align-items-center">
                                <img src="{{ $ad->user->profile_photo_path ? asset('storage/' . $ad->user->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                     alt="{{ $ad->user->name }}"
                                     class="rounded-circle"
                                     style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
                                <!-- Обновлённая ссылка: переходим по маршруту /profile/{id} -->
                                <h5 class="mb-0 text-gray-600" style="font-size: 16px;">
                                    <a href="my_profile/{{ $ad->user->id }}">
                                        {{ $ad->user->name }}
                                    </a>
                                </h5>
                            </div>
                            <div class="lqd-lp-date text-gray-600" style="font-size: 14px;">
                                {{ $ad->created_at->diffForHumans() }}
                            </div>
                        </div>

                        <!-- Заголовок объявления -->
                        <h2 class="entry-title lqd-lp-title mt-0/5em mb-0 h5">
                            {{ $ad->title }}
                        </h2>
                    </header>

                    <!-- Краткое описание объявления -->
                    <div class="lqd-lp-excerpt pt-1em pb-1/5em px-1em">
                        <p class="ld-fh-element mb-0/5em inline-block relative text-20 text-gray-600">
                            {{ Str::limit($ad->description, 100) }}
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
                    <!-- Кнопка для открытия модального окна -->
                    <div class="card-footer text-center">
                        <button class="btn btn-sm blue" data-bs-toggle="modal" data-bs-target="#adModal{{ $ad->id }}">
                            Подрібніше
                        </button>
                    </div>
                </div>
            </div>

            <!-- Модальное окно для объявления -->
            <div class="modal fade" id="adModal{{ $ad->id }}" tabindex="-1" aria-labelledby="adModalLabel{{ $ad->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <!-- Заголовок модального окна -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="adModalLabel{{ $ad->id }}">
                                {{ $ad->title }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрити"></button>
                        </div>

                        <!-- Содержимое объявления -->
                        <div class="modal-body">
                            <div class="text-center mb-3">
                                <img src="{{ $ad->photo_path ? asset('storage/' . $ad->photo_path) : asset('images/default-avatar.webp') }}"
                                    alt="{{ $ad->title }}"
                                    class="rounded"
                                    style="object-fit: cover; width: 100%; max-height: 400px;">
                            </div>
                            <p class="text-18 text-gray-700">
                                {{ $ad->description }}
                            </p>

                            <!-- Блок комментариев -->
                            <hr>
                            <div class="comments-section mt-4">
                                <h5>Коментарі</h5>

                                <!-- Список комментариев -->
                                <div class="comments-list mb-3">
                                    @forelse($ad->comments as $comment)
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

                                <!-- Форма добавления нового комментария -->
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <!-- Передаём идентификатор и тип комментарируемой модели -->
                                    <input type="hidden" name="commentable_id" value="{{ $ad->id }}">
                                    <input type="hidden" name="commentable_type" value="App\Models\Ad">
                                    <div class="mb-3">
                                        <textarea class="form-control" name="content" rows="3" placeholder="Залишіть коментар" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Залишити коментар</button>
                                </form>
                            </div>
                            <!-- /Блок комментариев -->
                        </div>

                        <!-- Футер модального окна -->
                        <div class="modal-footer d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{ $ad->user->profile_photo_path ? asset('storage/' . $ad->user->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                    alt="{{ $ad->user->name }}"
                                    class="rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
                                <small class="text-muted">
                                    Опубліковано {{ $ad->created_at->format('d.m.Y H:i') }} користувачем: {{ $ad->user->name }}
                                </small>
                            </div>
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
    @if(count($ads) > 6)
        <div class="text-center mt-4">
            <button id="loadMore" class="btn btn-sm blue">
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

<!-- Скрипт для реализации функционала "Load More" -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.ad-card');
    const loadMoreButton = document.getElementById('loadMore');
    let currentIndex = 6;
    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', function() {
            for (let i = currentIndex; i < currentIndex + 6 && i < cards.length; i++) {
                cards[i].style.display = 'block';
                cards[i].classList.add('fadeIn');
            }
            currentIndex += 6;
            if (currentIndex >= cards.length) {
                loadMoreButton.style.display = 'none';
            }
        });
    }
});
</script>
