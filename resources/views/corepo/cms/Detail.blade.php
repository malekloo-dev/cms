@extends(@env('TEMPLATE_NAME') . '.App')


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

<link href="{{ url($detail->slug) }}" rel="canonical" />


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

@auth
@if (Auth::user()->id == 1)
<div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/contents/' . $detail->id . '/edit/') }}')">
    ویرایش</div>
@endif
@endauth
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

@if (count($breadcrumb) > 0)
@include('jsonLdBreadcrumb')
@endif

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
<section class="intro" id="detail">
    <div class="grid sm:grid-cols-3 md:grid-cols-5 gap-x-5">
        <div class="pb-0 max-sm:w-full">
            @if (isset($detail->images['images']['small']))
            <figure class="image">
                <img class="" src="{{ $detail->images['images']['small'] }}" alt="{{ $detail->title }}" width="200" height="200" srcset="
                                    {{ $detail->images['images']['small'] }} 1x,
                                    {{ $detail->images['images']['large'] ?? $detail->images['images']['small'] }} 2x">

            </figure>
            @endif

        </div>
        <div class=" sm:col-span-2 md:col-span-4 pb-0">

            <h1 class="site-name py-0 align-right">{{ $detail->title }}</h1>
            <div class="website"></div>
            <div class="rate text-xs flex gap-x-1 items-center">
                @if (isset($detail->comments) && count($detail->comments))
                @php
                $rateAvrage = $rateSum = 0;
                @endphp
                @foreach ($detail->comments as $comment)
                @php
                $rateSum = $rateSum + $comment['rate'];
                @endphp
                @endforeach
                <span>
                    @for ($i = $rateSum / count($detail->comments); $i >= 1; $i--)
                    <label></label>
                    @endfor
                </span>
                @endif
                <span class="">
                    @if (isset($detail->comments) && count($detail->comments))
                    ({{ count($detail->comments) }} نفر) |
                    @endif
                    {{ $detail->viewCount }}
                    بازدید
                </span> |

                <span class=""> تاریخ انتشار:</span>
                <span class="ltr ">{{ convertGToJ($detail->publish_date) }} </span>
            </div>

            <div class="w-full pb-0">
                {!! $detail->brief_description !!}
            </div>
        </div>

    </div>
</section>

<section class="content-detail" id="">
    <div class="grid  md:grid-cols-5 gap-1">

        <div class="md:col-span-4 shadow">
            <div class="">
                <ul>
                    @foreach ($table_of_content as $key => $item)
                    <li class="toc1">
                        <a id="test" href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                    </li>
                    @endforeach

                </ul>
                @include(@env('TEMPLATE_NAME') . '.DescriptionModule')
            </div>
        </div>
        <div class=" shadow">
            <div class="">
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
                <ul class="max-sm:flex max-sm:flex-wrap max-sm:gap-x-4">
                    @foreach ($sideCategory['data'] as $item)
                    <li>
                        <a href="{{ url($item->slug) }}">{{ $item->title }}</a>
                    </li>
                    @endforeach
                </ul>
                @endisset


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
                    @foreach ($relatedProduct as $content)
                    <div>
                        <article>
                            @if (isset($content->images['images']['small']))
                            <div><img loading="lazy" src="{{ $content->images['images']['small'] }}"></div>
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
                <div class="flex two six-900 center">
                    @foreach ($relatedPost as $content)
                    <div>
                        <a href="{{ $content->slug }}">
                            <article>
                                @if (isset($content->images['images']['small']))
                                <div><img width="150" height="150" loading="lazy" src="{{ $content->images['images']['small'] }}">
                                </div>
                                @endif
                                <footer>
                                    <h3 class=" font-09"> {{ $content->title }}</h3>
                                </footer>
                            </article>
                        </a>
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

            @include('corepo.Comment')

        </div>
    </div>
</section>

@endsection
