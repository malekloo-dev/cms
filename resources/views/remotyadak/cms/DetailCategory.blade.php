@extends(@env('TEMPLATE_NAME').'.App')

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


@section('head')
    @if (json_decode($relatedProduct->toJson())->prev_page_url != null)
        <link rel="prev" href="{{ json_decode($relatedProduct->toJson())->prev_page_url }}">
    @endif
    @if (json_decode($relatedProduct->toJson())->next_page_url != null)
        <link rel="next" href="{{ json_decode($relatedProduct->toJson())->next_page_url }}">
    @endif
@endsection
@section('footer')
    @auth
        @if ((Auth::user()->id) == 1)
            <div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/category/'.$detail->id.'/edit/') }}')">ویرایش</div>
        @endif
    @endauth
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

                        @foreach ($subCategory as $content)
                            <div class="height-full">

                                <div class="border hover-box p-1 full">
                                    <a href="{{ $content->slug }}">
                                        <div class="flex one three-700 height-100">
                                            @if (isset($content->images['images']['small']))
                                                <div class="p-0">
                                                    <img title="{{ $content->title }}" alt="{{ $content->title }}" width="{{ env('CATEGORY_MEDIUM_W') }}"
                                                        height="{{ env('CATEGORY_MEDIUM_H') }}"
                                                        loading="lazy" src="{{ $content->images['images']['small'] }}" />
                                                </div>
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

                            @foreach ($relatedCompany as $content)
                                <div class="hover">
                                    <a href="{{ route('profile.index', $content->id) }}">
                                        <article>
                                            <div>
                                                @if (isset($content->logo['medium']))
                                                    <picture>
                                                        <img alt="{{ $content->name }}" title="{{ $content->name }}"
                                                            loading="lazy"
                                                            src="{{ str_replace(' ', '%20', $content->logo['large']) ?? '' }}"
                                                            width="{{ env('PRODUCT_SMALL_W') }}"
                                                            height="{{ env('PRODUCT_SMALL_W') }}">
                                                    </picture>
                                                @endif
                                            </div>
                                            <footer>
                                                <h2>{{ $content->name }}</h2>
                                                <div class="company-phones"> {{ $content->mobile }} - {{ $content->phone }}</div>
                                                <div><svg class="p-0 m-0" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                        fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                        fill="currentColor" />
                                                </svg>
                                                <span class="p-0 ml-1">{{ $content->viewCount }} </span> </div>
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

                            @foreach ($relatedProduct as $content)
                                <div>
                                    <article>
                                        <div>
                                            @if (isset($content->images['images']['small']))
                                                <picture>
                                                    <img alt="{{ $content->title }}" title="{{ $content->title }}"
                                                        loading="lazy"
                                                        src="{{ str_replace(' ', '%20', $content->images['images']['small']) ?? '' }}"
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
                                            <div class="price">قیمت: @convertCurrency($content->attr['price'])
                                                تومان </div>
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
                                                        <label></label>
                                                    @endfor
                                                    <span class="font-08">({{ count($content->comments) }}
                                                        نفر)</span>
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
                        <img loading="lazy" src="{{ $detail->images['images']['medium'] ?? '' }}"
                            alt="{{ $detail->title }}" title="{{ $detail->title }}"
                            width="{{ env('CATEGORY_MEDIUM_W') }}" height="{{ env('CATEGORY_MEDIUM_W') }}">
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

                                        @if (isset($content->images['images']['small']))
                                            <div><img width="{{ env('PRODUCT_SMALL_W') }}"
                                                    height="{{ env('PRODUCT_SMALL_H') }}"
                                                    title="{{ $content->title }}" alt="{{ $content->title }}"
                                                    loading="lazy" src="{{ $content->images['images']['small'] }}"></div>
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
