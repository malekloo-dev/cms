@extends(@env('TEMPLATE_NAME').'.App')


@section('head')

    <link rel="stylesheet" type="text/css" href="{{ asset('/DetailCategory.css') }}">
@endsection
@section('Content')

    @php
    $tableOfImages=tableOfImages($detail->description);
    $append='';
    @endphp
    @if (count($relatedProduct))
        @include('jsonLdRelatedProduct')
    @endif

    @if (count($breadcrumb))
        <section class="breadcrumb mb-0">
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
        <section class="sub-category mt-0" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="flex one two-500 four-900 center ">

                        {{--$data['newPost']--}}
                        @foreach ($subCategory as $content)
                            <div>
                                <article>
                                    @if (isset($content->images['images']['small']))
                                        <figure class="image">
                                            <img src="{{ $content->images['images']['small']  }}"
                                                sizes="(max-width:{{ env('CATEGORY_SMALL_W') }}px) 100vw {{ env('CATEGORY_SMALL_W') }}px {{ ENV('CATEGORY_MEDIUM_W') }}px"
                                                alt="{{ $content->title }}" width="{{ ENV('CATEGORY_SMALL_W') }}"
                                                height="{{ ENV('CATEGORY_SMALL_W') }}" srcset="
                                            {{ $content->images['images']['small']  }} {{ env('CATEGORY_SMALL_W') }}w,
                                            {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} 2x">
                                        </figure>

                                    @endif

                                    <h2><a href="{{ $content->slug }}"> {{ $content->title }}</a></h2>
                                    {!! readMore($content->brief_description) !!}

                                </article>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (count($relatedProduct))
        <section class="products mt-5" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="">

                        <div class="flex one two-500 four-900 center ">

                            {{--$data['newPost']--}}
                            @foreach ($relatedProduct as $content)
                                <div>
                                    <article>
                                        @if (isset($content->images['images']['small']))
                                            <div><img src="{{ $content->images['images']['small'] }}"></div>
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

    @if (count($relatedPost))
        <section class="products" id="">
            <div class="flex one ">
                <div>

                    <h2>مقاله های زیر مجموعه {{ $detail->title }}</h2>
                    <div class="flex one two-500 five-900 center ">

                        {{--$data['newPost']--}}
                        @foreach ($relatedPost as $content)
                            <div>
                                <a href="{{ $content->slug }}">
                                    <article>
                                        @if (isset($content->images['images']['small']))
                                            <div class="img-fit">
                                                <img class="full rounded" alt="{{ $content->title }}"
                                                    src="{{ $content->images['images']['small'] }}">
                                            </div>
                                        @endif
                                        <footer>
                                            <h2 class="font-1"> {{ $content->title }}</h2>
                                            {!! readMore($content->brief_description, 160) !!}
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


    <section class="" id="">
        <div class="flex one ">
            <div>
                <h1 class="">{{ $detail->title }}</h1>
                {!! $detail->description !!}

            </div>
        </div>
    </section>
@endsection
