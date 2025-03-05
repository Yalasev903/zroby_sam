@foreach($orders as $order)
    <div class="order-card">
        <h3>{{ $order->title }}</h3>
        <p>{{ $order->description }}</p>
        <p>Статус: {{ $order->status }}</p>

        <!-- Если заказ в статусе waiting и пользователь - заказчик, показываем кнопку подтверждения -->
        @if(auth()->user()->role == 'customer' && $order->status == 'waiting')
            <form method="POST" action="{{ route('orders.approve', $order) }}">
                @csrf
                <button type="submit" class="btn btn-success">Разрешить выполнение заказа</button>
            </form>
        @endif

        <!-- Остальные кнопки (для in_progress, pending_confirmation) остаются -->
        @if(auth()->user()->role == 'executor' && $order->status == 'in_progress')
            <form method="POST" action="{{ route('orders.complete', $order) }}">
                @csrf
                <button type="submit" class="btn btn-warning">Подтвердить выполнение заказа</button>
            </form>
        @endif

        @if(auth()->user()->role == 'customer' && $order->status == 'pending_confirmation')
            <form method="POST" action="{{ route('orders.confirm', $order) }}">
                @csrf
                <button type="submit" class="btn btn-info">Подтвердить завершение заказа</button>
            </form>
        @endif
    </div>
@endforeach
