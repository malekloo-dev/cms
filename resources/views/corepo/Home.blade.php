@extends(@env('TEMPLATE_NAME').'.App')

@section('head')
    <link rel="stylesheet" href="{{ asset('/home.css') }}">
@endsection
@section('footer')
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
@endsection

@section('Content')





    <section class="index-item-top banner pb-0">
        <div class="flex two">
            <div class="full two-third-500 slideshow-container ltr">
                {{--images&label=banner&var=banners&count=3--}}
                @if (isset($banners) && isset($banners['images']))
                    @foreach ($banners['images'] as $content)
                        <div class="mySlides fade ">
                            <figure class="image">
                                <img src="{{ $content }}" sizes="(max-width:792px) 100vw 396px 792px 1584px" alt=""
                                    width="792" height="370" srcset="
                                                    {{ $content }} 2x">
                            </figure>
                            {{-- <div class="text">{{ $content->title }}</div>
                            --}}
                        </div>
                    @endforeach
                @endisset

                {{-- <div class="mySlides fade">
                    <picture>
                        <source media="(min-width: 900px)"
                            srcset="{{ asset('/img/900_main-banner.jpg') }} 1x, {{ asset('/img/1800_main-banner.jpg') }} 2x"
                            type="image/jpeg">
                        <source media="(min-width: 601px)"
                            srcset="{{ asset('/img/600_main-banner.jpg') }} 1x, {{ asset('/img/1200_main-banner.jpg') }} 2x"
                            type="image/jpeg">
                        <source media="(max-width: 600px)"
                            srcset="{{ asset('/img/600_main-banner.jpg') }} 1x, {{ asset('/img/600_main-banner.jpg') }} 1x"
                            type="image/jpeg">
                        <img class="shadow2" src="{{ asset('/img/900_main-banner.jpg') }}" type="image/jpeg"
                            alt="my image description">
                    </picture>
                    <div class="text">طراحی سایت و سئو - طرح و وب</div>
                </div> --}}
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <div class="full third-500 banner-left flex one">

            <div>
                <figure class="image">
                    <img src="{{ asset('/img/bt.jpg') }}" sizes="(max-width:300px) 100vw 300px 600px " alt=""
                        width="383" height="182" srcset="
                                            {{ asset('/img/bt-small.jpg') }} 383w,
                                            {{ asset('/img/bt.jpg') }} 500w,
                                            {{ asset('/img/bt-large.jpg') }} 2x">

                </figure>
            </div>
            <div class="pb-0">
                <figure class="image">
                    <img src="{{ asset('/img/bt.jpg') }}" sizes="(max-width:300px) 100vw 300px 600px " alt=""
                        width="383" height="182" srcset="
                                            {{ asset('/img/bt-small.jpg') }} 383w,
                                            {{ asset('/img/bt.jpg') }} 500w,
                                            {{ asset('/img/bt-large.jpg') }} 2x">

                </figure>
            </div>


        </div>
    </div>
</section>




<section class="index-item-top  mt-0 mb-0 pt-2 pb-2 bg-white category-section" onresize="onResize()">
    <div class="flex one  ">
        <div class="siema p-0">
            {{--category&label=cat&var=category&count=10--}}
            @isset($category['data'])
                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="hover text-center">
                            @if (isset($content->images['thumb']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small'] ?? $content->images['thumb'] }}"
                                        sizes="(max-width:{{ env('CATEGORY_SMALL') }}px) 100vw {{ env('CATEGORY_SMALL') }}px {{ ENV('CATEGORY_MEDIUM') }}px {{ ENV('CATEGORY_LARGE') }}px"
                                        alt="{{ $content->title }}" width="200" height="200"
                                        srcset="
                                                                        {{ $content->images['images']['small'] ?? $content->images['thumb'] }} {{ env('CATEGORY_SMALL') }}w,
                                                                        {{ $content->images['images']['medium'] ?? $content->images['thumb'] }} {{ env('CATEGORY_MEDIUM') }}w,
                                                                        {{ $content->images['images']['large'] ?? $content->images['thumb'] }} 2x">
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
            @endisset
        </div>
        <a class="prev2">&#10094;</a>
        <a class="next2">&#10095;</a>
    </div>
</section>



<section class="index-items bg-pink mt-0 mb-0">
    <div class="flex one">
        <div>
            <div class="flex one three-500 five-900   ">
                {{--post&label=topView&var=topViewPost&count=10--}}
                @isset($topViewPost['data'])
                    @foreach ($topViewPost['data'] as $content)
                        <div>
                            <article class="shadow2">
                                @if (isset($content->images['thumb']))
                                    <figure class="image">
                                        <img src="{{ $content->images['images']['small'] ?? $content->images['thumb'] }}"
                                            sizes="(max-width:{{ env('ARTICLE_SMALL') }}px) 100vw {{ env('ARTICLE_SMALL') }}px {{ ENV('ARTICLE_MEDIUM') }}px"
                                            alt="{{ $content->title }}" width="100" height="100"
                                            srcset="
                                                                    {{ $content->images['images']['small'] ?? $content->images['thumb'] }} {{ env('ARTICLE_SMALL') }}w,
                                                                    {{ $content->images['images']['medium'] ?? $content->images['thumb'] }} 2x">
                                    </figure>
                                @endif

                                <a href="{{ $content->slug }}"> {{ $content->title }}</a>
                                <div class="info">
                                    {!! readMore($content->brief_description, 350) !!}
                                </div>
                                <div class="rate mt-1">
                                    @if (count($content->comments))
                                        @php
                                        $rateAvrage = $rateSum = 0;
                                        @endphp
                                        @foreach ($content->comments as $comment)
                                            @php
                                            $rateSum = $rateSum + $comment['rate'] ;
                                            @endphp
                                        @endforeach
                                        @for ($i = $rateSum / count($content->comments); $i >= 1; $i--)
                                            <img width="20" height="20"
                                                srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
                                        @endfor
                                    @endif
                                </div>

                            </article>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
</section>


@endsection
