@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Профиль пользователя</h1>
    <p><strong>Имя:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Рейтинг:</strong> {{ $user->rating }}</p>

    <a href="#" class="btn btn-primary">Редактировать профиль</a>
</div>
@endsection
