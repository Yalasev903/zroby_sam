@include('admin.components_admin_dashboard.header')
@include('admin.components_admin_dashboard.mobile_menu')
@include('admin.components_admin_dashboard.dashboard_sidebar')
@include('admin.components_admin_dashboard.dashboard_nav')
@include('admin.components_admin_dashboard.welcome')
@php
    use Carbon\Carbon;
    use App\Models\Order;

    $period = request('period', 'today'); // today, week, month, year
    $query = Order::query();

    switch ($period) {
        case 'week':
            $query->where('created_at', '>=', Carbon::now()->startOfWeek());
            break;
        case 'month':
            $query->where('created_at', '>=', Carbon::now()->startOfMonth());
            break;
        case 'year':
            $query->where('created_at', '>=', Carbon::now()->startOfYear());
            break;
        default:
            $query->where('created_at', '>=', Carbon::today());
            break;
    }

    $totalOrders = (clone $query)->count();
    $guaranteeOrders = (clone $query)->where('payment_type', 'guarantee')->count();
    $totalTurnover = (clone $query)->where('payment_type', 'guarantee')->sum('guarantee_amount');
    $totalIncome = $totalTurnover * 0.1;
@endphp

<div class="d-flex gap-3 flex-wrap mb-4">
    <form method="GET" class="mb-3">
        <select name="period" onchange="this.form.submit()" class="form-control">
            <option value="today" {{ request('period') === 'today' ? 'selected' : '' }}>Сьогодні</option>
            <option value="week" {{ request('period') === 'week' ? 'selected' : '' }}>Тиждень</option>
            <option value="month" {{ request('period') === 'month' ? 'selected' : '' }}>Місяць</option>
            <option value="year" {{ request('period') === 'year' ? 'selected' : '' }}>Рік</option>
        </select>
    </form>

    {{-- Всього замовлень --}}
    <div class="dashboard-widget">
        <span class="dashboard-widget__icon">
            <img src="{{ asset('/assets/admin_assets/images/icons/sidebar-icon7.svg') }}" alt="">
        </span>
        <div class="dashboard-widget__content flx-between gap-1 align-items-end">
            <div>
                <h4 class="dashboard-widget__number mb-1 mt-3">{{ $totalOrders }}</h4>
                <span class="dashboard-widget__text font-14">Усього замовлень</span>
            </div>
            <img src="{{ asset('assets/admin_assets/images/icons/chart-icon.svg') }}" alt="">
        </div>
    </div>

    {{-- Замовлення з гарантом --}}
    <div class="dashboard-widget">
        <span class="dashboard-widget__icon">
            <img src="{{ asset('/assets/admin_assets/images/icons/sidebar-icon7.svg') }}" alt="">
        </span>
        <div class="dashboard-widget__content flx-between gap-1 align-items-end">
            <div>
                <h4 class="dashboard-widget__number mb-1 mt-3">{{ $guaranteeOrders }}</h4>
                <span class="dashboard-widget__text font-14">Замовлень з гарантом</span>
            </div>
            <img src="{{ asset('assets/admin_assets/images/icons/chart-icon.svg') }}" alt="">
        </div>
    </div>

    {{-- Загальний дохід --}}
    <div class="dashboard-widget">
        <span class="dashboard-widget__icon">
            <img src="{{ asset('/assets/admin_assets/images/icons/sidebar-icon7.svg') }}" alt="">
        </span>
        <div class="dashboard-widget__content flx-between gap-1 align-items-end">
            <div>
                <h4 class="dashboard-widget__number mb-1 mt-3">{{ number_format($totalIncome, 2, ',', ' ') }} грн</h4>
                <span class="dashboard-widget__text font-14">Дохід (10%)</span>
            </div>
            <img src="{{ asset('assets/admin_assets/images/icons/chart-icon.svg') }}" alt="">
        </div>
    </div>

    {{-- Загальний оборот --}}
    <div class="dashboard-widget">
        <span class="dashboard-widget__icon">
            <img src="{{ asset('/assets/admin_assets/images/icons/sidebar-icon7.svg') }}" alt="">
        </span>
        <div class="dashboard-widget__content flx-between gap-1 align-items-end">
            <div>
                <h4 class="dashboard-widget__number mb-1 mt-3">{{ number_format($totalTurnover, 2, ',', ' ') }} грн</h4>
                <span class="dashboard-widget__text font-14">Загальний оборот</span>
            </div>
            <img src="{{ asset('assets/admin_assets/images/icons/chart-icon.svg') }}" alt="">
        </div>
    </div>
</div>

@include('admin.components_admin_dashboard.orders_table_widget')
@include('admin.components_admin_dashboard.footer')
