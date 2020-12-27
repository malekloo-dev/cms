@extends(@env('TEMPLATE_NAME').'.App')
@section('footer')
    <style>
        p {
            margin: 0 !important;
        }
        article{
            border-bottom: 1px dashed #ccc;
        }

    </style>
@endsection

@section('Content')

    @php
    $tableOfImages=tableOfImages($detail->description);
    $append='';
    @endphp
    @if (count($relatedProduct))[
        @include('jsonLdRelatedProduct')
    @endif


    <div id="" class="position-2 wrap t3-sl t3-sl-2  t3-mainbody new">
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
                        <div class="flex one two-500" style="justify-content: space-around">
                            <div class="">

                                @if (isset($detail->images['images']))
                                    <picture>

                                        <img src="{{ $detail->images['images']['original'] ?? '' }}"
                                            alt="{{ $detail->title }}">
                                    </picture>
                                @endif
                                <h3 class="moduleTitle">{{ $detail->title }}</h3>
                                <div>{{ convertGToJ($detail->publish_date) }}</div>
                                <ul>
                                    @foreach ($table_of_content as $key => $item)
                                        <li class="toc1">
                                            <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                        </li>
                                    @endforeach

                                </ul>

                                @include(@env('TEMPLATE_NAME').'.DescriptionModule')
                            </div>
                            <div class="third-500">
                                @if (count($relatedPost))
                                    <section class="products" id="index-best-view">
                                        <div class="flex one ">
                                            <div>
                                                <div class="shadow">
                                                    <div class="flex one  center ">

                                                        @foreach ($relatedPost as $content)
                                                            <div>
                                                                <article class="flex one two-500">
                                                                    @if (isset($content->images['thumb']))
                                                                        <div class="third-500" >
                                                                            <img style="object-fit: cover; "
                                                                                src="{{ $content->images['thumb'] }}">
                                                                        </div>
                                                                    @endif
                                                                    <footer class="two-third-500">
                                                                        <a href="{{ $content->slug }}">
                                                                            {{ $content->title }}</a>

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
                            </div>
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








                </div>
            </div>
        </div>
    </div>
@endsection
