
<div class="dashboard-body__item-wrapper">

    <!-- dashboard body Item Start -->
    <div class="dashboard-body__item">
        <div class="row gy-4">
<div class="col-xl-3 col-sm-6">
<div class="dashboard-widget">
<img src="{{ asset('assets/admin_assets/images/shapes/widget-shape2.png') }}" alt="" class="dashboard-widget__shape one">
<img src="{{ asset('assets/admin_assets/images/shapes/widget-shape2.png') }}" alt="" class="dashboard-widget__shape two">
<span class="dashboard-widget__icon">
<img src="{{ asset('/assets/admin_assets/images/icons/sidebar-icon7.svg') }}" alt="">
</span>
<div class="dashboard-widget__content flx-between gap-1 align-items-end">
<div>
<h4 class="dashboard-widget__number mb-1 mt-3">{{ \App\Models\Ad::count() }}</h4>
<span class="dashboard-widget__text font-14">Всього оголошень</span>
</div>
<img src="{{ asset('assets/admin_assets/images/icons/chart-icon.svg') }}" alt="">
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6">
<div class="dashboard-widget">
<img src="{{ asset('assets/admin_assets/images/shapes/widget-shape1.png') }}" alt="" class="dashboard-widget__shape one">
<img src="{{ asset('assets/admin_assets/images/shapes/widget-shape1.png') }}" alt="" class="dashboard-widget__shape two">
<span class="dashboard-widget__icon">
<img src="{{ asset('/assets/admin_assets/images/icons/sidebar-icon4.svg') }}" alt="">
</span>
<div class="dashboard-widget__content flx-between gap-1 align-items-end">
<div>
<h4 class="dashboard-widget__number mb-1 mt-3">{{ \App\Models\User::count() }}</h4>
<span class="dashboard-widget__text font-14">Всього користувачів</span>
</div>
<img src="{{ asset('assets/admin_assets/images/icons/chart-icon.svg') }}" alt="">
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6">
<div class="dashboard-widget">
<img src="{{ asset('assets/admin_assets/images/shapes/widget-shape1.png') }}" alt="" class="dashboard-widget__shape one">
<img src="{{ asset('assets/admin_assets/images/shapes/widget-shape2.png') }}" alt="" class="dashboard-widget__shape two">
<span class="dashboard-widget__icon">
<img src="{{ asset('/assets/admin_assets/images/icons/sidebar-icon5.svg') }}" alt="">
</span>
<div class="dashboard-widget__content flx-between gap-1 align-items-end">
<div>
<h4 class="dashboard-widget__number mb-1 mt-3">{{ \App\Models\Order::count() }}</h4>
<span class="dashboard-widget__text font-14">Всього замовлень</span>
</div>
<img src="{{ asset('assets/admin_assets/images/icons/chart-icon.svg') }}" alt="">
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6">
<div class="dashboard-widget">
<img src="{{ asset('assets/admin_assets/images/shapes/widget-shape1.png') }}" alt="" class="dashboard-widget__shape one">
<img src="{{ asset('assets/admin_assets/images/shapes/widget-shape2.png') }}" alt="" class="dashboard-widget__shape two">
<span class="dashboard-widget__icon">
<img src="{{ asset('/assets/admin_assets/images/icons/sidebar-icon12.svg') }}" alt="">
</span>
<div class="dashboard-widget__content flx-between gap-1 align-items-end">
<div>
<h4 class="dashboard-widget__number mb-1 mt-3">{{ \App\Models\Ticket::count() }}</h4>
<span class="dashboard-widget__text font-14">Всього скарг</span>
</div>
<img src="{{ asset('assets/admin_assets/images/icons/chart-icon.svg') }}" alt="">
</div>
</div>
</div>
</div>
    </div>
    <!-- dashboard body Item End -->
