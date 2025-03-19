@include('admin.components_admin_dashboard.header')
@include('admin.components_admin_dashboard.mobile_menu')
@include('admin.components_admin_dashboard.dashboard_sidebar')
@include('admin.components_admin_dashboard.dashboard_nav')
@include('admin.components_admin_dashboard.welcome')
<!-- dashboard body Item Start -->
<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <h3>Користувачі</h3>

        <!-- Поле поиска -->
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Пошук...">

        <table class="table style-two" id="usersTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">ID ▲▼</th> <!-- Сортировка только по ID -->
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
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити користувача?');" style="display: inline-block;">
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

<script>
    // Поиск по таблице с подсветкой
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#usersTable tbody tr");
        rows.forEach(row => {
            row.innerHTML = row.innerHTML.replace(/<mark>|<\/mark>/g, ""); // Убираем старые подсветки
            let found = false;
            row.querySelectorAll("td").forEach(cell => {
                let text = cell.innerText.toLowerCase();
                if (text.includes(filter) && filter !== "") {
                    found = true;
                    let regex = new RegExp(`(${filter})`, "gi");
                    cell.innerHTML = cell.innerText.replace(regex, "<mark>$1</mark>");
                }
            });
            row.style.display = found ? "" : "none";
        });
    });

    // Сортировка таблицы
    function sortTable(n) {
        if (n !== 0) return; // Сортируем только по ID (по индексу 0)

        let table = document.getElementById("usersTable");
        let rows = Array.from(table.rows).slice(1); // Получаем все строки, кроме заголовка
        let ascending = table.getAttribute("data-sort") === "asc"; // Проверяем направление сортировки

        // Меняем направление на противоположное
        table.setAttribute("data-sort", ascending ? "desc" : "asc");

        rows.sort((a, b) => {
            let cellA = a.cells[n].innerText.trim();
            let cellB = b.cells[n].innerText.trim();

            // Сортируем по ID (числовое значение)
            return ascending ? parseInt(cellA) - parseInt(cellB) : parseInt(cellB) - parseInt(cellA);
        });

        // Перемещаем строки обратно в таблицу
        rows.forEach(row => table.appendChild(row));

        // Обновляем стрелочку в заголовке для текущей колонки
        let headers = table.querySelectorAll("th");
        headers.forEach(header => header.innerHTML = header.innerHTML.replace(' ▲', '').replace(' ▼', '')); // Убираем старые стрелки

        let header = headers[n];
        header.innerHTML += ascending ? ' ▲' : ' ▼'; // Добавляем стрелку вверх или вниз
    }
</script>
@include('admin.components_admin_dashboard.footer')
