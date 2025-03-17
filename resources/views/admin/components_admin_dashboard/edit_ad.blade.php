@include('admin.components_admin_dashboard.header')
<div class="container mt-4">
    <h2>Редагувати оголошення</h2>
    <form action="{{ route('admin.ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $ad->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Опис</label>
            <textarea name="description" id="description" class="form-control" required>{{ $ad->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="city">Місто</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ $ad->city }}" required>
        </div>
        <div class="form-group">
            <label for="services_category_id">Категорія</label>
            <select name="services_category_id" id="services_category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $ad->services_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="photo">Фото (залиште пустим, якщо не хочете змінювати)</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Оновити оголошення</button>
    </form>
</div>
@include('admin.components_admin_dashboard.footer')
