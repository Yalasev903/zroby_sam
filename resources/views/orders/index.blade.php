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
                        {{-- Изображение --}}
                        @if($order->ad && $order->ad->photo_path)
                            <img src="{{ asset('storage/' . $order->ad->photo_path) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Order Image">
                        @else
                            <img src="{{ asset('images/default-ad.webp') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Default Order">
                        @endif

                        {{-- Заголовок --}}
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">{{ $order->title }}</h5>
                        </div>

                        {{-- Основная информация --}}
                        <div class="card-body">
                            <p class="card-text">{{ $order->description }}</p>
                            <ul class="list-unstyled">
                                <li><strong>Категорія:</strong> {{ $order->servicesCategory->name ?? '—' }}</li>
                                <li><strong>Статус:</strong> {{ $order->status }}</li>
                                <li><strong>Час виконання:</strong>
                                    @if($order->start_time && $order->end_time)
                                        {{ $order->start_time->diffForHumans($order->end_time, true) }}
                                    @else - @endif
                                </li>
                                <li><strong>Оплата через гаранта:</strong> {{ $order->isGuarantee() ? 'Так' : 'Ні' }}</li>
                                <li><strong>Замовник:</strong>
                                    @if($order->customer)
                                        <img src="{{ asset($order->customer->profile_photo_path ? 'storage/' . $order->customer->profile_photo_path : 'images/default-avatar.webp') }}"
                                             class="rounded-circle" style="width:30px; height:30px; object-fit:cover; margin-right:5px;">
                                        <a href="{{ route('my_profile.show', $order->customer->id) }}">{{ $order->customer->name }}</a>
                                    @else — @endif
                                </li>
                                <li><strong>Виконавець:</strong>
                                    @if($order->executor)
                                        <img src="{{ asset($order->executor->profile_photo_path ? 'storage/' . $order->executor->profile_photo_path : 'images/default-avatar.webp') }}"
                                             class="rounded-circle" style="width:30px; height:30px; object-fit:cover; margin-right:5px;">
                                        <a href="{{ route('my_profile.show', $order->executor->id) }}">{{ $order->executor->name }}</a>
                                    @else — @endif
                                </li>
                                @if($order->isGuarantee())
                                    @if($order->guarantee_payment_status === 'transferring')
                                        <li><strong>💸 Виплата:</strong> В процесі переказу...</li>
                                    @elseif($order->guarantee_payment_status === 'transferred')
                                        <li>
                                            <strong>💸 Виконано виплату:</strong>
                                            {{ $order->guarantee_transferred_at->format('d.m.Y H:i') }} на карту
                                            {{ $order->maskedCard() }} —
                                            <span class="text-success">{{ number_format($order->guarantee_amount * 0.9, 2) }} грн</span>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>

                        {{-- Кнопки действий --}}
                        <div class="card-footer">
                            {{-- Гарант предложен исполнителем --}}
                            @if(auth()->user()->role == 'executor' && $order->status == 'waiting' && $order->payment_type === 'none')
                                <form method="POST" action="{{ route('orders.setGuarantee', $order) }}">
                                    @csrf
                                    <input type="number" name="guarantee_amount" class="form-control form-control-sm mb-1" placeholder="Сума гаранта" required step="0.01">
                                    <input type="text" name="guarantee_card_number" class="form-control form-control-sm mb-1" placeholder="Номер карти (16 цифр)" required>
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Запропонувати гаранта</button>
                                </form>
                                <form method="POST" action="{{ route('orders.setNoGuarantee', $order) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-sm mt-2">Працювати без гаранта</button>
                                </form>
                            @endif

                            {{-- Заказчик оплачивает гаранту --}}
                            @if(auth()->user()->role == 'customer' && $order->isGuarantee() && $order->guarantee_payment_status === 'pending')
                                <a href="{{ route('orders.approveGuarantee', $order) }}" class="btn btn-success btn-sm">Оплатити гаранту</a>
                            @endif

                            {{-- Подтвердить начало (если вибрано без гаранта) --}}
                            @if(auth()->user()->role == 'customer' && $order->status == 'waiting' && $order->isNoGuarantee())
                                <form method="POST" action="{{ route('orders.approve', $order) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Одобрити початок</button>
                                </form>
                            @endif

                            {{-- Подтвердить выполнение --}}
                            @if(auth()->user()->role == 'executor' && $order->status == 'in_progress')
                                <form method="POST" action="{{ route('orders.complete', $order) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Підтвердити виконання</button>
                                </form>
                            @endif

                            {{-- Подтвердить завершение --}}
                            @if(auth()->user()->role == 'customer' && $order->status == 'pending_confirmation')
                                <form method="POST" action="{{ route('orders.confirm', $order) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">Підтвердити завершення</button>
                                </form>
                            @endif

                            {{-- Отмена --}}
                            @if(!in_array($order->status, ['completed', 'cancelled']))
                                @if(auth()->id() === $order->user_id || auth()->id() === $order->executor_id)
                                    <form method="POST" action="{{ route('orders.cancel', $order) }}" class="d-inline">
                                        @csrf
                                        <select name="cancellation_reason" class="form-control form-control-sm d-inline w-auto" onchange="toggleCustomReason(this)">
                                            <option value="">Причина скасування</option>
                                            <option value="Непередбачені обставини">Непередбачені обставини</option>
                                            <option value="Зміна пріоритетів">Зміна пріоритетів</option>
                                            <option value="Особисті причини">Особисті причини</option>
                                            <option value="Неможливість виконання замовлення">Неможливість виконання</option>
                                            <option value="other">Інша причина</option>
                                        </select>
                                        <input type="text" name="custom_reason" class="form-control form-control-sm d-inline w-auto" placeholder="Введіть свою причину" style="display: none;">
                                        <button type="submit" class="btn btn-danger btn-sm">Відмінити</button>
                                    </form>
                                @endif
                            @endif

                            {{-- Жалоба --}}
                            @if($order->status === 'cancelled' && !$order->ticket)
                            <a href="/tickets/create/{{ $order->id }}" class="btn btn-secondary btn-sm">Залишити скаргу</a>
                            @elseif($order->ticket && auth()->id() === $order->ticket->user_id)
                                <span class="text-muted">Скарга залишена</span>
                            @endif
                            {{-- Кнопка чата --}}
                            @if($order->customer && $order->executor)
                                @if(auth()->id() === $order->executor_id)
                                    <a href="{{ route('user', $order->user_id) }}" class="btn btn-outline-dark btn-sm">
                                        💬 Чат із замовником
                                    </a>
                                @elseif(auth()->id() === $order->user_id)
                                    <a href="{{ route('user', $order->executor_id) }}" class="btn btn-outline-dark btn-sm">
                                        💬 Чат з виконавцем
                                    </a>
                                @endif
                            @endif
                            {{-- Отзывы --}}
                            @if(auth()->user()->role === 'customer' && $order->status === 'completed' && !$order->reviews()->where('review_by', 'customer')->exists())
                                <a href="{{ route('reviews.create', ['order' => $order->id]) }}" class="btn btn-primary btn-sm">Відгук про виконавця</a>
                            @endif

                            @if(auth()->user()->role === 'executor' && $order->status === 'completed' && !$order->reviews()->where('review_by', 'executor')->exists())
                                @if(Route::has('reviews.create_customer'))
                                    <a href="{{ route('reviews.create_customer', $order) }}" class="btn btn-primary btn-sm">Відгук про замовника</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    function toggleCustomReason(select) {
        const customInput = select.nextElementSibling;
        customInput.style.display = select.value === 'other' ? 'inline-block' : 'none';
    }
</script>
@endsection
