@extends(@env('TEMPLATE_NAME').'.App')

@push('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('glider.min.css') }}">
@endpush

@push('scripts')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script>
        ///////////////
        // search
        ///////////////
        $(window).ready(function() {


            //setup before functions
            var typingTimer; //timer identifier
            var doneTypingInterval = 800; //time in ms, 5 second for example
            var $input = $('#q');
            var $searchSuggest = $('.search-suggest');


            //on keyup, start the countdown
            $input.on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            });

            //on keydown, clear the countdown
            $input.on('keydown', function() {
                clearTimeout(typingTimer);
            });

            //focus out
            $('body').click(function() {
                $searchSuggest.html('');
            });

            //user is "finished typing," do something
            function doneTyping() {

                $searchSuggest.html('');

                $('<div/>').addClass('loader').appendTo($searchSuggest);

                $.ajax({
                    method: "POST",
                    url: "{{ route('search.suggest') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'q': $input.val()
                    },
                    success: function(data, status) {

                        $searchSuggest.html('');


                        // console.log(data);

                        var ulPersian = {
                            'products': 'در محصولات',
                            'posts': 'در محتوا',
                            'companies': 'در کمپانی ها',
                        };

                        $.each(data, function(key, ulItem) {

                            var ul = $('<ul/>');
                            var ulName = key;
                            $('<li/>').text(ulPersian[ulName]).appendTo(ul);


                            $.each(ulItem, function(i, liItem) {


                                var href = (ulName == 'companies') ? '/profile/' + liItem.id : '/' + liItem.slug  ;

                                $('<li/>').append(

                                        $('<a/>').text(liItem.title ?? liItem.name)
                                        .attr('href', href)
                                    )

                                    .appendTo(ul);

                            })

                            $searchSuggest.append(ul);
                        });


                        // console.log('success',data);
                    },
                    error: function(xhr, status, error) {
                        $searchSuggest.html('');

                        console.log('error', status, error);
                    }
                });
            }


        })
    </script>


    <script src="{{ asset('glider.min.js') }}"></script>
    <script>
        new Glider(document.querySelector('.glider'), {
        // Mobile-first defaults
        slidesToShow: 'auto',
        slidesToScroll: 'auto',
        scrollLock: true,
        dots: '.dots',
        itemWidth: 80,
        duration: 0.25,

        responsive: [
            {
                // screens greater than >= 600px
                breakpoint: 500,
                settings: {
                    // Set to `auto` and provide item width to adjust to viewport
                    slidesToShow: 2,
                    slidesToScroll: 'auto',
                    duration: 0.25
                }
            },
            {
                // screens greater than >= 775px
                breakpoint: 650,
                settings: {
                    // Set to `auto` and provide item width to adjust to viewport
                    slidesToShow: '3',
                    slidesToScroll: 'auto',
                    duration: 0.25
                }
            },
            {
                // screens greater than >= 1024px
                breakpoint: 1024,
                settings: {
                    scrollLock:false,
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    // itemWidth: 150,
                    duration: 1
                }
            }
        ]
        });
    </script>

@endpush

