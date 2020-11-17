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
                "{{ url('/').$detail->images['images']['small'] }}",
                "{{ url('/').$detail->images['images']['medium'] }}",
                "{{ url('/').$detail->images['images']['large'] }}"
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

        "description": "@foreach($editorModule as $key=>$module) @if ($module['type']=='description') {{clearHtml($module['content'])}} @endif  @if ($module['type']=='attr'){!!  "مشخصا فنی : "!!} @foreach($module['content'] as $key=>$attr){!!  clearHtml($attr['field'])!!} : {!!  clearHtml($attr['value'])!!} - @endforeach @endif @endforeach",
        "sku": "{{$detail->id}}",
        "mpn": "{{$detail->id}}",
        "brand":
        {
            "@type": "Brand",
            "name": "{{ $detail->attr['brand'] }}"
        },

        "aggregateRating":
        {
            "@type": "AggregateRating",
            "ratingValue": "{{ $detail->attr['rate'] }}",
            "ratingCount": "{{ $detail->viewCount }}",
            "bestRating": "5",
            "worstRating": "0"
        },
        "offers":
        {
            "@type": "Offer",
            "url": "{{ url('/').'/'. $detail->slug }}",
            "priceCurrency": "IRR",
            "price": "{{ $detail->attr['price'] ?? 0}}",
            "priceValidUntil": "2021-08-09",
            "itemCondition": "https://schema.org/UsedCondition",
            "availability": "https://schema.org/InStock",
            "seller":
            {
                "@type": "Organization",
                "name": "ریموت یدک"
            }
        }
        @if(isset($detail->comments))
        ,"review":
        [
            @foreach ($detail->comments as $comment)
                {
                    "@type":"review",
                    "author":"{{ $comment['name'] }}",
                    "datePublished":"{{ $comment['created_at'] }}",
                    "reviewBody":"{{ $comment['comment'] }}"
                }
                @if(!$loop->last)
                ,
                @endif
            @endforeach
        ]
        @endif
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
            @if(isset($detail->images['thumb']))
            <figure class="image">
                <img src="{{ $detail->images['images']['medium'] ?? $detail->images['thumb']}}"
                sizes="(max-width:{{ env('ARTICLE_MEDIUM') }}px) 100vw {{ env('ARTICLE_MEDIUM') }}px {{ ENV('ARTICLE_LARGE') }}px"
                alt="{{$detail->title}}"
                width="{{ env('ARTICLE_MEDIUM') }}" height="100"
                srcset="
                    {{ $detail->images['images']['medium'] ?? $detail->images['thumb']}} {{ env('ARTICLE_MEDIUM') }}w,
                    {{ $detail->images['images']['large'] ?? $detail->images['thumb']}} 2x" >

            </figure>
            @endif
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



<section class="comments bg-gray mt-0 mb-0">
    <div class="flex one">
        <div>
            <h4>نظرات شما</h4>
            <div>
                <div class="comment-form">
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                    @endif

                    @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        {!! \Session::get('error') !!}
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger">
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    </div>
                    @endif
                    <form action="{{ route('comment.store') }}#comment" id="comment" method="post">
                        <input type="hidden" name="content_id" value="{{ $detail->id }}">

                        @csrf
                        <div>
                            <label>نام:</label>
                            <input type="text" name="name" value="{{ old('name') }}">
                        </div>
                        <div>
                            <label>پیام:</label>
                            <textarea name="comment">{{ old('comment') }}</textarea>
                        </div>
                        <button class="button button-blue g-recaptcha"
                        data-sitekey="reCAPTCHA_site_key"
                        data-callback='onSubmit'
                        data-action='submit'>ارسال نظر</button>
                    </form>
                </div>

                @foreach ($detail->comments as $comment)
                    <div class="comment">
                        <div class="aside">
                            <div class="name">{{ $comment['name'] }}</div>
                            <div class="date">{{ convertGToJ($comment['created_at']) }}</div>
                        </div>
                        <div class="article">
                            <div class="text">{{ $comment['comment'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
