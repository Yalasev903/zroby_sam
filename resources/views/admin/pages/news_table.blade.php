@include('admin.components_admin_dashboard.header')
@include('admin.components_admin_dashboard.mobile_menu')
@include('admin.components_admin_dashboard.dashboard_sidebar')
@include('admin.components_admin_dashboard.dashboard_nav')

{{-- передаем $news как переменную --}}
@include('admin.components_admin_dashboard.news_table_widget', ['news' => $news])

@include('admin.components_admin_dashboard.footer')
