@extends(@env('TEMPLATE_NAME').'.App')
@section('Content')

    @php
        $tableOfImages=tableOfImages($detail->description);
        $append='';
    @endphp
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
                    "{{ $content->images['images']['300'] }}",
                    "{{ $content->images['images']['600'] }}",
                    "{{ $content->images['images']['900'] }}"
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

    @if (count($breadcrumb))

        <section class="" id="">
            <div class="flex one ">
                <div>
                    <div class="shadow ">
                        <a class="button" href="/">iran remote</a>

                        @foreach($breadcrumb as $key=>$item)

                            <a class="button" href="{{$item['slug']}}">{{$item['title']}}</a>
                        @endforeach


                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (count($subCategory))
        <section class="products" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="shadow">
                        <h2>زیر دسته های {{$detail->title}}</h2>
                        <div class="flex one two-500 four-900 center ">

                            {{--$data['newPost']--}}
                            @foreach($subCategory as $content)
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

    @if (count($relatedProduct))
        <section class="products" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="shadow">
                        <h2>محصولات زیر مجموعه {{$detail->title}}</h2>
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
                        <h2>مقاله های زیر مجموعه {{$detail->title}}</h2>
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


    <section class="" id="">
        <div class="flex one ">
            <div>

                <div class="shadow ">
                    <h1 class="">{{ $detail->title }}</h1>
                    {!! $detail->description !!}
                </div>
            </div>
        </div>
    </section>
@endsection
