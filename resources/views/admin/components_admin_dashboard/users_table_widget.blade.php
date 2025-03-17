<!-- dashboard body Item Start -->
<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table style-two">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Им'я</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('admin.users.update', $user) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <select name="role" onchange="this.form.submit()">
                                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Замовник</option>
                                <option value="executor" {{ $user->role === 'executor' ? 'selected' : '' }}>Виконувач</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Адмін</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить пользователя?');" style="display: inline-block;">
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
