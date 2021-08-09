@extends(@env('TEMPLATE_NAME').'.App')


@section('Content')

    <section class="index-item-top bg-orange mt-0 mb-0">
        <div class="text-center">
            <h1>مرجع تخصصی اطلاعات درب </h1>
        </div>
        <div class="flex one five-500 center  ">
            {{--image&label=category&var=category --}}
            @isset($category['data'])
                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="shadow hover">
                            @if (isset($content->images['images']['small']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small']  }}"
                                        sizes="(max-width:{{ env('CATEGORY_SMALL_W') }}px) 100vw {{ env('CATEGORY_SMALL_W') }}px {{ ENV('CATEGORY_MEDIUM_W') }}px {{ ENV('CATEGORY_LARGE_W') }}px"
                                        alt="{{ $content->title }}" width="200" height="200" srcset="
                                                {{ $content->images['images']['small']  }} {{ env('CATEGORY_SMALL_W') }}w,
                                                {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                                {{ $content->images['images']['large'] ?? $content->images['images']['small'] }} 2x">
                                    <figcaption>
                                        <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                                    </figcaption>
                                </figure>
                            @else
                                <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                            @endif

                        </div>
                    </a>
                @endforeach
            @endisset
        </div>

        <div class="flex one five-500 center  ">
            {{--category&label=category&var=category --}}
            @isset($category['data'])
                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="shadow hover">
                            @if (isset($content->images['images']['small']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small']  }}"
                                        sizes="(max-width:{{ env('CATEGORY_SMALL_W') }}px) 100vw {{ env('CATEGORY_SMALL_W') }}px {{ ENV('CATEGORY_MEDIUM_W') }}px {{ ENV('CATEGORY_LARGE_W') }}px"
                                        alt="{{ $content->title }}" width="200" height="200" srcset="
                                                {{ $content->images['images']['small']  }} {{ env('CATEGORY_SMALL_W') }}w,
                                                {{ $content->images['images']['medium'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                                {{ $content->images['images']['large']  }} 2x">
                                    <figcaption>
                                        <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                                    </figcaption>
                                </figure>
                            @else
                                <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                            @endif

                        </div>
                    </a>
                @endforeach
            @endisset
        </div>
    </section>



    <section class="wide  m-0" id="index-comment">
        <div>خدمات درب کالا</div>
    </section>


    {{--#anchor topViewProduct --}}
    <section class="index-items home-top-view bg-gray2">
        <div class="flex one">
            <div>
                <div class="flex two two-500 three-700 six-900 center ">
                    {{--product&label=topViewPost&var=topViewPost&count=11 --}}
                    @isset($topViewPost['data'])
                        @foreach ($topViewPost['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['images']['small']))
                                        <div><img alt="{{ $content->title }}"
                                                width="{{ env('PRODUCT_SMALL_W') }}" height="{{ env('PRODUCT_SMALL_H') }}"
                                                src="{{ $content->images['images']['small'] }}" srcset="
                                                {{ $content->images['images']['small'] }} 850w,
                                                {{ $content->images['images']['medium'] }} 1536w,
                                                {{ $content->images['images']['large'] }} 2880w
                                                    "
                                                    sizes="
                                                    (min-width:1366px) {{ env('PRODUCT_SMALL_W') }}px,
                                                    (min-width:1536px) {{ env('PRODUCT_MEDIUM_W') }}px,
                                                    (min-width:850px) {{ env('PRODUCT_LARGE_W') }}px
                                                    "
                                                    ></div>
                                    @endif
                                    <footer>
                                        <h3> {{ $content->title }}</h3>
                                        <div>
                                            <div class="rate">
                                                @if (count($content->comments))
                                                    @php
                                                        $rateAvrage = $rateSum = 0;
                                                    @endphp
                                                    @foreach ($content->comments as $comment)
                                                        @php
                                                            $rateSum = $rateSum + $comment['rate'];
                                                        @endphp
                                                    @endforeach
                                                    @for ($i = $rateSum / count($content->comments); $i >= 1; $i--)
                                                        <img width="20" height="20"
                                                            srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                            src="{{ asset('/img/star1x.png') }}"
                                                            alt="{{ 'star for rating' }}">
                                                    @endfor
                                                @endif
                                            </div>
                                            @if (isset($content->attr['price']))
                                                @convertCurrency($content->attr['price']??0) تومان
                                            @endif
                                        </div>
                                    </footer>

                                </a>
                            </div>
                        @endforeach
                        <div>
                            <a class="shadow2" href="/درب-ضد-سرقت">
                                <article class=" py-5">
                                    <svg height="70px" width="70px" id="Layer_1" style="enable-background:new 0 0 32 32;"
                                        version="1.1" viewBox="0 0 32 32" xml:space="preserve"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path
                                            d="M28,14H8.8l4.62-4.62C13.814,8.986,14,8.516,14,8c0-0.984-0.813-2-2-2c-0.531,0-0.994,0.193-1.38,0.58l-7.958,7.958  C2.334,14.866,2,15.271,2,16s0.279,1.08,0.646,1.447l7.974,7.973C11.006,25.807,11.469,26,12,26c1.188,0,2-1.016,2-2  c0-0.516-0.186-0.986-0.58-1.38L8.8,18H28c1.104,0,2-0.896,2-2S29.104,14,28,14z" />
                                    </svg>
                                    <div class="title ">تمام درب ها</div>
                                </article>
                            </a>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </section>

    {{--categoryDetail&label=categoryDetail&var=categoryDetail&count=1--}}
    @isset($categoryDetail['data'])
    <section class="my-0 py-5">
        <div>
            <div class="flex one three-600">
                <div class="two-third-600 middle flex" style="order:2">
                    <h2>{{ $categoryDetail['data']->title }}</h2>
                    {!! $categoryDetail['data']->brief_description !!}
                </div>
                <div class="third-600" style="order:1">
                    <img src="{{ $categoryDetail['data']->images['images']['large'] }}" alt="">
                </div>
            </div>
        </div>
    </section>
    @endisset


    <section class="index-items articles bg-gray2 home-top-view mb-0">
        <div class="flex one">
            <div>
                <h2>مقالات درب کالا</h2>
                <div class="flex one two-500  three-800 center ">
                    {{--post&label=articles&var=articles&count=9 --}}
                    @isset($articles['data'])
                        @foreach ($articles['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['images']['medium']))
                                        <div><img width="{{ env('ARTICLE_MEDIUM_W') }}" height="{{ env('ARTICLE_MEDIUM_H') }}" src="{{ $content->images['images']['medium'] }}"></div>
                                    @endif
                                    <footer>
                                        <h3> {{ $content->title }}</h3>
                                    </footer>

                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </section>


    {{--#anchor footer --}}


@endsection
