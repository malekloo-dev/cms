@extends(@env('TEMPLATE_NAME').'.App')
@section('js')
    {{-- recaptcha --}}
    {{--
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        function callbackThen(response) {
            // read HTTP status
            console.log(response.status);

            // read Promise object
            response.json().then(function(data) {
                console.log(data);
            });
        }

        function callbackCatch(error) {
            console.error('Error:', error);
        }

    </script>
    {!! htmlScriptTagJsApi([
    'callback_then' => 'callbackThen',
    'callback_catch' => 'callbackCatch',
    ]) !!} --}}
@endsection

@section('Content')
    @php
    $tableOfImages=tableOfImages($detail->description);
    $append='';
    @endphp

    @if ($detail->attr_type == 'product')

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

    <div class="position-2 wrap t3-sl t3-sl-2 ">
        <div class="container ">
            <div class="row">
                <div class="moduletable parallax1 ">

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



                    <div class="module_container" style="">
                        <div class="top-page">
                            <picture>
                                <source media="(min-width:{{ env('PRODUCT_MEDIUM') }}px)"
                                    srcset="{{ str_replace(' ', '%20', $detail->images['images']['medium']) ?? '' }} , {{ str_replace(' ', '%20', $detail->images['images']['large']) ?? '' }} 2x">
                                <source media="(min-width:{{ env('PRODUCT_SMALL') }}px)"
                                    srcset="{{ str_replace(' ', '%20', $detail->images['images']['small']) ?? '' }} , {{ str_replace(' ', '%20', $detail->images['images']['medium']) ?? '' }} 2x">
                                <img src="{{ $detail->images['images']['medium'] ?? '' }}"
                                    sizes="(max-width:{{ env('PRODUCT_MEDIUM') }}px) 100vw  {{ ENV('PRODUCT_MEDIUM') }}px {{ ENV('PRODUCT_LARGE') }}px"
                                    alt="{{ $detail->title }}" width="{{ env('PRODUCT_MEDIUM') }}"
                                    height="{{ env('PRODUCT_MEDIUM') }}">
                            </picture>
                            <div>
                                <h1 class="">{{ $detail->title }}</h1>
                                <div>
                                    <span class="rate mt-1">
                                        @for ($i = $detail->attr['rate']; $i >= 1; $i--)
                                            <img width="20" height="20"
                                                srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
                                        @endfor
                                    </span> |
                                    View: {{ $detail->viewCount }} |
                                    Publish date: <span class="ltr">{{ convertGToJ($detail->publish_date) }} </span> |
                                </div>
                            </div>
                        </div>


                        <ul>
                            @foreach ($table_of_content as $key => $item)
                                <li class="toc1">
                                    <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                </li>
                            @endforeach

                        </ul>

                        @include(@env('TEMPLATE_NAME').'.DescriptionModule')


                        @if (count($relatedProduct))
                            <section class="products bg-gray m-0 pt-1 pb-1" id="index-best-view">
                                <div class="flex one ">
                                    <div>
                                        <h2>Related product with {{ $detail->title }}</h2>
                                        <div class="flex one two-500 four-900  ">

                                            {{--$data['newPost']--}}
                                            @foreach ($relatedProduct as $content)
                                                <div class="">
                                                    <a href="{{ url($content->slug) }}">
                                                        <article class="shadow">
                                                            @if (isset($content->images['thumb']))
                                                                <div><img width="150" height="150px"
                                                                        src="{{ $content->images['images']['small'] }}"
                                                                        alt="{{ $content->title }}"></div>
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
                                        <h2>Related content with {{ $detail->title }}</h2>
                                        <div class="flex one two-500 four-900 center ">

                                            {{--$data['newPost']--}}
                                            @foreach ($relatedPost as $content)
                                                <div>
                                                    <article>
                                                        @if (isset($content->images['thumb']))
                                                            <div><img src="{{ $content->images['thumb'] }}  alt="
                                                                    {{ $content->title }} "></div>
                             @endif
                                                                <footer>
                                                                    <h2><a href="{{ $content->slug }}">
                                                                            {{ $content->title }}</a></h2>
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
                                    <div>Comments</div>
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
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                                                </div>
                                            @endif
                                            <form action="{{ route('comment.store') }}#comment" id="comment" method="post">
                                                <input type="hidden" name="content_id" value="{{ $detail->id }}">

                                                @csrf
                                                <div>
                                                    <label for="comment_name">Name:</label>
                                                    <input id="comment_name" type="text" name="name"
                                                        value="{{ old('name') }}">
                                                </div>
                                                <div>
                                                    <label for="comment-text">Comment:</label>
                                                    <textarea id="comment-text"
                                                        name="comment">{{ old('comment') }}</textarea>
                                                </div>
                                                <button class="button button-blue g-recaptcha"
                                                    data-sitekey="reCAPTCHA_site_key" data-callback='onSubmit'
                                                    data-action='submit'>Send</button>
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





                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
