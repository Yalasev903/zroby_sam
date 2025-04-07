@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>➕ Додати проект у портфоліо</h2>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" class="mt-4 bg-white p-4 rounded shadow">
        @csrf
        <div class="mb-3">
            <label for="images">🖼️ Завантажити зображення проєктів:</label>
            <input type="file" name="images[]" class="form-control" multiple required>
        </div>
        <div class="mb-3">
            <input type="text" name="title" class="form-control" placeholder="✏️ Назва проєкту (необов'язково)">
        </div>
        <div class="mb-3">
            <textarea name="description" class="form-control" rows="2" placeholder="📝 Опис (необов'язково)"></textarea>
        </div>
        <button type="submit" class="btn btn-success">✅ Зберегти</button>
    </form>
</div>
@endsection
