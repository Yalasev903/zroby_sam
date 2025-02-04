@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Исполнители</h2>
    <div class="row">
        @foreach($executors as $executor)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Добавляем изображение профиля -->
                        <div class="text-center mb-3">
                            <img src="{{ $executor->profile_photo_path ? asset('storage/' . $executor->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                 alt="{{ $executor->name }}'s photo"
                                 class="card-img-top rounded"
                                 style="object-fit: cover; height: 200px;">
                        </div>

                        <h5 class="card-title">{{ $executor->name }}</h5>
                        <p class="card-text"><strong>Місто:</strong> {{ $executor->city }}</p>
                        <p class="card-text"><strong>Навички:</strong> {{ $executor->skills }}</p>
                        <p class="card-text"><strong>Рейтинг:</strong> ⭐{{ $executor->rating }}</p>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#executorModal{{ $executor->id }}">
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
                            <!-- Изображение в модальном окне -->
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
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
