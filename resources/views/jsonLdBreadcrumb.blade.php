<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            @foreach ($breadcrumb as $index => $item)

                {
                    "@type": "ListItem",
                    "position": {{ count($breadcrumb) - $index }},
                    "item": {
                        "@id": "{{ url($item['slug']) }}",
                        "name": "{{ $item['title'] }}"
                    }
                } @if ($index != array_key_last($breadcrumb)) , @endif
            @endforeach
        ]
    }
</script>
