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
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h3>Привітання</h3>

    <!-- Форма для отправки приветственного сообщения -->
    <form action="{{ route('admin.greetings.resend') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group mb-2">
            <label for="user_id">Користувач (ID). Залиште порожнім, щоб надіслати всім:</label>
            <input type="text" name="user_id" id="user_id" placeholder="Наприклад: 3" class="form-control">
        </div>
        <div class="form-group mb-2">
            <label for="message">Текст привітання (якщо залишити порожнім, використається з налаштувань):</label>
            <textarea name="message" id="message" rows="3" class="form-control" placeholder="Наприклад: Дякуємо за реєстрацію!"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Надіслати привітання</button>
    </form>

    <!-- Поле поиска -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Пошук...">

    <div class="table-responsive">
        <table class="table style-two" id="greetingsTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">ID ▲▼</th>
                    <th onclick="sortTable(1)">Користувач ▲▼</th>
                    <th onclick="sortTable(2)">Текст повідомлення ▲▼</th>
                    <th onclick="sortTable(3)">Дата ▲▼</th>
                </tr>
            </thead>
            <tbody>
                @foreach($greetings as $greeting)
                    <tr>
                        <td>{{ $greeting->id }}</td>
                        <td>
                            @if($greeting->user)
                                <a href="{{ route('my_profile.show', $greeting->user->id) }}">
                                    {{ $greeting->user->name }}
                                </a>
                            @else
                                Для всіх
                            @endif
                        </td>
                        <td>{{ $greeting->message ?? '—' }}</td>
                        <td>
                            {{ $greeting->created_at ? $greeting->created_at->format('d.m.Y H:i') : '—' }}
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
        let rows = document.querySelectorAll("#greetingsTable tbody tr");
        rows.forEach(row => {
            // Снимаем предыдущую подсветку
            row.innerHTML = row.innerHTML.replace(/<mark>|<\/mark>/g, "");
            let found = false;
            row.querySelectorAll("td").forEach(cell => {
                let text = cell.innerText.toLowerCase();
                if (text.includes(filter) && filter !== "") {
                    found = true;
                    // Подсвечиваем найденный фрагмент
                    let regex = new RegExp(`(${filter})`, "gi");
                    cell.innerHTML = cell.innerText.replace(regex, "<mark>$1</mark>");
                }
            });
            // Показываем/скрываем строку в зависимости от результата
            row.style.display = found || filter === "" ? "" : "none";
        });
    });

    // Сортировка таблицы
    function sortTable(n) {
        let table = document.getElementById("greetingsTable");
        let rows = Array.from(table.querySelectorAll("tbody tr"));
        let ascending = table.getAttribute("data-sort") === "asc";
        table.setAttribute("data-sort", ascending ? "desc" : "asc");

        rows.sort((a, b) => {
            let cellA = a.cells[n].innerText.trim().toLowerCase();
            let cellB = b.cells[n].innerText.trim().toLowerCase();
            // Локализация 'uk' (украинский) для корректного сравнения
            return ascending
                ? cellA.localeCompare(cellB, 'uk')
                : cellB.localeCompare(cellA, 'uk');
        });

        rows.forEach(row => table.tBodies[0].appendChild(row));
    }
</script>

@include('admin.components_admin_dashboard.footer')
