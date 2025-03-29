<!-- dashboard body Item Start -->
<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <h3>Повідомлення</h3>

        <!-- Поле поиска -->
        <input type="text" id="searchInputNotification" class="form-control mb-3" placeholder="Пошук...">

        <!-- Выбор количества строк на странице -->
        <select id="pageSizeNotification" class="form-control mb-3" onchange="updateNotificationTable()">
            <option value="5">5 на сторінці</option>
            <option value="10">10 на сторінці</option>
            <option value="20">20 на сторінці</option>
            <option value="50">50 на сторінці</option>
            <option value="100">100 на сторінці</option>
            <option value="200">200 на сторінці</option>
        </select>

        <table class="table style-two" id="notificationTable" data-sort="asc">
            <thead>
                <tr>
                    <th onclick="sortNotificationTable(0)">ID ▲▼</th>
                    <th>Заголовок</th>
                    <th>Повідомлення</th>
                    <th>Дата</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                    <tr class="notificationRow">
                        <td>{{ $notification->id }}</td>
                        <td>{{ $notification->title }}</td>
                        <td>{{ $notification->message }}</td>
                        <td>{{ $notification->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.notifications.destroy', $notification) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити це повідомлення?');" style="display: inline-block;">
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
        <div id="notificationPagination" class="pagination mt-3"></div>
    </div>
</div>
<!-- dashboard body Item End -->

<script>
    // Инициализация данных уведомлений из переданного контроллером массива $notifications
    let notificationsData = @json($notifications);
    let currentNotificationPage = 1;
    let notificationPageSize = 5;

    // Обновляем таблицу уведомлений (при изменении кол-ва строк или поиске)
    function updateNotificationTable() {
        notificationPageSize = parseInt(document.getElementById('pageSizeNotification').value);
        currentNotificationPage = 1; // сброс текущей страницы
        renderNotificationTable();
        renderNotificationPagination();
    }

    // Функция для отрисовки таблицы уведомлений с фильтрацией
    function renderNotificationTable() {
        const tableBody = document.querySelector("#notificationTable tbody");
        tableBody.innerHTML = '';
        const filter = document.getElementById("searchInputNotification").value.toLowerCase();
        const filteredNotifications = notificationsData.filter(notification =>
            (notification.title && notification.title.toLowerCase().includes(filter)) ||
            (notification.message && notification.message.toLowerCase().includes(filter))
        );
        const startIndex = (currentNotificationPage - 1) * notificationPageSize;
        const endIndex = Math.min(startIndex + notificationPageSize, filteredNotifications.length);
        const currentPageNotifications = filteredNotifications.slice(startIndex, endIndex);

        currentPageNotifications.forEach(notification => {
            const row = document.createElement("tr");
            row.classList.add("notificationRow");
            row.innerHTML = `
                <td>${notification.id}</td>
                <td>${notification.title}</td>
                <td>${notification.message}</td>
                <td>${new Date(notification.created_at).toLocaleString()}</td>
                <td>
                    <form action="/admin/notifications/${notification.id}/destroy" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити це повідомлення?');" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Видалити</button>
                    </form>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Функция для отрисовки пагинации уведомлений
    function renderNotificationPagination() {
        const pagination = document.getElementById('notificationPagination');
        const filter = document.getElementById("searchInputNotification").value.toLowerCase();
        const filteredNotifications = notificationsData.filter(notification =>
            (notification.title && notification.title.toLowerCase().includes(filter)) ||
            (notification.message && notification.message.toLowerCase().includes(filter))
        );
        const totalPages = Math.ceil(filteredNotifications.length / notificationPageSize);
        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const pageLink = document.createElement("button");
            pageLink.textContent = i;
            pageLink.classList.add('page-link');
            if (i === currentNotificationPage) {
                pageLink.classList.add('active');
            }
            pageLink.addEventListener("click", function() {
                currentNotificationPage = i;
                renderNotificationTable();
                renderNotificationPagination();
            });
            pagination.appendChild(pageLink);
        }
    }

    // Сортировка таблицы уведомлений по ID
    function sortNotificationTable(n) {
        if (n !== 0) return; // сортируем только по ID
        let table = document.getElementById("notificationTable");
        let rows = Array.from(table.rows).slice(1); // пропускаем строку заголовка
        let ascending = table.getAttribute("data-sort") === "asc";

        // меняем направление сортировки
        table.setAttribute("data-sort", ascending ? "desc" : "asc");

        rows.sort((a, b) => {
            let cellA = a.cells[n].innerText.trim();
            let cellB = b.cells[n].innerText.trim();
            return ascending ? parseInt(cellA) - parseInt(cellB) : parseInt(cellB) - parseInt(cellA);
        });

        // Перезаписываем строки таблицы
        rows.forEach(row => table.appendChild(row));

        // Обновляем индикатор сортировки в заголовке
        let headers = table.querySelectorAll("th");
        headers.forEach(header => header.innerHTML = header.innerHTML.replace(' ▲', '').replace(' ▼', ''));
        headers[n].innerHTML += ascending ? ' ▲' : ' ▼';
    }

    // Обработчик для поиска уведомлений
    document.getElementById("searchInputNotification").addEventListener("keyup", function() {
        renderNotificationTable();
        renderNotificationPagination();
    });

    // Инициализация таблицы
    updateNotificationTable();
</script>
