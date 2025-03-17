<!-- dashboard body Item Start -->
<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <h3>Замовлення</h3>
        <table class="table style-two">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Статус</th>
                    <th>Замовник</th>
                    <th>Виконавець</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->title }}</td>
                    <td>
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <select name="status" onchange="this.form.submit()">
                                <option value="new" {{ $order->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="waiting" {{ $order->status === 'waiting' ? 'selected' : '' }}>Waiting</option>
                                <option value="in_progress" {{ $order->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="pending_confirmation" {{ $order->status === 'pending_confirmation' ? 'selected' : '' }}>Pending Confirmation</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        @if($order->customer)
                            <a href="{{ route('my_profile.show', $order->customer->id) }}">{{ $order->customer->name }}</a>
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        @if($order->executor)
                            <a href="{{ route('my_profile.show', $order->executor->id) }}">{{ $order->executor->name }}</a>
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить заказ?');" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Видалити</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- dashboard body Item End -->
