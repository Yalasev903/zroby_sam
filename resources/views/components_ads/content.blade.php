<div class="container">
    <!-- Карточки оголошень -->
    <div class="row">
        @foreach($ads as $ad)
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

                        @if($ad->servicesCategory)
                            <ul class="lqd-lp-cat lqd-lp-cat-shaped lqd-lp-cat-solid reset-ul inline-ul font-bold uppercase tracking-0/1em">
                                <li>
                                    <a class="rounded-full" href="#" rel="category">{{ $ad->servicesCategory->name }}</a>
                                </li>
                            </ul>
                        @endif
                    </div>

                    <header class="lqd-lp-header pt-1/5em px-1em">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="lqd-lp-author d-flex align-items-center">
                                <img src="{{ $ad->user->profile_photo_path ? asset('storage/' . $ad->user->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                     alt="{{ $ad->user->name }}"
                                     class="rounded-circle"
                                     style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
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
                        <h2 class="entry-title lqd-lp-title mt-0/5em mb-0 h5">
                            {{ $ad->title }}
                        </h2>
                    </header>

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
                            border-radius: 50px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            background: linear-gradient(45deg, #007bff, #0056b3);
                            color: white;
                            overflow: hidden;
                        }
                    </style>
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
                        <div class="modal-header">
                            <h5 class="modal-title" id="adModalLabel{{ $ad->id }}">
                                {{ $ad->title }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрити"></button>
                        </div>
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
                            <hr>
                            <div class="comments-section mt-4">
                                <h5>Коментарі</h5>
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
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="commentable_id" value="{{ $ad->id }}">
                                    <input type="hidden" name="commentable_type" value="App\Models\Ad">
                                    <div class="mb-3">
                                        <textarea class="form-control" name="content" rows="3" placeholder="Залишіть коментар" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Залишити коментар</button>
                                </form>
                            </div>
                        </div>
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
                            <div>
                                {{-- Если пользователь-исполнитель и заказ для объявления ещё не создан, отображаем кнопку ---}}
                                @if(auth()->check() && auth()->user()->role == 'executor' && !$ad->order)
                                    <form action="{{ route('orders.take', $ad->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Узяти замовлення</button>
                                    </form>
                                @endif
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                                    Закрити
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(count($ads) > 6)
        <div class="text-center mt-4">
            <button id="loadMore" class="btn btn-sm blue">
                Більше
            </button>
        </div>
    @endif
</div>

<style>
    .fadeIn {
        animation: fadeIn 0.5s ease-in forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

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
