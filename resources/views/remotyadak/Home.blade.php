@extends(@env('TEMPLATE_NAME').'.App')



@section('Content')


    <section class="index-img bg-gray mt-0 mb-0 pb-2">
        <div class="text-center pb-1">
            <h1>مرجع تخصصی خدمات خودرو</h1>
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
    <section class="index-item-top bg-blue2 mt-0 mb-0">
        <div class="text-center pb-1">
            <h2>خدمات سوئیچ و ریموت</h2>
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


                            <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>


                        </div>
                    </a>
                @endforeach
            @endisset
        </div>
    </section>



    <section class="index-item-top bg-gray mt-0 mb-0">
        <div class="text-center pb-1">
            <h2>تعمیرگاه های تخصصی</h2>
        </div>
        <div class="flex two five-500 center  ">
            {{--category&label=category2&var=category2&count=15--}}
            @isset($category2['data'])

                @foreach ($category2['data'] as $content)
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


                            <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>


                        </div>
                    </a>
                @endforeach
            @endisset
        </div>
    </section>


    <section class="index-items bg-blue home-top-view m-0">

        <div class="flex one">
            <h2>محصولات</h2>
            <div>
                <div class="flex one three-500  center  ">

                    {{--product&label=topProducts&var=products&count=12--}}
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
