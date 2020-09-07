@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')
<link rel="stylesheet" href="{{ asset('/home.css') }}">
@endsection
@section('js')
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

<script src="{{asset('/siema.min.js')}}"></script>
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
            <div class="mySlides fade ">
                <picture>
                    <source media="(min-width: 900px)" srcset="{{ asset('/img/900_main-banner.jpg') }} 1x, {{ asset('/img/1800_main-banner.jpg') }} 2x" type="image/jpeg">
                    <source media="(min-width: 601px)" srcset="{{ asset('/img/600_main-banner.jpg') }} 1x, {{ asset('/img/1200_main-banner.jpg') }} 2x" type="image/jpeg">
                    <source media="(max-width: 600px)" srcset="{{ asset('/img/600_main-banner.jpg') }} 1x, {{ asset('/img/600_main-banner.jpg') }} 1x" type="image/jpeg">
                    <img class="shadow2" src="{{ asset('/img/900_main-banner.jpg') }}" type="image/jpeg" alt="my image description">
                </picture>
                <div class="text">طراحی سایت و سئو - طرح و وب</div>
            </div>
            <div class="mySlides fade">
                <picture>
                    <source media="(min-width: 900px)" srcset="{{ asset('/img/900_main-banner.jpg') }} 1x, {{ asset('/img/1800_main-banner.jpg') }} 2x" type="image/jpeg">
                    <source media="(min-width: 601px)" srcset="{{ asset('/img/600_main-banner.jpg') }} 1x, {{ asset('/img/1200_main-banner.jpg') }} 2x" type="image/jpeg">
                    <source media="(max-width: 600px)" srcset="{{ asset('/img/600_main-banner.jpg') }} 1x, {{ asset('/img/600_main-banner.jpg') }} 1x" type="image/jpeg">
                    <img class="shadow2" src="{{ asset('/img/900_main-banner.jpg') }}" type="image/jpeg" alt="my image description">
                </picture>
                <div class="text">طراحی سایت و سئو - طرح و وب</div>
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <div class="full third-500 banner-left flex one">

            <div>
                <img src="{{ asset('/img/bt.jpg') }}" srcset="">
            </div>
            <div class="pb-0">
                <img src="{{ asset('/img/bb.jpg') }}" srcset="">
            </div>


        </div>
    </div>
</section>




<section class="index-item-top  mt-0 mb-0 pt-2 pb-2 bg-white category-section" onresize="onResize()">
    <div class="flex one  ">
        <div class="siema p-0">
            @foreach($category as $content)
            <a href="{{ $content->slug }}">
                <div class="hover text-center">
                    @if(isset($content->images['thumb']))
                    <picture>
                        <source media="(min-width: 900px)" srcset="{{ $content->images['images']['600'] }} 1x, {{ $content->images['images']['900'] }} 2x" type="image/jpeg">
                        <source media="(min-width: 601px)" srcset="{{ $content->images['images']['300'] }} 1x, {{ $content->images['images']['600'] }} 2x" type="image/jpeg">
                        <source media="(max-width: 600px)" srcset="{{ $content->images['images']['300'] }} 1x, {{ $content->images['images']['300'] }} 1x" type="image/jpeg">
                        <img class="" src="{{ $content->images['images']['300'] }}" type="image/jpeg" alt="my image description">
                    </picture>


                    @endif
                    <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                </div>
            </a>
            @endforeach

        </div>
        <a class="prev2">&#10094;</a>
        <a class="next2">&#10095;</a>
    </div>
</section>



<section class="index-items bg-pink mt-0 mb-0">
    <div class="flex one">
        <div>
            <div class="flex one three-500 five-900   ">
                @foreach($topViewPost as $content)
                <div>
                    <article class="shadow2">
                        @if(isset($content->images['thumb']))
                        <picture>
                            <source media="(min-width: 900px)" srcset="{{ $content->images['images']['600'] }} 1x, {{ $content->images['images']['900'] }} 2x" type="image/jpeg">
                            <source media="(min-width: 601px)" srcset="{{ $content->images['images']['300'] }} 1x, {{ $content->images['images']['600'] }} 2x" type="image/jpeg">
                            <source media="(max-width: 600px)" srcset="{{ $content->images['images']['300'] }} 1x, {{ $content->images['images']['300'] }} 2x" type="image/jpeg">
                            <img class="" src="{{ $content->images['images']['300'] }}" type="image/jpeg" alt="my image description">
                        </picture>

                        @else
                        <img src="{{ asset('/img/site1.jpg') }}">
                        @endif
                        <a href="{{ $content->slug }}"> {{ $content->title }}</a>
                        <div class="info">
                            {!! $content->brief_description !!}
                        </div>
                        <div class="rate mt-1">
                            <img srcset="{{asset('/img/star2x.png')}} 2x , {{asset('/img/star1x.png')}} 1x" src="{{asset('/img/star1x.png')}}">
                            <img srcset="{{asset('/img/star2x.png')}} 2x , {{asset('/img/star1x.png')}} 1x" src="{{asset('/img/star1x.png')}}">
                        </div>

                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


@endsection
