<!-- dashboard body Item Start -->
<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h3>Замовлення</h3>
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

    <div class="table-responsive">
        <table class="table style-two" id="ordersTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">ID ▲▼</th>
                    <th onclick="sortTable(1)">Заголовок ▲▼</th>
                    <th onclick="sortTable(2)">Статус ▲▼</th>
                    <th onclick="sortTable(3)">Замовник ▲▼</th>
                    <th onclick="sortTable(4)">Виконавець ▲▼</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="orderRow">
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
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити замовлення?');" style="display: inline-block;">
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
    let ordersData = @json($orders);
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
        const tableBody = document.querySelector("#ordersTable tbody");
        tableBody.innerHTML = ''; // Очищаем текущие строки таблицы

        // Фильтрация по поисковому запросу
        const filter = document.getElementById("searchInput").value.toLowerCase();
        const filteredOrders = ordersData.filter(order =>
            order.title.toLowerCase().includes(filter) ||
            (order.customer ? order.customer.name.toLowerCase().includes(filter) : false) ||
            (order.executor ? order.executor.name.toLowerCase().includes(filter) : false)
        );

        // Расчет индексов для текущей страницы
        const startIndex = (currentPage - 1) * pageSize;
        const endIndex = Math.min(startIndex + pageSize, filteredOrders.length);
        const currentPageOrders = filteredOrders.slice(startIndex, endIndex);

        // Заполняем таблицу
        currentPageOrders.forEach(order => {
            const row = document.createElement("tr");
            row.classList.add("orderRow");
            row.innerHTML = `
                <td>${order.id}</td>
                <td>${order.title}</td>
                <td>
                    <form action="/admin/orders/${order.id}/update" method="POST" style="display: inline-block;">
                        <select name="status" onchange="this.form.submit()">
                            <option value="new" ${order.status === 'new' ? 'selected' : ''}>New</option>
                            <option value="waiting" ${order.status === 'waiting' ? 'selected' : ''}>Waiting</option>
                            <option value="in_progress" ${order.status === 'in_progress' ? 'selected' : ''}>In Progress</option>
                            <option value="pending_confirmation" ${order.status === 'pending_confirmation' ? 'selected' : ''}>Pending Confirmation</option>
                            <option value="completed" ${order.status === 'completed' ? 'selected' : ''}>Completed</option>
                        </select>
                    </form>
                </td>
                <td>
                    ${order.customer ? `<a href="/my_profile/show/${order.customer.id}">${order.customer.name}</a>` : '—'}
                </td>
                <td>
                    ${order.executor ? `<a href="/my_profile/show/${order.executor.id}">${order.executor.name}</a>` : '—'}
                </td>
                <td>
                    <form action="/admin/orders/${order.id}/destroy" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити замовлення?');" style="display: inline-block;">
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
        const filteredOrders = ordersData.filter(order =>
            order.title.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase()) ||
            (order.customer ? order.customer.name.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase()) : false) ||
            (order.executor ? order.executor.name.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase()) : false)
        );

        const totalPages = Math.ceil(filteredOrders.length / pageSize);
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

    // Инициализация таблицы
    updateTable();
</script>
