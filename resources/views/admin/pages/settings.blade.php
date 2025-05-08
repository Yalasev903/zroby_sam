@include('admin.components_admin_dashboard.header')
@include('admin.components_admin_dashboard.mobile_menu')
@include('admin.components_admin_dashboard.dashboard_sidebar')
@include('admin.components_admin_dashboard.dashboard_nav')

<div class="dashboard-body__item">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Налаштування адмін-панелі</h2>
    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="auto_greeting_enabled" class="block font-medium mb-2">
                    Включити автопривітання?
                </label>
                <input type="checkbox" name="auto_greeting_enabled" id="auto_greeting_enabled"
                       value="1" {{ old('auto_greeting_enabled', $adminSetting->auto_greeting_enabled) ? 'checked' : '' }}>
            </div>

            <div class="mb-4">
                <label for="auto_greeting_text" class="block font-medium mb-2">
                    Текст автопривітання:
                </label>
                <textarea name="auto_greeting_text" id="auto_greeting_text" rows="4"
                          class="w-full border border-gray-300 rounded px-3 py-2">{{ old('auto_greeting_text', $adminSetting->auto_greeting_text) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Зберегти</button>
        </form>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    </div>
</div>

@include('admin.components_admin_dashboard.footer')
