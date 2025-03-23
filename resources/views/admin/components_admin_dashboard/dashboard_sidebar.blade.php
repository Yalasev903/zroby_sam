<!-- ================================== Dashboard Start =========================== -->
<section class="dashboard">
    <div class="dashboard__inner d-flex">

        <!-- ===================== Dashboard Sidebar Start ======================= -->
        <div class="dashboard-sidebar">
            <button type="button" class="dashboard-sidebar__close d-lg-none d-flex"><i class="las la-times"></i></button>
            <div class="dashboard-sidebar__inner">
                <a href="index.html" class="logo mb-48">
                    <img src="{{ asset('assets/admin_assets/images/logo/logo.png') }}" alt="">
                </a>
                <a href="index.html" class="logo favicon mb-48">
                    <img src="{{ asset('assets/admin_assets/images/logo/favicon.png') }}" alt="">
                </a>

                <!-- Sidebar List Start -->
                <ul class="sidebar-list">
                    <li class="sidebar-list__item">
                        <a href="{{ url('admin/dashboard') }}" class="sidebar-list__link">
                            <span class="sidebar-list__icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon1.svg') }}" alt="" class="icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon-active1.svg') }}" alt="" class="icon icon-active">
                            </span>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list__item">
                        <a href="{{ route('admin.users.table') }}" class="sidebar-list__link">
                            <span class="sidebar-list__icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon4.svg') }}" alt="" class="icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon-active4.svg') }}" alt="" class="icon icon-active">
                            </span>
                            <span class="text">Користувачі</span>
                        </a>
                    </li>
                    <li class="sidebar-list__item">
                        <a href="{{ route('admin.orders.table') }}" class="sidebar-list__link">
                            <span class="sidebar-list__icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon5.svg') }}" alt="" class="icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon-active5.svg') }}" alt="" class="icon icon-active">
                            </span>
                            <span class="text">Замовлення</span>
                        </a>
                    </li>
                    <li class="sidebar-list__item">
                        <a href="{{ route('admin.ads.table') }}" class="sidebar-list__link">
                            <span class="sidebar-list__icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon11.svg') }}" alt="" class="icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon-active11.svg') }}" alt="" class="icon icon-active">
                            </span>
                            <span class="text">Оголошення</span>
                        </a>
                    </li>
                    <li class="sidebar-list__item">
                        <a href="{{ route('admin.chat.table') }}" class="sidebar-list__link">
                            <span class="sidebar-list__icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon7.svg') }}" alt="" class="icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon-active7.svg') }}" alt="" class="icon icon-active">
                            </span>
                            <span class="text">Чати</span>
                        </a>
                    </li>
                    <li class="sidebar-list__item">
                        <a href="{{ route('admin.greetings') }}" class="sidebar-list__link">
                            <span class="sidebar-list__icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon7.svg') }}" alt="" class="icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon-active7.svg') }}" alt="" class="icon icon-active">
                            </span>
                            <span class="text">Відправка повідомлень</span>
                        </a>
                    </li>
                    <li class="sidebar-list__item">
                        <!-- Исправлено: правильное имя маршрута -->
                        <a href="{{ route('admin.tickets.table') }}" class="sidebar-list__link">
                            <span class="sidebar-list__icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon12.svg') }}" alt="" class="icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon-active12.svg') }}" alt="" class="icon icon-active">
                            </span>
                            <span class="text">Скарги</span>
                        </a>
                    </li>
                    <li class="sidebar-list__item">
                        <a href="login.html" class="sidebar-list__link">
                            <span class="sidebar-list__icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon13.svg') }}" alt="" class="icon">
                                <img src="{{ asset('assets/admin_assets/images/icons/sidebar-icon-active13.svg') }}" alt="" class="icon icon-active">
                            </span>
                            <span class="text">Вихід</span>
                        </a>
                    </li>
                </ul>
                <!-- Sidebar List End -->

            </div>
        </div>
        <!-- ===================== Dashboard Sidebar End ======================= -->
