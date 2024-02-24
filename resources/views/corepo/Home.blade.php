@extends(@env('TEMPLATE_NAME') . '.App')

@push('scripts')
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            //dots[slideIndex - 1].className += " active";
        }
    </script>

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
@endpush

@section('Content')




    <section class="bg-pink  mt-0 mb-0">
        <div class="flex one ">
            <div class="text-center">
                <h1>جدیدترین وب سایت ها، مقالات، اپلیکیشن ها</h1>
                <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-1 mb-1 ">
                    {{--post&label=topView&var=topViewPost&count=5 --}}
                    @isset($topViewPost['data'])
                        @foreach ($topViewPost['data'] as $content)
                            <div class="">
                                <a href="{{ $content->slug }}">
                                    <article class="shadow2 flex flex-row two one-500 ">


                                        <div class="flex full p-0 two-500">



                                            @if (isset($content->images['images']['medium']))
                                                <figure class="image m-0 p-0 third full-500">
                                                    <img loading="lazy" src="{{ $content->images['images']['medium'] }}"
                                                        width="{{ env('ARTICLE_SMALL_W') }}"
                                                        height="{{ env('ARTICLE_SMALL_H') }}" alt="{{ $content->title }}">
                                                </figure>
                                            @endif

                                            <div class="pb-0 two-third full-500 flex">

                                                <div class="title align-right p-0">{{ $content->title }}</div>
                                                <div class="rate mt-0 p-0 font-08 full">
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

                                                <div class="p-0  font-08">

                                                    <span
                                                        class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>

                                                    <svg class="p-0 m-0" width="12" height="12" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                            fill="currentColor" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    <span class="p-0 ml-1">{{ $content->viewCount }} </span>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="info full p-0 font-09">
                                            {!! readMore($content->brief_description, 110) !!}
                                        </div>
                                    </article>
                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>

                <div class="flex one ">
                    <div class="text-center ">
                        <div class="flex one two-500 ">
                            <a class="pb-0" href="https://edengoldgallery.ir/?ref=corepo" target="__blunk"><img
                                    height="" class="full border-radius-10 " src="{{ asset('/img/eden-70.jpg') }}"
                                    alt=""></a>
                            <a class="pb-0" href="https://it-times-store.com/?ref=corepo" target="__blunk"><img
                                    height="" class="full border-radius-10 " src="{{ asset('/img/it-70.jpg') }}"
                                    alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>










    <section class="category-box  mt-0  pb-0">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-1 ">
            <div>
                <div class="shadow full-height border-radius-10">
                    <h2 class=" pb-0"><a href="{{ url('فروشگاه-اینترنتی') }}">فروشگاه اینترنتی</a></h2>
                    <div class="flex one">
                        {{--post&label=shop&var=shop&count=2 --}}
                        @isset($shop['data'])
                            @foreach ($shop['data'] as $content)
                                <div class="flex three align-items-center p-0 pt-1 min-height ">
                                    <img class="third p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                        src="{{ $content['images']['images']['small'] }}">
                                    <div class="two-third pb-0 flex mb-0">
                                        <a class="full p-0 m-0" href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                    </div>
                                </div>
                                <div class="full flex p-0 align-items-center ">
                                    <div class="rate p-0">
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


                                    <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                </div>
                                <div class="p-0 @if (!$loop->last) border-bottom @endif">
                                    {!! readMore($content->brief_description) !!}
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
            <div>
                <div class="shadow full-height border-radius-10 pt-0">
                    <h2 class=" pb-0"><a href="{{ url('خودرو') }}">خودرو</a></h2>
                    <div class="flex one">
                        {{--post&label=car&var=car&count=2 --}}
                        @isset($car['data'])
                            @foreach ($car['data'] as $content)
                                <div class="flex three align-items-center p-0 pt-1 min-height ">
                                    <img class="third p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                        src="{{ $content['images']['images']['small'] }}">
                                    <div class="two-third pb-0 flex mb-0">
                                        <a class="full p-0 m-0"
                                            href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                    </div>
                                </div>
                                <div class="full flex p-0 align-items-center ">
                                    <div class="rate p-0">
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


                                    <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                </div>
                                <div class="p-0 @if (!$loop->last) border-bottom @endif">
                                    {!! readMore($content->brief_description) !!}
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
            <div class="">
                <div class=" shadow full-height border-radius-10 pt-0">
                    <h2 class=" pb-0"><a href="{{ url('تور-و-گردشگری') }}">تور و گردشگری</a></h2>
                    <div class="flex one">
                        {{--post&label=tour&var=tour&count=2 --}}
                        @isset($tour['data'])
                            @foreach ($tour['data'] as $content)
                                <div class="flex three align-items-center p-0 pt-1 min-height ">
                                    <img class="third p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                        src="{{ $content['images']['images']['small'] }}">
                                    <div class="two-third pb-0 flex mb-0">
                                        <a class="full p-0 m-0"
                                            href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                    </div>
                                </div>
                                <div class="full flex p-0 align-items-center ">
                                    <div class="rate p-0">
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


                                    <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                </div>
                                <div class="p-0 @if (!$loop->last) border-bottom @endif">
                                    {!! readMore($content->brief_description) !!}
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
            <div class="">
                <div class=" shadow full-height border-radius-10 pt-0">
                    <h2 class=" pb-0"><a href="{{ url('صنایع-غذایی') }}">غذا و رستوران</a></h2>
                    <div class="flex one">
                        {{--post&label=restaurant&var=restaurant&count=2 --}}
                        @isset($restaurant['data'])
                            @foreach ($restaurant['data'] as $content)
                                <div class="flex three align-items-center p-0 pt-1 min-height ">
                                    <img class="third p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                        src="{{ $content['images']['images']['small'] }}">
                                    <div class="two-third pb-0 flex mb-0">
                                        <a class="full p-0 m-0"
                                            href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                    </div>
                                </div>
                                <div class="full flex p-0 align-items-center ">
                                    <div class="rate p-0">
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


                                    <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                </div>
                                <div class="p-0 @if (!$loop->last) border-bottom @endif">
                                    {!! readMore($content->brief_description) !!}
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </section>






    <section class="category-box mt-0  py-0">
        <div class="flex one two-500 ">
            <div>
                <div class="shadow full-height bg-wood border-radius-10 pt-0">
                    <h2 class=" pb-0"><a class="color-brown" href="{{ url('دکوراسیون-و-معماری') }}">دکوراسیون</a>
                    </h2>
                    <div class="flex  one two-700 ">
                        {{--post&label=deco&var=deco&count=2 --}}
                        @isset($deco['data'])
                            @foreach ($deco['data'] as $content)
                                <div class="py-0">
                                    <div class="flex one bg-white full-height shadow3 border-radius-5 align-items-center p-0 ">


                                        <img class="third p-0" width="70" height="70"
                                            src="{{ $content['images']['images']['small'] }}" alt="">
                                        <a class="two-third  pb-0"
                                            href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>

                                        <div class="full flex p-0 align-items-center ">
                                            <div class="rate p-0">
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


                                            <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                    fill="currentColor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span class="p-0">{{ $content->viewCount }}</span>


                                            <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                    fill="currentColor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span
                                                class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                        </div>
                                        <div class="m-auto mb-0 pb-0">{!! readMore($content['brief_description'], 90) !!}</div>

                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
            <div>
                <div class="shadow full-height border-radius-10 pt-0">
                    <h2 class=" pb-0"><a href="{{ url('آموزشگاه') }}">آموزشگاه</a></h2>
                    <div class="flex one two-700">
                        {{--post&label=uni&var=uni&count=2 --}}
                        @isset($uni['data'])
                            @foreach ($uni['data'] as $content)
                                <div class="flex  align-items-center p-0">
                                    <img class="third p-0" width="70" height="70"
                                        src="{{ $content['images']['images']['small'] }}" alt="">
                                    <a class="two-third pb-0" href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                    <div class="full flex p-0 align-items-center ">
                                        <div class="rate p-0">
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


                                        <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="p-0">{{ $content->viewCount }}</span>


                                        <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                    </div>
                                    <div>{!! readMore($content['brief_description']) !!}</div>

                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-pink  mt-0 mb-0  ">
        <div class="flex one ">
            <div class="text-center pb-0 pt-1">
                <div class="flex one two-500 ">
                    <a class="" href="https://garmgah.com/?ref=corepo" target="__blank"><img height=""
                            class=" border-radius-10 " src="{{ asset('/img/garmgah-70.jpg') }}" alt=""></a>
                    <a class="" href="#"><img height="" class=" border-radius-10 "
                            src="{{ asset('/img/banner-70.jpg') }}" alt=""></a>
                </div>
            </div>
        </div>
    </section>

    <section class="category-box  mt-0  pb-0">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-1">
            <div class="">
                <div class="shadow border-radius-10 pt-0 full-height">
                    <h2><a href="{{ url('خدماتی') }}">خدماتی</a></h2>
                    {{--post&label=service&var=service&count=2 --}}
                    @isset($service['data'])
                        @foreach ($service['data'] as $content)
                            <div
                                class="flex four-800 align-items-center px-0 py-1 @if (!$loop->last) border-bottom @endif ">
                                <img class="fourth-800 p-0 pl-1" width="100" height="100"
                                    src="{{ $content['images']['images']['small'] }}" alt="">
                                <div class="three-fourth-800 p-0 ">
                                    <a class="" href="{{ url($content['slug']) }}">{{ $content['title'] }}

                                    </a>
                                    <div class=" flex p-0 align-items-center font-09">
                                        <div class="rate p-0">
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


                                        <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="p-0">{{ $content->viewCount }}</span>


                                        <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                    </div>
                                </div>

                                <div class="full">{!! readMore($content['brief_description'], 220) !!}</div>
                            </div>
                        @endforeach
                    @endisset

                </div>
            </div>
            <div class=" md:col-span-2 ">
                <div class="shadow border-radius-10 pt-0 mb-1">
                    <h2 class=" pb-0"><a href="{{ url('استخدام-و-کاریابی') }}">استخدام</a></h2>
                    <div class="flex one three-500">
                        {{--post&label=job&var=job&count=3 --}}
                        @isset($job['data'])
                            @foreach ($job['data'] as $content)
                                <div class="flex  one-500 align-items-center p-0">
                                    <img class="mt-0 m-auto p-0" width="100" height="100"
                                        src="{{ $content['images']['images']['small'] }}" alt="">
                                    <a class=" text-center pb-0"
                                        href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                    <div class=" flex p-0 align-items-center font-09">
                                        <div class="rate p-0">
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


                                        <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="p-0">{{ $content->viewCount }}</span>


                                        <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                    </div>
                                    <div class="full m-auto pb-0 mb-0">{!! readMore($content['brief_description']) !!}</div>

                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
                <div class="shadow border-radius-10 pt-0">
                    <h2 class=" pb-0"><a href="{{ url('پزشکی') }}">پزشکی</a></h2>
                    <div class="flex one three-500">
                        {{--post&label=medical&var=medical&count=3 --}}
                        @isset($medical['data'])
                            @foreach ($medical['data'] as $content)
                                <div class="flex one-500 align-items-center p-0">
                                    <a class=" text-center pb-0" href="{{ url($content['slug']) }}">
                                        <img class=" p-0" width="100" height="100"
                                            src="{{ $content['images']['images']['small'] }}" alt="">
                                    </a>
                                    <a class=" text-center pb-0"
                                        href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                    <div class=" flex p-0 align-items-center font-09">
                                        <div class="rate p-0">
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


                                        <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="p-0">{{ $content->viewCount }}</span>


                                        <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                    </div>
                                    <div class="full">{!! readMore($content['brief_description']) !!}</div>

                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </section>








    <section class="index-items bg-pink mt-0 mb-0">

        <h2>بازی و اپلیکیشن </h2>
        <div class="flex  application gap-1 ">
            {{--post&label=application&var=application&count=5 --}}
            @isset($application['data'])
                @foreach ($application['data'] as $content)
                    <div class="flex-1">
                        <a href="{{ $content->slug }}">
                            <article class="shadow2 ">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image m-0">
                                        <img loading="lazy" src="{{ $content->images['images']['small'] }}"
                                            alt="{{ $content->title }}" width="80" height="80">
                                    </figure>
                                @endif

                                <div class="title mt-1">{{ $content->title }}</div>
                                @if (count($content->comments))
                                    <div class="rate ">
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
                                    </div>
                                @endif

                            </article>
                        </a>
                    </div>
                @endforeach
                <div class="flex-1">
                    <a href="/بازی-و-اپلیکیشن">
                        <article class="shadow2 py-3">
                            <svg height="70px" width="70px" id="Layer_1" style="enable-background:new 0 0 32 32;"
                                version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path
                                    d="M28,14H8.8l4.62-4.62C13.814,8.986,14,8.516,14,8c0-0.984-0.813-2-2-2c-0.531,0-0.994,0.193-1.38,0.58l-7.958,7.958  C2.334,14.866,2,15.271,2,16s0.279,1.08,0.646,1.447l7.974,7.973C11.006,25.807,11.469,26,12,26c1.188,0,2-1.016,2-2  c0-0.516-0.186-0.986-0.58-1.38L8.8,18H28c1.104,0,2-0.896,2-2S29.104,14,28,14z" />
                            </svg>
                            <div class="title ">تمام اپلیکیشن ها</div>
                        </article>
                    </a>
                </div>
            @endisset
        </div>



        <div class="text-center mt-1">
            <div class="flex one two-500 ">
                <a class="" href=""><img height="" class=" border-radius-10 "
                        src="{{ asset('/img/banner-70.jpg') }}" alt=""></a>
                <a class="" href=""><img height="" class=" border-radius-10 "
                        src="{{ asset('/img/banner-70.jpg') }}" alt=""></a>
            </div>
        </div>

    </section>



    <section class="category-box bg-gray-dark  mt-0 mb-0">


        <div class="flex  ">
            <div class="full">
                <h2 class="color-white p-0">مقالات</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-5  gap-1">
                <div class="  mb-1">
                    <div class="shadow full-height border-radius-10 ">
                        {{--categoryDetail&label=categoryDetail&var=categoryDetail&count=1 --}}
                        @isset($categoryDetail['data'])
                            <div class="flex four-800 align-items-center px-0 py-0  ">
                                <div class="full">
                                    {!! readMore($categoryDetail['data']['brief_description'], 140) !!}
                                    {!! $categoryDetail['data']['description'] !!}</div>
                            </div>
                        @endisset
                    </div>
                </div>
                <div class="sm:col-span-4  ">
                    <div class="shadow mb-1  border-radius-10">
                        {{--post&label=salamat&var=salamat&count=3 --}}
                        <h3><a href="{{ url('سلامت-و-سبک-زندگی') }}">سلامت و سبک زندگی</a></h3>
                        <div class="flex one three-500">
                            @isset($salamat['data'])
                                @foreach ($salamat['data'] as $content)
                                    <div
                                        class="flex four-800 align-items-center px-0 py-1 @if (!$loop->last) border-bottom @endif ">
                                        <img class="fourth-800 p-0" width="100" height="100"
                                            src="{{ $content['images']['images']['small'] }}" alt="">
                                        <a class="three-fourth-800 pb-0"
                                            href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                        <div class="full flex p-0 align-items-center ">
                                            <div class="rate p-0">
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


                                            <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                    fill="currentColor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span class="p-0">{{ $content->viewCount }}</span>


                                            <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                    fill="currentColor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span
                                                class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                        </div>
                                        <div class="full">{!! readMore($content['brief_description'], 140) !!}</div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-1  ">

                        <div class="mb-1 flex-1">
                            <div class="shadow full-height border-radius-10 ">
                                <h3><a href="{{ url('آشپزی-و-تغذیه') }}">آشپزی و تغذیه</a></h3>
                                <div class="flex one ">
                                    {{--post&label=articleChef&var=articleChef&count=2 --}}
                                    @isset($articleChef['data'])
                                        @foreach ($articleChef['data'] as $content)
                                            <div class="flex three align-items-center p-0 pt-1 min-height ">
                                                <img class="third p-0" width="70" height="70"
                                                    alt="{{ $content['title'] }}"
                                                    src="{{ $content['images']['images']['small'] }}">
                                                <div class="two-third pb-0 flex mb-0">
                                                    <a class="full p-0 m-0"
                                                        href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                                </div>
                                            </div>
                                            <div class="full flex p-0 align-items-center ">

                                                <div class="rate p-0">
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
                                                    <span class="p-0 ">{{ $content->viewCount }}</span>
                                                </div>

                                                <div>
                                                    <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                            fill="currentColor" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    <span
                                                        class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                                </div>

                                            </div>
                                            <div class="p-0 @if (!$loop->last) border-bottom @endif">
                                                {!! readMore($content->brief_description) !!}
                                            </div>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>


                        <div class="mb-1 flex-1">
                            <div class="shadow full-height border-radius-10">
                                <h3><a href="{{ url('کسب-و-کار') }}">کسب و کار</a></h3>
                                <div class="flex one">
                                    {{--post&label=articleJob&var=articleJob&count=2 --}}
                                    @isset($articleJob['data'])
                                        @foreach ($articleJob['data'] as $content)
                                            <div class="flex three align-items-center p-0 pt-1 min-height ">
                                                <img class="third p-0" width="70" height="70"
                                                    alt="{{ $content['title'] }}"
                                                    src="{{ $content['images']['images']['small'] }}">
                                                <div class="two-third pb-0 flex mb-0">
                                                    <a class="full p-0 m-0"
                                                        href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                                </div>
                                            </div>
                                            <div class="full flex p-0 align-items-center ">
                                                <div class="rate p-0">
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
                                                    <span class="p-0 ">{{ $content->viewCount }}</span>
                                                </div>

                                                <div>
                                                    <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                            fill="currentColor" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    <span
                                                        class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>

                                                </div>
                                            </div>
                                            <div class="p-0 @if (!$loop->last) border-bottom @endif">
                                                {!! readMore($content->brief_description) !!}
                                            </div>
                                        @endforeach
                                    @endisset
                                </div>

                            </div>
                        </div>

                        <div class="mb-1 flex-1">
                            <div class="shadow full-height border-radius-10">
                                <h3><a href="{{ url('سفر-و-گردش') }}">سفر و گردش</a></h3>
                                <div class="flex one">
                                    {{--post&label=articleTour&var=articleTour&count=2 --}}
                                    @isset($articleTour['data'])
                                        @foreach ($articleTour['data'] as $content)
                                            <div class="flex three align-items-center p-0 pt-1 min-height ">
                                                <img class="third p-0" width="70" height="70"
                                                    alt="{{ $content['title'] }}"
                                                    src="{{ $content['images']['images']['small'] }}">
                                                <div class="two-third pb-0 flex mb-0">
                                                    <a class="full p-0 m-0"
                                                        href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                                </div>
                                            </div>
                                            <div class="full flex p-0 align-items-center ">
                                                <div class="rate p-0">
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
                                                    <span class="p-0 ">{{ $content->viewCount }}</span>
                                                </div>

                                                <div>
                                                    <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                            fill="currentColor" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    <span
                                                        class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>

                                                </div>
                                            </div>
                                            <div class="p-0 @if (!$loop->last) border-bottom @endif">
                                                {!! readMore($content->brief_description) !!}
                                            </div>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 flex-1">
                            <div class="shadow full-height border-radius-10">
                                <h3><a href="{{ url('دکور-و-خانه-داری') }}">دکور و خانه داری</a></h3>
                                <div class="flex one">
                                    {{--post&label=articleDeco&var=articleDeco&count=2 --}}
                                    @isset($articleDeco['data'])
                                        @foreach ($articleDeco['data'] as $content)
                                            <div class="flex three align-items-center p-0 pt-1 min-height ">
                                                <img class="third p-0" width="70" height="70"
                                                    alt="{{ $content['title'] }}"
                                                    src="{{ $content['images']['images']['small'] }}">
                                                <div class="two-third pb-0 flex mb-0">
                                                    <a class="full p-0 m-0"
                                                        href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                                </div>
                                            </div>
                                            <div class="full flex p-0 align-items-center ">
                                                <div class="rate p-0">
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
                                                    <span class="p-0 ">{{ $content->viewCount }}</span>
                                                </div>

                                                <div>
                                                    <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                            fill="currentColor" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    <span
                                                        class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>

                                                </div>
                                            </div>
                                            <div class="p-0 @if (!$loop->last) border-bottom @endif">
                                                {!! readMore($content->brief_description) !!}
                                            </div>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 ">
                <div class="">
                    <div class="shadow full-height border-radius-10 pt-0">
                        <h3><a href="{{ url('علمی-و-آموزشی') }}">علمی و آموزشی</a></h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 ">
                            {{--post&label=articleUni&var=articleUni&count=2 --}}
                            @isset($articleUni['data'])
                                @foreach ($articleUni['data'] as $content)
                                    <div class="flex  align-items-center p-0">
                                        <img class="third p-0" width="70" height="70"
                                            src="{{ $content['images']['images']['small'] }}" alt="">
                                        <a class="two-third pb-0"
                                            href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                        <div class="full flex p-0 align-items-center ">
                                            <div class="rate p-0">
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


                                            <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                    fill="currentColor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span class="p-0">{{ $content->viewCount }}</span>


                                            <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                    fill="currentColor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span
                                                class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                        </div>
                                        <div>{!! readMore($content['brief_description']) !!}</div>

                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="shadow full-height border-radius-10 pt-0">
                        <h3><a href="{{ url('مقالات-خودرو') }}">مقالات خودرو</a></h3>
                        <div class="flex one two-700">
                            {{--post&label=articleCar&var=articleCar&count=2 --}}
                            @isset($articleCar['data'])
                                @foreach ($articleCar['data'] as $content)
                                    <div class="flex  align-items-center p-0">
                                        <img class="third p-0" width="70" height="70"
                                            src="{{ $content['images']['images']['small'] }}" alt="">
                                        <a class="two-third pb-0"
                                            href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                        <div class="full flex p-0 align-items-center ">
                                            <div class="rate p-0">
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


                                            <svg class="p-0" width="13" height="13" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                                    fill="currentColor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span class="p-0">{{ $content->viewCount }}</span>


                                            <svg class="p-0 " width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15 17C16.1046 17 17 16.1046 17 15C17 13.8954 16.1046 13 15 13C13.8954 13 13 13.8954 13 15C13 16.1046 13.8954 17 15 17Z"
                                                    fill="currentColor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z"
                                                    fill="currentColor" />
                                            </svg>
                                            <span
                                                class="p-0">{{ convertGToJ($content->publish_date, false, '%d %B') }}</span>
                                        </div>
                                        <div>{!! readMore($content['brief_description']) !!}</div>

                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>






@endsection
