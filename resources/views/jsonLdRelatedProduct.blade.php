<script type="application/ld+json">
    @foreach($relatedProduct as $key => $content)
[
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "{{ $content->title }}",

        @if(isset($content->images['thumb']))
        "image": [
            "{{ url('/').$content->images['images']['small'] }}",
            "{{ url('/').$content->images['images']['medium'] }}",
            "{{ url('/').$content->images['images']['large'] }}"
        ],
        @endif
     "description": "{{clearHtml($content->brief_description)}}",

        "sku": "{{$content->id}}",
        "mpn": "{{$content->id}}",
        "brand": {
            "@type": "Brand",
            "name": "{{ $content->attr['brand'] }}"
        },
        "offers":
        {
            "@type": "Offer",
            "url": "{{ url()->current().$content->slug }}",
            "priceCurrency": "IRR",
            "price": "{{ $content->attr['price'] ?? 0}}",
            "priceValidUntil": "2021-08-09",
            "itemCondition": "https://schema.org/UsedCondition",
            "availability": "https://schema.org/InStock",
            "seller":
            {
                "@type": "Organization",
                "name": "{{ env('TEMPLATE_NAME') }}"
            }
        }

        @if(count($content->comments))
        ,"review":
        [
            @php $rateSum = $rateAvrage =  $jj = $j = 0;  @endphp

            @foreach ($content->comments as $comment)
                @if($comment['name'] !='' && $comment['comment'] != '')
                    @php $jj++; @endphp
                @endif
                @php $rateSum = $rateSum + $comment['rate']; @endphp
            @endforeach

            @foreach ($content->comments as $comment)
                @if($comment['name'] !='' && $comment['comment'] != '')
                    @php $j++; @endphp
                    {
                        "@type":"review",
                        "author":"{{ $comment['name'] }}",
                        "datePublished":"{{ $comment['created_at'] }}",
                        "reviewBody":"{{ $comment['comment'] }}",
                        "reviewRating": {
                            "@type": "Rating",
                            "bestRating": "5",
                            "ratingValue": "{{ $comment['rate'] }}",
                            "worstRating": "0"
                        }
                    }
                    @if($j < $jj)
                        ,
                    @endif
                @endif
            @endforeach
        ],
        "aggregateRating":
        {
            "@type": "AggregateRating",
            "ratingValue": "{{ intval($rateSum / count($content->comments)) }}",
            "ratingCount": "{{ count($content->comments) }}",
            "bestRating": "5",
            "worstRating": "0"
        }
        @endif
    }
    @isset($relatedProduct[$key+1])
        {{","}}
    @endisset
    @endforeach

]
</script>
