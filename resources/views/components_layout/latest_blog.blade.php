@php
    // Получаем последние 3 опубликованные новости
    $latestNews = \App\Models\News::whereNotNull('published_at')
                    ->orderBy('published_at', 'desc')
                    ->take(3)
                    ->get();
@endphp

<!-- Start Blog -->
<section class="lqd-section blog py-90 bg-transparent transition-all" style="background-image: linear-gradient(180deg, #FAF9FE 0%, #fff 100%);" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "ease": "power4.out", "initValues": {"y": "35px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
    <div class="container">
        <div class="row items-center">
            <div class="col col-12 col-md-6 animation-element">
                <div class="mb-15 ld-fancy-heading relative">
                    <h6 class="ld-fh-element m-0 inline-block relative label text-10 tracking-1 uppercase font-bold text-black bg-blue-200 trackink-1px py-5 px-15 rounded-100">
                        Останні новини
                    </h6>
                </div>
                <div class="ld-fancy-heading relative">
                   <a href="{{ url('/news') }}">
                    <h2 class="ld-fh-element mb-0/5em inline-block relative text-40 text-gray-600">
                        Останні публікації
                    </h2>
                    </a>
                </div>
            </div>
            <div class="col col-12 col-md-6 animation-element">
                <div class="ld-fancy-heading relative">
                    <p class="ld-fh-element mb-0/5em inline-block relative leading-1/6em text-18 text-gray-500">
                        Будьте в курсі актуальних подій – наші новини завжди свіжі та інформативні.
                    </p>
                </div>
            </div>
            <div class="col col-12 animation-element">
                <div class="flex flex-wrap -mr-30 -ml-30 module-blog">
                    @forelse($latestNews as $news)
                        <div class="w-33percent flex px-30 mb-30 md:w-50percent sm:w-full module-col">
                            <article class="lqd-lp relative lqd-lp-style-6 lqd-lp-style-6-alt lqd-lp-hover-img-zoom lqd-lp-hover-img-zoom-out lqd-lp-animate-onhover rounded-4 overflow-hidden text-start">
                                <div class="lqd-lp-img overflow-hidden">
                                    <figure>
                                        @if($news->image_url)
                                            <img class="w-full" src="{{ asset($news->image_url) }}" alt="{{ $news->title }}">
                                        @else
                                            <img class="w-full" src="{{ asset('assets/images/default-news.jpg') }}" alt="{{ $news->title }}">
                                        @endif
                                    </figure>
                                    <div class="lqd-lp-meta uppercase font-bold relative z-3">
                                        <span class="screen-reader-text">Категорії</span>
                                        <ul class="lqd-lp-cat lqd-lp-cat-shaped lqd-lp-cat-solid reset-ul inline-ul font-bold uppercase tracking-0/1em">
                                            @if($news->category)
                                                <li>
                                                    <a class="rounded-full" href="{{ route('news.byCategory', $news->category->id) }}">
                                                        {{ $news->category->name }}
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <header class="lqd-lp-header pt-1/5em px-1em">
                                    <div class="lqd-lp-meta lqd-lp-meta-dot-between flex flex-wrap items-center">
                                        <div class="lqd-lp-author relative z-3">
                                            <div class="lqd-lp-author-info">
                                                <h3 class="mt-0 mb-0">
                                                    <a href="#">Адміністрація</a>
                                                </h3>
                                            </div>
                                        </div>
                                        <time class="lqd-lp-date" datetime="{{ $news->published_at }}">
                                            {{ $news->published_at ? $news->published_at->diffForHumans() : '' }}
                                        </time>
                                    </div>
                                    <h2 class="entry-title lqd-lp-title mt-0/5em mb-0 h5">
                                        <a href="{{ route('news.show', $news->slug) }}">
                                            {{ $news->title }}
                                        </a>
                                    </h2>
                                </header>
                                <div class="lqd-lp-excerpt pt-1em pb-1/5em px-1em">
                                    <p>{{ $news->excerpt }}</p>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>Новин поки що немає.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="col col-12 text-center animation-element">
                <div class="flex flex-row flex-wrap items-center justify-center">
                    <div class="mr-25 ld-fancy-heading relative sm:mr-0">
                        <h6 class="ld-fh-element m-0 inline-block relative label text-purple-500 font-normal bg-purple-100 text-15 font-normal py-5 px-15 rounded-100">
                            Зв'язок
                        </h6>
                    </div>
                    <div class="ld-fancy-heading relative">
                        <p class="ld-fh-element relative m-0 text-14 text-purple-700">
                            <span>Шукаєте корпоративне рішення?</span>
                            <a href="#contact" data-localscroll="true">
                                <u class="text-purple-500">Зв'яжіться з нами.</u>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Blog -->
