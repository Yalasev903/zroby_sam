@if(isset($breadcrumbs))
    <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1">
        <div class="breadcrumb-two">
            {{-- <img src="{{ asset('assets/images/gradients/breadcrumb-gradient-bg.png') }}" alt="" class="bg--gradient"> --}}
            <div class="container container-two">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="breadcrumb-two-content text-center">
                            <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                                @foreach ($breadcrumbs as $index => $breadcrumb)
                                    @if ($index < count($breadcrumbs) - 1)
                                        <li class="breadcrumb-list__item font-14 text-body">
                                            <a href="{{ $breadcrumb['url'] }}" class="breadcrumb-list__link text-body hover-text-main">
                                                {{ $breadcrumb['title'] }}
                                            </a>
                                        </li>
                                        <li class="breadcrumb-list__item font-14 text-body">
                                            <span class="breadcrumb-list__icon font-10">
                                                <i class="fas fa-chevron-right"></i>
                                            </span>
                                        </li>
                                    @else
                                        <li class="breadcrumb-list__item font-14 text-body">
                                            <span class="breadcrumb-list__text">
                                                {{ $breadcrumb['title'] }}
                                            </span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">
                                {{ $breadcrumbs[count($breadcrumbs) - 1]['title'] }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
