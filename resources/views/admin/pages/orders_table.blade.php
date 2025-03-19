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

    <h3>Замовлення</h3>
    <!-- Поле поиска -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Пошук...">

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
                <tr>
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
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить заказ?');" style="display: inline-block;">
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
        let rows = document.querySelectorAll("#ordersTable tbody tr");
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
        let table = document.getElementById("ordersTable");
        let rows = Array.from(table.rows).slice(1);
        let ascending = table.getAttribute("data-sort") === "asc";
        table.setAttribute("data-sort", ascending ? "desc" : "asc");
        rows.sort((a, b) => {
            let cellA = a.cells[n].innerText.trim().toLowerCase();
            let cellB = b.cells[n].innerText.trim().toLowerCase();
            return ascending ? cellA.localeCompare(cellB, 'uk') : cellB.localeCompare(cellA, 'uk');
        });
        rows.forEach(row => table.appendChild(row));
    }
</script>
@include('admin.components_admin_dashboard.footer')
