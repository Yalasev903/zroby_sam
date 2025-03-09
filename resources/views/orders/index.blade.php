@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Список замовлень</h2>

    @if($orders->isEmpty())
        <p>Замовлень немає.</p>
    @else
        <div class="row">
            @foreach($orders as $order)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <!-- Изображение заказа (из объявления) -->
                        @if($order->ad && $order->ad->photo_path)
                            <img src="{{ asset('storage/' . $order->ad->photo_path) }}" alt="Order Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-ad.webp') }}" alt="Default Order Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif

                        <!-- Заголовок карточки -->
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">{{ $order->title }}</h5>
                        </div>

                        <!-- Тело карточки с информацией о заказе -->
                        <div class="card-body">
                            <p class="card-text">{{ $order->description }}</p>
                            <ul class="list-unstyled">
                                <li>
                                    <strong>Категорія:</strong>
                                    {{ $order->servicesCategory ? $order->servicesCategory->name : '—' }}
                                </li>
                                <li>
                                    <strong>Статус:</strong>
                                    {{ $order->status }}
                                </li>
                                <li>
                                    <strong>Час виконання:</strong>
                                    @if($order->start_time && $order->end_time)
                                        {{ $order->start_time->diffForHumans($order->end_time, true) }}
                                    @else
                                        -
                                    @endif
                                </li>
                                <li>
                                    <strong>Замовник:</strong>
                                    @if($order->customer)
                                        <img src="{{ $order->customer->profile_photo_path ? asset('storage/' . $order->customer->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                             alt="{{ $order->customer->name }}"
                                             class="rounded-circle"
                                             style="width:30px; height:30px; object-fit: cover; margin-right:5px;">
                                        <a href="{{ route('my_profile.show', $order->customer->id) }}" class="text-decoration-none">
                                            {{ $order->customer->name }}
                                        </a>
                                    @else
                                        —
                                    @endif
                                </li>
                                <li>
                                    <strong>Виконавець:</strong>
                                    @if($order->executor)
                                        <img src="{{ $order->executor->profile_photo_path ? asset('storage/' . $order->executor->profile_photo_path) : asset('images/default-avatar.webp') }}"
                                             alt="{{ $order->executor->name }}"
                                             class="rounded-circle"
                                             style="width:30px; height:30px; object-fit: cover; margin-right:5px;">
                                        <a href="{{ route('my_profile.show', $order->executor->id) }}" class="text-decoration-none">
                                            {{ $order->executor->name }}
                                        </a>
                                    @else
                                        —
                                    @endif
                                </li>
                            </ul>
                        </div>

                        <!-- Подвал карточки с кнопками действий -->
                        <div class="card-footer">
                            @if(auth()->user()->role == 'customer' && $order->status == 'waiting')
                                <form method="POST" action="{{ route('orders.approve', $order) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Одобрити початок</button>
                                </form>
                            @endif

                            @if(auth()->user()->role == 'executor' && $order->status == 'in_progress')
                                <form method="POST" action="{{ route('orders.complete', $order) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Підтвердити виконання</button>
                                </form>
                            @endif

                            @if(auth()->user()->role == 'customer' && $order->status == 'pending_confirmation')
                                <form method="POST" action="{{ route('orders.confirm', $order) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">Підтвердити завершення</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
