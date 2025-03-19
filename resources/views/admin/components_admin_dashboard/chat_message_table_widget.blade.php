<!-- dashboard body Item Start -->
<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <h3>Повідомлення у чаті</h3>
        <table class="table style-two">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Відправник (from_id)</th>
                    <th>Одержувач (to_id)</th>
                    <th>Повідомлення</th>
                    <th>Вкладення</th>
                    <th>Статус</th>
                    <th>Дата створення</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chatMessages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->from_id }}</td>
                    <td>{{ $message->to_id }}</td>
                    <td>{{ $message->body ?: '—' }}</td>
                    <td>
                        @if($message->attachment)
                            <a href="{{ asset('storage/' . $message->attachment) }}" target="_blank">Просмотр</a>
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $message->seen ? 'Просмотрено' : 'Не просмотрено' }}</td>
                    <td>{{ $message->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.chat.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить сообщение?');" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- dashboard body Item End -->
