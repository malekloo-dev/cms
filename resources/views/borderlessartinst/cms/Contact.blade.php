@extends(@env('TEMPLATE_NAME').'.App')

@section('head')
    <meta property="og:image" content="{{ url($detail->images['images']['medium'] ?? '') }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM') : env('ARTICLE_MEDIUM') }}" />
    <meta property="og:image:height"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM') : env('ARTICLE_MEDIUM') }}" />
    <meta property="og:image:alt" content="{{ $detail->title }}" />
@endsection

@section('Content')
    @php
    $tableOfImages = tableOfImages($detail->description);
    $append = '';
    @endphp
    @if (count($relatedProduct))
        @include('jsonLdRelatedProduct')
    @endif

    @if (count($breadcrumb))
        <section class="breadcrumb">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/">خانه </a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <section>
        <div class="flex one">
            <h1>{{ $detail->title }}</h1>
        </div>
    </section>


    <section class="" id="">
        <div class="flex one ">
            <div>

                @if (isset($detail->images['images']))
                    <picture>
                        <source media="(min-width:{{ env('CATEGORY_LARGE') }}px)"
                            srcset="{{ $detail->images['images']['large'] ?? '' }}">

                        <source media="(min-width:{{ env('CATEGORY_MEDIUM') }}px)"
                            srcset="{{ $detail->images['images']['medium'] ?? '' }}">

                        <source media="(min-width:{{ env('CATEGORY_SMALL') }}px)"
                            srcset="{{ $detail->images['images']['small'] ?? '' }}">

                        <img src="{{ $detail->images['images']['medium'] ?? '' }}" alt="{{ $detail->title }}"
                            width="{{ env('CATEGORY_MEDIUM') }}" height="{{ env('CATEGORY_MEDIUM') }}">
                    </picture>
                @endif

                <ul>
                    @foreach ($table_of_content as $key => $item)
                        <li class="toc1">
                            <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                        </li>
                    @endforeach

                </ul>

                @include(@env('TEMPLATE_NAME').'.DescriptionModule')

                <div class="contact-form">
                    <form action="{{ route('contact.store') }}#contact" method="post" class="" id="" novalidate="">
                        @csrf
                        @if (\Session::has('success'))
                            <div class="alert alert-success ">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="alert alert-danger ">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif

                        <fieldset>
                            <div class="row mt-1">
                                <div class="control">
                                    <input type="text" value="{{ old('name') }}" placeholder="نام" name="name"
                                        title="Name">
                                </div>
                                <div class="control">
                                    <input type="text" value="{{ old('lastname') }}" placeholder="نام خانوادگی "
                                        name="lastname" title="نام خانوادگی">
                                </div>
                                <div class="control">
                                    <textarea name="comment" placeholder="پیام" class="" title="" data-autosize-on="true"
                                        style="overflow: hidden; overflow-wrap: break-word; height: 98px;">{{ old('comment') }}</textarea>
                                </div>
                                <div class="control">
                                    <button class="btn btn-primary">
                                        ارسال
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
