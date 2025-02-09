@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row items-center pt-5">
        @foreach($executors as $executor)
            <div class="col-md-4 col-sm-6 mb-4 animation-element">
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
                            <li><a class="rounded-full" href="#" rel="category">{{ $executor->role }}</a></li>
                        </ul>
                    </div>
                    <header class="lqd-lp-header pt-1/5em px-1em">
                        <div class="lqd-lp-meta lqd-lp-meta-dot-between flex flex-wrap items-center">
                            <div class="lqd-lp-author relative z-3">
                                <h3  class="ld-fh-element mb-0/5em inline-block relative text-40 text-gray-600">
                                    <a href="#">{{ $executor->name }}</a>
                                </h3>
                            </div>
                            <time class="lqd-lp-date" datetime="{{ $executor->created_at }}">{{ $executor->created_at->diffForHumans() }}</time>
                        </div>
                        <h2 class="entry-title lqd-lp-title mt-0/5em mb-0 h5">Рейтинг: ⭐{{ $executor->rating }}</h2>
                    </header>
                    <div class="lqd-lp-excerpt pt-1em pb-1/5em px-1em">
                        <p class="ld-fh-element mb-0/5em inline-block relative text-20 text-gray-600"><strong>Місто:</strong> {{ $executor->city }}</p>
                        <p class="ld-fh-element mb-0/5em inline-block relative text-20 text-gray-600"><strong >Навички:</strong> {{ $executor->skills }}</p>
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
                        <div class="modal-header">
                            <h5 class="modal-title" id="executorModalLabel{{ $executor->id }}">{{ $executor->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
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
                            <p><strong>Послуги:</strong> {{ implode(', ', json_decode($executor->services, true) ?: []) }}</p>
                            <p><strong>Рейтинг:</strong> ⭐{{ $executor->rating }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Закрити</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection



