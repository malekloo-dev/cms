<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "{{ $detail->title }}",

        @if (isset($detail->images['images']['small']))
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
    {!! isset($attr['value']) ? $attr['value'] :'' !!}

        "description": "@foreach($editorModule as $key=>$module) @if ($module['type']=='description') {{clearHtml($module['content'])}} @endif @if ($module['type']=='attr'){!!  "مشخصا فنی : "!!}@foreach($module['content'] as $key=>$attr) {!! isset($attr['field']) ? clearHtml($attr['field']) :'' !!} :   {!! isset($attr['value']) ? clearHtml($attr['value']) :'' !!} - @endforeach @endif @endforeach",
        "sku": "{{$detail->id}}",
        "mpn": "{{$detail->id}}",
        "brand":
        {
            "@type": "Brand",
            "name": "{{ $detail->attr['brand'] ?? 'darbkala' }}"
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

        @if($detail->comments->count())
            @php $rateSum = $rateAvrage =  $jj = $j = 0;  @endphp
            @foreach ($detail->comments as $comment)
                @if($comment['name'] !='' && $comment['comment'] != '')
                    @php $jj++; @endphp
                @endif
                @php $rateSum = $rateSum + $comment['rate']; @endphp
            @endforeach
        @endif
        @if($detail->comments->where('name','<>','')->count())
        ,"review":
        [
            @foreach ($detail->comments as $comment)
                @if($comment['name'] !='' && $comment['comment'] != '')
                    @php $j++; @endphp
                    {
                        "@type":"review",
                        "author":"{{ $comment['name'] }}",
                        "datePublished":"{{ $comment['created_at'] }}",
                        "reviewBody":"{!! str_replace('"',"'",$comment['comment']) !!}",
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
        ]
        @endif

        @if($detail->comments->count())
        ,"aggregateRating":
        {
            "@type": "AggregateRating",
            "ratingValue": "{{ intval($rateSum / count($detail->comments)) }}",
            "ratingCount": "{{ count($detail->comments) }}",
            "bestRating": "5",
            "worstRating": "0"
        }
        @endif
}
</script>
