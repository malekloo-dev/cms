@extends(@env('TEMPLATE_NAME').'.App')
@section('head')
    <link rel="stylesheet" href="{{ asset('/detail.category.css') }}">

    @if (json_decode($relatedProduct->toJson())->prev_page_url != null)
        <link rel="prev" href="{{ json_decode($relatedProduct->toJson())->prev_page_url }}">
    @endif
    @if (json_decode($relatedProduct->toJson())->next_page_url != null)
        <link rel="next" href="{{ json_decode($relatedProduct->toJson())->next_page_url }}">
    @endif
@endsection


@section('footer')

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
                perPageNumber = 7;
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

    @if (count($subCategory))
        <section class="category-list category-section" id="index-best-view">
            <div class="flex one ">
                <div class="siema p-0">
                    @foreach ($subCategory as $content)
                        <a href="{{ $content->slug }}">
                            <div class="hover text-center">
                                @if (isset($content->images['thumb']))
                                    <figure class="image">
                                        <img src="{{ $content->images['images']['small'] ?? $content->images['thumb'] }}"
                                            alt="{{ $content->title }}" width="{{ env('CATEGORY_SMALL_W') }}" height="{{ env('CATEGORY_SMALL_H') }}" srcset="
                                            {{ $content->images['images']['small'] ?? $content->images['thumb'] }} {{ env('CATEGORY_SMALL_W') }}w,
                                            {{ $content->images['images']['medium'] ?? $content->images['thumb'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                            {{ $content->images['images']['large'] ?? $content->images['thumb'] }} {{ env('CATEGORY_LARGE_W') }}w">
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

    @if (count($relatedProduct))
        <section class="products mt-5" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="">

                        <div class="flex one two-500 four-900 center ">

                            {{-- $data['newPost'] --}}
                            @foreach ($relatedProduct as $content)
                                <div>
                                    <article>
                                        @if (isset($content->images['thumb']))
                                            <figure class="image">
                                                <img src="{{ $content->images['images']['small'] ?? $content->images['thumb'] }}"
                                                    sizes="(max-width:{{ env('ARTICLE_SMALL_W') }}px) 100vw {{ env('ARTICLE_SMALL_W') }}px {{ ENV('ARTICLE_MEDIUM_W') }}px"
                                                    alt="{{ $content->title }}" width="100" height="100"
                                                    srcset="
                                                        {{ $content->images['images']['small'] ?? $content->images['thumb'] }} {{ env('ARTICLE_SMALL_W') }}w,
                                                        {{ $content->images['images']['medium'] ?? $content->images['thumb'] }} 2x">
                                            </figure>

                                        @endif
                                        <footer>
                                            <h2><a href="{{ $content->slug }}"> {{ $content->title }}</a></h2>
                                            {!! $content->brief_description !!}
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

    <section class="index-items bg-pink mt-0 mb-0">
        <div class="flex one">
            <div>
                <h1>{{ $detail->title ?? '' }}</h1>
                @isset($relatedPost)
                    <div class="flex one three-500 five-900   ">
                        @foreach ($relatedPost as $content)
                            <div>
                                <a href="{{ $content->slug }}">
                                    <article class="shadow2">
                                        @if (isset($content->images['thumb']))
                                            <figure class="image">
                                                <img src="{{ $content->images['images']['medium'] ?? $content->images['thumb'] }}"
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
                    {{ $relatedPost->links() }}
                @endisset
            </div>
        </div>
    </section>



    <section class="category-content" id="">
        <div class="flex one ">
            <div>
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


@endsection
