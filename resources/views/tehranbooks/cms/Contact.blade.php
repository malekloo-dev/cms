@extends(@env('TEMPLATE_NAME').'.App')

@section('head')
    {{-- <meta property="og:image" content="{{ url($detail->images['images']['medium'] ?? '') }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W') }}" />
    <meta property="og:image:height"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H') }}" />
    <meta property="og:image:alt" content="{{ $detail->title }}" /> --}}
@endsection
@section('footer')
@auth
    @if ((Auth::user()->id) == 1)
        <div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/category/'.$detail->id.'/edit/') }}')">ویرایش</div>
    @endif
    @endauth
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
        <section class="breadcrumb my-0 py-0">
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


    <section class="" id="">
        <div class="flex justify-center">
            <div class="w-1/2 ">
                <h1 class="p-0 m-0">تماس با گالری طلای ایدن</h1>


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
                                    <input type="text" class="w-full p-1" value="{{ old('name') }}" placeholder="نام" name="name"
                                        title="Name">
                                </div>
                                <div class="control">
                                    <input type="text"  class="w-full p-1" value="{{ old('lastname') }}" placeholder="نام خانوادگی "
                                        name="lastname" title="نام خانوادگی">
                                </div>
                                <div class="control">
                                    <textarea name="comment"  placeholder="پیام" class="w-full p-1" title="" data-autosize-on="true"
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
