<!-- dashboard body Item Start -->
<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h3>Замовлення</h3>

    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Пошук...">

    <select id="pageSize" class="form-control mb-3 w-auto d-inline" onchange="updateTable()">
        <option value="5">5 на сторінці</option>
        <option value="10">10 на сторінці</option>
        <option value="20">20 на сторінці</option>
        <option value="50">50 на сторінці</option>
        <option value="100">100 на сторінці</option>
    </select>

    <div class="table-responsive">
        <table class="table style-two" id="ordersTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">#</th>
                    <th>Заголовок</th>
                    <th>Статус</th>
                    <th>Тип оплати</th>
                    <th>Замовник</th>
                    <th>Виконавець</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="orderRow">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->title }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                                @csrf
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>new</option>
                                    <option value="waiting" {{ $order->status == 'waiting' ? 'selected' : '' }}>waiting</option>
                                    <option value="in_progress" {{ $order->status == 'in_progress' ? 'selected' : '' }}>in progress</option>
                                    <option value="pending_confirmation" {{ $order->status == 'pending_confirmation' ? 'selected' : '' }}>pending</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            @if($order->isGuarantee())
                                <span class="badge bg-info">Гарант</span>
                            @elseif($order->isNoGuarantee())
                                <span class="badge bg-secondary">Без гаранта</span>
                            @else
                                <span class="badge bg-light text-dark">Не вказано</span>
                            @endif
                        </td>
                        <td>
                            @if($order->customer)
                                <a href="{{ route('my_profile.show', $order->customer->id) }}">{{ $order->customer->name }}</a>
                            @else — @endif
                        </td>
                        <td>
                            @if($order->executor)
                                <a href="{{ route('my_profile.show', $order->executor->id) }}">{{ $order->executor->name }}</a>
                            @else — @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Видалити замовлення #{{ $order->id }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div id="pagination" class="pagination mt-3"></div>
    </div>
</div>
<!-- dashboard body Item End -->

<script>
    let ordersData = @json($orders);
    let currentPage = 1;
    let pageSize = 5;

    function updateTable() {
        pageSize = parseInt(document.getElementById('pageSize').value);
        currentPage = 1;
        renderTable();
        renderPagination();
    }

    function renderTable() {
        const tbody = document.querySelector("#ordersTable tbody");
        tbody.innerHTML = '';

        const filter = document.getElementById("searchInput").value.toLowerCase();

        const filtered = ordersData.filter(order =>
            order.title.toLowerCase().includes(filter) ||
            (order.customer && order.customer.name.toLowerCase().includes(filter)) ||
            (order.executor && order.executor.name.toLowerCase().includes(filter))
        );

        const start = (currentPage - 1) * pageSize;
        const end = start + pageSize;
        const pageItems = filtered.slice(start, end);

        pageItems.forEach(order => {
            tbody.innerHTML += `
                <tr>
                    <td>${order.id}</td>
                    <td>${order.title}</td>
                    <td>
                        <form method="POST" action="/admin/orders/${order.id}/update">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="new" ${order.status === 'new' ? 'selected' : ''}>new</option>
                                <option value="waiting" ${order.status === 'waiting' ? 'selected' : ''}>waiting</option>
                                <option value="in_progress" ${order.status === 'in_progress' ? 'selected' : ''}>in progress</option>
                                <option value="pending_confirmation" ${order.status === 'pending_confirmation' ? 'selected' : ''}>pending</option>
                                <option value="completed" ${order.status === 'completed' ? 'selected' : ''}>completed</option>
                                <option value="cancelled" ${order.status === 'cancelled' ? 'selected' : ''}>cancelled</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        ${order.payment_type === 'guarantee' ? '<span class="badge bg-info">Гарант</span>' :
                          order.payment_type === 'no_guarantee' ? '<span class="badge bg-secondary">Без гаранта</span>' :
                          '<span class="badge bg-light text-dark">Не вказано</span>'}
                    </td>
                    <td>${order.customer ? `<a href="/my_profile/${order.customer.id}">${order.customer.name}</a>` : '—'}</td>
                    <td>${order.executor ? `<a href="/my_profile/${order.executor.id}">${order.executor.name}</a>` : '—'}</td>
                    <td>
                        <form method="POST" action="/admin/orders/${order.id}" onsubmit="return confirm('Видалити замовлення #${order.id}?')">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger">Видалити</button>
                        </form>
                    </td>
                </tr>
            `;
        });
    }

    function renderPagination() {
        const pagination = document.getElementById('pagination');
        const filter = document.getElementById("searchInput").value.toLowerCase();

        const filtered = ordersData.filter(order =>
            order.title.toLowerCase().includes(filter) ||
            (order.customer && order.customer.name.toLowerCase().includes(filter)) ||
            (order.executor && order.executor.name.toLowerCase().includes(filter))
        );

        const totalPages = Math.ceil(filtered.length / pageSize);
        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.className = 'btn btn-sm mx-1 ' + (i === currentPage ? 'btn-primary' : 'btn-outline-primary');
            btn.onclick = () => {
                currentPage = i;
                renderTable();
                renderPagination();
            };
            pagination.appendChild(btn);
        }
    }

    document.getElementById("searchInput").addEventListener("keyup", () => {
        renderTable();
        renderPagination();
    });

    updateTable();
</script>
