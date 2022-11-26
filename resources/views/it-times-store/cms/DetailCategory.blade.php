@extends(@env('TEMPLATE_NAME').'.App')

@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->brief_description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->brief_description))

@if (isset($detail->images['images']['medium']))
    @section('twitter:image', url($detail->images['images']['medium']))

    @section('og:image', url($detail->images['images']['medium']))
    @section('og:image:type', 'image/jpeg')
    @section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
    @section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
    @section('og:image:alt', $detail->title)
@endif


@push('head')
    @if (json_decode($relatedProduct->toJson())->prev_page_url != null)
        <link rel="prev" href="{{ json_decode($relatedProduct->toJson())->prev_page_url }}">
    @endif
    @if (json_decode($relatedProduct->toJson())->next_page_url != null)
        <link rel="next" href="{{ json_decode($relatedProduct->toJson())->next_page_url }}">
    @endif
@endpush


@push('scripts')
    <script src="{{ asset('/siema.min.js') }}"></script>
    <script>
        var w;
        var perPageNumber;

        function perPage() {
            w = window.innerWidth;
            if (w <= 500) {
                perPageNumber = 1;
            } else if (w <= 768) {
                perPageNumber = 5;
            } else if (w <= 1024) {
                perPageNumber = 5;
            } else {
                perPageNumber = 6;
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
            <div class="btn btn-info edit-button"
                onclick="window.open('{{ url('/admin/category/' . $detail->id . '/edit/') }}')">
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

    @if (count($subCategory))
        <section class="category-list category-section" id="index-best-view">
            <div class="flex one relative">
                <div class="siema p-0">
                    @foreach ($subCategory as $content)
                        <a href="{{ $content->slug }}">
                            <div class="hover text-center">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        <img src="{{ $content->images['images']['small'] }}" alt="{{ $content->title }}"
                                            width="{{ env('CATEGORY_SMALL_W') }}" height="{{ env('CATEGORY_SMALL_H') }}"
                                            srcset="
                                {{ $content->images['images']['small'] }} {{ env('CATEGORY_SMALL_W') }}w,
                                {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                {{ $content->images['images']['large'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_LARGE_W') }}w">
                                        <figcaption>
                                            <div class="p-0 m-0 text-center"> {{ $content->title }}</div>
                                        </figcaption>
                                    </figure>
                                @else
                                    <div class="p-0 m-0 text-center"> {{ $content->title }}</div>
                                @endif

                            </div>
                        </a>
                    @endforeach

                </div>
                <a class="prev2">&#10094;</a>
                <a class="next2">&#10095;</a>



            </div>
        </section>
        <hr>
    @endif



    @if (count($relatedProduct))
        <section class="products" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="">
                        <div class="flex two two-500 five-900 center ">
                            @foreach ($relatedProduct as $content)
                                    <article class="">
                                        @if (isset($content->images['images']['small']))
                                            <a href="{{ $content->slug }}">

                                                <figure class="image">
                                                    <img src="{{ $content->images['images']['small'] }}"
                                                    sizes="(max-width:{{ env('ARTICLE_SMALL_W') }}px) 100vw {{ env('ARTICLE_SMALL_W') }}px {{ ENV('ARTICLE_MEDIUM_W') }}px"
                                                    alt="{{ $content->title }}" width="100" height="100" srcset="
                                                    {{ $content->images['images']['small'] }} {{ env('ARTICLE_SMALL_W') }}w,
                                                    {{ $content->images['images']['medium'] }} 2x">
                                                </figure>
                                            </a>
                                        @endif
                                        <footer>
                                            <div> {{ $content->title }}</div>
                                            {{-- {!! $content->brief_description !!} --}}
                                            <a class="btn btn-block bg-blue"
                                                href="{{ $content->slug }}">@lang('messages.more')</a>

                                        </footer>
                                    </article>
                            @endforeach

                        </div>
                    </div>

                    {{ $relatedProduct->links('vendor.pagination.default') }}

                </div>
            </div>
        </section>
    @endif

    <section class="index-items bg-gray2 my-0 ">
        <div class="flex one">
            <div>
                <h1>{{ $detail->title ?? '' }}</h1>
                @isset($relatedPost)
                    <div class="flex one three-500 five-900   ">
                        @foreach ($relatedPost as $content)
                            <div>
                                <a href="{{ $content->slug }}">
                                    <article class="shadow2">
                                        @if (isset($content->images['images']['medium']))
                                            <figure class="image">
                                                <img src="{{ $content->images['images']['medium'] }}" width="198"
                                                    height="100" alt="{{ $content->title }}">
                                            </figure>
                                        @endif

                                        <div class="title">{{ $content->title }}</div>
                                        <div class="info">
                                            {!! readMore($content->brief_description, 250) !!}
                                        </div>
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
                                                        srcset="{{ asset('/img/star1x.png') }} , {{ asset('/img/star2x.png') }} 2x"
                                                        src="{{ asset('/img/star1x.png') }}"
                                                        alt="{{ 'star for rating' }}">
                                                @endfor
                                            @endif
                                        </div>

                                    </article>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
    </section>



    <section class="category-content p-0 m-0" id="">
        <div class="flex one ">
            <div class="p-1">
                @if (count($table_of_content))
                    <ul>
                        @foreach ($table_of_content as $key => $item)
                            <li class="toc1">
                                <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                            </li>
                        @endforeach

                    </ul>
                @endif

                @include(@env('TEMPLATE_NAME') . '.DescriptionModule')
            </div>
        </div>
    </section>





    <section class=" bg-gray mb-0 pt-1">
        <div>
            <h2>مقالات</h2>
            <div class="flex two five-500 center">
                @foreach (\App\Models\Content::where('parent_id','=',80)->get() as $content)
                <div>
                    <a href="{{ $content->slug }}">
                        <article class="shadow2">
                            @if (isset($content->images['images']['medium']))
                            <figure class="image">
                                <img src="{{ $content->images['images']['medium'] }}"
                                width="198" height="100" alt="{{ $content->title }}">
                            </figure>
                            @endif

                            <div class="title">{{ $content->title }}</div>
                            <div class="info">
                                {!! readMore($content->brief_description, 250) !!}
                            </div>
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
                                    srcset="{{ asset('/img/star1x.png') }} , {{ asset('/img/star2x.png') }} 2x"
                                    src="{{ asset('/img/star1x.png') }}"
                                    alt="{{ 'star for rating' }}">
                                    @endfor
                                    @endif
                                </div>

                            </article>
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
    </section>


@endsection
