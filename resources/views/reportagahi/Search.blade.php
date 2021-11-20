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
    {{-- <link rel="stylesheet" href="{{ asset('/detail.category.css') }}">

    @if (json_decode($relatedProduct->toJson())->prev_page_url != null)
        <link rel="prev" href="{{ json_decode($relatedProduct->toJson())->prev_page_url }}">
    @endif
    @if (json_decode($relatedProduct->toJson())->next_page_url != null)
        <link rel="next" href="{{ json_decode($relatedProduct->toJson())->next_page_url }}">
    @endif --}}
@endsection


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

    {{-- @if (count($relatedProduct))
        @include('jsonLdRelatedProduct')
    @endif

    @include('jsonLdFaq')

    @if (count($breadcrumb) > 0)
        @include('jsonLdBreadcrumb')
    @endif --}}





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

    <section class="bg-gray-black " id="index-best-view">
        <div class="flex one ">
            <h2>محصولات</h2>
            <div>
                @if (count($products))
                    <div class="flex one two-500 four-900 center ">

                        {{-- $data['newPost'] --}}
                        @foreach ($products as $content)
                            <a href="{{ $content->slug }}">
                                <div class="shadow hover p-0 border-radius-5">
                                    @if (isset($content->images['images']['small']))
                                        <figure class="image">
                                            <img src="{{ $content->images['images']['large'] }}"
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

                @else
                    موردی یافت نشد.
                @endif
            </div>
        </div>
    </section>

    <section class="products" id="index-best-view">
        <div class="flex one ">
            <h2>مقالات</h2>
            @if (count($posts))
                <div>
                    <h2>مقاله های زیر مجموعه {{ $detail->title }}</h2>
                    <div class="flex one two-500 four-900 center ">

                        @foreach ($posts as $content)
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
            @else
                موردی یافت نشد.
            @endif
        </div>
    </section>



    <section class="products" id="index-best-view">
        <div class="flex one ">
            <h2>کمپانی ها</h2>
            @if (count($companies))
                <div>

                    <div class="flex one two-500 four-900 center ">

                        @foreach ($companies as $content)
                            <div>
                                <a href="{{ route('profile.index', ['id', $content->id]) }}">


                                    @if (isset($content->images['images']['small']))
                                        <div><img width="{{ env('PRODUCT_SMALL_W') }}"
                                                height="{{ env('PRODUCT_SMALL_H') }}" title="{{ $content->title }}"
                                                alt="{{ $content->title }}" loading="lazy"
                                                src="{{ $content->images['images']['small'] }}"></div>
                                    @endif

                                    <h2> {{ $content->title }}</h2>
                                    {!! $content->brief_description !!}


                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            @else
                موردی یافت نشد.
            @endif
        </div>
    </section>






@endsection
