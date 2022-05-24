@extends(@env('TEMPLATE_NAME').'.App')

@push('scripts')
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
                perPageNumber = 6;
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
    <section class="banner wide p-0 m-0">
        <div>
            {{--images&label=banner&var=banners&count=1 --}}
            @if (isset($banners) && isset($banners['images']))
                @foreach ($banners['images'] as $content)
                    <img src="{{ $content }}" alt="عصر آی تی">
                @endforeach
            @endisset
    </div>
</section>




<section class=" shadowy-1 my-0 py-2 brands category-section" onresize="onResize()">
    <div class="flex one  relative">
        <div class="siema p-0">
            {{--category&label=cat&var=category&count=10 --}}
            @isset($category['data'])
                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="hover text-center">
                            @if (isset($content->images['images']['small']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small']  }}"
                                        alt="{{ $content->title }}" width="" height=""
                                        srcset="{{ $content->images['images']['small']  }} {{ env('CATEGORY_SMALL_W') }}w,
                                                {{ $content->images['images']['medium']  }} {{ env('CATEGORY_MEDIUM_W') }}w">
                                    <figcaption>
                                        <div class="p-0 m-0 text-center"> {{ $content->title }}</div>
                                    </figcaption>
                                </figure>
                            @else
                                <div class="p-0 m-0 text-center"> {{ $content->title }}</div>
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


{{--categoryDetail&label=about&var=about&count=1 --}}
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


<section>
    <div>
        <div class="flex one five-500 center">
            <a href="/سیم-ها" class="flex">
                <img src="{{ url(env('TEMPLATE_NAME').'/img/سیم.jpg') }}" alt="سیم">
            </a>
            <a href="/کانکتور-و-تبدیل" class="flex">
                <img src="{{ url(env('TEMPLATE_NAME').'/img/کانکتور.jpg') }}" alt="کانکتور">
            </a>
            <a href="/کابل" class="flex">
                <img src="{{ url(env('TEMPLATE_NAME').'/img/کابل.jpg') }}" alt="کابل">
            </a>
            <a href="/تجهیزات-الکترونیک" class="flex">
                <img src="{{ url(env('TEMPLATE_NAME').'/img/تجهیزات-الکتریکی.jpg') }}" alt="تجهیزات-الکتریکی">
            </a>
        </div>
    </div>
</section>

<section class="bg-gray-dark my-0 products">
    <div >
        <h2 class="mb-2">محصولات</h2>
        <div class="flex one five-500">
            {{--product&label=product&var=product&count=20 --}}
            @isset($product['data'])
                @foreach ($product['data'] as $content)
                    <div>
                        <a href="{{ $content->slug }}">
                            <article class="shadow2">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        <img src="{{ $content->images['images']['small']  }}"
                                            alt="{{ $content->title }}" width="{{ env('ARTICLE_SMALL_W') }}"
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
                @endisset
            </div>
    </div>


    </section>


    <section class="home-feature my-5">
        <div class="flex one two-700">
            <div class="item">
                <figure class="third-700">
                    <img width="128" height="" src="{{ asset('img/1470399662_Marketing.png') }}"  alt="" >
                </figure>
                <div class="two-third-700">
                    <h3>
                        تنوع بالا محصولات
                    </h3>
                    <p>
                        شما می توانید محصولات ما در دسته بندی های مشخص شده مشاهده نمایید. با ما تماس گرفته و سفارش خود را ثبت نمایید.
                    </p>
                </div>
            </div>

            <div class="item">
                <figure class="third-700">
                    <img width="128" height="" src="{{ asset('img/1470399674_App_Development.png') }}"  alt="" >
                </figure>
                <div class="two-third-700">

                    <h3>تضمین کیفیت</h3>
                    <p>محصولات عصر آی تی را می توانید با بالاترین کیفیت به صورت تست شده و یا بدون تست خریداری نمایید.
                    </p>
                </div>
            </div>

            <div class="item">
                <figure class="third-700">
                    <img width="128" height="" src="{{ asset('img/1470399671_SEO.png') }}"  alt="" >
                </figure>
                <div class="two-third-700">

                    <h3>
                        ارسال به سراسر ایران
                    </h3>
                    <p>
                        تماس محصولات ما قابلیت ارسال به سراسر ایران را به صورت پست ، تیپاکس و یا پیک دارد.
                    </p>
                </div>
            </div>

            <div class="item">
                <figure class="third-700">
                    <img width="128" height="" src="{{ asset('img/1470399667_Newsletter.png') }}"  alt="" >
                </figure>
                <div class="two-third-700">
                    <h3>
                        مناسب ترین قیمت
                    </h3>
                    <p>
                        فروشگاه ما با مناسب ترین قیمت محصولات الکترونیکی به دلیل عرضه بدون واسطه و مستقیم محصولات می باشد.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <section class=" bg-gray mb-0 pt-1">
        {{--post&label=articles&var=articles&count=3--}}
        <div>
            <h2>مقالات</h2>
            <div class="flex five center">
                @isset($articles['data'])
                @foreach ($articles['data'] as $content)
                <div>
                    <a href="{{ $content->slug }}">
                        <article class="shadow2">
                            @if (isset($content->images['images']['medium']))
                            <figure class="image">
                                <img src="{{ $content->images['images']['medium'] }}"
                                width="198" height="100" alt="{{ $content->title }}">
                            </figure>
                            @endif

                            <div class="title">{{ $content->title }}</div>
                            <div class="info">
                                {!! readMore($content->brief_description, 250) !!}
                            </div>
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
                                    srcset="{{ asset('/img/star1x.png') }} , {{ asset('/img/star2x.png') }} 2x"
                                    src="{{ asset('/img/star1x.png') }}"
                                    alt="{{ 'star for rating' }}">
                                    @endfor
                                    @endif
                                </div>

                            </article>
                        </a>
                    </div>
                    @endforeach
                    @endisset
                </div>
            </div>
    </section>


@endsection
