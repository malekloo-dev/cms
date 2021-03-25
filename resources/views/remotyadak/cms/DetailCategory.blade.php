@extends(@env('TEMPLATE_NAME').'.App')
@section('head')
    <meta property="og:image" content="{{ url($detail->images['images']['medium'] ?? '') }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM') : env('ARTICLE_MEDIUM') }}" />
    <meta property="og:image:height"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM') : env('ARTICLE_MEDIUM') }}" />
    <meta property="og:image:alt" content="{{ $detail->title }}" />
@endsection

@section('Content')

    @php
    $tableOfImages = tableOfImages($detail->description);
    $append = '';
    @endphp
    @if (count($relatedProduct))
        @include('jsonLdRelatedProduct')
    @endif


    @if (count($breadcrumb))
        <section class="breadcrumb">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/">خانه </a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <section>
        <div class="flex one">
            <h1>{{ $detail->title }}</h1>
        </div>
    </section>

    @if (count($subCategory))
        <section class="category-list" id="index-best-view">
            <div class="flex one ">
                <div>
                    <h2>دسته بندی: {{ $detail->title }}</h2>
                    <div class="flex one two-800   ">

                        {{-- $data['newPost'] --}}
                        @foreach ($subCategory as $content)
                            <div class="height-full">

                                <div class="border hover-box p-1 full">
                                    <a href="{{ $content->slug }}">
                                        <div class="flex one three-700 height-100">
                                            @if (isset($content->images['thumb']))
                                                <div class="p-0"><img alt="{{ $content->title }}" src="{{ $content->images['thumb'] }}" /></div>
                                            @endif
                                            <div class="one two-third-700 pr-1">
                                                <h2 class="p-0"> {{ $content->title }}</h2>
                                                {!! $content->brief_description !!}

                                            </div>

                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </section>
    @endif

    @if (count($relatedProduct))
        <section class="category-products mt-1" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="">

                        <div class="flex one  two-1100  ">

                            {{-- $data['newPost'] --}}
                            @foreach ($relatedProduct as $content)
                                <div>
                                    <article>
                                        <div>
                                            @if (isset($content->images['thumb']))
                                                <picture>
                                                    <img src="{{ str_replace(' ', '%20', $content->images['images']['small']) ?? '' }}"
                                                        {{-- srcset="{{ str_replace(' ', '%20', $content->images['images']['small']) ?? '' }} ,{{ str_replace(' ', '%20', $content->images['images']['medium']) ?? '' }} 2x" --}} alt="{{ $content->title }}"
                                                        width="{{ env('PRODUCT_SMALL') }}"
                                                        height="{{ env('PRODUCT_SMALL') }}">
                                                </picture>
                                            @endif
                                        </div>
                                        <footer>
                                            <a href="{{ $content->slug }}">
                                                <h2>{{ $content->title }}</h2>
                                            </a>
                                            <div class="brand">برند: {{ $content->attr['brand'] }}</div>
                                            <div class="price">قیمت: @convertCurrency($content->attr['price']) تومان </div>
                                            <div class="view-count">{{ $content->viewCount }} بار دیده شده</div>
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
                                                    <span class="font-08">({{ count($content->comments) }} نفر)</span>
                                                @endif
                                            </div>
                                            <div class="brief">
                                                {!! readMore($content->brief_description, 250) !!}
                                            </div>
                                        </footer>
                                    </article>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif



    <section class="" id="">
        <div class="flex one ">
            <div>


                @if (isset($detail->images['images']))
                    <picture>
                        <source media="(min-width:{{ env('CATEGORY_LARGE') }}px)"
                            srcset="{{ $detail->images['images']['large'] ?? '' }}">

                        <source media="(min-width:{{ env('CATEGORY_MEDIUM') }}px)"
                            srcset="{{ $detail->images['images']['medium'] ?? '' }}">

                        <source media="(min-width:{{ env('CATEGORY_SMALL') }}px)"
                            srcset="{{ $detail->images['images']['small'] ?? '' }}">

                        <img src="{{ $detail->images['images']['medium'] ?? '' }}" alt="{{ $detail->title }}"
                            width="{{ env('CATEGORY_MEDIUM') }}" height="{{ env('CATEGORY_MEDIUM') }}">
                    </picture>
                @endif

                <ul>
                    @foreach ($table_of_content as $key => $item)
                        <li class="toc1">
                            <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                        </li>
                    @endforeach

                </ul>

                @include(@env('TEMPLATE_NAME').'.DescriptionModule')

            </div>
        </div>
    </section>

    @if (count($relatedPost))
        <section class="products" id="index-best-view">
            <div class="flex one ">
                <div>
                    <h2>مقاله های زیر مجموعه {{ $detail->title }}</h2>
                    <div class="flex one two-500 four-900 center ">

                        @foreach ($relatedPost as $content)
                            <div>
                                <a href="{{ $content->slug }}">
                                    <article>
                                        @if (isset($content->images['thumb']))
                                            <div><img  width="{{ env('PRODUCT_SMALL_W') }}" height="{{ env('PRODUCT_SMALL_H') }}" alt="{{ $content->title }}" src="{{ $content->images['thumb'] }}"></div>
                                        @endif
                                        <footer>
                                            <h2> {{ $content->title }}</h2>
                                            {!! $content->brief_description !!}
                                        </footer>
                                    </article>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
