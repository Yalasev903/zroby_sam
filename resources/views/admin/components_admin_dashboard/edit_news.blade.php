@include('admin.components_admin_dashboard.header')
@include('admin.components_admin_dashboard.mobile_menu')
@include('admin.components_admin_dashboard.dashboard_sidebar')
@include('admin.components_admin_dashboard.dashboard_nav')
<div class="container mt-4">
    <h2>Редагування новини: {{ $news->title }}</h2>
    <form method="POST" action="{{ route('admin.news.update', $news) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Заголовок</label>
            <input type="text" name="title" value="{{ $news->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Короткий опис</label>
            <textarea name="excerpt" class="form-control">{{ $news->excerpt }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Контент</label>
            <textarea name="content" rows="8" class="form-control">{{ $news->content }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Категорія</label>
            <select name="news_category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $news->news_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Посилання на зображення</label>
            <input type="text" name="image_url" value="{{ $news->image_url }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Зберегти</button>
    </form>
</div>
@include('admin.components_admin_dashboard.footer')
