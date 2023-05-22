@extends(@env('TEMPLATE_NAME') . '.App')

@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->brief_description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->brief_description))
@section('canonical', url($detail->slug))

@if (isset($detail->images['images']['medium']))
    @section('twitter:image', url($detail->images['images']['medium']))

    @section('og:image', url($detail->images['images']['medium']))
    @section('og:image:type', 'image/jpeg')
    @section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
    @section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
    @section('og:image:alt', $detail->title)
@endif


@push('head')

@endpush
@push('scripts')
    <script type="text/javascript">
        function zoom(e) {
            var zoomer = e.currentTarget;
            e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
            e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
            x = offsetX / zoomer.offsetWidth * 100
            y = offsetY / zoomer.offsetHeight * 100
            zoomer.style.backgroundPosition = x + '% ' + y + '%';
        }

        function myFunction(imgs) {
            var Img = document.getElementById("main-image");
            var figure = document.getElementById("figure-main-image");

            Img.src = imgs.dataset.large;
            Img.parentElement.style.display = "block";
            figure.style = 'background-image: url(' + imgs.dataset.xlarge + ')';
            $('#main-image').data('xlarge', imgs.dataset.xlarge);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(window).ready(function(e) {

            var zoomer = e.currentTarget;


            $('.zoom').css({
                position: 'absolute',
                top: '1em',
                left: '1em',
                'background-color': 'white',
            })
            $('.zoom').click(function() {

                xlarge = $('#main-image').data('xlarge')
                console.log(xlarge);
                $('#main-image').attr('src', xlarge)
                $('#main-image').toggleClass('zoom2x')

                $(this).toggleClass('fa-magnifying-glass-plus')
                $(this).toggleClass('fa-magnifying-glass-minus')
            })


        });
    </script>
    <style>
        figure.zoom2 {
            background-position: 50% 50%;
            position: relative;
            /* width: 400px; */
            overflow: hidden;
            cursor: zoom-in;
        }

        figure.zoom2 img:hover {
            opacity: 0;
        }

        figure.zoom2 img {
            transition: opacity .5s;
            display: block;
            width: 100%;
        }
    </style>
@endpush

@section('footer')
    @auth
        @if (Auth::user()->id == 1)
            <div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/contents/' . $detail->id . '/edit/') }}')">
                ویرایش</div>
        @endif
    @endauth
@endsection