@section('Content')

    @include('jsonLdWebsite')

    <script type="application/ld+json">
        {
            "@context": "http://www.schema.org",
            "@type": "Organization",
            "name": "Remotyadak",
            "url": "{{ url('/') }}",
            "logo": "{{ url(env('TEMPLATE_NAME') . '/img/logo2x.png') }}",
            "description": "{{ $seo['meta_description'] }}",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "هفت تیر",
                "addressLocality": "تهران",
                "addressRegion": "تهران",
                "postalCode": "13589331",
                "addressCountry": "ایران"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "customer service",
                "telephone": "+98933-1181877"
            }
        }
    </script>

    <section class="search bg-gray-dark pt-2 my-0 pb-4">
        <div>

            <h1 class="text-center">مرجع تخصصی خدمات خودرو </h1>
            <div class="flex one two-500 two-800 center ">

                <form action="{{ route('search') }}" class="p-0">

                    <input name="q" autocomplete="off" id="q" alt="جستجو" type="text"
                        placeholder="جستجوی محصول / محتوا / کمپانی" required oninvalid="this.setCustomValidity('کلمه ای برای جستجو تایپ کنید')"  onchange="this.setCustomValidity('')">

                    <button class=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24"
                            height="24" viewBox="0 0 32 32" style=" fill:#000000;">
                            <path
                                d="M 19 3 C 13.488281 3 9 7.488281 9 13 C 9 15.394531 9.839844 17.589844 11.25 19.3125 L 3.28125 27.28125 L 4.71875 28.71875 L 12.6875 20.75 C 14.410156 22.160156 16.605469 23 19 23 C 24.511719 23 29 18.511719 29 13 C 29 7.488281 24.511719 3 19 3 Z M 19 5 C 23.429688 5 27 8.570313 27 13 C 27 17.429688 23.429688 21 19 21 C 14.570313 21 11 17.429688 11 13 C 11 8.570313 14.570313 5 19 5 Z">
                            </path>
                        </svg></button>
                    <div class="search-suggest">

                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="index-img bg-gray mt-0 mb-0 pb-2">

        <div class="flex two five-500  center ">
            {{--images&label=banner&var=banners&count=5 --}}
            @if (isset($banners) && isset($banners['images']))
                @foreach ($banners['images'] as $k => $content)
                    <a href="{{ $banners['url'][$k] }}" @if (!isset($banners['follow'][$k])) rel="nofollow" @endif target="blank">
                        <div class="shadow  p-0">
                            <picture>
                                <img class="cover" src="{{ $content }}" alt="{{ $banners['name'][$k] }}"
                                    width="200" height="200">
                            </picture>
                        </div>
                    </a>

                @endforeach
            @endisset

    </div>
</section>


