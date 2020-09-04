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
        dots[slideIndex - 1].className += " active";
    }
</script>
@endsection

@section('Content')


<section class="index-item-top   ">
    <div class="flex one two-500 center ltr ">
        <div class="third-500 ">
            <img class="banner-t shadow2" src="{{ asset('/img/bt.jpg') }}" srcset="">
            <img class="banner-b shadow2" src="{{ asset('/img/bb.jpg') }}" srcset="">
        </div>
        <div class="two-third-500 slideshow-container pb-0 pl-1">

            <div class="mySlides fade ">
                <div class="numbertext">1 / 1</div>
                <img class="shadow2" src="{{ asset('/img/main-banner.jpg') }}" style="width:100%">
                <div class="text">طراحی سایت و سئو - طرح و وب</div>
            </div>

            <div class="mySlides fade pt-1">
                <div class="numbertext">1 / 1</div>
                <img class="shadow2" src="{{ asset('/img/main-banner.jpg') }}" style="width:100%">
                <div class="text">طراحی سایت و سئو - طرح و وب</div>
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

        </div>




    </div>
</section>




<section class="index-item-top  mt-0 mb-0 pt-5 pb-5 bg-white category-section">
    <div class="flex one seven-500 center  ">
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
