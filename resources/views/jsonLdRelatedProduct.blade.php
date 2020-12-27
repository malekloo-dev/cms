<script type="application/ld+json">
    @foreach($relatedProduct as $key => $content)

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
        "aggregateRating":
        {
            "@type": "AggregateRating",
            "ratingValue": "{{ $content->attr['rate'] }}",
            "ratingCount": "{{ $content->viewCount }}",
            "bestRating": "5",
            "worstRating": "0"
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
                "name": "ریموت یدک"
            }
        }
    }
    @isset($relatedProduct[$key+1])
        {{","}}
    @endisset
@endforeach

]
</script>
