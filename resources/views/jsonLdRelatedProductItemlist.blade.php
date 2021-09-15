<script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "ItemList",
            "itemListElement": [
                @foreach($relatedProduct as $key => $content)
                    {
                        "@type": "ListItem",
                        "additionalType" :"product",
                        "position": 1,
                        "name" : "{{ $content->title }}",
                        "url" : "{{ url('/').'/'.$content->slug }}",
                        @if(isset($content->images['images']['small']))
                        "image": [
                            "{{ url('/').$content->images['images']['small'] }}",
                            "{{ url('/').$content->images['images']['medium'] }}",
                            "{{ url('/').$content->images['images']['large'] }}"
                        ]
                        @endif

                    }
                    @isset($relatedProduct[$key+1])
                        {{","}}
                    @endisset
                @endforeach

            ]
        }

</script>
