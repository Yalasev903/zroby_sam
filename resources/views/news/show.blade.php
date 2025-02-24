@include('news.component_news.header')
@include('news.component_news.breadcrumb', ['breadcrumbs' => $breadcrumbs])
<!--==================== Preloader Start ====================-->
 {{-- <div class="loader-mask">
  <div class="loader">
      <div></div>
      <div></div>
  </div>
</div> --}}
<!--==================== Preloader End ====================-->
<!-- ======================= Blog Details Section Start ========================= -->
<section class="blog-details padding-y-120 position-relative overflow-hidden">
    <div class="container container-two">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- blog details top Start -->
                <div class="blog-details-top mb-64">
                    <div class="blog-details-top__info flx-align gap-3 mb-4">
                        <div class="blog-details-top__thumb flx-align gap-2">
                            <!-- Здесь можно вывести аватар автора, если он есть. Пока используется картинка по умолчанию -->
                            <img src="{{ asset('assets/images/thumbs/blog-details-user.png') }}" alt="">
                            <!-- Выводим название категории новости или другого автора, если понадобится -->
                            <span class="text-heading fw-500">{{ $news->category->name ?? 'News' }}</span>
                        </div>
                        <span class="blog-details-top__date flx-align gap-2">
                            <img src="{{ asset('assets/images/icons/clock.svg') }}" alt="">
                            {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('d M Y') : '' }}
                        </span>
                    </div>
                    <h2 class="blog-details-top__title mb-4 text-capitalize">{{ $news->title }}</h2>
                    <p class="blog-details-top__desc">{{ $news->excerpt }}</p>
                </div>
                <!-- blog details top End -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- blog details content Start -->
                <div class="blog-details-content">
                    <div class="blog-details-content__thumb mb-32">
                        <img src="{{ $news->image_url ?: asset('assets/images/thumbs/default-details.png') }}" alt="{{ $news->title }}">
                    </div>
                    <div class="blog-details-content__desc mb-40">
                        {!! $news->content !!}
                    </div>

                    <!-- Можно добавить дополнительные динамические блоки, например, вывод тегов, комментариев и т.д. -->

                    <!-- Пример: блок тегов -->
                    @if(isset($news->tags) && $news->tags->isNotEmpty())
                        <div class="post-tag flx-align gap-3 mb-40 mt-40">
                            <span class="post-tag__text text-heading fw-500">Post Tag: </span>
                            <ul class="post-tag__list flx-align gap-2">
                                @foreach($news->tags as $tag)
                                    <li class="post-tag__item">
                                        <a href="{{ route('news.byTag', $tag->slug) }}" class="post-tag__link font-14 text-heading pill fw-500">{{ $tag->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Блок для социальных кнопок (статичный или динамический) -->
                    <div class="socail-share flx-align gap-3 mb-40">
                        <span class="socail-share__text text-heading fw-500">Share On: </span>
                        <ul class="social-list colorful-style">
                            <li class="social-list__item">
                                <a href="https://www.facebook.com" class="social-list__link text-heading font-16 flex-center"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li class="social-list__item">
                                <a href="https://www.twitter.com" class="social-list__link text-heading font-16 flex-center"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li class="social-list__item">
                                <a href="https://www.linkedin.com" class="social-list__link text-heading font-16 flex-center"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                        </ul>
                    </div>

                    <!-- Дополнительно: комментарии, форма оставления комментария и т.д. -->
                    <!-- Если они реализованы, динамически подключайте соответствующие компоненты -->

                </div>
                <!-- blog details content End -->
            </div>
        </div>
    </div>
</section>
<!-- ======================= Blog Details Section End ========================= -->

<!-- =========================== Article Section Start ============================ -->
<section class="article padding-y-120 section-bg">
    <div class="container container-two">
        <div class="section-heading style-left style-flex flx-between align-items-end gap-3">
            <div class="section-heading__inner">
                <h3 class="section-heading__title">Дивись Усі Пости </h3>
            </div>
            <a href="{{ route('news.index') }}" class="btn btn-outline-light btn-lg pill">Усі Новини</a>
        </div>
        <!-- Здесь можно добавить блок похожих статей (рекомендуемых) -->
        <div class="article-item-wrapper">
            <!-- Если реализована логика похожих новостей, можно передать переменную $relatedArticles и вывести их циклом -->
            @if(isset($relatedArticles) && $relatedArticles->isNotEmpty())
                @foreach($relatedArticles as $related)
                    <div class="article-item">
                        <div class="article-item__inner d-flex position-relative">
                            <div class="article-item__start">
                                <div class="user-info">
                                    <div class="user-info__thumb">
                                        <img src="{{ asset('assets/images/thumbs/user-info-img1.png') }}" alt="">
                                    </div>
                                    <span class="user-info__text mt-2 mb-1 font-14 text-heading">Posted by</span>
                                    <h6 class="user-info__name font-16 font-body fw-600 mb-0">Ralph Edwards</h6>
                                </div>
                            </div>
                            <div class="article-item__center d-flex align-items-center">
                                <div class="article-item__content">
                                    <div class="article-item__top flx-align">
                                        <a href="{{ route('news.byCategory', $related->news_category_id) }}" class="article-item__tag font-14">{{ $related->category->name ?? 'Category' }}</a>
                                        <span class="text-heading font-16 fw-500">{{ \Carbon\Carbon::parse($related->published_at)->format('d M, Y') }}</span>
                                    </div>
                                    <h4 class="article-item__title mb-3">
                                        <a href="{{ route('news.show', $related->slug) }}" class="link">{{ $related->title }}</a>
                                    </h4>
                                    <p class="article-item__desc">{{ Str::limit(strip_tags($related->excerpt), 100) }}</p>
                                </div>

                                <div class="article-item__thumb">
                                    <img src="{{ $related->image_url ?: asset('assets/images/thumbs/default.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="article-item__end flex-shrink-0">
                            <a href="{{ route('news.show', $related->slug) }}" class="btn-simple">Read More <span class="icon font-26"><i class="las la-arrow-right"></i></span> </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- =========================== Article Section End ============================ -->

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

@include('news.component_news.footer')
