@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Залишити скаргу для замовлення: {{ $order->title }}</h2>

    <form action="{{ route('tickets.store', $order) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="complaint">Текст скарги</label>
            <textarea name="complaint" id="complaint" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Відправити скаргу</button>
    </form>
</div>
@endsection
