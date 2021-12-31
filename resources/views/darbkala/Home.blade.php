@extends(@env('TEMPLATE_NAME').'.App')

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


                                var href = (ulName == 'companies') ? '/profile/' +
                                    liItem.id : '/' + liItem.slug;

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
@endpush

@section('Content')
    @include('jsonLdWebsite')

    <script type="application/ld+json">
        {
            "@context": "http://www.schema.org",
            "@type": "Organization",
            "name": "Darbkala",
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
            },
            "sameAs": [
                "https://www.instagram.com/darbkala/",
                "https://www.linkedin.com/company/darbkala/"
            ]
        }
    </script>
    <section class="search bg-gray-dark pt-2 my-0 pb-4">
        <div>

            <h1 class="text-center font-14">مرجع آگهی و نیازمندی های درب </h1>
            <div class="flex one two-500 two-800 center ">

                <form action="{{ route('search') }}" class="p-0">

                    <input name="q" autocomplete="off" id="q" alt="جستجو" type="text"
                        placeholder="جستجوی محصول / محتوا / کمپانی" required>

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

    <section class="index-item-top  mt-0 pt-0 mb-0">
        <div class="text-center">

        </div>
        <div class="flex one five-500 center  ">
            {{-- image&label=category&var=category --}}
            @isset($category['data'])
                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="shadow hover">
                            @if (isset($content->images['images']['small']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small'] }}"
                                        sizes="(max-width:{{ env('CATEGORY_SMALL_W') }}px) 100vw {{ env('CATEGORY_SMALL_W') }}px {{ ENV('CATEGORY_MEDIUM_W') }}px {{ ENV('CATEGORY_LARGE_W') }}px"
                                        alt="{{ $content->title }}" width="200" height="200"
                                        srcset="
                                                                                                                                                {{ $content->images['images']['small'] }} {{ env('CATEGORY_SMALL_W') }}w,
                                                                                                                                                {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                                                                                                                                {{ $content->images['images']['large'] ?? $content->images['images']['small'] }} 2x">
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

        <div class="flex one five-500 center  ">
            {{-- category&label=category&var=category --}}
            @isset($category['data'])
                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="shadow hover">
                            @if (isset($content->images['images']['small']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small'] }}"
                                        sizes="(max-width:{{ env('CATEGORY_SMALL_W') }}px) 100vw {{ env('CATEGORY_SMALL_W') }}px {{ ENV('CATEGORY_MEDIUM_W') }}px {{ ENV('CATEGORY_LARGE_W') }}px"
                                        alt="{{ $content->title }}" width="200" height="200"
                                        srcset="
                                                                                                                                                {{ $content->images['images']['small'] }} {{ env('CATEGORY_SMALL_W') }}w,
                                                                                                                                                {{ $content->images['images']['medium'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                                                                                                                                {{ $content->images['images']['large'] }} 2x">
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





    <section class="index-items home-top-view bg-gray mb-0 pb-0">
        <div class="flex one">
            <div class="p-0">
                <h2><a class="pt-1" href="{{ url('درب-ضد-سرقت') }}"> درب ضد سرقت</a></h2>
                <div class="flex two two-500 three-700 six-900 center ">
                    {{-- product&label=topViewPost1&var=topViewPost1&count=6 --}}
                    @isset($topViewPost1['data'])
                        @foreach ($topViewPost1['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['images']['small']))
                                        <div><img alt="{{ $content->title }}" width="{{ env('PRODUCT_SMALL_W') }}"
                                                height="{{ env('PRODUCT_SMALL_H') }}"
                                                src="{{ $content->images['images']['small'] }}"
                                                srcset="
                                                                                                                                                {{ $content->images['images']['small'] }} 850w,
                                                                                                                                                {{ $content->images['images']['medium'] }} 1536w,
                                                                                                                                                {{ $content->images['images']['large'] }} 2880w
                                                                                                                                                    "
                                                sizes="
                                                                                                                                                    (min-width:1366px) {{ env('PRODUCT_SMALL_W') }}px,
                                                                                                                                                    (min-width:1536px) {{ env('PRODUCT_MEDIUM_W') }}px,
                                                                                                                                                    (min-width:850px) {{ env('PRODUCT_LARGE_W') }}px
                                                                                                                                                    ">
                                        </div>
                                    @endif
                                    <div>
                                        <h4> {{ $content->title }}</h4>
                                        <div>
                                            <div class="rate">
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

                                            @if (isset($content->attr['price']) && !in_array($content->attr['price'], [null, 0]))
                                                <div>@convertCurrency($content->attr['price']??0) تومان</div>
                                            @endif
                                            <div>
                                                <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                        fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                        fill="currentColor" />
                                                </svg>
                                                {{ $content->viewCount }}
                                            </div>
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


    <section class="bg-theme-color sm:text-center ">
        <div class="flex justify-content-between sm:justify-content-center  py-1">
            <h2 class="inline-block p-0">آیا محصولات خودتان را در درب کالا ثبت کردید؟</h2>
            <a class="inline-block btn btn-primary bg-purple border-radius-5 " href="{{ route('company.products') }}">برای درج محصول کلیک نمایید</a>
        </div>
    </section>



    <section class="index-items home-top-view bg-gray my-0 py-0">
        <div class="flex one">
            <div class="p-0">
                <h2><a class="pt-1" href="{{ url('درب-لابی') }}"> درب لابی</a></h2>
                <div class="flex two two-500 three-700 six-900 center ">
                    {{-- product&label=topViewPost2&var=topViewPost2&count=6 --}}
                    @isset($topViewPost2['data'])
                        @foreach ($topViewPost2['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['images']['small']))
                                        <div><img alt="{{ $content->title }}" width="{{ env('PRODUCT_SMALL_W') }}"
                                                height="{{ env('PRODUCT_SMALL_H') }}"
                                                src="{{ $content->images['images']['small'] }}"
                                                srcset="
                                                                                                                                                {{ $content->images['images']['small'] }} 850w,
                                                                                                                                                {{ $content->images['images']['medium'] }} 1536w,
                                                                                                                                                {{ $content->images['images']['large'] }} 2880w
                                                                                                                                                    "
                                                sizes="
                                                                                                                                                    (min-width:1366px) {{ env('PRODUCT_SMALL_W') }}px,
                                                                                                                                                    (min-width:1536px) {{ env('PRODUCT_MEDIUM_W') }}px,
                                                                                                                                                    (min-width:850px) {{ env('PRODUCT_LARGE_W') }}px
                                                                                                                                                    ">
                                        </div>
                                    @endif
                                    <div>
                                        <h4> {{ $content->title }}</h4>
                                        <div>
                                            <div class="rate">
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
                                            @if (isset($content->attr['price']) && !in_array($content->attr['price'], [null, 0]))
                                                <div>@convertCurrency($content->attr['price']??0) تومان</div>
                                            @endif
                                            <div>
                                                <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                        fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                        fill="currentColor" />
                                                </svg>
                                                {{ $content->viewCount }}
                                            </div>
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




    <section class="index-items home-top-view bg-gray my-0 py-0">
        <div class="flex one">
            <div class="p-0">
                <h2><a class="pt-1" href="{{ url('درب-ضد-حریق') }}">درب ضد حریق</a></h2>
                <div class="flex two two-500 three-700 six-900 center ">
                    {{-- product&label=topViewPost3&var=topViewPost3&count=6 --}}
                    @isset($topViewPost3['data'])
                        @foreach ($topViewPost3['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['images']['small']))
                                        <div><img alt="{{ $content->title }}" width="{{ env('PRODUCT_SMALL_W') }}"
                                                height="{{ env('PRODUCT_SMALL_H') }}"
                                                src="{{ $content->images['images']['small'] }}"
                                                srcset="
                                                                                                                                                {{ $content->images['images']['small'] }} 850w,
                                                                                                                                                {{ $content->images['images']['medium'] }} 1536w,
                                                                                                                                                {{ $content->images['images']['large'] }} 2880w
                                                                                                                                                    "
                                                sizes="
                                                                                                                                                    (min-width:1366px) {{ env('PRODUCT_SMALL_W') }}px,
                                                                                                                                                    (min-width:1536px) {{ env('PRODUCT_MEDIUM_W') }}px,
                                                                                                                                                    (min-width:850px) {{ env('PRODUCT_LARGE_W') }}px
                                                                                                                                                    ">
                                        </div>
                                    @endif
                                    <div>
                                        <h4> {{ $content->title }}</h4>
                                        <div>
                                            <div class="rate">
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
                                            @if (isset($content->attr['price']) && !in_array($content->attr['price'], [null, 0]))
                                                <div>@convertCurrency($content->attr['price']??0) تومان</div>
                                            @endif
                                            <div>
                                                <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                        fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                        fill="currentColor" />
                                                </svg>
                                                {{ $content->viewCount }}
                                            </div>
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




    <section class="index-items home-top-view bg-gray my-0 py-0">
        <div class="flex one">
            <div class="p-0">
                <h2 class="font-08 "><a class="pt-1" href="{{ url('درب-اتوماتیک') }}">درب اتوماتیک</a>
                </h2>
                <div class="flex two two-500 three-700 six-900 center ">
                    {{-- product&label=topViewPost4&var=topViewPost4&count=6 --}}
                    @isset($topViewPost4['data'])
                        @foreach ($topViewPost4['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['images']['small']))
                                        <div><img alt="{{ $content->title }}" width="{{ env('PRODUCT_SMALL_W') }}"
                                                height="{{ env('PRODUCT_SMALL_H') }}"
                                                src="{{ $content->images['images']['small'] }}"
                                                srcset="
                                                                                                                                                {{ $content->images['images']['small'] }} 850w,
                                                                                                                                                {{ $content->images['images']['medium'] }} 1536w,
                                                                                                                                                {{ $content->images['images']['large'] }} 2880w
                                                                                                                                                    "
                                                sizes="
                                                                                                                                                    (min-width:1366px) {{ env('PRODUCT_SMALL_W') }}px,
                                                                                                                                                    (min-width:1536px) {{ env('PRODUCT_MEDIUM_W') }}px,
                                                                                                                                                    (min-width:850px) {{ env('PRODUCT_LARGE_W') }}px
                                                                                                                                                    ">
                                        </div>
                                    @endif
                                    <div>
                                        <h4> {{ $content->title }}</h4>
                                        <div>
                                            <div class="rate">
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
                                            @if (isset($content->attr['price']) && !in_array($content->attr['price'], [null, 0]))
                                                <div>@convertCurrency($content->attr['price']??0) تومان</div>
                                            @endif
                                            <div>
                                                <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                        fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                        fill="currentColor" />
                                                </svg>
                                                {{ $content->viewCount }}
                                            </div>
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


    {{-- companies --}}
    @isset($companies)
        <section class="index-items  bg-gray-dark mb-0">
            <h2>کمپانی ها</h2>
            <div class="flex one">
                <div>
                    <div class="flex two two-500 three-700 six-900 center ">
                        @foreach ($companies as $content)
                            <div>
                                <a class="hover shadow2 pb-0" href="{{ url('profile/' . $content->id) }}">

                                    @if (isset($content->logo) && isset($content->logo))
                                        <img alt="{{ $content->name ?? '' }}"
                                            class="h-auto img-contain border-radius-50 mt-1"
                                            width="{{ env('COMPANY_LARGE_W') }}" height="{{ env('COMPANY_LARGE_H') }}"
                                            src="{{ $content->logo['large'] ?? '' }}">

                                    @endif

                                    <div class="flex ">
                                        <div class="p-0 ">
                                            {{ $content->name ?? 'کاربر جدید' }}
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
                        <a class="inline-block p-0 bg-orange" href="{{ route('register') }}">ثبت نام کمپانی جدید</a>
                    </div>

                </div>
            </div>
        </section>
    @endisset



    <section class="index-items articles bg-gray2 home-top-view mb-0">
        <div class="flex one">
            <div>
                <h2>مقالات درب کالا</h2>
                <div class="flex one two-500  three-800 center ">
                    {{-- post&label=articles&var=articles&count=9 --}}
                    @isset($articles['data'])
                        @foreach ($articles['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['images']['medium']))
                                        <div><img loading="lazy" alt="{{ $content->title }}"
                                                width="{{ env('ARTICLE_MEDIUM_W') }}"
                                                height="{{ env('ARTICLE_MEDIUM_H') }}"
                                                src="{{ $content->images['images']['medium'] }}"></div>
                                    @endif
                                    <div>
                                        <h3 class="p-1">{{ $content->title }}</h3>


                                    </div>

                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </section>

    {{-- categoryDetail&label=categoryDetail&var=categoryDetail&count=1 --}}
    @isset($categoryDetail['data'])
        <section class="my-0 py-5 ">
            <div>
                <div class="flex one three-600">
                    <div class="two-third-600 middle flex" style="order:2">
                        <h2>{{ $categoryDetail['data']->title }}</h2>
                        {!! $categoryDetail['data']->brief_description !!}
                    </div>
                    <div class="third-600" style="order:1">
                        <img loading="lazy" src="{{ $categoryDetail['data']->images['images']['large'] }}"
                            alt="darbkala about us">
                    </div>
                </div>
            </div>
        </section>
    @endisset


    {{-- #anchor footer --}}


@endsection
