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
            perPageNumber = 3;
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
        onChange: () => {},
    });
    document.querySelector('.prev2').addEventListener('click', () => mySiema.prev());
    document.querySelector('.next2').addEventListener('click', () => mySiema.next());
</script>
@endsection

@section('Content')


<section class="index-item-top   ">
    <div class="flex one two-500 center ltr ">
        <div class="third-500 ">
            <img class="banner-t shadow2" src="{{ asset('/img/bt.jpg') }}" srcset="">
            <img class="banner-b shadow2" src="{{ asset('/img/bb.jpg') }}" srcset="">
        </div>
        <div class="two-third-500 slideshow-container pb-0 pl-1 ">

            <div class="mySlides fade ">

                <img class="shadow2" src="{{ asset('/img/main-banner.jpg') }}" style="width:100%">
                <div class="text">طراحی سایت و سئو - طرح و وب</div>
            </div>

            <div class="mySlides fade">

                <img class="shadow2" src="{{ asset('/img/main-banner.jpg') }}" style="width:100%">
                <div class="text">طراحی سایت و سئو - طرح و وب</div>
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

        </div>




    </div>
</section>




<section class="index-item-top  mt-0 mb-0 pt-5 pb-5 bg-white category-section" onresize="onResize()">
    <div class="flex one center  ">
        <div class="siema p-0">
            @foreach($category as $content)
            <a href="{{ $content->slug }}">
                <div class="hover text-center">
                    @if(isset($content->images['thumb']))
                    <img src="{{ $content->images['thumb'] }}" srcset="
                {{ $content->images['thumb'] }} ,
                {{ $content->images['thumb'] }} 1.5x,
                {{ $content->images['thumb'] }} 2x">
                    @endif
                    <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                </div>
            </a>
            @endforeach

        </div>
        <a class="prev2">&#10094;</a>
        <a class="next2">&#10095;</a>
    </div>
</section>



<section class="index-items bg-pink">
    <div class="flex one">
        <div>
            <div class="flex one five-500   ">
                @foreach($topViewPost as $content)
                <div>
                    <article class="shadow2">
                        @if(isset($content->images['thumb']))
                        <img src="{{ $content->images['thumb'] }}">
                        @else
                        <img src="{{ asset('/img/site1.jpg') }}">
                        @endif
                        <h2><a href="{{ $content->slug }}"> {{ $content->title }}</a></h2>
                        <div class="info">
                            {!! $content->brief_description !!}
                        </div>

                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


@endsection
