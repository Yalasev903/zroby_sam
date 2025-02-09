@extends('layouts.app')

@section('content')
<section class="lqd-section blog py-90 bg-transparent transition-all" style="background-image: linear-gradient(180deg, #FAF9FE 0%, #fff 100%);">
    <div class="container">
        <div class="row items-center">
            <div class="col col-12 col-md-6">
                <h6 class="text-10 tracking-1 uppercase font-bold text-black bg-blue-200 py-5 px-15 rounded-100">Объявления</h6>
                <h2 class="text-40 text-gray-600">Последние объявления</h2>
            </div>
            <div class="col col-12 col-md-6">
                <p class="text-18 text-gray-500">Просматривайте актуальные объявления на нашей платформе.</p>
            </div>
        </div>
        <div class="row">
            @foreach($ads as $ad)
                <div class="w-33percent flex px-30 mb-30 md:w-50percent sm:w-full module-col">
                    <article class="lqd-lp relative rounded-4 overflow-hidden text-start">
                        <div class="lqd-lp-img overflow-hidden">
                            <figure>
                                <img class="w-full"
                                src="{{ $ad->photo_path ? asset('storage/' . $ad->photo_path) : asset('images/default-avatar.webp') }}"
                                alt="{{ $ad->title }}">

                            </figure>
                            <div class="lqd-lp-meta uppercase font-bold">
                                <ul class="lqd-lp-cat lqd-lp-cat-shaped inline-ul">
                                    {{-- <li><a href="#">{{ $ad->category->name }}</a></li> --}}
                                </ul>
                            </div>
                        </div>
                        <header class="lqd-lp-header pt-1/5em px-1em">
                            <div class="lqd-lp-meta flex flex-wrap items-center">
                                <div class="lqd-lp-author">
                                    <h3 class="mt-0 mb-0">
                                        <a href="#">{{ $ad->user->name }}</a>
                                    </h3>
                                </div>
                                <time class="lqd-lp-date">{{ $ad->created_at->diffForHumans() }}</time>
                            </div>
                            <h2 class="entry-title lqd-lp-title mt-0/5em mb-0 h5">{{ $ad->title }}</h2>
                        </header>
                        <div class="lqd-lp-excerpt pt-1em pb-1/5em px-1em">
                            <p>{{ Str::limit($ad->description, 100) }}</p>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
