@extends(@env('TEMPLATE_NAME').'.App')

@push('script')
    <script src="{{ asset('/siema.min.js') }}"></script>
    <script>
        var w;
        var perPageNumber;

        function perPage() {
            w = window.innerWidth;
            if (w <= 500) {
                perPageNumber = 1;
            } else if (w <= 768) {
                perPageNumber = 5;
            } else if (w <= 1024) {
                perPageNumber = 5;
            } else {
                perPageNumber = 7;
            }
        }


        document.getElementsByTagName("BODY")[0].onresize = function() {
            mySiema.destroy();
            perPage();
            mySiema.init();
        };


        perPage();
        var mySiema = new Siema({
            selector: '.siema',
            duration: 200,
            easing: 'ease-out',
            perPage: perPageNumber,
            startIndex: 0,
            draggable: true,
            multipleDrag: true,
            threshold: 20,
            loop: false,
            rtl: true,
            onInit: () => {},
            onChange: () => {

            },
        });
        document.querySelector('.prev2').addEventListener('click', () => mySiema.prev());
        document.querySelector('.next2').addEventListener('click', () => mySiema.next());
    </script>
@endpush

@section('Content')
    <section class="banner wide pb-0">
        <div>
            {{--images&label=banner&var=banners&count=1 --}}
            @if (isset($banners) && isset($banners['images']))
                @foreach ($banners['images'] as $content)
                    <img src="{{ $content }}" alt="عصر آی تی">
                @endforeach
            @endisset
    </div>
</section>




<section class=" shadowy-1 my-0 py-3  category-section" onresize="onResize()">
    <div class="flex one  ">
        <div class="siema p-0">
            {{--category&label=cat&var=category&count=10 --}}
            @isset($category['data'])
                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="hover text-center">
                            @if (isset($content->images['thumb']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small'] ?? $content->images['thumb'] }}"
                                        alt="{{ $content->title }}" width="40" height="40"
                                        srcset="
                                                                                            {{ $content->images['images']['small'] ?? $content->images['thumb'] }} {{ env('CATEGORY_SMALL_W') }}w,
                                                                                            {{ $content->images['images']['medium'] ?? $content->images['thumb'] }} {{ env('CATEGORY_MEDIUM_W') }}w">
                                    <figcaption>
                                        <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                    </figcaption>
                                </figure>
                            @else
                                <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                            @endif

                        </div>
                    </a>
                @endforeach
            @endisset
        </div>
        <a class="prev2">&#10094;</a>
        <a class="next2">&#10095;</a>
    </div>
</section>


{{--categoryDetail&label=about&var=about&count=1  --}}
@isset($about['data'])
<section class="my-0 py-5 bg-gray">
    <div>
        <div class="flex three">
            <div class="two-third middle flex">
                <h2>فروشگاه عصر آی تی</h2>
                {!! $about['data']->brief_description !!}
            </div>
            <div class="third">
                <img src="{{ $about['data']->images['images']['large'] }}" alt="">
            </div>
        </div>
    </div>
    </section>
@endisset




<section class=" bg-gray  mt-0 mb-0">

    <div class="flex four-800">

        <div class=" one-fourth-800">

            <div class="application flex one">
                <div>
                    <h2>اپلیکیشن ها</h2>
                    <div class="flex two grow one-800  ">
                        {{--post&label=application&var=application&count=5 --}}
                        @isset($application['data'])
                            @foreach ($application['data'] as $content)
                                <div>
                                    <a href="{{ $content->slug }}">
                                        <article class="shadow2">
                                            @if (isset($content->images['thumb']))
                                                <figure class="image">
                                                    <img src="{{ $content->images['images']['small'] ?? $content->images['thumb'] }}"
                                                        alt="{{ $content->title }}"
                                                        width="{{ env('ARTICLE_SMALL_W') }}"
                                                        height="{{ env('ARTICLE_SMALL_H') }}">
                                                </figure>
                                            @endif

                                            <div class="title">{{ $content->title }}</div>
                                            @if (count($content->comments))
                                                <div class="rate mt-1">
                                                    @php
                                                        $rateAvrage = $rateSum = 0;
                                                    @endphp
                                                    @foreach ($content->comments as $comment)
                                                        @php
                                                            $rateSum = $rateSum + $comment['rate'];
                                                        @endphp
                                                    @endforeach
                                                    @for ($i = $rateSum / count($content->comments); $i >= 1; $i--)
                                                        <img width="18" height="18" src="{{ asset('/img/star1x.png') }}"
                                                            alt="{{ 'star for rating' }}">
                                                    @endfor
                                                </div>
                                            @endif

                                        </article>
                                    </a>
                                </div>
                            @endforeach
                            <div>
                                <a href="/اپلیکیشن">
                                    <article class="shadow2 py-3">
                                        <svg height="70px" width="70px" id="Layer_1"
                                            style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32"
                                            xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <path
                                                d="M28,14H8.8l4.62-4.62C13.814,8.986,14,8.516,14,8c0-0.984-0.813-2-2-2c-0.531,0-0.994,0.193-1.38,0.58l-7.958,7.958  C2.334,14.866,2,15.271,2,16s0.279,1.08,0.646,1.447l7.974,7.973C11.006,25.807,11.469,26,12,26c1.188,0,2-1.016,2-2  c0-0.516-0.186-0.986-0.58-1.38L8.8,18H28c1.104,0,2-0.896,2-2S29.104,14,28,14z" />
                                        </svg>
                                        <div class="title ">تمام اپلیکیشن ها</div>
                                    </article>
                                </a>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>

        </div>

        <div class="three-fourth-800">

            <div class="articles-home flex one">
                <div>
                    <h2> مقالات</h2>
                    <div class="flex one    ">
                        {{--post&label=articles&var=articles&count=6&child=true --}}

                        @isset($articles['data'])
                            @foreach ($articles['data'] as $content)
                                <div>
                                    <a href="{{ $content->slug }}">
                                        <article class="shadow2">
                                            <div class="title">{{ $content->title }}</div>

                                            @if (isset($content->images['thumb']))
                                                <figure class="image">
                                                    <img src="{{ $content->images['images']['small'] ?? $content->images['thumb'] }}"
                                                        alt="{{ $content->title }}"
                                                        width="{{ env('ARTICLE_SMALL_W') }}"
                                                        height="{{ env('ARTICLE_SMALL_H') }}">
                                                </figure>
                                            @endif


                                            <div class="info">
                                                {!! readMore($content->brief_description, 250) !!}

                                                <div class="rate mt-1">
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
                                            </div>


                                        </article>
                                    </a>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>

    </div>







</section>


@endsection
