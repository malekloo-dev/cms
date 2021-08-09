<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Article",
        "name": "{{ $detail->title }}",
        "datePublished":"{{ $detail->publish_date }}",
        "dateModified":"{{ $detail->updated_at }}",
        "description": "{{ clearHtml($detail->description) }}",
        "author":{
            "@type":"Organization",
            "name":"{{ env('TEMPLATE_NAME') }}"
        },
        "publisher":{
            "@type":"Organization",
            "name":"{{ env('TEMPLATE_NAME') }}",
            "logo":"{{ url(env('TEMPLATE_NAME') . '/img/logo-96-96.png') }}"
        },
        "headline":"{{ $table_of_content[0]['label']??$detail->title }}",
        "mainEntityOfPage":"{{ Request::url() }}",
@if (isset($detail->images['images']['small']))
        "image": [
            "{{ url('/').$detail->images['images']['small'] }}",
            "{{ url('/').$detail->images['images']['medium'] }}",
            "{{ url('/').$detail->images['images']['large'] }}"
        ]
@endif
      }
</script>
