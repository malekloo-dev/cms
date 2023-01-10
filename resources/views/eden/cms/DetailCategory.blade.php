@extends(@env('TEMPLATE_NAME') . '.App')



@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->meta_description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->meta_description))

@if ($relatedProduct->hasPages() || json_decode($relatedProduct->toJson())->current_page == 1)
    @section('canonical', url($detail->slug))
@endif

@if (isset($detail->images['images']['medium']))
    @section('twitter:image', url($detail->images['images']['medium']))

    @section('og:image', url($detail->images['images']['medium']))
    @section('og:image:type', 'image/jpeg')
    @section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
    @section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
    @section('og:image:alt', $detail->title)
@endif


@section('head')
    <link rel="stylesheet" href="{{ asset('/detail.category.css') }}">

    @if (json_decode($relatedProduct->toJson())->prev_page_url != null)
        <link rel="prev" href="{{ json_decode($relatedProduct->toJson())->prev_page_url }}">
    @endif
    @if (json_decode($relatedProduct->toJson())->next_page_url != null)
        <link rel="next" href="{{ json_decode($relatedProduct->toJson())->next_page_url }}">
    @endif
@endsection


@push('scripts')
    <script src="{{ asset('/siema.min.js') }}"></script>
    <script>
        var w;
        var perPageNumber;

        function perPage() {
            w = window.innerWidth;
            if (w <= 500) {
                perPageNumber = 3;
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
@endpush

@section('footer')
    @auth
        @if (Auth::user()->id == 1)
            <div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/category/' . $detail->id . '/edit/') }}')">
                ویرایش</div>
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

    @include('jsonLdFaq')

    @if (count($breadcrumb) > 0)
        @include('jsonLdBreadcrumb')
    @endif



    @if (count($subCategory))
        <section class=" category-section bg-white mt-0" id="index-best-view">
            <div class="p-2 relative">
                <div class="siema p-0">
                    @foreach ($subCategory as $content)
                        <a href="{{ $content->slug }}">
                            <div class="hover text-center">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        <img loading="lazy" src="{{ $content->images['images']['small'] }}"
                                            alt="{{ $content->title }}" width="{{ env('CATEGORY_SMALL_W') }}"
                                            height="{{ env('CATEGORY_SMALL_H') }}"
                                            srcset="
                                            {{ $content->images['images']['small'] }} {{ env('CATEGORY_SMALL_W') }}w,
                                            {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                            {{ $content->images['images']['large'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_LARGE_W') }}w">
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
                <a class="prev2">&#10094;</a>
                <a class="next2">&#10095;</a>



            </div>
        </section>
    @endif


    @if (count($breadcrumb))
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
    @endif

    <h1>{{ $item['title'] }}</h1>



        <section class=" " id="index-best-view">
            <div class="flex one  four-800  ">
                <div class="one-fourth-800 p-0">
                    @include(@env('TEMPLATE_NAME').'.cms.filter')

                </div>
                <div class="three-fourth-800 p-0">
                    <div class="">

                        <div class="flex two five-900 center ">
                        @if (count($relatedProduct))

                            @foreach ($relatedProduct as $content)
                                <a href="{{ $content->slug }}">
                                    <div class="shadow hover p-0 ">
                                        @if (isset($content->images['images']['small']))
                                            <figure class="image ">
                                                @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                                    <div class="not-in-stock">قابل سفارش</div>
                                                @endif
                                                <img src="{{ $content->images['images']['large'] }}"
                                                    alt="{{ $content->title }}" title="{{ $content->title }}"
                                                    loading="lazy" width="300" height="300">
                                                <figcaption>
                                                    <h3 class="px-0 m-0 text-center"> {{ $content->title }}</h3>
                                                    <div class=" text-green font-09 ">
                                                        @isset($content->attr['weight'])
                                                            @convertCurrency(calcuteGoldPrice($content->attr['weight'] ?? 0, $content->attr['additionalprice'] ?? 0)['totalPrice']) تومان
                                                        @else
                                                            تماس گرفته شود
                                                        @endisset
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        @else
                                            <h3 class="px-0 m-0 text-center"> {{ $content->title }}</h3>
                                        @endif

                                    </div>
                                </a>
                            @endforeach
                            @endif

                        </div>
                        {{ $relatedProduct->links('vendor.pagination.default') }}

                    </div>
                </div>
            </div>
        </section>

    @if (count($relatedPost))

        <section class=" " id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="">

                        <div class="flex one two-500 five-900 center ">

                            @foreach ($relatedPost as $content)
                                <a href="{{ $content->slug }}">
                                    <div class="shadow hover p-0 ">
                                        @if (isset($content->images['images']['small']))
                                            <figure class="image ">
                                                <img src="{{ $content->images['images']['large'] }}"
                                                    alt="{{ $content->title }}" title="{{ $content->title }}"
                                                    width="300" height="300">
                                                <figcaption>
                                                    <h3 class="px-0 m-0 text-center"> {{ $content->title }}</h3>
                                                </figcaption>
                                            </figure>
                                        @else
                                            <h3 class="px-0 m-0 text-center"> {{ $content->title }}</h3>
                                        @endif

                                    </div>
                                </a>
                            @endforeach

                        </div>
                        {{ $relatedPost->links('vendor.pagination.default') }}

                    </div>
                </div>
            </div>
        </section>
    @endif



    @if (!Request::get('page'))
        <section class="category-content" id="">
            <div class="flex one ">
                <div class="font-08">
                    <span class="rate mt-1">
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
                    </span> |
                    {{ $detail->viewCount }} بار دیده شده |
                </div>

                <div>
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
        </section>
    @endif



@endsection
