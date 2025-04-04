@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Створити Оголошення</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Заголовок объявления -->
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Описание объявления -->
        <div class="form-group mt-3">
            <label for="description">Опис</label>
            <textarea class="form-control" name="description" id="description" rows="5" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Выбор категории объявления -->
        <div class="form-group mt-3">
            <label for="services_category_id">Категорія</label>
            <select name="services_category_id" id="services_category_id" class="form-control" required>
                <option value="">Оберіть категорію</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('services_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('services_category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Выбор города -->
        <div class="form-group mt-3">
            <label for="city">Місто</label>
            <select name="city" id="city" class="form-control" required>
                <option value="">Оберіть місто</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}" {{ old('city') == $city ? 'selected' : '' }}>
                        {{ $city }}
                    </option>
                @endforeach
            </select>
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Фото объявления -->
        <div class="form-group mt-3">
            <label for="photo">Фото</label>
            <input type="file" class="form-control" name="photo" id="photo">
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <style>
            .btn {
                border-radius: 50ch;
            }
        </style>

        <button type="submit" class="btn btn-primary mt-3">Створити Оголошення</button>
    </form>
</div>
@endsection
