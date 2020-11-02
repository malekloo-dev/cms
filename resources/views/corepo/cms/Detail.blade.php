@extends(@env('TEMPLATE_NAME').'.App')
@section('assets')
<link rel="stylesheet" href="{{ asset('/detail.css') }}">
@endsection
@section('Content')
@php
$tableOfImages=tableOfImages($detail->description);
$append='';
@endphp

@if ($detail->attr_type=='product')

<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "{{ $detail->title }}",

        @if (isset($detail->images['thumb']))
            "image": [
                "{{ $detail->images['images']['300'] }}",
                "{{ $detail->images['images']['600'] }}",
                "{{ $detail->images['images']['900'] }}"
            ],
        @endif
        @if (count($tableOfImages))

            "images": [

                @foreach($tableOfImages as $key=>$item)
                    {
                    "type": "gallery",
                    "url": "{{$item['src']}}",
                    "alt": "{{$item['alt']}}",
                    "title":"{{$item['alt']}}"

                    }
                    @isset($tableOfImages[$key+1])
                        {{","}}
                    @endisset

                @endforeach
            ],
        @endif

        "description": "{{$detail->description}}",
        "sku": "{{$detail->id}}",
        "mpn": "{{$detail->id}}",
        "brand":
        {
            "@type": "Brand",
            "name": "{{ $detail->brand }}"
        },

        "aggregateRating":
        {
            "@type": "AggregateRating",
            "ratingValue": {{ $detail->attr['rate'] }},
            "reviewCount": {{ $detail->viewCount }},
            "bestRating": 5,
            "worstRating": 0
        },
        "offers":
        {
            "@type": "Offer",
            "url": "{{ url()->current().$detail->slug }}",
            "priceCurrency": "IRR",
            "price": "{{ $detail->attr['price'] }}",
            "itemCondition": "https://schema.org/UsedCondition",
            "availability": "https://schema.org/InStock",
            "seller":
            {
                "@type": "Organization",
                "name": "ایران ریموت"
            }
        }
    }
</script>
@endif

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

<section class="intro" id="">
    <div class="flex one two-500  ">
        <div class="third-500">
            <figure class="image">
                <img src="{{ $detail->images['images']['medium'] ?? $detail->images['thumb']}}"
                sizes="(max-width:{{ env('ARTICLE_MEDIUM') }}px) 100vw {{ env('ARTICLE_MEDIUM') }}px {{ ENV('ARTICLE_LARGE') }}px"
                alt="{{$detail->title}}"
                width="{{ env('ARTICLE_MEDIUM') }}" height="100"
                srcset="
                    {{ $detail->images['images']['medium'] ?? $detail->images['thumb']}} {{ env('ARTICLE_MEDIUM') }}w,
                    {{ $detail->images['images']['large'] ?? $detail->images['thumb']}} 2x" >

            </figure>
            <div>
                <h1 class="site-name">{{ $detail->title }}</h1>
                <div class="website"></div>
                <div class="rate">
                    @for($i = $detail->attr['rate']; $i >= 1; $i--)
                        <img width="20" height="20" srcset="{{asset('/img/star2x.png')}} 2x , {{asset('/img/star1x.png')}} 1x" src="{{asset('/img/star1x.png')}}"   alt="{{"star for rating"}}">
                    @endfor
                    
                </div>
            </div>
        </div>
        <div class="two-third-500">

            {!! $detail->brief_description !!}
        </div>
    </div>
</section>

<section class="" id="">
    <div class="flex one ">
        <div>





                <ul>
                    @foreach($table_of_content as $key=>$item)
                    <li class="toc1">
                        <a id="test" href="#{{$item['anchor']}}">{{$item['label']}}</a>
                    </li>
                    @endforeach

                </ul>
                {!! $detail->description !!}

        </div>
    </div>
</section>

@if (count($relatedProduct))
<section class="products bg-gray m-0 pt-1 pb-1" id="index-best-view">
    <div class="flex one ">
        <div>
            <div class="shadow ">
                <h2>محصولات مرتبط {{$detail->title}}</h2>
                <div class="flex one two-500 four-900 center ">

                    {{--$data['newPost']--}}
                    @foreach($relatedProduct as $content)
                    <div>
                        <article>
                            @if (isset($content->images['thumb']))
                            <div><img src="{{ $content->images['thumb']}}"></div>
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
                <h2>مقاله های مرتبط {{$detail->title}}</h2>
                <div class="flex one two-500 four-900 center ">

                    {{--$data['newPost']--}}
                    @foreach($relatedPost as $content)
                    <div>
                        <article>
                            @if (isset($content->images['thumb']))
                            <div><img src="{{ $content->images['thumb']}}"></div>
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

@endsection
