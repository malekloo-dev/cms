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
    <script type="text/javascript">
        function zoom(e) {
            var zoomer = e.currentTarget;
            e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
            e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
            x = offsetX / zoomer.offsetWidth * 100
            y = offsetY / zoomer.offsetHeight * 100
            zoomer.style.backgroundPosition = x + '% ' + y + '%';
        }
    </script>
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

        document.addEventListener('DOMContentLoaded', () => {

            const ratings = document.querySelectorAll('[name="rate"]');
            const labels = document.querySelectorAll('.rating > label');

            const change = (e) => {
                console.log(e.target.value);

            }
            const mouseenter = (e) => {
                document.getElementById('rating-hover-label').innerHTML = e.target.title;
            }
            const mouseleave = (e) => {

                document.getElementById('rating-hover-label').innerHTML = '';
            }

            ratings.forEach((el) => {
                el.addEventListener('change', change);
            });
            labels.forEach((el) => {
                el.addEventListener('mouseenter', mouseenter);
                el.addEventListener('mouseleave', mouseleave);
            });




        });


        function myFunction(imgs) {
            var Img = document.getElementById("main-image");
            var figure = document.getElementById("figure-main-image");

            Img.src = imgs.dataset.large;
            Img .parentElement.style.display = "block";
            figure.style = 'background-image: url('+imgs.dataset.xlarge+')';
            $('#main-image').data('xlarge',imgs.dataset.xlarge);
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
                $('#main-image').attr('src',xlarge)
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
                        <h1 id="product-name" class="">{{ $detail->title }}</h1>
                        <div>
                            <div class="flex one three-800">
                                <div id="product-image" class="one thirth-800 relative">
                                    @if (isset($detail->images['images']['large']))

                                        <div class="p-0">
                                            <figure class="image zoom2" id="figure-main-image" onmousemove="zoom(event)"
                                                style="background-image: url({{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }})">
                                                @if (isset($detail->attr['in-stock']) && $detail->attr['in-stock'] == 0)
                                                    <div class="not-in-stock">قابل سفارش</div>
                                                @endif
                                                <div class="overflow-hidden">
                                                    <img id="main-image" loading="lazy"
                                                        data-xlarge="{{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }}"
                                                        src="{{ $detail->images['images']['large'] }}"

                                                        alt="{{ $detail->title }}"
                                                        width="{{ env(Str::upper($detail->attr_type) . '_LARGE_W') }}"
                                                        height="{{ env(Str::upper($detail->attr_type) . '_LARGE_H') }}">

                                                    <i
                                                        class="fa-solid hidden-500 fa-magnifying-glass-plus font-15 zoom p-1 border-radius-5"></i>
                                                </div>

                                            </figure>
                                        </div>

                                        @if ($detail->gallery->count())
                                            <div class="gallery">
                                                <img onclick="myFunction(this);" class="m-1"
                                                    data-large="{{  $detail->images['images']['large']}}"
                                                    data-xlarge="{{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large']}}"
                                                    src="{{ $detail->images['images']['small'] }}" height="100">
                                                @foreach ($detail->gallery as $item)
                                                    <img onclick="myFunction(this);" class="m-1"
                                                        data-large="{{ $item->images['images']['large']}}"
                                                        data-xlarge="{{ $item->images['images']['xlarge'] ?? $item->images['images']['large']}}"
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
                                <div class="two-third-800 p-0">



                                    @if (count($detail->companies))
                                        <div class="company-logo">
                                            <a href="{{ url('/profile/' . $detail->companies->first()->id) }}">

                                                @if (isset($detail->companies->first()->logo) &&
                                                        $detail->companies->first()->logo['medium'] != '' &&
                                                        file_exists(public_path($detail->companies->first()->logo['medium'])))
                                                    {{-- @if (isset($detail->companies->first()->logo) && $detail->companies->first()->logo['medium'] == '' && !file_exists(public_path($detail->companies->first()->logo['medium']))) --}}
                                                    <img loading="lazy"
                                                        src="{{ url($detail->companies->first()->logo['medium']) }}"
                                                        width="50" height="50" class="border-radius-50"
                                                        alt="company profile">
                                                @endif
                                                {{ $detail->companies->first()->name ?? '' }}
                                            </a>
                                        </div>
                                    @endif

                                    @isset($detail->attr['weight'])
                                        <div class="flex three">

                                            <div class="two-third p-0">
                                                <div class="flex one">

                                                    <span class="price text-green pb-0   ">قیمت @convertCurrency($detail->GoldPrice()['totalPrice']) تومان</span>
                                                    <span class="font-08 pb-0">(قیمت روز طلا:@convertCurrency($detail->GoldPrice()['goldprice']) تومان)</span>
                                                </div>
                                            </div>
                                            <span class="p-0 third">وزن: {{ $detail->attr['weight'] ?? 0 }} گرم</span>
                                        </div>
                                    @endisset






                                    <div>
                                        {!! $detail->brief_description !!}
                                    </div>


                                    <form action="{{ route('customer.cart.store') }}" method="post"
                                        class="order-form flex one two-500 three-900 four-1200">
                                        @csrf
                                        @if (\Session::has('success'))
                                            <div class="alert alert-success ">
                                                {!! \Session::get('success') !!}
                                            </div>
                                        @endif
                                        @if (\Session::has('error'))
                                            <div class="alert alert-danger ">
                                                {!! \Session::get('error') !!}
                                            </div>
                                        @endif
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                                            </div>
                                        @endif
                                        <input type="hidden" name="id" value="{{ $detail->id }}">
                                        <button class="btn btn-buy px-3   border-radius-5">
                                            <i class="fa fa-plus"></i>
                                            ثبت سفارش
                                        </button>
                                    </form>


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
                                    <div id="product-categories" class=" mt-1 font-09">
                                        دسته بندی :
                                        @foreach ($detail->categories as $key => $item)
                                            <a href="{{ $item['slug'] }}"> {{ $item['title'] }} </a>
                                            @if (!$loop->last)
                                                <span> | </span>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            </div>

                            <ul>
                                @foreach ($table_of_content as $key => $item)
                                    <li class="toc1">
                                        <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                    </li>
                                @endforeach

                            </ul>


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
                    <div class="flex two  five-900  center">

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
                <div>نظرات شما درباره {{ $detail->title }}</div>
                <div>
                    <div class="comment-form">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif

                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif
                        <form action="{{ route('comment.client.store') }}#comment" id="comment" method="post">
                            <input type="hidden" name="content_id" value="{{ $detail->id }}">

                            @csrf
                            <div>
                                <div class="rating">
                                    <span>امتیاز: </span>
                                    <input name="rate" type="radio" id="st5"
                                        {{ old('rate') == '5' ? 'checked' : '' }} value="5" />
                                    <label for="st5" title="عالی"></label>
                                    <input name="rate" type="radio" id="st4"
                                        {{ old('rate') == '4' ? 'checked' : '' }} value="4" />
                                    <label for="st4" title="خوب"></label>
                                    <input name="rate" type="radio" id="st3"
                                        {{ old('rate') == '3' ? 'checked' : '' }} value="3" />
                                    <label for="st3" title="معمولی"></label>
                                    <input name="rate" type="radio" id="st2"
                                        {{ old('rate') == '2' ? 'checked' : '' }} value="2" />
                                    <label for="st2" title="ضعیف"></label>
                                    <input name="rate" type="radio" id="st1"
                                        {{ old('rate') == '1' ? 'checked' : '' }} value="1" />
                                    <label for="st1" title="بد"></label>
                                    <span id="rating-hover-label"></span>
                                </div>
                            </div>

                            <div>
                                <label for="comment_name">نام:</label>
                                <input id="comment_name" type="text" name="name" value="{{ old('name') }}">
                            </div>
                            <div>
                                <label for="comment-text">پیام:</label>
                                <textarea id="comment-text" name="comment">{{ old('comment') }}</textarea>
                            </div>
                            <button class="button button-blue g-recaptcha" data-sitekey="reCAPTCHA_site_key"
                                data-callback='onSubmit' data-action='submit'>ارسال نظر</button>
                        </form>
                    </div>

                    @foreach ($detail->comments as $comment)
                        @if ($comment['name'] != '' && $comment['comment'] != '')
                            <div class="comment">
                                <div class="aside">
                                    <div class="name">{{ $comment['name'] }}</div>
                                    <div class="date">{{ convertGToJ($comment['created_at']) }}</div>
                                </div>
                                <div class="article">
                                    <div>
                                        @for ($i = $comment->rate; $i >= 1; $i--)
                                            <label></label>
                                        @endfor
                                    </div>
                                    <div class="text">{!! $comment['comment'] !!}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection