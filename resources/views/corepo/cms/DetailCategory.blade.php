@extends(@env('TEMPLATE_NAME').'.App')
@section('assets')
<link rel="stylesheet" href="{{ asset('/detail.category.css') }}">
@endsection

@section('Content')

@php
$tableOfImages=tableOfImages($detail->description);
$append='';
@endphp

@if (count($relatedProduct))
<script type="application/ld+json">
    @if (count($relatedProduct))
[
   @foreach($relatedProduct as $key=>$content)

        {
            "@context": "https://schema.org/",
            "@type": "Product",
            "name": "{{ $content->title }}",

            @if (isset($content->images['thumb']))
                "image": [
                    "{{ url('/').$content->images['images']['small'] }}",
                    "{{ url('/').$content->images['images']['medium'] }}",
                    "{{ url('/').$content->images['images']['large'] }}"
                ],
            @endif

            "description": "{{$content->brief_description}}",
            "sku": "{{$content->id}}",
            "mpn": "{{$content->id}}",
            "brand":
            {
                "@type": "Brand",
                "name": "{{ $detail->brand }}"
            },

            "aggregateRating":
            {
                "@type": "AggregateRating",
                "ratingValue": {{ $content->attr['rate'] }},
                "reviewCount": {{ $content->viewCount }},
                "bestRating": 5,
                "worstRating": 0
            },
            "offers":
            {
                "@type": "Offer",
                "url": "{{ url()->current().$content->slug }}",
                "priceCurrency": "IRR",
                "price": "{{ $content->attr['price']??"0"}}",
                "priceValidUntil": "2021-08-09",
                "itemCondition": "https://schema.org/UsedCondition",
                "availability": "https://schema.org/InStock",
                "seller":
                {
                    "@type": "Organization",
                    "name": "ایران ریموت"
                }
            }
        }
        @isset($relatedProduct[$key+1])
            {{","}}
        @endisset
   @endforeach

]
@endif
</script>
@endif

@if (count($breadcrumb))
<section class="breadcrumb">
    <div class="flex one  ">
        <div class="p-0">
            <a href="/">خانه </a>
            @foreach($breadcrumb as $key=>$item)
            <span>></span>
            <a href="{{$item['slug']}}">{{$item['title']}}</a>
            @endforeach

        </div>
    </div>
</section>
@endif

@if (count($subCategory))
<section class="category-list" id="index-best-view">
    <div class="flex one ">
        <div>
            <h2>دسته بندی: {{$detail->title}}</h2>
            <div class="flex one two-800   ">

                {{--$data['newPost']--}}
                @foreach($subCategory as $content)
                <div class="height-full">
                    <div class="border hover-box p-1 full">
                        <div class="flex one three-700 height-100">
                            @if (isset($content->images['thumb']))
                            <div class="p-0">
                                <picture>
                                    <source media="(min-width:{{ env('CATEGORY_LARGE') }}px)" srcset="{{ $content->images['images']['large'] ?? '' }} , {{ $content->images['images']['large'] ?? '' }} 2x">
                                    <source media="(min-width:{{ env('CATEGORY_MEDIUM') }}px)" srcset="{{ $content->images['images']['medium'] ?? '' }} , {{ $content->images['images']['large'] ?? '' }} 2x">
                                    <source media="(min-width:{{ env('CATEGORY_SMALL') }}px)" srcset="{{ $content->images['images']['small'] ?? ''}} , {{ $content->images['images']['medium'] ?? ''}} 2x">
                                    <img src="{{ $content->images['images']['medium'] ?? ''}}"
                                            sizes="(max-width:{{ env('CATEGORY_MEDIUM') }}px) 100vw  {{ ENV('CATEGORY_MEDIUM') }}px {{ ENV('CATEGORY_LARGE') }}px"
                                            alt="{{$content->title}}"
                                            width="{{ env('CATEGORY_MEDIUM') }}" height="{{ env('CATEGORY_MEDIUM') }}">
                                </picture>
                            </div>
                            @endif
                            <div class="one two-third-700 pr-1">
                                <h2 class="p-0"><a href="{{ $content->slug }}"> {{ $content->title }}</a></h2>
                                {!! $content->brief_description !!}

                            </div>

                        </div>
                    </div>
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
                    @foreach($relatedProduct as $content)
                    <div>
                        <article>
                            @if (isset($content->images['thumb']))
                            <figure class="image">
                                    <img src="{{ $content->images['images']['small'] ?? $content->images['thumb']}}"
                                    sizes="(max-width:{{ env('ARTICLE_SMALL') }}px) 100vw {{ env('ARTICLE_SMALL') }}px {{ ENV('ARTICLE_MEDIUM') }}px"
                                    alt="{{$content->title}}"
                                    width="100" height="100"
                                    srcset="
                                        {{ $content->images['images']['small'] ?? $content->images['thumb']}} {{ env('ARTICLE_SMALL') }}w,
                                        {{ $content->images['images']['medium'] ?? $content->images['thumb']}} 2x" >
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

@if (count($relatedPost))
<section class="products" id="index-best-view">
    <div class="flex one ">
        <div>
            <div class="shadow">
                <h2>مقاله های زیر مجموعه {{$detail->title}}</h2>
                <div class="flex one two-500 four-900 center ">

                    {{--$data['newPost']--}}
                    @foreach($relatedPost as $content)
                    <div>
                        <article>
                            @if (isset($content->images['thumb']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small'] ?? $content->images['thumb']}}"
                                    sizes="(max-width:{{ env('ARTICLE_SMALL') }}px) 100vw {{ env('ARTICLE_SMALL') }}px {{ ENV('ARTICLE_MEDIUM') }}px"
                                    alt="{{$content->title}}"
                                    width="100" height="100"
                                    srcset="
                                        {{ $content->images['images']['small'] ?? $content->images['thumb']}} {{ env('ARTICLE_SMALL') }}w,
                                        {{ $content->images['images']['medium'] ?? $content->images['thumb']}} 2x" >
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


<section class="" id="">
    <div class="flex one ">
        <div>
            <h1 class="">{{ $detail->title }}</h1>


            @include(@env('TEMPLATE_NAME').'.DescriptionModule')
        </div>
    </div>
</section>
@endsection
