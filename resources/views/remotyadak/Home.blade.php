
@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')

@endsection
@section('js')

@endsection

@section('Content')


    {{--#anchor top --}}

    <section class="index-item-top bg-orange mt-0 mb-0">
        <div class="text-center">
            <h1>مرکز ساخت سوئیچ و ریموت</h1>
        </div>
        <div class="flex one five-500 center  ">
        {{--category&label=category&var=category&count=5--}}
            @isset($category)

                @foreach ($category as $content)
                    <a href="{{ $content->slug }}">
                        <div class="shadow hover">

                                @if (isset($content->images['images']))
                                    <picture>

                                        <source media="(min-width:{{ env('CATEGORY_MEDIUM') }}px)"
                                            srcset="{{ $content->images['images']['medium'] ?? '' }}">

                                        <source media="(min-width:{{ env('CATEGORY_SMALL') }}px)"
                                            srcset="{{ $content->images['images']['small'] ?? '' }}">

                                        <img src="{{ $content->images['images']['medium'] ?? '' }}" alt="{{ $content->title }}"
                                            width="{{ env('CATEGORY_MEDIUM') }}" height="{{ env('CATEGORY_MEDIUM') }}">
                                    </picture>
                                @endif


                                <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>


                        </div>
                    </a>
                @endforeach
            @endisset
        </div>
    </section>

    <section class="wide  m-0" id="index-comment">
        <div>خدمات طرح و وب</div>
    </section>


    <section class="index-items home-top-view">
        <div class="flex one">
            <div>
                <div class="flex one two-500  four-800 center  ">

                    {{--product&label=top products&var=products&count=12--}}
                    @isset($products)


                        @foreach ($products as $content)
                            <div>
                                <a class="hover" href="{{ $content->slug }}">

                                    @if (isset($content->images['thumb']))
                                        <div><img src="{{ $content->images['thumb'] }}"></div>
                                    @endif
                                    <footer>
                                        <h3> {{ $content->title }}</h3>
                                        <div>
                                            @if (isset($content->attr['rate']))
                                                <div class="rate mt-1">
                                                    @for ($i = $content->attr['rate']; $i >= 1; $i--)
                                                        <img srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                            src="{{ asset('/img/star1x.png') }}">
                                                    @endfor
                                                </div>
                                            @endif
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

    {{--#anchor down --}}
@endsection
