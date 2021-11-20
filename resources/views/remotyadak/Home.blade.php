@extends(@env('TEMPLATE_NAME').'.App')



@section('Content')

    <section class="search">
        <div class="flex one two-500 three-800 center">

            <form action="{{ route('search') }}" class="">

                <input name="q" alt="جستجو" type="text" placeholder="جستجوی محصول / محتوا / کمپانی" required>

                <button class=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                        viewBox="0 0 32 32" style=" fill:#000000;">
                        <path
                            d="M 19 3 C 13.488281 3 9 7.488281 9 13 C 9 15.394531 9.839844 17.589844 11.25 19.3125 L 3.28125 27.28125 L 4.71875 28.71875 L 12.6875 20.75 C 14.410156 22.160156 16.605469 23 19 23 C 24.511719 23 29 18.511719 29 13 C 29 7.488281 24.511719 3 19 3 Z M 19 5 C 23.429688 5 27 8.570313 27 13 C 27 17.429688 23.429688 21 19 21 C 14.570313 21 11 17.429688 11 13 C 11 8.570313 14.570313 5 19 5 Z">
                        </path>
                    </svg></button>
            </form>
        </div>
    </section>

    <section class="index-img bg-gray mt-0 mb-0 pb-2">
        <div class="text-center pb-1">
            <h1>مرجع تخصصی خدمات خودرو</h1>
        </div>
        <div class="flex two five-500  center ">
            {{-- images&label=banner&var=banners&count=5 --}}
            @if (isset($banners) && isset($banners['images']))
                @foreach ($banners['images'] as $k => $content)
                    <a href="{{ $banners['url'][$k] }}" @if (!isset($banners['follow'][$k])) rel="nofollow" @endif target="blank">
                        <div class="shadow  p-0">
                            <picture>
                                <img class="cover" src="{{ $content }}" alt="{{ $banners['name'][$k] }}"
                                    width="200" height="200">
                            </picture>
                        </div>
                    </a>

                @endforeach
            @endisset

    </div>
</section>


{{-- #anchor top --}}
<section class="index-item-top bg-blue2 mt-0 mb-0">
    <div class="text-center pb-1">
        <h2>خدمات سوئیچ و ریموت</h2>
    </div>
    <div class="flex two five-500 center  ">
        {{-- category&label=category&var=category&count=15 --}}
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
        {{-- category&label=category2&var=category2&count=15 --}}
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

                                <img src="{{ $content->images['images']['medium'] ?? '' }}"
                                    alt="{{ $content->title }}" width="{{ env('CATEGORY_MEDIUM_W') }}"
                                    height="{{ env('CATEGORY_MEDIUM_W') }}">
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

                {{-- product&label=topProducts&var=products&count=12 --}}
                @isset($products['data'])


                    @foreach ($products['data'] as $content)
                        <div>
                            <a class="hover" href="{{ $content->slug }}">

                                @if (isset($content->images['images']['small']))
                                    <div class=""><img width="{{ env('PRODUCT_SMALL_W') }}"
                                            height="{{ env('PRODUCT_SMALL_H') }}" alt="{{ $content->title }}"
                                            src="{{ $content->images['images']['small'] }}"></div>
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
                                                        $rateSum = $rateSum + $comment['rate'];
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

{{-- #anchor down --}}
@endsection
