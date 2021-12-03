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

    @if (json_decode($relatedProduct->toJson())->prev_page_url != null)
        <link rel="prev" href="{{ json_decode($relatedProduct->toJson())->prev_page_url }}">
    @endif
    @if (json_decode($relatedProduct->toJson())->next_page_url != null)
        <link rel="next" href="{{ json_decode($relatedProduct->toJson())->next_page_url }}">
    @endif
    <link href="{{$seo['url']}}" rel="canonical" />

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
    @if (count($breadcrumb)>0)
        @include('jsonLdBreadcrumb')
    @endif
    @if (count($relatedProduct))
        @include('jsonLdRelatedProductItemlist')
    @endif
    {{--@if (count($relatedProduct))
        @include('jsonLdRelatedProduct')
    @endif--}}

    @include('jsonLdFaq')


    @if (count($breadcrumb))
        <section class="breadcrumb">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/">درب کالا</a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a title="{{ $item['title'] }}" href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <section class="p-0 ">
        <div class="flex one">
            <h1 class="p-0">{{ $detail->title }}</h1>
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

            @if($detail->brief_description !='')
                <div class="bg-orange-light  pt-1">
                    {!! clearHtml($detail->brief_description) !!}
                </div>
            @endif
        </div>
    </section>


    @if (count($relatedProduct) == 0 and count($subCategory))
        <section class="category-list m-0 p-0" id="index-best-view">
            <div class="flex two three-500 five-900 mobile-horizantal">
                @foreach ($subCategory as $content)
                    <div class="item flex">

                        <div class="border hover-box shadow p-0 full">
                            <a href="{{ $content->slug }}">
                                @if (isset($content->images['images']['small']))
                                <div class="flex one three-700 height-100 ">
                                        <div class="p-0"><img width="{{ env('CATEGORY_SMALL_W') }}" height="{{ env('CATEGORY_SMALL_H') }}" alt="{{ $content->title }}" src="{{ $content->images['images']['small'] }}" /></div>
                                        <div class="one two-third-700 p-1">
                                            <h2 class="p-0 font-08"> {{ $content->title }}</h2>
                                        </div>
                                        </div>
                                    @else
                                        <h2 class="p-1 font-08"> {{ $content->title }}</h2>
                                    @endif
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif


    @if (count($relatedProduct))
        <section class="category-products mt-1" id="products">
            <div class="flex one four-800 ">
                <div class="one-fourth-800 p-0 filter">
                    @if (count($subCategory))
                        <section class="category-list m-0 p-0" id="index-best-view">
                            <div class="flex two three-500 one-800 mobile-horizantal">

                                        @foreach ($subCategory as $content)
                                            <div class="item flex">

                                                <div class="border hover-box shadow p-0 full">
                                                    <a href="{{ $content->slug }}">
                                                        <div class="flex one three-700 height-100 ">
                                                            @if (isset($content->images['images']['small']))
                                                                <div class="p-0"><img width="{{ env('CATEGORY_SMALL_W') }}" height="{{ env('CATEGORY_SMALL_H') }}" alt="{{ $content->title }}" src="{{ $content->images['images']['small'] }}" /></div>
                                                            @endif
                                                            <div class="one two-third-700 p-1">
                                                                <h2 class="p-0 font-08"> {{ $content->title }}</h2>
                                                            </div>

                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                            </div>
                        </section>
                    @endif
                </div>
                <div class="three-fourth-800 p-0">
                    <div class="">

                        <div class="flex one">


                            @foreach ($relatedProduct as $content)
                                <div>

                                    <article class="shadow">
                                        <div>
                                            @if (isset($content->images['images']['small']))

                                                <a href="{{ $content->slug }}">
                                                <picture>
                                                    <img  loading="lazy"
                                                        src="{{ str_replace(' ', '%20', $content->images['images']['small']) ?? '' }}"
                                                        {{-- srcset="{{ str_replace(' ', '%20', $content->images['images']['small']) ?? '' }} ,
                                                        {{ str_replace(' ', '%20', $content->images['images']['medium']) ?? '' }} 2x"  --}}
                                                        alt="{{ $content->title }}"
                                                        width="{{ env('PRODUCT_SMALL_W') }}"
                                                        height="{{ env('PRODUCT_SMALL_H') }}">
                                                </picture>

                                                </a>
                                            @endif

                                        </div>
                                        <div class="info">

                                             <h5> <a href="{{ $content->slug }}"> {{ $content->title }}</a></h5>
                                            <div class="brief">
                                                {!! readMore($content->brief_description, 250) !!}
                                            </div>

                                        </div>
                                        <div>

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
                                                    <span class="font-08">({{ count($content->comments) }} نفر)</span>
                                                @endif
                                            </div>



                                            <div class="view-count">{{ $content->viewCount }} بار دیده شده</div>



                                            <div class="brand">برند: {{ $content->attr['brand'] }}</div>

                                            @if(count($content->companies))

                                                <div class="company-logo">
                                                    @if (isset($content->companies->first()->logo) && $content->companies->first()->logo['small'] != '' && file_exists(public_path($content->companies->first()->logo['small'])))
                                                        <img src="{{ url($content->companies->first()->logo['small']) }}" width="30" height="30" class="border-radius-50" alt="" />
                                                    @endif
                                                    {{ $content->companies->first()->name ?? '' }}
                                                </div>
                                            @endif


                                            <p class="price text-green">
                                                <span itemprop="price" content="@convertCurrency($content->attr['price'])">  @convertCurrency($content->attr['price']) </span>
                                                <span itemprop="priceCurrency" content="IRR" >تومان </span>
                                           </p>
                                        </div>
                                    </article>

                                </div>
                            @endforeach
                        </div>
                        {{ $relatedProduct->links() }}
                    </div>
                </div>
            </div>
        </section>
    @endif





    @if (!Request::get('page'))


    @if(isset($relatedCompany) && $relatedCompany->count())
    <section class="index-items  bg-gray-dark mb-0">
        <h2>کمپانی ها</h2>
        <div class="flex one">
            <div>
                <div class="flex two three-500  five-900 center ">
                    @foreach ($relatedCompany as $content)
                        <div>
                            <a class="hover shadow2" href="{{ url('profile/' . $content->id) }}">

                                @if (isset($content->logo) && isset($content->logo))
                                    <img alt="{{ $content->name ?? '' }}" class="img-contain border-radius-50 mt-1"
                                        width="{{ env('COMPANY_MEDIUM_W') }}" height="{{ env('COMPANY_MEDIUM_H') }}"
                                        src="{{ $content->logo['medium'] ?? '' }}">
                                @endif

                                <div class="flex ">
                                    <div class="p-0 ">
                                        {{ $content->name }}
                                    </div>
                                    <div class="p-0 ">
                                        <svg class="p-0" width="13" height="13" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                            d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                            fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                            fill="currentColor" />
                                        </svg>
                                        <span class="p-0">{{ $content->viewCount }}</span>
                                    </div>

                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif


    <section class="" id="">
        <div class="flex one ">
            <div class="bg-white p-1 border-radius-5">

                <div class="flex one two-700">
                    <div class="two-third-700">
                        <ul>
                            @foreach ($table_of_content as $key => $item)
                                <li class="toc1">
                                    <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                </li>
                            @endforeach

                        </ul>

                    </div>
                    <div class="third-700">
                        @if (isset($detail->images['images']))
                            <picture>


                                <img loading="lazy" src="{{ $detail->images['images']['medium'] ?? '' }}"
                                     alt="{{ $detail->title }}"

                                     width="{{ env('CATEGORY_MEDIUM_W') }}"
                                     height="{{ env('CATEGORY_MEDIUM_W') }}">
                            </picture>
                        @endif


                    </div>

                </div>

                @include(@env('TEMPLATE_NAME').'.DescriptionModule')

            </div>
        </div>
    </section>

@endif

        {{--post&label=relatedPost&var=relatedPost&count=5 --}}
        @if (isset($relatedPost) && count($relatedPost))
            <section class="articles bg-orange mb-0" id="articles">
                <div class="flex one ">
                    <div class="">
                        <h2>مقاله های زیر مجموعه {{ $detail->title }}</h2>
                        <div class="flex one two-500 five-900 center ">

                            @foreach ($relatedPost as $content)

                                <div>
                                    <a href="{{ $content->slug }}">
                                        <article class="shadow1">
                                            @if (isset($content->images['images']['medium']))
                                                <div><img loading="lazy"
                                                    alt="{{ $content->title }}"
                                                    src="{{ $content->images['images']['medium'] }}"

                                                    width="{{ env('ARTICLE_MEDIUM_W') }}"
                                                    height="{{ env('ARTICLE_MEDIUM_H') }}"
                                                    ></div>
                                            @endif
                                            <div class="p-1">
                                                <h3> {{ readmore($content->title, 80) }}</h3>
                                                {!! readmore($content->brief_description, 210) !!}
                                            </div>
                                        </article>
                                    </a>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </section>
        @endif



    @if (!Request::get('page'))

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


        <div class="mobile-menu">
            <ul>
                <li><a href="#products">محصولات</a></li>
                <li><a href="#articles">مقالات</a></li>
            </ul>
        </div>

    @endif

@endsection
