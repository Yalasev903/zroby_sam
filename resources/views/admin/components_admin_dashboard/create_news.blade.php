@include('admin.components_admin_dashboard.header')
@include('admin.components_admin_dashboard.mobile_menu')
@include('admin.components_admin_dashboard.dashboard_sidebar')
@include('admin.components_admin_dashboard.dashboard_nav')
<div class="container mt-4">
    <h3>Додати новину</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="excerpt" class="form-label">Короткий опис</label>
            <textarea name="excerpt" class="form-control" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Контент</label>
            <textarea name="content" class="form-control" rows="6" required></textarea>
        </div>

        <div class="mb-3">
            <label for="news_category_id" class="form-label">Категорія</label>
            <select name="news_category_id" class="form-control" required>
                <option value="">Оберіть категорію</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">Зображення</label>
            <input type="file" name="image_url" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</div>
@include('admin.components_admin_dashboard.footer')
