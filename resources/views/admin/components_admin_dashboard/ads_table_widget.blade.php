<!-- dashboard body Item Start -->
<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h3>Оголошення</h3>

    <!-- Поле поиска -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Пошук...">

    <!-- Выбор количества строк на странице -->
    <select id="pageSize" class="form-control mb-3" onchange="updateTable()">
        <option value="5">5 на сторінці</option>
        <option value="10">10 на сторінці</option>
        <option value="20">20 на сторінці</option>
        <option value="50">50 на сторінці</option>
        <option value="100">100 на сторінці</option>
        <option value="200">200 на сторінці</option>
    </select>

    <div class="table-responsive">
        <table class="table style-two" id="adsTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">ID ▲▼</th>
                    <th onclick="sortTable(1)">Заголовок ▲▼</th>
                    <th onclick="sortTable(2)">Автор ▲▼</th>
                    <th onclick="sortTable(3)">Місто ▲▼</th>
                    <th onclick="sortTable(4)">Категорія ▲▼</th>
                    <th onclick="sortTable(5)">Дата розміщення ▲▼</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody id="adsTableBody">
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

    <!-- Пагинация -->
    <div id="pagination" class="pagination mt-3"></div>
</div>
<!-- dashboard body Item End -->

<script>
    let adsData = @json($ads);
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
        const tableBody = document.querySelector("#adsTableBody");
        tableBody.innerHTML = ''; // Очищаем текущие строки таблицы

        // Фильтрация по поисковому запросу
        const filter = document.getElementById("searchInput").value.toLowerCase();
        const filteredAds = adsData.filter(ad =>
            ad.title.toLowerCase().includes(filter) ||
            ad.city.toLowerCase().includes(filter) ||
            (ad.user && ad.user.name.toLowerCase().includes(filter))
        );

        // Расчет индексов для текущей страницы
        const startIndex = (currentPage - 1) * pageSize;
        const endIndex = Math.min(startIndex + pageSize, filteredAds.length);
        const currentPageAds = filteredAds.slice(startIndex, endIndex);

        // Заполняем таблицу
        currentPageAds.forEach(ad => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${ad.id}</td>
                <td>${ad.title}</td>
                <td>${ad.user ? `<a href="/my_profile/${ad.user.id}">${ad.user.name}</a>` : '—'}</td>
                <td>${ad.city}</td>
                <td>${ad.servicesCategory ? ad.servicesCategory.name : '—'}</td>
                <td>${ad.posted_at ? new Date(ad.posted_at).toLocaleString() : '—'}</td>
                <td>
                    <a href="/admin/ads/${ad.id}/edit" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="/admin/ads/${ad.id}/destroy" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити оголошення?');" style="display: inline-block;">
                        <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                    </form>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Пагинация
    function renderPagination() {
        const pagination = document.getElementById('pagination');
        const filteredAds = adsData.filter(ad =>
            ad.title.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase()) ||
            ad.city.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase()) ||
            (ad.user && ad.user.name.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase()))
        );

        const totalPages = Math.ceil(filteredAds.length / pageSize);
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
        const table = document.getElementById("adsTable");
        const rows = Array.from(table.rows).slice(1); // Получаем все строки, кроме заголовка
        const ascending = table.getAttribute("data-sort") === "asc"; // Проверяем направление сортировки

        // Меняем направление на противоположное
        table.setAttribute("data-sort", ascending ? "desc" : "asc");

        rows.sort((a, b) => {
            let cellA = a.cells[n].innerText.trim();
            let cellB = b.cells[n].innerText.trim();

            // Сортируем по числовым и строковым данным
            if (n === 0 || n === 5) {
                // Для ID и даты соритируем как числа
                return ascending ? parseInt(cellA) - parseInt(cellB) : parseInt(cellB) - parseInt(cellA);
            } else {
                // Для строковых данных
                return ascending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
            }
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
