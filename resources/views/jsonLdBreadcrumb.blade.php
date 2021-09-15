<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
                 {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "{{ url('/') }}",
                        "name": "{{ env('SITE_NAME','خانه')}}"
                    }
                },
            @foreach ($breadcrumb as $index => $item)

                {
                    "@type": "ListItem",
                    "position": {{ count($breadcrumb) - ($index-1) }},
                    "item": {
                        "@id": "{{ url($item['slug']) }}",
                        "name": "{{ $item['title'] }}"
                    }
                } @if ($index != array_key_last($breadcrumb)) , @endif
            @endforeach
        ]
    }
</script>
