
@section('twitter:title', $detail->title)@endsection
@section('twitter:description', clearHtml($detail->brief_description))@endsection

@section('og:title', $detail->title)@endsection
@section('og:description', clearHtml($detail->brief_description))@endsection

@if (isset($detail->images['images']['medium']))
@section('twitter:image', url($detail->images['images']['medium']))@endsection

@section('og:image', url($detail->images['images']['medium']))@endsection
@section('og:image:type', 'image/jpeg')@endsection
@section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))@endsection
@section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))@endsection
@section('og:image:alt', $detail->title)@endsection

@endif
