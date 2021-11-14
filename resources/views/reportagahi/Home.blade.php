@extends(@env('TEMPLATE_NAME').'.App')

@section('footer')

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
                perPageNumber = 5;
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
@endsection

@section('Content')


    <section class="index-img bg-gray mt-0 mb-0 pb-2">
        <div class="text-center pb-1">
            <h1>مرجع تخصصی تبلیغات</h1>
        </div>
        <div class="flex two five-500  center ">
            {{--images&label=banner&var=banners&count=5--}}
            @if (isset($banners) && isset($banners['images']))
                @foreach ($banners['images'] as $k => $content)
                <a href="{{ $banners['url'][$k] }}" @if (!isset($banners['follow'][$k])) rel="nofollow" @endif target="blank">
                    <div class="shadow  p-0">
                        <picture>
                            <img class="cover" src="{{ $content }}" alt="{{ $banners['name'][$k] }}" width="200" height="200">
                        </picture>
                    </div>
                </a>

                @endforeach
            @endisset

        </div>
    </section>



    <section class="index-item-top  mt-0 mb-0 pt-2 pb-2 bg-white category-section " onresize="onResize()">
        <div class="flex one  ">
            <div class="siema p-0">
                {{--category&label=cat&var=category&count=10 --}}
                @isset($category['data'])
                    @foreach ($category['data'] as $content)
                        <a href="{{ $content->slug }}">
                            <div class="hover text-center">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        <img loading="lazy" src="{{ $content->images['images']['small'] }}"
                                            alt="{{ $content->title }}" width="61" height="79"
                                            srcset="
                                                                        {{ $content->images['images']['small'] }} {{ env('CATEGORY_SMALL_W') }}w,
                                                                        {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_MEDIUM_W') }}w">
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
            <a class="prev2">&#10094;</a>
            <a class="next2">&#10095;</a>
        </div>
    </section>


    <section class="index-items bg-theme-color home-top-view m-0">

        <div class="flex one">
            <h2>مقالات</h2>
            <div>
                <div class="flex one three-500  center  ">

                    {{--post&label=topProducts&var=products&count=12--}}
                    @isset($products['data'])


                        @foreach ($products['data'] as $content)
                            <div>
                                <a class="hover" href="{{ $content->slug }}">

                                    @if (isset($content->images['images']['small']))
                                        <div class="" ><img width="{{ env('PRODUCT_SMALL_W') }}" height="{{ env('PRODUCT_SMALL_H') }}" alt="{{ $content->title }}" src="{{ $content->images['images']['small'] }}"></div>
                                    @endif
                                    <div class="">
                                        <h3> {{ $content->title }}</h3>
                                        <div>
                                            <div class="rate mt-1">
                                                @if (count($content->comments))
                                                    @php
                                                    $rateAvrage = $rateSum = 0;
                                                    @endphp
                                                    @foreach ($content->comments as $comment)
                                                        @php
                                                        $rateSum = $rateSum + $comment['rate'] ;
                                                        @endphp
                                                    @endforeach
                                                    @for ($i = $rateSum / count($content->comments); $i >= 1; $i--)
                                                        <label></label>
                                                    @endfor
                                                @endif
                                            </div>
                                            @if (isset($content->attr['price']))
                                                @convertCurrency($content->attr['price']??0) تومان
                                            @endif
                                        </div>
                                    </div>

                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </section>

    {{--#anchor down --}}
@endsection
