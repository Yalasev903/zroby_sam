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

    <div class="table-responsive">
        <table class="table style-two" id="chatTable">
            <thead>
                <tr>
                    <th>ID</th>
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
</div>
<!-- dashboard body Item End -->

<script>
    // Поиск по таблице с подсветкой только найденного текста
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#chatTable tbody tr");
        rows.forEach(row => {
            let found = false;
            row.querySelectorAll("td").forEach(cell => {
                let text = cell.innerText.toLowerCase();
                if (filter && text.includes(filter)) {
                    found = true;
                    let regex = new RegExp(`(${filter})`, "gi");
                    cell.innerHTML = cell.innerText.replace(regex, '<span style="background-color: yellow;">$1</span>');
                } else {
                    cell.innerHTML = cell.innerText;
                }
            });
            row.style.display = found ? "" : "none";
        });
    });

    // Сортировка таблицы
    function sortTable(n) {
        let table = document.getElementById("chatTable");
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
