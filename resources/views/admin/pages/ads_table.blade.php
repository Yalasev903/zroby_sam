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

    <h3>Оголошення</h3>
    <!-- Поле поиска -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Пошук...">

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

<script>
    // Поиск по таблице с подсветкой
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#adsTable tbody tr");
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
        let table = document.getElementById("adsTable");
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
