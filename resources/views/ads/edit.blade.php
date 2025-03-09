@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редагувати Оголошення</h1>

    <form action="{{ route('ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Заголовок -->
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $ad->title) }}" required>
        </div>

        <!-- Описание -->
        <div class="form-group mt-3">
            <label for="description">Опис</label>
            <textarea class="form-control" name="description" id="description" rows="5" required>{{ old('description', $ad->description) }}</textarea>
        </div>

        <!-- Город -->
        <div class="form-group mt-3">
            <label for="city">Місто</label>
            <input type="text" class="form-control" name="city" id="city" value="{{ old('city', $ad->city) }}" required>
        </div>

        <!-- Выбор категории объявления -->
        <div class="form-group mt-3">
            <label for="services_category_id">Категорія</label>
            <select name="services_category_id" id="services_category_id" class="form-control" required>
                <option value="">Оберіть категорію</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('services_category_id', $ad->services_category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('services_category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Текущее изображение -->
        @if($ad->photo_path)
            <div class="form-group mt-3">
                <label>Поточне зображення</label>
                <div>
                    <img src="{{ asset('storage/' . $ad->photo_path) }}" alt="Фото оголошення" class="img-fluid" style="max-width: 200px;">
                </div>
            </div>
        @endif

        <!-- Новое изображение -->
        <div class="form-group mt-3">
            <label for="photo">Нове Фото (необов’язково)</label>
            <input type="file" class="form-control" name="photo" id="photo">
        </div>

        <button type="submit" class="btn btn-success mt-3">Оновити Оголошення</button>
    </form>
</div>
@endsection
