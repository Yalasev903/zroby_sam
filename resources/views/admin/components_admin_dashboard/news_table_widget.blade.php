<div class="dashboard-body__item">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Новини</h3>
        <a href="{{ route('admin.news.create') }}" class="btn btn-success btn-sm">➕ Додати новину</a>
    </div>

    <div class="table-responsive">
        <input type="text" id="newsSearchInput" class="form-control mb-2" placeholder="Пошук...">
        <select id="newsPageSize" class="form-control mb-3 w-auto d-inline-block" style="width: auto;" onchange="updateNewsTable()">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="20">20</option>
        </select>

        <table class="table table-sm table-striped" id="newsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Дата</th>
                    <th>Дія</th>
                </tr>
            </thead>
            <tbody>
                <!-- JS вставит строки -->
            </tbody>
        </table>

        <div id="newsPagination" class="pagination mt-3"></div>
    </div>
</div>

<script>
    let newsData = @json($news);
    let newsCurrentPage = 1;
    let newsPageSize = 10;

    function updateNewsTable() {
        newsPageSize = parseInt(document.getElementById('newsPageSize').value);
        newsCurrentPage = 1;
        renderNewsTable();
        renderNewsPagination();
    }

    function renderNewsTable() {
        const tableBody = document.querySelector("#newsTable tbody");
        tableBody.innerHTML = '';
        const filter = document.getElementById("newsSearchInput").value.toLowerCase();

        const filtered = newsData.filter(n =>
            (n.title && n.title.toLowerCase().includes(filter)) ||
            (n.category && n.category.name && n.category.name.toLowerCase().includes(filter))
        );

        const startIndex = (newsCurrentPage - 1) * newsPageSize;
        const pageItems = filtered.slice(startIndex, startIndex + newsPageSize);

        pageItems.forEach(n => {
            const row = document.createElement("tr");
            row.innerHTML = `
            <td>${n.id}</td>
            <td>
                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <img src="${n.image_url}" alt="Image" style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px;">
                    <div style="max-width: 300px;">
                        <div style="font-weight: 600; font-size: 14px;">${n.title}</div>
                        <div style="color: #6c757d; font-size: 13px;">${n.category?.name || '-'}</div>
                    </div>
                </div>
            </td>
            <td style="white-space: nowrap;">${(new Date(n.created_at)).toLocaleDateString()}</td>
            <td style="white-space: nowrap;">
                <a href="/admin/news/${n.id}/edit" class="btn btn-sm btn-primary mb-1">Редагувати</a>
                <form method="POST" action="/admin/news/${n.id}/destroy" style="display:inline-block;" onsubmit="return confirm('Ви впевнені, що хочете видалити новину?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
                </form>
            </td>
        `;
            tableBody.appendChild(row);
        });
    }

    function renderNewsPagination() {
        const pagination = document.getElementById('newsPagination');
        const filter = document.getElementById("newsSearchInput").value.toLowerCase();

        const filtered = newsData.filter(n =>
            (n.title && n.title.toLowerCase().includes(filter)) ||
            (n.category && n.category.name && n.category.name.toLowerCase().includes(filter))
        );

        const totalPages = Math.ceil(filtered.length / newsPageSize);
        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.className = 'btn btn-outline-secondary btn-sm mx-1';
            if (i === newsCurrentPage) btn.classList.add('active');
            btn.onclick = () => {
                newsCurrentPage = i;
                renderNewsTable();
                renderNewsPagination();
            };
            pagination.appendChild(btn);
        }
    }

    document.getElementById("newsSearchInput").addEventListener("keyup", () => {
        newsCurrentPage = 1;
        renderNewsTable();
        renderNewsPagination();
    });

    renderNewsTable();
    renderNewsPagination();
</script>
