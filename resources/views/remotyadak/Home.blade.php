@extends(@env('TEMPLATE_NAME').'.App')

@section('head')

@endsection
@section('footer')

@endsection

@section('Content')


    <section class="index-img bg-gray mt-0 mb-0 pb-2">
        <div class="text-center pb-1">
            <h1>مرکز ساخت سوئیچ و ریموت</h1>
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


    {{--#anchor top --}}
    <section class="index-item-top bg-gray2 mt-0 mb-0">
        <div class="text-center pb-1">
            <h2>دسته بندی</h2>
        </div>
        <div class="flex two five-500 center  ">
            {{--category&label=category&var=category&count=15--}}
            @isset($category['data'])

                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="shadow hover h-100">

                            @if (isset($content->images['images']))
                                <picture>

                                    <source media="(min-width:{{ env('CATEGORY_MEDIUM_W') }}px)"
                                        srcset="{{ $content->images['images']['medium'] ?? '' }}">

                                    <source media="(min-width:{{ env('CATEGORY_SMALL_W') }}px)"
                                        srcset="{{ $content->images['images']['small'] ?? '' }}">

                                    <img src="{{ $content->images['images']['medium'] ?? '' }}" alt="{{ $content->title }}"
                                        width="{{ env('CATEGORY_MEDIUM_W') }}" height="{{ env('CATEGORY_MEDIUM_W') }}">
                                </picture>
                            @endif


                            <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>


                        </div>
                    </a>
                @endforeach
            @endisset
        </div>
    </section>

    <section class="wide  m-0" id="index-comment">
        <div>خدمات ریموت یدک</div>
    </section>


    <section class="index-items home-top-view">
        <div class="flex one">
            <div>
                <div class="flex one two-500  four-800 center  ">

                    {{--product&label=topProducts&var=products&count=12--}}
                    @isset($products['data'])


                        @foreach ($products['data'] as $content)
                            <div>
                                <a class="hover" href="{{ $content->slug }}">

                                    @if (isset($content->images['thumb']))
                                        <div><img width="{{ env('PRODUCT_SMALL_W') }}" height="{{ env('PRODUCT_SMALL_H') }}" alt="{{ $content->title }}" src="{{ $content->images['thumb'] }}"></div>
                                    @endif
                                    <footer>
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
                                                        <img width="20" height="20"
                                                            srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                            src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
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
                    @endisset
                </div>
            </div>
        </div>
    </section>

    {{--#anchor down --}}
@endsection
