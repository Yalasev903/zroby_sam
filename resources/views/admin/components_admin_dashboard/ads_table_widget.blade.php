<!-- dashboard body Item Start -->
<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <h3>Оголошення</h3>
        <table class="table style-two">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Автор</th>
                    <th>Місто</th>
                    <th>Категорія</th>
                    <th>Дата розміщення</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ads as $ad)
                <tr>
                    <td>{{ $ad->id }}</td>
                    <td>{{ $ad->title }}</td>
                    <td>
                        @if($ad->user)
                            <a href="{{ route('my_profile.show', $ad->user->id) }}">{{ $ad->user->name }}</a>
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $ad->city }}</td>
                    <td>{{ $ad->servicesCategory ? $ad->servicesCategory->name : '—' }}</td>
                    <td>{{ $ad->posted_at ? $ad->posted_at->format('d.m.Y H:i') : '—' }}</td>
                    <td>
                        <a href="{{ route('admin.ads.edit', $ad) }}" class="btn btn-primary btn-sm">Редагувати</a>
                        <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити оголошення?');" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- dashboard body Item End -->
