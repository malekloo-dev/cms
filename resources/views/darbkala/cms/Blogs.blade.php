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
    <link href="{{ $seo['url'] }}" rel="canonical" />

@endsection

@section('footer')
    @auth

        @if (Auth::user()->id == 1)
            <div class="btn btn-info edit-button"
                onclick="window.open('{{ url('/admin/category/' . $detail->id . '/edit/') }}')">
                ویرایش</div>
        @endif
    @endauth
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        // $(window).ready(function() {
        //     $('.filter-menu').click(function(e) {
        //         $('.filter-items').css('right', 0);
        //         $('.filter-items').prepend('<a class="close-filter">بستن فیلتر</a>');
        //         $("body").css("overflow", "hidden");

        //     });

        //     $('.filter-header').click(function() {
        //         $(this).next().slideToggle();
        //     });

        //     $('body').on('click', '.close-filter', function() {
        //         $('.filter-items').css("right", '-100%');
        //         $('.close-filter').remove();
        //         $("body").css("overflow", "");

        //     });


        // });
    </script>
@endpush

@section('Content')

    @php
    $tableOfImages = tableOfImages($detail->description);
    $append = '';
    @endphp
    @if (count($breadcrumb) > 0)
        @include('jsonLdBreadcrumb')
    @endif
    {{-- @if (count($relatedProduct))
        @include('jsonLdRelatedProductItemlist')
    @endif --}}
    {{-- @if (count($relatedProduct))
        @include('jsonLdRelatedProduct')
    @endif --}}

    {{-- @include('jsonLdFaq') --}}


    @if (count($breadcrumb))
        <section class="breadcrumb">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/">درب کالا</a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a title="{{ $item['title'] }}" href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif









    @if (!Request::get('page'))


        @if (isset($relatedCompany) && $relatedCompany->count())
            <section class="index-items  bg-gray-dark mb-0">

                <h2>کمپانی ها</h2>
                <div class="flex one">
                    <div>
                        <div class="flex two three-500  five-900 center ">
                            @foreach ($relatedCompany as $content)
                                <div>
                                    <a class="hover shadow2" href="{{ url('profile/' . $content->id) }}">

                                        @if (isset($content->logo) && isset($content->logo))
                                            <img alt="{{ $content->name ?? '' }}"
                                                class="img-contain border-radius-50 mt-1"
                                                width="{{ env('COMPANY_MEDIUM_W') }}"
                                                height="{{ env('COMPANY_MEDIUM_H') }}"
                                                src="{{ $content->logo['medium'] ?? '' }}">
                                        @endif

                                        <div class="flex ">
                                            <div class="p-0 ">
                                                {{ $content->name }}
                                            </div>
                                            <div class="p-0 ">
                                                <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                        fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                        fill="currentColor" />
                                                </svg>
                                                <span class="p-0">{{ $content->viewCount }}</span>
                                            </div>

                                        </div>

                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif




    @endif

    {{-- post&label=relatedPost&var=relatedPost&count=5 --}}
    @if (isset($relatedPost) && count($relatedPost))
        <section class="articles bg-orange my-0" id="articles">
            <div class="flex one ">
                <div class="">
                    <h1 class="py-0" style="display: inline-block">{{ $detail->title }}</h1>
                    <div class="flex one two-500 five-900 center blog-items">

                        @foreach ($relatedPost as $content)

                            <div>
                                <a href="{{ $content->slug }}">
                                    <article class="shadow1">
                                        @if (isset($content->images['images']['medium']))
                                            <div><img loading="lazy" alt="{{ $content->title }}"
                                                    src="{{ $content->images['images']['medium'] }}"
                                                    width="{{ env('ARTICLE_MEDIUM_W') }}"
                                                    height="{{ env('ARTICLE_MEDIUM_H') }}"></div>
                                        @endif
                                        <div class="p-1">
                                            <h3 class="blog-title"> {{ readmore($content->title, 80) }}</h3>
                                            <div class="font-08 blog-publish_date">{{ convertGToJ($content->publish_date) }}</div>
                                            {!! readmore($content->brief_description, 210) !!}
                                            <div>
                                                <svg class="p-0" width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                    fill="currentColor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span class="p-0 blog-view-count">{{ $content->viewCount }}</span>


                                            </div>
                                        </div>
                                    </article>
                                </a>
                            </div>
                        @endforeach


                    </div>
                    {{ $relatedPost->links('vendor.pagination.default') }}
                </div>
            </div>
        </section>
    @endif




@endsection
