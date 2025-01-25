@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Чат</h1>
    <form method="POST" action="{{ route('chat.send') }}">
        @csrf
        <textarea name="message" class="form-control mb-3" placeholder="Введите сообщение"></textarea>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>

    <div class="mt-5">
        <h2>Сообщения</h2>
        <ul>
            @foreach (\DB::table('messages')->orderBy('created_at', 'desc')->get() as $message)
                <li>
                    <strong>{{ \App\Models\User::find($message->user_id)->name }}:</strong>
                    {{ $message->message }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
