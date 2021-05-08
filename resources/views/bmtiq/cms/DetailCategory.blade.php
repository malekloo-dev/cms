@extends(@env('TEMPLATE_NAME').'.App')

@section('head')
@endsection

@section('footer')
<style>
    .module_container{padding:0 1em;}
        figure.image{margin:1em;}
        @media (max-width:500px){
            figure.image{
                width:auto !important;
                display:contents !important;
            }
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
                            <h2 class="moduleTitle"><span>{{ $detail->title }}</span></h2>
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
                                        {{-- <h2> {{ $detail->title }} Alternative</h2> --}}
                                        <div class="flex one two-500 six-900 center ">

                                            {{--$data['newPost']--}}
                                            @foreach ($relatedPost as $content)
                                                <div>
                                                    <a href="{{ $content->slug }}">
                                                    <article>
                                                        @if (isset($content->images['thumb']))
                                                            <div><img src="{{ $content->images['thumb'] }}"></div>
                                                        @endif
                                                        <footer>
                                                             {{ $content->title }}

                                                            {!! $content->brief_description !!}
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


                    <section class="module_container" id="">
                        <div class="flex one ">
                            <div>


                           

                                @if(count($table_of_content)>0)
                                <ul>
                                    @foreach ($table_of_content as $key => $item)
                                        <li class="toc1">
                                            <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                                @endif
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
