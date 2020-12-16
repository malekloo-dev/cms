@extends(@env('TEMPLATE_NAME').'.App')
@section('assets')
@endsection

@section('Content')

    @php
    $tableOfImages=tableOfImages($detail->description);
    $append='';
    @endphp
    @if (count($relatedProduct))[
        @include('jsonLdRelatedProduct')
    @endif


    <div class="position-2 wrap t3-sl t3-sl-2 ">
        <div class="container ">
            <div class="row">
                <div class="moduletable parallax1 ">


                    @if (count($breadcrumb))
                        <section class="breadcrumb">
                            <div class="flex one  ">
                                <div class="p-0">
                                    <a href="/">Home </a>
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
                                    <h2>Category: {{ $detail->title }}</h2>
                                    <div class="flex one two-800   ">

                                        {{--$data['newPost']--}}
                                        @foreach ($subCategory as $content)
                                            <div class="height-full">

                                                <div class="border hover-box p-1 full">
                                                    <a href="{{ $content->slug }}">
                                                        <div class="flex one three-700 height-100">
                                                            @if (isset($content->images['thumb']))
                                                                <div class="p-0"><img
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


                    @if (count($relatedPost))
                        <section class="products" id="index-best-view">
                            <div class="flex one ">
                                <div>
                                    <div class="shadow">
                                        <h2> {{ $detail->title }} Alternative</h2>
                                        <div class="flex one two-500 four-900 center ">

                                            {{--$data['newPost']--}}
                                            @foreach ($relatedPost as $content)
                                                <div>
                                                    <article>
                                                        @if (isset($content->images['thumb']))
                                                            <div><img src="{{ $content->images['thumb'] }}"></div>
                                                        @endif
                                                        <footer>
                                                            <h2><a href="{{ $content->slug }}"> {{ $content->title }}</a>
                                                            </h2>
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

                                        <img src="{{ $detail->images['images']['medium'] ?? '' }}"
                                            alt="{{ $detail->title }}" width="{{ env('CATEGORY_MEDIUM') }}"
                                            height="{{ env('CATEGORY_MEDIUM') }}">
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

                                {{-- {!! $detail->description
                                !!}--}}
                            </div>
                        </div>
                    </section>



                </div>
            </div>
        </div>
    </div>
@endsection
