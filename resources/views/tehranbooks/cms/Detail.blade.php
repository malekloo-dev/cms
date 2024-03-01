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
    @endphp

    @if ($detail->attr_type == 'product')
        @php
            $price = $detail->GoldPrice();
        @endphp
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

    <section class="product-detail mt-0 pt-0 pb-5 bg-gray-100" id="">
        <div class="  ">
            <div class="bg-white ">
                <div class="top-page">

                    <div>
                        @if ($item['attr_type'] == 'product')
                            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3  gap-x-5 p-5 ">

                                <div id="product-image" class="     relative">
                                    @if (isset($detail->images['images']['large']))

                                        <div class="">
                                            <figure class="image zoom2 rounded" id="figure-main-image"
                                                onmousemove="zoom(event)"
                                                style="background-image: url({{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }})">
                                                {{-- @if (isset($detail->attr['in-stock']) && $detail->attr['in-stock'] == 0)
                                                    <div class="not-in-stock">قابل سفارش</div>
                                                @endif --}}
                                                <div class="overflow-hidden">
                                                    <img id="main-image" loading="lazy" class=""
                                                        data-xlarge="{{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }}"
                                                        src="{{ $detail->images['images']['large'] }}"
                                                        alt="{{ $detail->title }}"
                                                        width="{{ env(Str::upper($detail->attr_type) . '_LARGE_W') }}"
                                                        height="{{ env(Str::upper($detail->attr_type) . '_LARGE_H') }}">

                                                    <i
                                                        class="fa-solid hidden-500 fa-magnifying-glass-plus font-15 zoom p-3 border-radius-5"></i>
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

                                <div class="  ">
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

                                    <div>{!! $detail->brief_description !!}</div>


                                </div>
                                <div class="  ">
                                    <div class="bg-gray  p-2 ">

                                        @include('eden.AddToCart')
                                    </div>

                                </div>
                            </div>
                        @else
                            <div class="flex  ">

                                <div id="product-image" class=" w-full sm:w-1/2 lg:w-1/3  p-5  relative">
                                    @if (isset($detail->images['images']['large']))

                                        <div class="">
                                            <figure class="image zoom2 rounded" id="figure-main-image"
                                                onmousemove="zoom(event)"
                                                style="background-image: url({{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }})">
                                                {{-- @if (isset($detail->attr['in-stock']) && $detail->attr['in-stock'] == 0)
                                                <div class="not-in-stock">قابل سفارش</div>
                                            @endif --}}
                                                <div class="overflow-hidden">
                                                    <img id="main-image" loading="lazy" class=""
                                                        data-xlarge="{{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }}"
                                                        src="{{ $detail->images['images']['large'] }}"
                                                        alt="{{ $detail->title }}"
                                                        width="{{ env(Str::upper($detail->attr_type) . '_LARGE_W') }}"
                                                        height="{{ env(Str::upper($detail->attr_type) . '_LARGE_H') }}">

                                                    <i
                                                        class="fa-solid hidden-500 fa-magnifying-glass-plus font-15 zoom p-3 border-radius-5"></i>
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

                                <div class="  w-full sm:w-1/2 lg:w-1/3 p-5">
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

                                    <div>{!! $detail->brief_description !!}</div>


                                </div>

                            </div>
                        @endif
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
    </section>

    @if (count($relatedProduct))
        <section class="products    m-0 pt-1 pb-1" id="index-best-view">
            <div class="flex one ">
                <div>
                    <h2>محصولات مرتبط {{ $detail->title }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3  ">
                        @foreach ($relatedProduct as $content)
                            <a href="{{ url($content->slug) }}">
                                <div class=" p-0 border-radius-5">
                                    @if (isset($content->images['images']['small']))
                                        <figure class="image">
                                            @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                                <div class="not-in-stock">قابل سفارش</div>
                                            @endif
                                            <img loading="lazy" src="{{ $content->images['images']['large'] }}"
                                                alt="{{ $content->title }}" title="{{ $content->title }}"
                                                width="300" height="300">
                                            <figcaption>
                                                <h3 class="p-3 m-0 text-center text-sm"> {{ $content->title }}</h3>
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
        <div>

            @include('tehranbooks.Comment')

        </div>
    </section>

@endsection
