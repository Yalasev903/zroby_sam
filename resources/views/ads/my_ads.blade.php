@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Мої оголошення</h1>

    @if($ads->isEmpty())
        <p>У вас ще немає оголошень.</p>
    @else
        <div class="row">
            @foreach($ads as $ad)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <img src="{{ $ad->photo_path ? asset('storage/' . $ad->photo_path) : asset('images/default-avatar.webp') }}"
                             alt="{{ $ad->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <!-- Заголовок объявления -->
                            <h5 class="card-title">{{ $ad->title }}</h5>

                            <!-- Краткое описание -->
                            <p class="card-text">{{ Str::limit($ad->description, 100) }}</p>

                            <!-- Проверяем, является ли пользователь владельцем объявления -->
                            @if(Auth::id() === $ad->user_id)
                                <div class="d-flex justify-content-between mt-2">
                                    <!-- Кнопка "Редагувати" -->
                                    <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-warning btn-sm">
                                        Редагувати
                                    </a>

                                    <!-- Кнопка "Видалити" -->
                                    <form action="{{ route('ads.destroy', $ad->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити це оголошення?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
