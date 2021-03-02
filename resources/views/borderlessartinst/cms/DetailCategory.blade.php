@extends(@env('TEMPLATE_NAME').'.App')
@section('head')
    <meta property="og:image" content="{{ url($detail->images['images']['medium'] ?? '') }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM') : env('ARTICLE_MEDIUM') }}" />
    <meta property="og:image:height"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM') : env('ARTICLE_MEDIUM') }}" />
    <meta property="og:image:alt" content="{{ $detail->title }}" />
    @if (json_decode($relatedProduct->toJson())->prev_page_url != null)
        <link rel="prev" href="{{ json_decode($relatedProduct->toJson())->prev_page_url }}">
    @endif
    @if (json_decode($relatedProduct->toJson())->next_page_url != null)
        <link rel="next" href="{{ json_decode($relatedProduct->toJson())->next_page_url }}">
    @endif
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

    <section class="product-detail " id="">

        @if (count($breadcrumb))
            <section class="breadcrumb">
                <div class="flex one  ">
                    <div class="p-0">
                        <a href="/"> Home </a>
                        @foreach ($breadcrumb as $key => $item)
                            <span>></span>
                            <a href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                        @endforeach

                    </div>
                </div>
            </section>
        @endif

        <div class="col-1-padding">
            <div id="wb_aboutText">



                <section>
                    <div class="flex one">
                        <h1>{{ $detail->title }}</h1>
                    </div>
                </section>

                @if (count($relatedPost))
                <section class="products" id="index-best-view">
                    <div class="flex one ">
                        <div>
                            <div class="flex one two-500 four-900 center ">

                                @foreach ($relatedPost as $detail2)
                                    <div>
                                        <article>
                                            @if (isset($detail2->images['thumb']))
                                                <figure class="image">
                                                    <img src="{{ $detail2->images['images']['small'] ?? $detail2->images['thumb'] }}"
                                                        sizes="(max-width:{{ env('ARTICLE_SMALL') }}px) 100vw {{ env('ARTICLE_SMALL') }}px {{ ENV('ARTICLE_MEDIUM') }}px"
                                                        alt="{{ $detail2->title }}" width="100" height="100"
                                                        srcset="
                                                        {{ $detail2->images['images']['small'] ?? $detail2->images['thumb'] }} {{ env('ARTICLE_SMALL') }}w,
                                                        {{ $detail2->images['images']['medium'] ?? $detail2->images['thumb'] }} 2x">
                                                </figure>

                                            @endif
                                            <footer>
                                                <h2><a href="{{ $detail2->slug }}"> {{ $detail2->title }}</a></h2>
                                                {!! $detail2->brief_description !!}
                                            </footer>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif


            </div>
        </div>

    </section>



    @endsection
