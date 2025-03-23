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

        <!-- Выбор количества строк на странице -->
        <button>
        <select id="pageSize" class="form-control mb-3" onchange="updateTable()">
            <option value="5">5 на сторінці</option>
            <option value="10">10 на сторінці</option>
            <option value="20">20 на сторінці</option>
            <option value="50">50 на сторінці</option>
            <option value="100">100 на сторінці</option>
            <option value="200">200 на сторінці</option>
        </select>
        </button>
        <table class="table style-two" id="usersTable" data-sort="asc">
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
                <tr class="userRow">
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

        <!-- Пагинация -->
        <div id="pagination" class="pagination mt-3"></div>
    </div>
</div>
<!-- dashboard body Item End -->

<script>
    let usersData = @json($users);
    let currentPage = 1;
    let pageSize = 5;

    // Обновляем таблицу
    function updateTable() {
        pageSize = parseInt(document.getElementById('pageSize').value);
        currentPage = 1; // Сброс текущей страницы на 1 при изменении размера страницы
        renderTable();
        renderPagination();
    }

    // Отображение таблицы
    function renderTable() {
        const tableBody = document.querySelector("#usersTable tbody");
        tableBody.innerHTML = ''; // Очищаем текущие строки таблицы

        // Фильтрация по поисковому запросу
        const filter = document.getElementById("searchInput").value.toLowerCase();
        const filteredUsers = usersData.filter(user =>
            user.name.toLowerCase().includes(filter) ||
            user.email.toLowerCase().includes(filter)
        );

        // Расчет индексов для текущей страницы
        const startIndex = (currentPage - 1) * pageSize;
        const endIndex = Math.min(startIndex + pageSize, filteredUsers.length);
        const currentPageUsers = filteredUsers.slice(startIndex, endIndex);

        // Заполняем таблицу
        currentPageUsers.forEach(user => {
            const row = document.createElement("tr");
            row.classList.add("userRow");
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>
                    <form action="/admin/users/${user.id}/update" method="POST" style="display: inline-block;">
                        <select name="role" onchange="this.form.submit()">
                            <option value="customer" ${user.role === 'customer' ? 'selected' : ''}>Замовник</option>
                            <option value="executor" ${user.role === 'executor' ? 'selected' : ''}>Виконувач</option>
                            <option value="admin" ${user.role === 'admin' ? 'selected' : ''}>Адмін</option>
                        </select>
                    </form>
                </td>
                <td>
                    <form action="/admin/users/${user.id}/destroy" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити користувача?');" style="display: inline-block;">
                        <button type="submit" class="btn btn-danger">Видалити</button>
                    </form>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Пагинация
    function renderPagination() {
        const pagination = document.getElementById('pagination');
        const filteredUsers = usersData.filter(user =>
            user.name.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase()) ||
            user.email.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase())
        );

        const totalPages = Math.ceil(filteredUsers.length / pageSize);
        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const pageLink = document.createElement("button");
            pageLink.textContent = i;
            pageLink.classList.add('page-link');
            if (i === currentPage) {
                pageLink.classList.add('active');
            }
            pageLink.addEventListener("click", function() {
                currentPage = i;
                renderTable();
                renderPagination();
            });
            pagination.appendChild(pageLink);
        }
    }

    // Поиск по таблице с подсветкой
    document.getElementById("searchInput").addEventListener("keyup", function() {
        renderTable();
        renderPagination();
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

    // Инициализация таблицы
    updateTable();
</script>
