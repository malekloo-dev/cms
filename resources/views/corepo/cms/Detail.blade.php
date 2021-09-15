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
    {{-- <meta property="og:image" content="{{ url($detail->images['images']['medium'] ?? '') }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W') }}" />
    <meta property="og:image:height"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H') }}" />
    <meta property="og:image:alt" content="{{ $detail->title }}" /> --}}

    <link rel="stylesheet" href="{{ asset('/detail.css') }}">
@endsection
@section('footer')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {

            const ratings = document.querySelectorAll('[name="rate"]');
            const labels = document.querySelectorAll('.rating > label');

            const change = (e) => {
                console.log(e.target.value);

            }
            const mouseenter = (e) => {
                document.getElementById('rating-hover-label').innerHTML = e.target.title;
            }
            const mouseleave = (e) => {

                document.getElementById('rating-hover-label').innerHTML = '';
            }

            ratings.forEach((el) => {
                el.addEventListener('change', change);
            });
            labels.forEach((el) => {
                el.addEventListener('mouseenter', mouseenter);
                el.addEventListener('mouseleave', mouseleave);
            });
        });

    </script>

@endsection
@section('Content')
    @php
    $tableOfImages = tableOfImages($detail->description);
    $append = '';
    @endphp

    @if ($detail->attr_type == 'product')
        @include('jsonLdProduct')
    @endif
    @include('jsonLdFaq')

    @if ($detail->attr_type == 'article')
        @include('jsonLdArticle')
    @endif

    @if (count($breadcrumb)>0)
        @include('jsonLdBreadcrumb')
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
    <section class="intro" id="detail">
        <div class="flex one two-500  ">
            <div class="fourth-500">
                @if (isset($detail->images['images']['small']))
                    <figure class="image">
                        <img src="{{ $detail->images['images']['small']  }}"
                            alt="{{ $detail->title }}" width="189" height="100" srcset="
                                    {{ $detail->images['images']['small']  }} 1x,
                                    {{ $detail->images['images']['large'] ?? $detail->images['images']['small'] }} 2x">

                    </figure>
                @endif

            </div>
            <div class="three-fourth-500">
                <div>
                    <h1 class="site-name pt-0">{{ $detail->title }}</h1>
                    <div class="website"></div>
                    <div class="rate">

                        @if (isset($detail->comments) && count($detail->comments))
                            @php
                                $rateAvrage = $rateSum = 0;
                            @endphp
                            @foreach ($detail->comments as $comment)
                                @php
                                    $rateSum = $rateSum + $comment['rate'];
                                @endphp
                            @endforeach
                            @for ($i = $rateSum / count($detail->comments); $i >= 1; $i--)
                                <img width="20" height="20"
                                    srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                    src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
                            @endfor
                            <span class="font-08">({{ count($detail->comments) }} نفر)</span> |
                        @endif
                        <span class="font-08">
                            {{ $detail->viewCount }} بار دیده شده |
                        </span>
                        <span class="font-08"> تاریخ انتشار:</span>
                                    <span class="ltr font-08">{{ convertGToJ($detail->publish_date) }} </span> |
                    </div>
                </div>
                {!! $detail->brief_description !!}
            </div>
        </div>
    </section>

    <section class="content-detail" id="">
        <div class="flex one two-700">
            <div class="fourth-500">
                <div>
                    <div class="mb-1">محل تبلیغ شما</div>
                    {{-- images&label=adv&var=adv&count=3 --}}
                    @if (isset($adv) && isset($adv['images']))
                        <div class="text-center">
                            @foreach ($adv['images'] as $k => $content)
                                <a target="_blanck" href="{{ $adv['url'][$k] }}" @if (!isset($adv['follow'][$k])) rel="nofollow" @endif>
                                    <img width="200px" height="200px" src="{{ $content }}" alt="محل تبلیغ کریپو">
                                </a>
                            @endforeach
                        </div>
                    @endisset
                    <div>وبسایت ها</div>
                    {{-- category&label=sideCategory&var=sideCategory&count=6 --}}
                    @isset($sideCategory['data'])
                        <ul>
                            @foreach ($sideCategory['data'] as $item)
                                <li>
                                    <a href="{{ url($item->slug) }}">{{ $item->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endisset

                    <div>آخرین مقالات</div>
                    {{-- post&label=sideLastPost&var=sideLastPost&count=6&child=true --}}
                    @isset($sideLastPost['data'])
                        <ul class="p-0">
                            @foreach ($sideLastPost['data'] as $content)
                                <li class="flex ">
                                    <a class="flex three" href="{{ url($content->slug) }}">
                                        @if (isset($content->images['images']['small']))
                                            <div class="third"><img style="width: 100%" alt="{{ $content->title }}"
                                                    src="{{ $content->images['images']['small'] }}"></div>
                                        @endif
                                        <div class="two-third">

                                            {{ $content->title }}
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endisset
            </div>
        </div>
        <div class="three-fourth-500 ">
            <div>
                <ul>
                    @foreach ($table_of_content as $key => $item)
                        <li class="toc1">
                            <a id="test" href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                        </li>
                    @endforeach

                </ul>
                @include(@env('TEMPLATE_NAME').'.DescriptionModule')
            </div>
        </div>
    </div>
</section>

@if (count($relatedProduct))
    <section class="products bg-gray m-0 pt-1 pb-1" id="index-best-view">
        <div class="flex one ">
            <div>
                <div class="shadow ">
                    <h2>محصولات مرتبط {{ $detail->title }}</h2>
                    <div class="flex one two-500 four-900 center ">

                        {{-- $data['newPost'] --}}
                        @foreach ($relatedProduct as $content)
                            <div>
                                <article>
                                    @if (isset($content->images['images']['small']))
                                        <div><img src="{{ $content->images['images']['small'] }}"></div>
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

@if (count($relatedPost))
    <section class="products" id="index-best-view">
        <div class="flex one ">
            <div>
                <div class="shadow">
                    <h2>مقاله های مرتبط {{ $detail->title }}</h2>
                    <div class="flex one two-500 four-900 center ">

                        {{-- $data['newPost'] --}}
                        @foreach ($relatedPost as $content)
                            <div>
                                <article>
                                    @if (isset($content->images['images']['small']))
                                        <div><img src="{{ $content->images['images']['small'] }}"></div>
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



<section class="comments bg-gray mt-0 mb-0">
    <div class="flex one">
        <div>
            <h4>نظرات شما درباره {{ $detail->title }}</h4>
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
                            <label>نام:</label>
                            <input type="text" name="name" value="{{ old('name') }}">
                        </div>
                        <div>
                            <label>پیام:</label>
                            <textarea name="comment">{{ old('comment') }}</textarea>
                        </div>
                        <button class="button button-blue g-recaptcha" data-sitekey="reCAPTCHA_site_key"
                            data-callback='onSubmit' data-action='submit'>ارسال نظر</button>
                    </form>
                </div>
                @isset($detail->comments)
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
                                            <img width="20" height="20"
                                                srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
                                        @endfor
                                    </div>
                                    <div class="text">{!! $comment['comment'] !!}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
</section>
@endsection