{{--#anchor top --}}
<section class="index-item-top bg-blue2 mt-0 mb-0">
    <div class="text-center pb-1">
        <h2>خدمات سوئیچ و ریموت</h2>
    </div>
    <div class="flex one two-500 three-700 four-900 center  ">
        {{--category&label=category&var=category&count=15 --}}
        @isset($category['data'])
            <div class="glider-contain ltr">

                <div class="glider">

                    @foreach ($category['data'] as $content)
                    <a class="m-1" href="{{ $content->slug }}">
                        <div class="shadow  hover h-100">

                            @if (isset($content->images['images']))
                            <picture>

                                <source media="(min-width:{{ env('CATEGORY_MEDIUM_W') }}px)"
                                srcset="{{ $content->images['images']['medium'] ?? '' }}">

                                <source media="(min-width:{{ env('CATEGORY_SMALL_W') }}px)"
                                srcset="{{ $content->images['images']['small'] ?? '' }}">

                                <img src="{{ $content->images['images']['medium'] ?? '' }}" alt="{{ $content->title }}"
                                width="{{ env('CATEGORY_MEDIUM_W') }}" height="{{ env('CATEGORY_MEDIUM_W') }}">
                            </picture>
                            @endif


                            <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>


                        </div>
                    </a>
                    @endforeach
                </div>

                <div role="tablist" class="dots"></div>
            </div>

            <a class="bg-theme4 btn border-radius-5 white-space-nowrap text-center" href="{{ url('/سوئیچ-و-ریموت-خودرو') }}">مشاهده بیشتر سوئیچ و ریموت</a>
        @endisset
    </div>
</section>



<section class="index-item-top bg-gray mt-0 mb-0">
    <div class="text-center pb-1">
        <h2>تعمیرگاه های تخصصی</h2>
    </div>
    <div class="flex two three-500 seven-1000 center  ">
        {{--category&label=category2&var=category2&count=15 --}}
        @isset($category2['data'])

            @foreach ($category2['data'] as $content)
                <a href="{{ $content->slug }}">
                    <div class="shadow hover h-100">

                        @if (isset($content->images['images']))
                            <picture>

                                <source media="(min-width:{{ env('CATEGORY_MEDIUM_W') }}px)"
                                    srcset="{{ $content->images['images']['medium'] ?? '' }}">

                                <source media="(min-width:{{ env('CATEGORY_SMALL_W') }}px)"
                                    srcset="{{ $content->images['images']['small'] ?? '' }}">

                                <img src="{{ $content->images['images']['medium'] ?? '' }}"
                                    alt="{{ $content->title }}" width="{{ env('CATEGORY_MEDIUM_W') }}"
                                    height="{{ env('CATEGORY_MEDIUM_W') }}">
                            </picture>
                        @endif


                        <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>


                    </div>
                </a>
            @endforeach
        @endisset
    </div>
</section>


<section class="index-items bg-blue home-top-view m-0">

    <div class="flex one">
        <h2>محصولات</h2>
        <div>
            <div class="flex  three-500  center  ">

                {{--product&label=topProducts&var=products&count=6 --}}
                @isset($products['data'])

                    @foreach ($products['data'] as $content)
                        <div class="">
                            <a class="hover " href="{{ $content->slug }}">

                                @if (isset($content->images['images']['small']))
                                    <div class=""><img width="{{ env('PRODUCT_SMALL_W') }}"
                                            height="{{ env('PRODUCT_SMALL_H') }}" alt="{{ $content->title }}"
                                            src="{{ $content->images['images']['small'] }}"></div>
                                @endif
                                <div class="">
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
                                                    <label></label>
                                                @endfor
                                            @endif
                                        </div>
                                        @if (isset($content->attr['price']))
                                            @convertCurrency($content->attr['price']??0) تومان
                                        @endif
                                    </div>
                                </div>

                            </a>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
</section>



<section class="index-item-top bg-gray2 mt-0 mb-0">
    <div class="text-center pb-1">
        <h2>نمایشگاه خودرو</h2>
    </div>
    <div class="flex two three-500 six-1000 center  ">


        @php
            $auto = \App\Models\Category::find(215)->companiesCategory()->limit(6)->get();
        @endphp

        @isset($auto)

            @foreach ($auto as $content)
                <a href="/profile/{{ $content->id }}">
                    <div class="shadow hover h-100">

                        @if (isset($content->logo))
                            <picture>

                                <source media="(min-width:{{ env('COMPANY_MEDIUM_W') }}px)"
                                    srcset="{{ $content->logo['large'] ?? '' }}">

                                <source media="(min-width:{{ env('COMPANY_SMALL_W') }}px)"
                                    srcset="{{ $content->logo['medium'] ?? '' }}">

                                <img src="{{ $content->logo['medium'] ?? '' }}"
                                    alt="{{ $content->title }}" width="{{ env('COMPANY_MEDIUM_W') }}"
                                    height="{{ env('COMPANY_MEDIUM_W') }}">
                            </picture>
                        @endif


                        <h3 class="p-0 m-0 text-center"> {{ $content->name }}</h3>


                    </div>
                </a>
            @endforeach
        @endisset
    </div>
</section>



<section class="index-item-top bg-gray mt-0 mb-0">
    <div class="text-center pb-1">
        <h2>لوازم خودرو</h2>
    </div>
    <div class="flex two three-500 six-1000 center  ">


        @php
            $auto = \App\Models\Category::find(216)->companiesCategory()->limit(6)->get();
        @endphp

        @isset($auto)

            @foreach ($auto as $content)
                <a href="/profile/{{ $content->id }}">
                    <div class="shadow hover h-100">

                        @if (isset($content->logo))
                            <picture>

                                <source media="(min-width:{{ env('COMPANY_MEDIUM_W') }}px)"
                                    srcset="{{ $content->logo['large'] ?? '' }}">

                                <source media="(min-width:{{ env('COMPANY_SMALL_W') }}px)"
                                    srcset="{{ $content->logo['medium'] ?? '' }}">

                                <img src="{{ $content->logo['medium'] ?? '' }}"
                                    alt="{{ $content->title }}" width="{{ env('COMPANY_MEDIUM_W') }}"
                                    height="{{ env('COMPANY_MEDIUM_W') }}">
                            </picture>
                        @endif


                        <h3 class="p-0 m-0 text-center"> {{ $content->name }}</h3>


                    </div>
                </a>
            @endforeach
        @endisset
    </div>
</section>

@endsection
