<!-- ======================== Filter Section Start ===================== -->
<section class="filter-section mb-4">
    <div class="container">
        <form action="{{ route('news.index') }}" method="GET" class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="category">Категорії</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Усі Категорій</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary mt-4">Фільтр</button>
            </div>
        </form>
    </div>
</section>
<!-- ======================== Filter Section End ===================== -->


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
            <ul class="pagination common-pagination">
                {{ $news->links() }}
            </ul>
        </nav>
        <!-- Pagination End -->
    </div>
</section>
<!-- =========================== Blog Section End ========================== -->
