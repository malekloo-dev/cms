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
                "name": "{{ env('TEMPLATE_NAME') }}"
            }
        }
        @if(isset($detail->comments))
        ,"review":
        [
            @php
            $rateCount = $rateAvrage = 0;
            @endphp

            @foreach ($detail->comments as $comment)

            @php
            $rateCount++;
            $rateAvrage = $rateAvrage + $comment['rate'] / $rateCount;
            @endphp
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
                @if(!$loop->last)
                ,
                @endif
            @endforeach
        ],
        "aggregateRating":
        {
            "@type": "AggregateRating",
            "ratingValue": "{{ intval($rateAvrage) }}",
            "ratingCount": "{{ $rateCount }}",
            "bestRating": "5",
            "worstRating": "0"
        }
        @endif
    }
</script>
