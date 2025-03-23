<!-- dashboard body Item Start -->
<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h3>Повідомлення у чаті</h3>

    <!-- Поле поиска -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Пошук...">

    <!-- Выбор количества строк на странице -->
    <select id="pageSize" class="form-control mb-3" onchange="updateTable()">
        <option value="5">5 на сторінці</option>
        <option value="10">10 на сторінці</option>
        <option value="20">20 на сторінці</option>
        <option value="50">50 на сторінці</option>
        <option value="100">100 на сторінці</option>
    </select>

    <div class="table-responsive">
        <table class="table style-two" id="chatTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">ID ▲▼</th>
                    <th onclick="sortTable(1)">Відправник (from_id) ▲▼</th>
                    <th onclick="sortTable(2)">Одержувач (to_id) ▲▼</th>
                    <th onclick="sortTable(3)">Повідомлення ▲▼</th>
                    <th>Вкладення</th>
                    <th onclick="sortTable(5)">Статус ▲▼</th>
                    <th onclick="sortTable(6)">Дата створення ▲▼</th>
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

    <!-- Пагинация -->
    <div id="pagination" class="pagination mt-3"></div>
</div>
<!-- dashboard body Item End -->

<script>
    let chatMessagesData = @json($chatMessages);
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
        const tableBody = document.querySelector("#chatTable tbody");
        tableBody.innerHTML = ''; // Очищаем текущие строки таблицы

        // Фильтрация по поисковому запросу
        const filter = document.getElementById("searchInput").value.toLowerCase();
        const filteredMessages = chatMessagesData.filter(message =>
            message.from_id.toString().includes(filter) ||
            message.to_id.toString().includes(filter) ||
            message.body.toLowerCase().includes(filter)
        );

        // Расчет индексов для текущей страницы
        const startIndex = (currentPage - 1) * pageSize;
        const endIndex = Math.min(startIndex + pageSize, filteredMessages.length);
        const currentPageMessages = filteredMessages.slice(startIndex, endIndex);

        // Заполняем таблицу
        currentPageMessages.forEach(message => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${message.id}</td>
                <td>${message.from_id}</td>
                <td>${message.to_id}</td>
                <td>${message.body || '—'}</td>
                <td>
                    ${message.attachment ? `<a href="/storage/${message.attachment}" target="_blank">Просмотр</a>` : '—'}
                </td>
                <td>${message.seen ? 'Просмотрено' : 'Не просмотрено'}</td>
                <td>${new Date(message.created_at).toLocaleString()}</td>
                <td>
                    <form action="/admin/chat/messages/${message.id}/destroy" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить сообщение?');" style="display: inline-block;">
                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Пагинация
    function renderPagination() {
        const pagination = document.getElementById('pagination');
        const filteredMessages = chatMessagesData.filter(message =>
            message.from_id.toString().includes(document.getElementById("searchInput").value) ||
            message.to_id.toString().includes(document.getElementById("searchInput").value) ||
            message.body.toLowerCase().includes(document.getElementById("searchInput").value)
        );

        const totalPages = Math.ceil(filteredMessages.length / pageSize);
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
        const table = document.getElementById("chatTable");
        const rows = Array.from(table.rows).slice(1);
        const ascending = table.getAttribute("data-sort") === "asc";
        table.setAttribute("data-sort", ascending ? "desc" : "asc");

        rows.sort((a, b) => {
            let cellA = a.cells[n].innerText.trim();
            let cellB = b.cells[n].innerText.trim();

            return ascending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
        });

        rows.forEach(row => table.appendChild(row));

        let headers = table.querySelectorAll("th");
        headers.forEach(header => header.innerHTML = header.innerHTML.replace(' ▲', '').replace(' ▼', ''));
        let header = headers[n];
        header.innerHTML += ascending ? ' ▲' : ' ▼';
    }

    // Инициализация таблицы
    updateTable();
</script>