@section('Content')

    <script></script>
    @php
        $tableOfImages = tableOfImages($detail->description);
        $append = '';
        // $price = calcuteGoldPrice($detail->attr['weight'] ?? 0, $detail->attr['additionalprice'] ?? 0);
    @endphp

    @if ($detail->attr_type == 'product')
        @include('jsonLdProduct')
    @endif
    @include('jsonLdFaq')

    @if ($detail->attr_type == 'article')
        @include('jsonLdArticle')
    @endif

    @if (count($breadcrumb) > 0)
        @include('jsonLdBreadcrumb')
    @endif

    <section class="breadcrumb my-0 py-0">
        <div class="flex one  ">
            <div class="p-0">
                <a href="/">خانه </a>
                @foreach ($breadcrumb as $key => $item)
                    <span>></span>
                    <a title="{{ $item['title'] }}" href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                @endforeach

            </div>
        </div>
    </section>

    <section class="product-detail mt-0 pt-0" id="">
        <div class="flex one ">
            <div class="bg-white border-radius-5">
                <div class="top-page">

                    <div>

                        <div>
                            <div class="flex one three-800">

                                <div id="product-image" class="one mt-2   thirth-800 relative">
                                    @if (isset($detail->images['images']['large']))

                                        <div class="">
                                            <figure class="image zoom2 rounded" id="figure-main-image" onmousemove="zoom(event)"
                                                style="background-image: url({{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }})">
                                                @if (isset($detail->attr['in-stock']) && $detail->attr['in-stock'] == 0)
                                                    <div class="not-in-stock">قابل سفارش</div>
                                                @endif
                                                <div class="overflow-hidden">
                                                    <img id="main-image" loading="lazy"
                                                        class=""
                                                        data-xlarge="{{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }}"
                                                        src="{{ $detail->images['images']['large'] }}"
                                                        alt="{{ $detail->title }}"
                                                        width="{{ env(Str::upper($detail->attr_type) . '_LARGE_W') }}"
                                                        height="{{ env(Str::upper($detail->attr_type) . '_LARGE_H') }}">

                                                    <i class="fa-solid hidden-500 fa-magnifying-glass-plus font-15 zoom p-3 border-radius-5"></i>
                                                </div>

                                            </figure>
                                        </div>

                                        @if ($detail->gallery->count())
                                            <div class="gallery">
                                                <img onclick="myFunction(this);" class="m-1"
                                                    data-large="{{ $detail->images['images']['large'] }}"
                                                    data-xlarge="{{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }}"
                                                    src="{{ $detail->images['images']['small'] }}" height="100">
                                                @foreach ($detail->gallery as $item)
                                                    <img onclick="myFunction(this);" class="m-1"
                                                        data-large="{{ $item->images['images']['large'] }}"
                                                        data-xlarge="{{ $item->images['images']['xlarge'] ?? $item->images['images']['large'] }}"
                                                        src="{{ $item->images['images']['small'] }}" height="100">
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <picture>
                                            <img class="m-auto p-4" width="" height=""
                                                src="https://img.icons8.com/ios/100/cccccc/no-image.png"
                                                alt="company-no-image" />
                                        </picture>
                                    @endif
                                </div>

                                <div class="one third-800 sm:p-1 lg:pr-5">
                                    <h1 id="product-name font-bold" class="">{{ $detail->title }}</h1>


                                    <span id="product-rate" class="rate  mt-1">
                                        @if (count($detail->comments))
                                            @php
                                                $rateAvrage = $rateSum = 0;
                                            @endphp
                                            @foreach ($detail->comments as $comment)
                                                @php
                                                    $rateSum = $rateSum + $comment['rate'];
                                                @endphp
                                            @endforeach
                                            @for ($i = $rateSum / count($detail->comments); $i >= 1; $i--)
                                                <label></label>
                                            @endfor
                                            <span class="font-07">({{ count($detail->comments) }} نفر) </span>
                                        @endif
                                    </span>
                                    <div id="product-categories" class=" my-1 font-09">
                                        دسته بندی :
                                        @foreach ($detail->categories as $key => $item)
                                            {{-- <a href="{{ $item['slug'] }}"> {{ $item['title'] }} </a> --}}
                                            @if ($loop->last)
                                                <a href="{{ $item['slug'] }}"> {{ $item['title'] }} </a>
                                                {{-- <span> | </span> --}}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div><i class="fa-solid fa-square-check text-green font-13 pl-1"></i> ضمانت طلای ۱۸ عیار</div>
                                    <div><i class="fa-solid fa-certificate font-13 pl-1 text-gold"></i> تضمین به روز بودن قیمت طلا</div>
                                    <div><i class="fa-solid fa-gift text-blue  font-13 pl-1"></i> فاکتور + پکیج هدیه</div>

                                    @if (isset($detail->attr['in-stock']) && $detail->attr['in-stock'] == 0)
                                        <div class="bg-slate-100 p-1 rounded-md border mt-1">ناموجود: ساخت و ارسال ۷ روز کاری</div>
                                    @endif

                                    <div>{!! $detail->brief_description !!}</div>


                                </div>
                                <div class=" lg:p-1 lg:px-5 sm:mt-1 sm:p-1">
                                    <div class="bg-gray border p-2 border-radius-5">


                                        @isset($detail->attr['weight'])
                                            <div class="flex one">

                                                <div class="flex py-3 justify-between">
                                                    <span class="text-slate-500 text-sm">وزن: </span>
                                                    <span class="text-left">{{ $detail->attr['weight'] ?? 0 }} گرم</span>
                                                </div>
                                                <div class="flex border-t py-3 justify-between">
                                                    <span class="text-slate-500 text-sm">قیمت روز طلا:</span>
                                                    <span class="text-left">@convertCurrency($detail->GoldPrice()['goldprice']) تومان</span>
                                                </div>
                                                <div class="flex border-t py-3 justify-between">
                                                    <span class="text-slate-500 text-sm">اجرت ساخت:</span> <span class="text-left">۱۸٪</span>
                                                </div>
                                                <div class="flex border-t py-3 justify-between"><span class="text-slate-500 text-sm">سود ایدن:</span><span class="text-left">۷٪</span></div>
                                                <div class="flex border-t py-3 justify-between"><span class="text-slate-500 text-sm">مالیات:</span><span class="text-left">@convertCurrency($detail->GoldPrice()['tax']) تومان</span> </div>
                                                <div class="flex border-t py-3 justify-between"><span class="text-slate-500 text-sm">خرج کار:</span><span class="text-left">@convertCurrency($detail->attr['additionalprice']) تومان</span></div>
                                                <div class="font-15 bold text-green">قیمت @convertCurrency($detail->GoldPrice()['totalPrice']) تومان</div>

                                            </div>
                                        @endisset

                                        @include('eden.AddToCart')
                                    </div>

                                </div>
                            </div>

                            <ul class="sm:p-1">
                                @foreach ($table_of_content as $key => $item)
                                    <li class="toc1">
                                        <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                    </li>
                                @endforeach

                            </ul>

                            <div class="p-1">
                                @include(@env('TEMPLATE_NAME') . '.DescriptionModule')
                            </div>

                        </div>
                    </div>
                </div>




            </div>
        </div>
    </section>

    @if (count($relatedProduct))
        <section class="products    m-0 pt-1 pb-1" id="index-best-view">
            <div class="flex one ">
                <div>

                    <h2>محصولات مرتبط {{ $detail->title }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-1  ">

                        {{-- $data['newPost'] --}}
                        @foreach ($relatedProduct as $content)
                            <a href="{{ url($content->slug) }}">
                                <div class="shadow hover p-0 border-radius-5">
                                    @if (isset($content->images['images']['small']))
                                        <figure class="image">
                                            @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                                <div class="not-in-stock">قابل سفارش</div>
                                            @endif
                                            <img loading="lazy" src="{{ $content->images['images']['large'] }}"
                                                alt="{{ $content->title }}" title="{{ $content->title }}" width="300"
                                                height="300">
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

                    </div>

                </div>
            </div>
        </section>
    @endif



    <section class="comments bg-gray mt-0 mb-0">
        <div class="flex one">
            <div>

                @include('eden.Comment')

            </div>
        </div>
    </section>

@endsection
