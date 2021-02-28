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

    <div id="wb_about">

        <div id="about">

            <div class="row">
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


                        @if (count($subCategory))
                            <section class="category-list" id="index-best-view">
                                <div class="flex one ">
                                    <div>
                                        <h2>دسته بندی: {{ $detail->title }}</h2>
                                        <div class="flex one two-800   ">

                                            @foreach ($subCategory as $content)
                                                <div class="height-full">

                                                    <div class="border hover-box p-1 full">
                                                        <a href="{{ $content->slug }}">
                                                            <div class="flex one three-700 height-100">
                                                                @if (isset($content->images['thumb']))
                                                                    <div class="p-0"><img
                                                                            src="{{ $content->images['thumb'] }}" />
                                                                    </div>
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

                        @if (count($relatedProduct))
                            <section class="category-products mt-1" id="products">
                                <div class="flex one ">
                                    <div>
                                        <div class="">

                                            <div class="flex one  two-1100  ">

                                                {{-- $data['newPost'] --}}
                                                @foreach ($relatedProduct as $content)
                                                    <div>
                                                        <article class="shadow">
                                                            <div>
                                                                @if (isset($content->images['thumb']))
                                                                    <picture>
                                                                        <img loading="lazy"
                                                                            src="{{ str_replace(' ', '%20', $content->images['images']['small']) ?? '' }}"
                                                                            {{-- srcset="{{ str_replace(' ', '%20', $content->images['images']['small']) ?? '' }} ,{{ str_replace(' ', '%20', $content->images['images']['medium']) ?? '' }} 2x" --}}
                                                                            alt="{{ $content->title }}"
                                                                            width="{{ env('PRODUCT_SMALL') }}"
                                                                            height="{{ env('PRODUCT_SMALL') }}">
                                                                    </picture>
                                                                @endif
                                                            </div>
                                                            <footer>
                                                                <a href="{{ $content->slug }}">
                                                                    <h2>{{ $content->title }}</h2>
                                                                </a>
                                                                <div class="brand">برند: {{ $content->attr['brand'] }}
                                                                </div>
                                                                <div class="price text-green">قیمت:
                                                                    @convertCurrency($content->attr['price'])
                                                                    تومان </div>
                                                                <div class="view-count">{{ $content->viewCount }} بار
                                                                    دیده شده</div>
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
                                                                                srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                                                src="{{ asset('/img/star1x.png') }}"
                                                                                alt="{{ 'star for rating' }}">
                                                                        @endfor
                                                                        <span
                                                                            class="font-08">({{ count($content->comments) }}
                                                                            نفر)</span>
                                                                    @endif
                                                                </div>
                                                                <div class="brief">
                                                                    {!! readMore($content->brief_description, 250) !!}
                                                                </div>
                                                            </footer>
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
                                                        <source media="(min-width:{{ env('CATEGORY_LARGE') }}px)"
                                                            srcset="{{ $detail->images['images']['large'] ?? '' }}">

                                                        <source media="(min-width:{{ env('CATEGORY_MEDIUM') }}px)"
                                                            srcset="{{ $detail->images['images']['medium'] ?? '' }}">

                                                        <source media="(min-width:{{ env('CATEGORY_SMALL') }}px)"
                                                            srcset="{{ $detail->images['images']['small'] ?? '' }}">

                                                        <img src="{{ $detail->images['images']['medium'] ?? '' }}"
                                                            alt="{{ $detail->title }}"
                                                            width="{{ env('CATEGORY_MEDIUM') }}"
                                                            height="{{ env('CATEGORY_MEDIUM') }}">
                                                    </picture>
                                                @endif


                                            </div>

                                        </div>

                                        @include(@env('TEMPLATE_NAME').'.DescriptionModule')

                                    </div>
                                </div>
                            </section>

                            {{-- post&label=relatedPost&var=relatedPost&count=5 --}}
                            @if (isset($relatedPost['data']))
                                <section class="articles bg-orange mb-0" id="articles">
                                    <div class="flex one ">
                                        <div class="">
                                            <h2>مقاله های زیر مجموعه {{ $detail->title }}</h2>
                                            <div class="flex one two-500 five-900 center ">

                                                {{-- $data['newPost'] --}}
                                                @foreach ($relatedPost['data'] as $content)
                                                    <div>
                                                        <a href="{{ $content->slug }}">
                                                            <article class="shadow1">
                                                                @if (isset($content->images['thumb']))
                                                                    <div><img src="{{ $content->images['thumb'] }}">
                                                                    </div>
                                                                @endif
                                                                <footer>
                                                                    <h2> {{ readmore($content->title, 80) }}</h2>
                                                                    {!! readmore($content->brief_description, 210) !!}
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



                            <div class="mobile-menu">
                                <ul>
                                    <li><a href="#products">محصولات</a></li>
                                    <li><a href="#articles">مقالات</a></li>
                                </ul>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="col-2-padding">
                </div>
            </div>
        </div>
    </div>
    </div>





@endsection
