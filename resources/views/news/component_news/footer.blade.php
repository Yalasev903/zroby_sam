<!-- ==================== Footer Start Here ==================== -->
<footer class="footer section-bg">
    <img src="{{ asset('assets/images/shapes/pattern.png') }}" alt="" class="bg-pattern">
    <img src="{{ asset('assets/images/shapes/element1.png') }}" alt="" class="element one">
    <img src="{{ asset('assets/images/shapes/element2.png') }}" alt="" class="element two">
    <img src="{{ asset('assets/images/gradients/footer-gradient.png') }}" alt="" class="bg--gradient">

    <div class="container container-two">
        <div class="row gy-5">
            <div class="col-xl-3 col-sm-6">
                <div class="footer-item">
                    <div class="footer-item__logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="Zroby_Sam Logo">
                        </a>
                    </div>
                    <p class="footer-item__desc">Zroby_Sam — платформа для пошуку майстрів, замовлення послуг і натхнення для власних проектів.</p>
                    <div class="footer-item__social">
                        <ul class="social-list">
                            <li class="social-list__item">
                                <a href="https://www.facebook.com" class="social-list__link flx-center"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li class="social-list__item">
                                <a href="https://www.twitter.com" class="social-list__link flx-center"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li class="social-list__item">
                                <a href="https://www.linkedin.com" class="social-list__link flx-center"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                            <li class="social-list__item">
                                <a href="https://www.youtube.com" class="social-list__link flx-center"><i class="fab fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-sm-6 col-xs-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">Сторінки</h5>
                    <ul class="footer-menu">
                        <li class="footer-menu__item"><a href="{{ route('home') }}" class="footer-menu__link">Головна</a></li>
                        <li class="footer-menu__item"><a href="#about" class="footer-menu__link">Про нас</a></li>
                        <li class="footer-menu__item"><a href="#services" class="footer-menu__link">Послуги</a></li>
                        <li class="footer-menu__item"><a href="#contact" class="footer-menu__link">Контакти</a></li>
                        <li class="footer-menu__item"><a href="{{ url('/news') }}" class="footer-menu__link">Новини</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-2 col-sm-6 col-xs-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">Користувачу</h5>
                    <ul class="footer-menu">
                        <li class="footer-menu__item"><a href="{{ route('login') }}" class="footer-menu__link">Увійти</a></li>
                        <li class="footer-menu__item"><a href="{{ route('register') }}" class="footer-menu__link">Реєстрація</a></li>
                        <li class="footer-menu__item"><a href="{{ url('/dashboard') }}" class="footer-menu__link">Кабінет</a></li>
                    </ul>
                </div>
            </div>

            {{-- <div class="col-xl-4 col-sm-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">Підписка</h5>
                    <p class="footer-item__desc">Отримуйте оновлення та новини першими</p>
                    <form action="#" class="mt-4 subscribe-box d-flex align-items-center flex-column gap-2">
                        <input type="email" class="form-control common-input pill text-white" placeholder="Ваша електронна пошта">
                        <button type="submit" class="btn btn-main btn-lg w-100 pill">Підписатись</button>
                    </form>
                </div>
            </div> --}}
            <div class="col-xl-4 col-sm-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">Чому ми?</h5>
                    <ul class="footer-menu">
                        <li class="footer-menu__item">✔ Надійні майстри з рейтингом</li>
                        <li class="footer-menu__item">✔ Гарантовані платежі</li>
                        <li class="footer-menu__item">✔ Безпечне спілкування в чаті</li>
                        <li class="footer-menu__item">✔ Портфоліо та реальні відгуки</li>
                        <br/>
                        <h5 class="footer-item__title">Чат підтримки</h5>
                        <p class="footer-item__desc">Маєте питання? Напишіть нам у Telegram і ми допоможемо.</p>
                        <a href="https://t.me/zroby_sam_support" target="_blank" class="btn btn-main btn-sm mt-3">Відкрити Telegram</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- bottom Footer -->
<div class="bottom-footer">
    <div class="container container-two">
        <div class="bottom-footer__inner flx-between gap-3">
            <p class="bottom-footer__text font-14">Copyright &copy; {{ now()->year }} RobotaPro. Всі права захищені.</p>
            <div class="footer-links">
                <a href="{{ route('policy') }}" class="footer-link font-14" target="_blank">Політика конфіденційності</a>
                <a href="{{ route('agreement') }}" class="footer-link font-14" target="_blank">Умови використання</a>
                <a href="#contact" class="footer-link font-14">Підтримка</a>
            </div>
        </div>
    </div>
</div>
<!-- ==================== Footer End Here ==================== -->

<!-- JS Scripts -->
<script src="{{ asset('assets/news/assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/news/assets/js/boostrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/news/assets/js/countdown.js') }}"></script>
<script src="{{ asset('assets/news/assets/js/counterup.min.js') }}"></script>
<script src="{{ asset('assets/news/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/news/assets/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('assets/news/assets/js/apexchart.js') }}"></script>
<script src="{{ asset('assets/news/assets/js/main.js') }}"></script>

</body>
</html>
