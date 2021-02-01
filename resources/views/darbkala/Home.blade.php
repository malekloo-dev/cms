@extends(@env('TEMPLATE_NAME').'.App')

@section('head')

@endsection
@section('footer')

@endsection

@section('Content')




    <section class="index-item-top bg-orange mt-0 mb-0">
        <div class="text-center">
            <h1>مرجع تخصصی اطلاعات درب </h1>
        </div>
        <div class="flex one five-500 center  ">
            {{--category&label=category&var=category--}}
            @isset($category['data'])
                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="shadow hover">
                            @if (isset($content->images['thumb']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small'] ?? $content->images['thumb'] }}"
                                        sizes="(max-width:{{ env('CATEGORY_SMALL') }}px) 100vw {{ env('CATEGORY_SMALL') }}px {{ ENV('CATEGORY_MEDIUM') }}px {{ ENV('CATEGORY_LARGE') }}px"
                                        alt="{{ $content->title }}" width="200" height="200" srcset="
                                        {{ $content->images['images']['small'] ?? $content->images['thumb'] }} {{ env('CATEGORY_SMALL') }}w,
                                        {{ $content->images['images']['medium'] ?? $content->images['thumb'] }} {{ env('CATEGORY_MEDIUM') }}w,
                                        {{ $content->images['images']['large'] ?? $content->images['thumb'] }} 2x">
                                    <figcaption>
                                        <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                                    </figcaption>
                                </figure>
                            @else
                                <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                            @endif

                        </div>
                    </a>
                @endforeach
            @endisset
        </div>
    </section>



    <section class="wide  m-0" id="index-comment">
        <div>خدمات درب کالا</div>
    </section>


    {{--#anchor topViewProduct --}}
    <section class="index-items home-top-view">
        <div class="flex one">
            <div>
                <div class="flex one two-500  five-800 center ">
                    {{--product&label=topViewPost&var=topViewPost&count=10--}}
                    @isset($topViewPost['data'])
                        @foreach ($topViewPost['data'] as $content)
                            <div>
                                <a class="hover" href="{{ $content->slug }}">

                                    @if (isset($content->images['thumb']))
                                        <div><img src="{{ $content->images['thumb'] }}"></div>
                                    @endif
                                    <footer>
                                        <h3> {{ $content->title }}</h3>
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
                                                        <img width="20" height="20"
                                                            srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                            src="{{ asset('/img/star1x.png') }}"
                                                            alt="{{ 'star for rating' }}">
                                                    @endfor
                                                @endif
                                            </div>
                                            @if (isset($content->attr['price']))
                                                @convertCurrency($content->attr['price']??0) تومان
                                            @endif
                                        </div>
                                    </footer>

                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </section>


    <section class="index-items bg-gray home-top-view">
        <div class="flex one">
            <div>
                <h2>مقالات درب کالا</h2>
                <div class="flex one two-500  four-800 center ">
                    {{--post&label=articles&var=articles&count=4--}}
                    @isset($articles['data'])
                        @foreach ($articles['data'] as $content)
                            <div>
                                <a class="hover" href="{{ $content->slug }}">

                                    @if (isset($content->images['thumb']))
                                        <div><img width="288" height="190" src="{{ $content->images['thumb'] }}"></div>
                                    @endif
                                    <footer>
                                        <h3> {{ $content->title }}</h3>
                                    </footer>

                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </section>


    {{--#anchor footer --}}


@endsection
