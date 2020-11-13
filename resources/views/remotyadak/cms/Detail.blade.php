@extends(@env('TEMPLATE_NAME').'.App')
@section('assets')
{{-- recaptcha --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
    function callbackThen(response){
        // read HTTP status
        console.log(response.status);
     
        // read Promise object
        response.json().then(function(data){
            console.log(data);
        });
    }
    function callbackCatch(error){
        console.error('Error:', error);
        alert('صفحه را مجدد بارگذاری نمایید.')
    }
    </script>
     
    {!! htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch'
    ]) !!}
    
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
                "{{ $detail->images['images']['small'] }}",
                "{{ $detail->images['images']['medium'] }}",
                "{{ $detail->images['images']['large'] }}"
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
        "review":
        [   
            @foreach ($detail->comments as $comment)
            {
                "@type":"review",
                "author":"{{ $comment['name'] }}",
                "datePublished":"{{ $comment['created_at'] }}",
                "reviewBody":"{{ $comment['comment'] }}"
            },    
            @endforeach
                
        ]
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

<section class="product-detail" id="">
    <div class="flex one ">
        <div>
            <div class="top-page">
                <picture>
                    <source media="(min-width:{{ env('PRODUCT_MEDIUM') }}px)" srcset="{{ $detail->images['images']['medium'] ?? '' }} , {{ $detail->images['images']['large'] ?? '' }} 2x">
                    <source media="(min-width:{{ env('PRODUCT_SMALL') }}px)" srcset="{{ $detail->images['images']['small'] ?? ''}} , {{ $detail->images['images']['medium'] ?? ''}} 2x">
                    <img src="{{ $detail->images['images']['medium'] ?? ''}}"
                            sizes="(max-width:{{ env('PRODUCT_MEDIUM') }}px) 100vw  {{ ENV('PRODUCT_MEDIUM') }}px {{ ENV('PRODUCT_LARGE') }}px"
                            alt="{{$detail->title}}"
                            width="{{ env('PRODUCT_MEDIUM') }}" height="{{ env('PRODUCT_MEDIUM') }}">
                </picture>
                <div>
                    <h1 class="">{{ $detail->title }}</h1>
                    <div>
                        <span class="rate mt-1">
                            @for($i = $detail->attr['rate']; $i >= 1; $i--)
                                <img width="20" height="20" srcset="{{asset('/img/star2x.png')}} 2x , {{asset('/img/star1x.png')}} 1x" src="{{asset('/img/star1x.png')}}"   alt="{{"star for rating"}}">
                            @endfor
                        </span> | 
                        {{ $detail->viewCount }} بار دیده شده | 
                        تاریخ انتشار: <span class="ltr">{{ convertGToJ($detail->publish_date) }} </span> |  
                    </div>
                </div>
            </div>
            

            <ul>
                @foreach($table_of_content as $key=>$item)
                <li class="toc1">
                    <a href="#{{$item['anchor']}}">{{$item['label']}}</a>
                </li>
                @endforeach

            </ul>


            @include(@env('TEMPLATE_NAME').'.DescriptionModule')


        </div>
    </div>
</section>

@if (count($relatedProduct))
<section class="products bg-gray m-0 pt-1 pb-1" id="index-best-view">
    <div class="flex one ">
        <div>
                <h2>محصولات مرتبط {{$detail->title}}</h2>
                <div class="flex one two-500 four-900  ">

                    {{--$data['newPost']--}}
                    @foreach($relatedProduct as $content)
                    <div class="">
                        <a href="{{ $content->slug }}">
                            <article class="shadow">
                                @if (isset($content->images['thumb']))
                                <div><img width="150" height="150px" src="{{ $content->images['images']['small']}}"   alt="{{$content->title}}" ></div>
                                @endif
                                <footer>
                                    <h2> {{ $content->title }}</h2>
                                    {!! $content->brief_description !!}
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

@if (count($relatedPost))
<section class="products" id="index-best-view">
    <div class="flex one ">
        <div>
            <h2>مقاله های مرتبط {{$detail->title}}</h2>
            <div class="flex one two-500 four-900 center ">

                {{--$data['newPost']--}}
                @foreach($relatedPost as $content)
                <div>
                    <article>
                        @if (isset($content->images['thumb']))
                        <div><img src="{{ $content->images['thumb']}}  alt="{{$content->title}} "></div>
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
