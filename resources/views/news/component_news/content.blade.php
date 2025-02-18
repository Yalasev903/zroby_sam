<!-- ======================== Breadcrumb Two Section Start ===================== -->
<section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1">
    <div class="breadcrumb-two">
        <img src="{{ asset('assets/images/gradients/breadcrumb-gradient-bg.png') }}" alt="" class="bg--gradient">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="breadcrumb-two-content text-center">
                        <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                            <li class="breadcrumb-list__item font-14 text-body">
                                <a href="{{ route('home') }}" class="breadcrumb-list__link text-body hover-text-main">Home</a>
                            </li>
                            <li class="breadcrumb-list__item font-14 text-body">
                                <span class="breadcrumb-list__icon font-10"><i class="fas fa-chevron-right"></i></span>
                            </li>
                            <li class="breadcrumb-list__item font-14 text-body">
                                <span class="breadcrumb-list__text">Blog</span>
                            </li>
                        </ul>
                        <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">Latest Blogs And Articles</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================== Breadcrumb Two Section End ===================== -->

<!-- =========================== Blog Section Start ========================== -->
<section class="blog padding-y-120 section-bg position-relative z-index-1 overflow-hidden">
    <img src="{{ asset('assets/images/shapes/pattern-five.png') }}" class="position-absolute end-0 top-0 z-index--1" alt="">
    <div class="container container-two">
        <div class="row gy-4">
            @foreach($news as $article)
                <div class="col-lg-4 col-sm-6">
                    <div class="blog-item">
                        <div class="blog-item__thumb">
                            <a href="{{ route('news.show', $article->slug) }}" class="link">
                                <img src="{{ $article->image_url ? $article->image_url : asset('assets/images/thumbs/default.png') }}" class="cover-img" alt="{{ $article->title }}">
                            </a>
                        </div>
                        <div class="blog-item__content">
                            <div class="blog-item__top flx-align">
                                <!-- Выводим название категории -->
                                <a href="{{ route('news.byCategory', $article->news_category_id) }}" class="blog-item__tag pill font-14 text-heading fw-500 hover-text-main">
                                    {{ $article->category->name ?? 'News' }}
                                </a>
                                <!-- Дата публикации -->
                                <div class="blog-item__date font-14 flx-align gap-2 font-14 text-heading fw-500">
                                    <span class="icon">
                                        <img src="{{ asset('assets/images/icons/calendar.svg') }}" alt="">
                                    </span>
                                    <span class="text">
                                        {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('M d, Y') : '' }}
                                    </span>
                                </div>
                            </div>
                            <h5 class="blog-item__title">
                                <a href="{{ route('news.show', $article->slug) }}" class="link">
                                    {{ $article->title }}
                                </a>
                            </h5>
                            <a href="{{ route('news.details', $article->slug) }}" class="btn btn-outline-light pill fw-600">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Start -->
        <nav aria-label="Page navigation example">
            <!-- Используем стандартный вывод пагинации Laravel -->
            <ul class="pagination common-pagination">
                {{ $news->links() }}
            </ul>
        </nav>
        <!-- Pagination End -->
    </div>
</section>
<!-- =========================== Blog Section End ========================== -->

<!-- ======================== Brand Section Start ========================= -->
<div class="brand">
    <div class="container container">
        <div class="brand-slider">
            <div class="brand-item d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/thumbs/brand-img1.png') }}" alt="">
            </div>
            <div class="brand-item d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/thumbs/brand-img2.png') }}" alt="">
            </div>
            <div class="brand-item d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/thumbs/brand-img3.png') }}" alt="">
            </div>
            <div class="brand-item d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/thumbs/brand-img4.png') }}" alt="">
            </div>
            <div class="brand-item d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/thumbs/brand-img5.png') }}" alt="">
            </div>
            <div class="brand-item d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/thumbs/brand-img3.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- ======================== Brand Section End ========================= -->
