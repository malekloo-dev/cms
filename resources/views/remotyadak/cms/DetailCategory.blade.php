@extends(@env('TEMPLATE_NAME').'.App')
@section('head')
    <meta property="og:image" content="{{ url($detail->images['images']['medium'] ?? '') }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W') }}" />
    <meta property="og:image:height"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H') }}" />
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
        <section class="breadcrumb my-0">
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

    <section class="bg-gray my-0 py-0">
        <div class="flex one">
            <h1>{{ $detail->title }}</h1>
        </div>
    </section>

    @if (count($subCategory))
        <section class="category-list bg-gray my-0" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="flex one two-800   ">

                        {{-- $data['newPost'] --}}
                        @foreach ($subCategory as $content)
                            <div class="height-full">

                                <div class="border hover-box p-1 full">
                                    <a href="{{ $content->slug }}">
                                        <div class="flex one three-700 height-100">
                                            @if (isset($content->images['thumb']))
                                                <div class="p-0"><img alt="{{ $content->title }}"
                                                        src="{{ $content->images['thumb'] }}" /></div>
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




    @if (count($relatedCompany))
        <section class="companies m-0 bg-blue" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="">

                        <div class="flex one  two-800  ">

                            {{-- $data['newPost'] --}}
                            @foreach ($relatedCompany as $content)
                                <div class="hover">
                                    <a href="{{ route('profile.index', $content->id) }}">
                                        <article>
                                            <div>
                                                @if (isset($content->logo['medium']))
                                                    <picture>
                                                        <img src="{{ str_replace(' ', '%20', $content->logo['large']) ?? '' }}"
                                                            width="{{ env('PRODUCT_SMALL_W') }}"
                                                            height="{{ env('PRODUCT_SMALL_W') }}">
                                                    </picture>
                                                @endif
                                            </div>
                                            <footer>
                                                <h2>{{ $content->name }}</h2>
                                                <div> {{ $content->mobile }}</div>
                                                <div>{{ $content->phone }}</div>
                                                <div>{{ $content->address }}</div>

                                            </footer>
                                        </article>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif




    @if (count($relatedProduct))
        <section class="category-products m-0 bg-gray" id="index-best-view">
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
                                                        width="{{ env('PRODUCT_SMALL_W') }}"
                                                        height="{{ env('PRODUCT_SMALL_W') }}">
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
                        <img src="{{ $detail->images['images']['medium'] ?? '' }}" alt="{{ $detail->title }}"
                            width="{{ env('CATEGORY_MEDIUM_W') }}" height="{{ env('CATEGORY_MEDIUM_W') }}"
                            >
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
                                            <div><img width="{{ env('PRODUCT_SMALL_W') }}"
                                                    height="{{ env('PRODUCT_SMALL_H') }}" alt="{{ $content->title }}"
                                                    src="{{ $content->images['thumb'] }}"></div>
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
