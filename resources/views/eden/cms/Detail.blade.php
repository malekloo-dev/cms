@extends(@env('TEMPLATE_NAME').'.App')

@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->brief_description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->brief_description))
@section('canonical', url($detail->slug))

@if (isset($detail->images['images']['medium']))

@section('twitter:image', url($detail->images['images']['medium']))

@section('og:image', url($detail->images['images']['medium']))
@section('og:image:type', 'image/jpeg')
@section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
@section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
@section('og:image:alt', $detail->title)

@endif



@section('scripts')
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

@section('footer')
    @auth
        @if ((Auth::user()->id) == 1)
            <div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/contents/'.$detail->id.'/edit/') }}')">ویرایش</div>
        @endif
    @endauth
@endsection

@section('Content')
    @php
    $tableOfImages=tableOfImages($detail->description);
    $append='';
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

    <section class="breadcrumb my-0 py-0">
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

    <section class="product-detail mt-0 pt-0" id="">
        <div class="flex one ">
            <div class="bg-white border-radius-5">
                <div class="top-page">

                    <div>
                        <h1 id="product-name" class="">{{ $detail->title }}</h1>
                        <div>
                            <div class="flex three-500">
                                <div id="product-image" class="one thirth-500">
                                    @isset($detail->images['images']['large'])
                                        <picture>
                                            <img src="{{ $detail->images['images']['large'] ?? '' }}"
                                                loading="lazy" width="{{ env('PRODUCT_LARGE_W') }}" height="{{ env('PRODUCT_LARGE_H') }}"
                                                alt="{{ $detail->title }}">
                                        </picture>
                                    @endisset
                                </div>
                                <div class="two-third-500">
                                    @if(count($detail->companies))
                                        <div class="company-logo">
                                            <a href="{{ url('/profile/'.$detail->companies->first()->id) }}">

                                                @if (isset($detail->companies->first()->logo) && $detail->companies->first()->logo['medium'] != '' && file_exists(public_path($detail->companies->first()->logo['medium'])))
                                                {{-- @if (isset($detail->companies->first()->logo) && $detail->companies->first()->logo['medium'] == '' && !file_exists(public_path($detail->companies->first()->logo['medium']))) --}}
                                                    <img loading="lazy" src="{{ url($detail->companies->first()->logo['medium']) }}" width="50" height="50" class="border-radius-50" alt="company profile">
                                                @endif
                                                {{ $detail->companies->first()->name ?? '' }}</a>
                                        </div>
                                    @endif

                                    @isset($detail->attr['price'])
                                        <span class="price text-green ">قیمت @convertCurrency($detail->attr['price']?? 0) تومان</span>
                                    @endisset

                                    <span id="product-rate" class="rate  mt-1">
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
                                    </span>
                                    <div>

                                        {{ $detail->viewCount }} بار دیده شده |
                                        تاریخ انتشار: <span class="ltr">{{ convertGToJ($detail->publish_date) }} </span> |


                                    @lang('messages.power'):{{ $detail->power }}
                                </div>
                                        <div id="product-categories" class=" mt-1">
                                            دسته بندی :


                                            @php $countBread= count($breadcrumb)-1; $i=0; @endphp
                                        @foreach ($breadcrumb as $key => $item)
                                                <span>  &nbsp |  &nbsp</span>
                                                <a href="{{ $item['slug'] }}"> {{ $item['title'] }} </a>
                                                @php
                                                    $i++;
                                                    if($i>=$countBread){ break; }
                                                @endphp
                                            @endforeach
                                        </div>
                                        <div>
                                            {!! $detail->brief_description !!}

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
                </div>




            </div>
        </div>
    </section>

    @if (count($relatedProduct))
        <section class="products bg-gray-black   m-0 pt-1 pb-1" id="index-best-view">
            <div class="flex one ">
                <div>

                    <h2>محصولات مرتبط {{ $detail->title }}</h2>
                    <div class="flex one two-500 five-900  center">

                        {{--$data['newPost']--}}
                        @foreach ($relatedProduct as $content)

                                <a  href="{{ url($content->slug) }}">
                                    <div class="shadow hover p-0 border-radius-5">
                                        @if (isset($content->images['images']['small']))
                                            <figure class="image">
                                                <img loading="lazy" src="{{ $content->images['images']['large'] }}"
                                                    alt="{{ $content->title }}" title="{{ $content->title }}" width="300" height="300">
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

                </div>
            </div>
        </section>
    @endif



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