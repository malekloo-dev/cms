@extends(@env('TEMPLATE_NAME').'.App')

@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->brief_description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->brief_description))

@if (isset($detail->images['images']['medium']))
@section('twitter:image', url($detail->images['images']['medium']))

@section('og:image', url($detail->images['images']['medium']))
@section('og:image:type', 'image/jpeg')
@section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
@section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
@section('og:image:alt', $detail->title)

@endif


@section('head')
    <link rel="stylesheet" href="{{ asset('/detail.category.css') }}">

    @if (json_decode($relatedProduct->toJson())->prev_page_url != null)
        <link rel="prev" href="{{ json_decode($relatedProduct->toJson())->prev_page_url }}">
    @endif
    @if (json_decode($relatedProduct->toJson())->next_page_url != null)
        <link rel="next" href="{{ json_decode($relatedProduct->toJson())->next_page_url }}">
    @endif

    <link href="{{$seo['url']}}" rel="canonical" />

@endsection


@section('footer')



    <script src="{{ asset('/siema.min.js') }}"></script>
    <script>
        var w;
        var perPageNumber;

        function perPage() {
            w = window.innerWidth;
            if (w <= 500) {
                perPageNumber = 1;
            } else if (w <= 768) {
                perPageNumber = 5;
            } else if (w <= 1024) {
                perPageNumber = 5;
            } else {
                perPageNumber = 7;
            }
        }


        document.getElementsByTagName("BODY")[0].onresize = function() {
            mySiema.destroy();
            perPage();
            mySiema.init();
        };


        perPage();
        var mySiema = new Siema({
            selector: '.siema',
            duration: 200,
            easing: 'ease-out',
            perPage: perPageNumber,
            startIndex: 0,
            draggable: true,
            multipleDrag: true,
            threshold: 20,
            loop: false,
            rtl: true,
            onInit: () => {},
            onChange: () => {

            },
        });
        document.querySelector('.prev2').addEventListener('click', () => mySiema.prev());
        document.querySelector('.next2').addEventListener('click', () => mySiema.next());

    </script>

    @auth
        @if (Auth::user()->id == 1)
            <div class="btn btn-info edit-button"
                onclick="window.open('{{ url('/admin/category/' . $detail->id . '/edit/') }}')">
                ویرایش</div>
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

    @include('jsonLdFaq')

    @if (count($breadcrumb)>0)
        @include('jsonLdBreadcrumb')
    @endif

    @if (count($breadcrumb))
        <section class="breadcrumb">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/">خانه </a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a title="{{ $item['title'] }}" href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    @if (count($subCategory))
        <section class=" category-section "  id="index-best-view">
            <div class="flex one relative">
                <div class="siema p-0">
                    @foreach ($subCategory as $content)
                        <a href="{{ $content->slug }}">
                            <div class="hover text-center">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        <img  loading="lazy" src="{{ $content->images['images']['small']  }}"
                                            alt="{{ $content->title }}" width="{{ env('CATEGORY_SMALL_W') }}" height="{{ env('CATEGORY_SMALL_H') }}" srcset="
                                            {{ $content->images['images']['small']  }} {{ env('CATEGORY_SMALL_W') }}w,
                                            {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                            {{ $content->images['images']['large'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_LARGE_W') }}w">
                                        <figcaption>
                                            <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                        </figcaption>
                                    </figure>
                                @else
                                    <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                @endif

                            </div>
                        </a>
                    @endforeach

                </div>
                <a class="prev2">&#10094;</a>
                <a class="next2">&#10095;</a>



            </div>
        </section>
    @endif

    @if (count($relatedProduct))
        <section class="products mt-5" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="">

                        <div class="flex one two-500 four-900 center ">

                            {{-- $data['newPost'] --}}
                            @foreach ($relatedProduct as $content)
                                <div>
                                    <article>
                                        @if (isset($content->images['images']['small']))
                                            <figure class="image">
                                                <img  loading="lazy" src="{{ $content->images['images']['small']  }}"
                                                    sizes="(max-width:{{ env('ARTICLE_SMALL_W') }}px) 100vw {{ env('ARTICLE_SMALL_W') }}px {{ ENV('ARTICLE_MEDIUM_W') }}px"
                                                    alt="{{ $content->title }}" width="100" height="100"
                                                    srcset="
                                                        {{ $content->images['images']['small']  }} {{ env('ARTICLE_SMALL_W') }}w,
                                                        {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} 2x">
                                            </figure>

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
            </div>
        </section>
    @endif

    <section class="index-items bg-pink mt-0 mb-0">
        <div class="flex one">
            <div>
                <h1>{{ $detail->title ?? '' }}</h1>
                @isset($relatedPost)
                    <div class="flex one three-500 five-900   ">
                        @foreach ($relatedPost as $content)
                            <div>
                                <a href="{{ $content->slug }}">
                                    <article class="shadow2">
                                        @if (isset($content->images['images']['small']))
                                            <figure class="image">
                                                <img  loading="lazy" src="{{ $content->images['images']['small']  }}"
                                                    width="198" height="100" alt="{{ $content->title }}">
                                            </figure>
                                        @endif

                                        <div class="title">{{ $content->title }}</div>
                                        <div class="info">
                                            {!! readMore($content->brief_description, 250) !!}
                                        </div>
                                        <div class="rate mt-1">
                                            @if (count($content->comments))
                                                @php
                                                    $rateAvrage = $rateSum = 0;
                                                @endphp
                                                @foreach ($content->comments as $comment)
                                                    @php
                                                        $rateSum = $rateSum + $comment['rate'];
                                                    @endphp
                                                @endforeach
                                                @for ($i = $rateSum / count($content->comments); $i >= 1; $i--)
                                                <label></label>

                                                @endfor
                                            @endif
                                        </div>

                                    </article>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    {{ $relatedPost->links('pagination::default') }}
                @endisset
            </div>
        </div>
    </section>



    <section class="category-content" id="">
        <div class="flex one ">
            <div class="font-08">
                <span class="rate mt-1">
                    @if (count($detail->comments))
                        @php
                        $rateAvrage = $rateSum = 0;
                        @endphp
                        @foreach ($detail->comments as $comment)
                            @php
                            $rateSum = $rateSum + $comment['rate'] ;
                            @endphp
                        @endforeach
                        @for ($i = $rateSum / count($detail->comments); $i >= 1; $i--)
                        <label></label>

                        @endfor
                        <span class="font-07">({{ count($detail->comments) }} نفر)   </span>
                    @endif
                </span> |
                {{ $detail->viewCount }} بار دیده شده |
            </div>

            <div>
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

    <section class="comments bg-gray mt-0 mb-0">
        <div class="flex one">
            <div>
                <div>نظرات شما درباره {{ $detail->title }}</div>
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
                        <form action="{{ route('comment.client.store') }}#comment" id="comment" method="post">
                            <input type="hidden" name="content_id" value="{{ $detail->id }}">

                            @csrf
                            <div>
                                <div class="rating">
                                    <span>امتیاز: </span>
                                    <input name="rate" type="radio" id="st5" {{ old('rate') == '5' ? 'checked' : '' }}
                                        value="5" />
                                    <label for="st5" title="عالی"></label>
                                    <input name="rate" type="radio" id="st4" {{ old('rate') == '4' ? 'checked' : '' }}
                                        value="4" />
                                    <label for="st4" title="خوب"></label>
                                    <input name="rate" type="radio" id="st3" {{ old('rate') == '3' ? 'checked' : '' }}
                                        value="3" />
                                    <label for="st3" title="معمولی"></label>
                                    <input name="rate" type="radio" id="st2" {{ old('rate') == '2' ? 'checked' : '' }}
                                        value="2" />
                                    <label for="st2" title="ضعیف"></label>
                                    <input name="rate" type="radio" id="st1" {{ old('rate') == '1' ? 'checked' : '' }}
                                        value="1" />
                                    <label for="st1" title="بد"></label>
                                    <span id="rating-hover-label"></span>
                                </div>
                            </div>

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
                        @if ($comment['name'] != '' && $comment['comment'] != '')
                            <div class="comment">
                                <div class="aside">
                                    <div class="name">{{ $comment['name'] }}</div>
                                    <div class="date">{{ convertGToJ($comment['created_at']) }}</div>
                                </div>
                                <div class="article">
                                    <div>
                                        @for ($i = $comment->rate; $i >= 1; $i--)
                                        <label></label>

                                        @endfor
                                    </div>
                                    <div class="text">{!! $comment['comment'] !!}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>


@endsection
