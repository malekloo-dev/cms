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

@section('head')

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
    @if (count($breadcrumb)>0)
        @include('jsonLdBreadcrumb')
    @endif
    {{--@if (count($relatedProduct))
        @include('jsonLdRelatedProduct')
    @endif--}}
    @include('jsonLdFaq')


    @if (count($breadcrumb))
        <section class="breadcrumb my-0 py-0">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/"> خانه</a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <section class="p-0  mt-0">
        <div class="flex one">
            <h1 class="p-0">{{ $detail->title }}</h1>
            <div class="font-08">
                <span class="rate mt-1">
                    @if (count($detail->comments))
                        @php
                        $rateAvrage = $rateSum = 0;
                        @endphp
                        @foreach ($detail->comments as $comment)
                            @php
                            $rateSum = $rateSum + $comment['rate'] ;
                            @endphp
                        @endforeach
                        @for ($i = $rateSum / count($detail->comments); $i >= 1; $i--)
                            <img width="20" height="20"
                                srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
                        @endfor
                        <span class="font-07">({{ count($detail->comments) }} نفر)   </span>
                    @endif
                </span>             </div>


        </div>
    </section>



    @if (count($relatedProduct))
        <section class="category-products mt-1" id="products">
            <div class="flex one four-800 ">
                <div class="one-fourth-800 p-0 filter">
                    @if (count($subCategory))
                    <section class="category-list m-0 p-0" id="index-best-view">
                        <div class="flex one ">

                                    @foreach ($subCategory as $content)
                                        <div class="">

                                            <div class="border hover-box shadow p-1 full">
                                                <a href="{{ $content->slug }}">
                                                    <div class="flex one three-700 height-100">
                                                        @if (isset($content->images['images']['small']))
                                                            <div class="p-0"><img src="{{ $content->images['images']['small'] }}" /></div>
                                                        @endif
                                                        <div class="one two-third-700 pr-1">
                                                            <h2 class="p-0 font-08"> {{ $content->title }}</h2>
                                                        </div>

                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                        </div>
                    </section>
                @endif
                </div>
                <div class="three-fourth-800 p-0">
                    <div class="">

                        <div class="flex one">


                            @foreach ($relatedProduct as $content)
                                <div>

                                    <article class="shadow">
                                        <div>
                                            @if (isset($content->images['images']['small']))

                                                <a href="{{ $content->slug }}">
                                                <picture>
                                                    <img loading="lazy"
                                                        src="{{ str_replace(' ', '%20', $content->images['images']['small']) ?? '' }}"
                                                        {{-- srcset="{{ str_replace(' ', '%20', $content->images['images']['small']) ?? '' }} ,
                                                        {{ str_replace(' ', '%20', $content->images['images']['medium']) ?? '' }} 2x"  --}}
                                                        alt="{{ $content->title }}"
                                                        width="{{ env('PRODUCT_SMALL_W') }}"
                                                        height="{{ env('PRODUCT_SMALL_H') }}">
                                                </picture>

                                                </a>
                                            @endif

                                        </div>
                                        <div class="info">

                                             <h5> <a href="{{ $content->slug }}"> {{ $content->title }}</a></h5>
                                            <div class="brief">
                                                {!! readMore($content->brief_description, 250) !!}
                                            </div>

                                        </div>
                                        <div>

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
                                                        <img width="16" height="16"
                                                            srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                            src="{{ asset('/img/star1x.png') }}"
                                                            alt="{{ 'star for rating' }}">
                                                    @endfor
                                                    <span class="font-08">({{ count($content->comments) }} نفر)</span>
                                                @endif
                                            </div>



                                            <div class="view-count">{{ $content->viewCount }} بار دیده شده</div>



                                            <div class="brand">برند: {{ $content->attr['brand'] }}</div>

                                            @if(count($content->companies))

                                                <div class="company-logo">
                                                    @if (isset($content->companies->first()->logo) && $content->companies->first()->logo['small'] != '' && file_exists(public_path($content->companies->first()->logo['small'])))
                                                        <img src="{{ url($content->companies->first()->logo['small']) }}" width="30" height="30" class="border-radius-50" alt="" />
                                                    @endif
                                                    {{ $content->companies->first()->name ?? '' }}
                                                </div>
                                            @endif




                                            <div class="price text-green">
                                                @convertCurrency($content->attr['price'])
                                               تومان
                                           </div>
                                        </div>
                                    </article>

                                </div>
                            @endforeach
                        </div>
                        {{ $relatedProduct->links() }}
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (!Request::get('page'))

        <section class="" id="">
            <div class="flex one ">
                <div class="bg-white p-1 border-radius-5">

                    <div class="flex one two-700">
                        <div class="two-third-700">
                            <ul>
                                @foreach ($table_of_content as $key => $item)
                                    <li class="toc1">
                                        <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                    </li>
                                @endforeach

                            </ul>

                        </div>
                        <div class="third-700">
                            @if (isset($detail->images['images']))
                                <picture>


                                    <img loading="lazy" src="{{ $detail->images['images']['medium'] ?? '' }}"
                                        alt="{{ $detail->title }}"

                                        width="{{ env('CATEGORY_MEDIUM_W') }}"
                                        height="{{ env('CATEGORY_MEDIUM_W') }}">
                                </picture>
                            @endif


                        </div>

                    </div>

                    @include(@env('TEMPLATE_NAME').'.DescriptionModule')

                </div>
            </div>
        </section>



    @endif

@endsection
