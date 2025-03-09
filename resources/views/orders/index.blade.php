@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Список замовлень</h2>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Опис</th>
                    <th>Категорія</th>
                    <th>Статус</th>
                    <th>Замовник</th>
                    <th>Виконавець</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->title }}</td>
                        <td>{{ $order->description }}</td>
                        <td>{{ $order->servicesCategory ? $order->servicesCategory->name : '—' }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @if($order->customer)
                                <a href="{{ route('my_profile.show', $order->customer->id) }}">
                                    {{ $order->customer->name }}
                                </a>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            @if($order->executor)
                                <a href="{{ route('my_profile.show', $order->executor->id) }}">
                                    {{ $order->executor->name }}
                                </a>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            @if(auth()->user()->role == 'customer' && $order->status == 'waiting')
                                <form method="POST" action="{{ route('orders.approve', $order) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Одобрити початок виконання замовлення</button>
                                </form>
                            @endif

                            @if(auth()->user()->role == 'executor' && $order->status == 'in_progress')
                                <form method="POST" action="{{ route('orders.complete', $order) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Підтвердити виконання замовлення</button>
                                </form>
                            @endif

                            @if(auth()->user()->role == 'customer' && $order->status == 'pending_confirmation')
                                <form method="POST" action="{{ route('orders.confirm', $order) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-info">Підтвердити завершення замовлення</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
