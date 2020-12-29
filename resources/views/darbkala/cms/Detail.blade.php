@extends(@env('TEMPLATE_NAME').'.App')
@section('js')
    {{-- recaptcha --}}
    {{--
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        function callbackThen(response) {
            // read HTTP status
            console.log(response.status);

            // read Promise object
            response.json().then(function(data) {
                console.log(data);
            });
        }

        function callbackCatch(error) {
            console.error('Error:', error);
            alert('صفحه را مجدد بارگذاری نمایید.')
        }

    </script>
    {!! htmlScriptTagJsApi([
    'callback_then' => 'callbackThen',
    'callback_catch' => 'callbackCatch',
    ]) !!} --}}
@endsection

@section('Content')
    @php
    $tableOfImages=tableOfImages($detail->description);
    $append='';
    @endphp

    @if ($detail->attr_type == 'product')
        @include('jsonLdProduct')
    @endif

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

    <section class="product-detail" id="">
        <div class="flex one ">
            <div>
                <div class="top-page">
                    <picture>
                        <source media="(min-width:{{ env('PRODUCT_MEDIUM') }}px)"
                            srcset="{{ str_replace(' ', '%20', $detail->images['images']['medium']) ?? '' }} , {{ str_replace(' ', '%20', $detail->images['images']['large']) ?? '' }} 2x">
                        <source media="(min-width:{{ env('PRODUCT_SMALL') }}px)"
                            srcset="{{ str_replace(' ', '%20', $detail->images['images']['small']) ?? '' }} , {{ str_replace(' ', '%20', $detail->images['images']['medium']) ?? '' }} 2x">
                        <img src="{{ $detail->images['images']['medium'] ?? '' }}"
                            sizes="(max-width:{{ env('PRODUCT_MEDIUM') }}px) 100vw  {{ ENV('PRODUCT_MEDIUM') }}px {{ ENV('PRODUCT_LARGE') }}px"
                            alt="{{ $detail->title }}" width="{{ env('PRODUCT_MEDIUM') }}"
                            height="{{ env('PRODUCT_MEDIUM') }}">
                    </picture>
                    <div>
                        <h1 class="">{{ $detail->title }}</h1>
                        <div>
                            <span class="price text-green "> @convertCurrency($detail->attr['price']) تومان</span>
                            <span class="rate mt-1">
                                @for ($i = $detail->attr['rate']; $i >= 1; $i--)
                                    <img width="20" height="20"
                                        srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                        src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
                                @endfor
                            </span> |
                            {{ $detail->viewCount }} بار دیده شده |
                            تاریخ انتشار: <span class="ltr">{{ convertGToJ($detail->publish_date) }} </span> |
                        </div>
                    </div>
                </div>


                <ul>
                    @foreach ($table_of_content as $key => $item)
                        <li class="toc1">
                            <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                        </li>
                    @endforeach

                </ul>


                @include(@env('TEMPLATE_NAME').'.DescriptionModule')


            </div>
        </div>
    </section>

    @if (count($relatedProduct))
        <section class="products bg-gray m-0 pt-1 pb-1" id="index-best-view">
            <div class="flex one ">
                <div>
                    <h2>محصولات مرتبط {{ $detail->title }}</h2>
                    <div class="flex one two-500 four-900  ">

                        {{--$data['newPost']--}}
                        @foreach ($relatedProduct as $content)
                            <div class="">
                                <a href="{{ url($content->slug) }}">
                                    <article class="shadow">
                                        @if (isset($content->images['thumb']))
                                            <div><img width="150" height="150px"
                                                    src="{{ $content->images['images']['small'] }}"
                                                    alt="{{ $content->title }}"></div>
                                        @endif
                                        <footer>
                                            <h3> {{ $content->title }}</h3>
                                            {!! $content->brief_description !!}
                                        </footer>
                                    </article>
                                </a>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </section>
    @endif

    @if (count($relatedPost))
        <section class="products" id="index-best-view">
            <div class="flex one ">
                <div>
                    <h2>مقاله های مرتبط {{ $detail->title }}</h2>
                    <div class="flex one two-500 four-900 center ">

                        {{--$data['newPost']--}}
                        @foreach ($relatedPost as $content)
                            <div>
                                <article>
                                    @if (isset($content->images['thumb']))
                                        <div><img src="{{ $content->images['thumb'] }}  alt=" {{ $content->title }} "></div>
                                  @endif
                                            <footer>
                                                <h2><a href="{{ $content->slug }}"> {{ $content->title }}</a></h2>
                                                {!! $content->brief_description !!}
                                            </footer>
                                </article>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </section>
    @endif


    <section class="comments bg-gray mt-0 mb-0">
        <div class="flex one">
            <div>
                <div>نظرات شما</div>
                <div>
                    <div class="comment-form">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif

                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif
                        <form action="{{ route('comment.store') }}#comment" id="comment" method="post">
                            <input type="hidden" name="content_id" value="{{ $detail->id }}">

                            @csrf
                            <div>
                                <label for="comment_name">نام:</label>
                                <input id="comment_name" type="text" name="name" value="{{ old('name') }}">
                            </div>
                            <div>
                                <label for="comment-text">پیام:</label>
                                <textarea id="comment-text" name="comment">{{ old('comment') }}</textarea>
                            </div>
                            <button class="button button-blue g-recaptcha" data-sitekey="reCAPTCHA_site_key"
                                data-callback='onSubmit' data-action='submit'>ارسال نظر</button>
                        </form>
                    </div>

                    @foreach ($detail->comments as $comment)
                        <div class="comment">
                            <div class="aside">
                                <div class="name">{{ $comment['name'] }}</div>
                                <div class="date">{{ convertGToJ($comment['created_at']) }}</div>
                            </div>
                            <div class="article">
                                <div class="text">{{ $comment['comment'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
