<script type="application/ld+json">
    {
        "@context": "http://www.schema.org",
        "@type": "Organization",
        "name": "{{ Str::camel(env('TEMPLATE_NAME')) }}",
        "url": "{{ url('/') }}",
        "logo": "{{ url(env('TEMPLATE_NAME') . '/img/logo2x.png') }}",
        "description": "{{ $seo['meta_description'] }}",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "هفت تیر",
            "addressLocality": "تهران",
            "addressRegion": "تهران",
            "postalCode": "13589331",
            "addressCountry": "ایران"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "telephone": "+98933-1181877"
        },
        "sameAs": [
            "https://www.instagram.com/darbkala/",
            "https://www.linkedin.com/company/darbkala/"
        ]
    }
</script>
