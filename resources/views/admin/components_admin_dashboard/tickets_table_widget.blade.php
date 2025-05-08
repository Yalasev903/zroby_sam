<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <h3>Тікети</h3>

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

        <table class="table style-two" id="ticketsTable" data-sort="asc">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">ID ▲▼</th>
                    <th>Замовлення</th>
                    <th>Скарга</th>
                    <th>Автор</th>
                    <th>Дата</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr class="ticketRow">
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->order_id }}</td>
                    <td>{{ $ticket->complaint }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.tickets.resolve', $ticket) }}" method="POST">
                            @csrf
                            <input type="text" name="resolution" class="form-control" placeholder="Введіть рішення" required>
                            <button type="submit" class="btn btn-primary btn-sm mt-1">Надіслати</button>
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

<script>
    let ticketsData = @json($tickets);
    let currentPage = 1;
    let pageSize = 5;

    function updateTable() {
        pageSize = parseInt(document.getElementById('pageSize').value);
        currentPage = 1;
        renderTable();
        renderPagination();
    }

    function renderTable() {
        const tableBody = document.querySelector("#ticketsTable tbody");
        tableBody.innerHTML = '';
        const filter = document.getElementById("searchInput").value.toLowerCase();
        const filteredTickets = ticketsData.filter(ticket =>
            ticket.order_id.toString().includes(filter) ||
            ticket.complaint.toLowerCase().includes(filter) ||
            ticket.user.name.toLowerCase().includes(filter)
        );
        const startIndex = (currentPage - 1) * pageSize;
        const endIndex = Math.min(startIndex + pageSize, filteredTickets.length);
        const currentPageTickets = filteredTickets.slice(startIndex, endIndex);

        currentPageTickets.forEach(ticket => {
            const row = document.createElement("tr");
            row.classList.add("ticketRow");
            row.innerHTML = `
                <td>${ticket.id}</td>
                <td>${ticket.order_id}</td>
                <td>${ticket.complaint}</td>
                <td>${ticket.user.name}</td>
                <td>${ticket.created_at}</td>
                <td>
                    <form action="/admin/tickets/${ticket.id}/resolve" method="POST">
                        <input type="text" name="resolution" class="form-control" placeholder="Введіть рішення" required>
                        <button type="submit" class="btn btn-primary btn-sm mt-1">Надіслати</button>
                    </form>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    function renderPagination() {
        const pagination = document.getElementById('pagination');
        const filteredTickets = ticketsData.filter(ticket =>
            ticket.order_id.toString().includes(document.getElementById("searchInput").value.toLowerCase()) ||
            ticket.complaint.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase()) ||
            ticket.user.name.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase())
        );
        const totalPages = Math.ceil(filteredTickets.length / pageSize);
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

    document.getElementById("searchInput").addEventListener("keyup", function() {
        renderTable();
        renderPagination();
    });

    renderTable();
    renderPagination();
</script>
