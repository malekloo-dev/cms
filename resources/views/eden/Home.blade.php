@extends(@env('TEMPLATE_NAME') . '.App')

@section('canonical', url(''))

@section('footer')

    <script src="{{ asset('/siema.min.js') }}"></script>
    <script>
        var w;
        var perPageNumber, perPageNumberProducts;

        function perPage() {
            w = window.innerWidth;
            console.log(w);
            if (w <= 500) {
                perPageNumber = 3;
                perPageNumberProducts = 2;
            } else if (w <= 768) {
                perPageNumber = 5;
                perPageNumberProducts = 4;
            } else if (w <= 1024) {
                perPageNumber = 5;
                perPageNumberProducts = 4;
            } else {
                perPageNumber = 5;
                perPageNumberProducts = 4;
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
            loop: true,
            rtl: true,
            onInit: () => {},
            onChange: () => {

            },
        });
        document.querySelector('.prev-cat').addEventListener('click', () => mySiema.prev());
        document.querySelector('.next-cat').addEventListener('click', () => mySiema.next());




        // new product




        var products = new Siema({
            selector: '.siema-products',
            duration: 200,
            easing: 'ease-out',
            perPage: perPageNumberProducts,
            startIndex: 0,
            draggable: true,
            multipleDrag: true,
            threshold: 20,
            loop: true,
            rtl: true,
            onInit: () => {},
            onChange: () => {

            },
        });
        document.querySelector('.prev-products').addEventListener('click', () => products.prev());
        document.querySelector('.next-products').addEventListener('click', () => products.next());


        var products_women = new Siema({
            selector: '.siema-products-women',
            duration: 200,
            easing: 'ease-out',
            perPage: perPageNumberProducts,
            startIndex: 0,
            draggable: true,
            multipleDrag: true,
            threshold: 20,
            loop: true,
            rtl: true,
            onInit: () => {},
            onChange: () => {

            },
        });
        document.querySelector('.prev-products-women').addEventListener('click', () => products_women.prev());
        document.querySelector('.next-products-women').addEventListener('click', () => products_women.next());

        var products2 = new Siema({
            selector: '.siema-products2',
            duration: 200,
            easing: 'ease-out',
            perPage: perPageNumberProducts,
            startIndex: 0,
            draggable: true,
            multipleDrag: true,
            threshold: 20,
            loop: true,
            rtl: true,
            onInit: () => {},
            onChange: () => {

            },
        });
        document.querySelector('.prev-products2').addEventListener('click', () => products2.prev());
        document.querySelector('.next-products2').addEventListener('click', () => products2.next());

        var products3 = new Siema({
            selector: '.siema-products3',
            duration: 200,
            easing: 'ease-out',
            perPage: perPageNumberProducts,
            startIndex: 0,
            draggable: true,
            multipleDrag: true,
            threshold: 20,
            loop: true,
            rtl: true,
            onInit: () => {},
            onChange: () => {

            },
        });
        document.querySelector('.prev-products3').addEventListener('click', () => products3.prev());
        document.querySelector('.next-products3').addEventListener('click', () => products3.next());

        var products4 = new Siema({
            selector: '.siema-products4',
            duration: 200,
            easing: 'ease-out',
            perPage: perPageNumberProducts,
            startIndex: 0,
            draggable: true,
            multipleDrag: true,
            threshold: 20,
            loop: true,
            rtl: true,
            onInit: () => {},
            onChange: () => {

            },
        });
        document.querySelector('.prev-products4').addEventListener('click', () => products4.prev());
        document.querySelector('.next-products4').addEventListener('click', () => products4.next());
    </script>
@endsection

@section('Content')


    <section class="banner my-0 py-0">
        <div class="flex one max-w-max" >
            <img class="h-auto p-0"
                srcset="{{ url('eden/img/banner-mom-mob.jpg') }} 800w, {{ url('eden/img/banner-mom.jpg') }} 1200w, {{ url('eden/img/banner-mom.jpg') }} 1800w"
                src="{{ url('eden/img/banner-mom-mob.jpg') }}" alt="طلای ایدن" title="طلای ایدن" width="1200" height="344">

        </div>
    </section>





    <section class="index-item-top  mt-0 mb-0  bg-white category-section " onresize="onResize()">
        <div class="   relative px-2 ">
            <div class="siema p-0">
                {{--category&label=cat&var=category&count=10 --}}
                @isset($category['data'])
                    @foreach ($category['data'] as $content)
                        <a href="{{ $content->slug }}">
                            <div class="hover text-center">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        <img loading="lazy" src="{{ $content->images['images']['small'] }}"
                                            alt="{{ $content->title }}" width="61" height="79"
                                            srcset="
                                                                                        {{ $content->images['images']['small'] }} {{ env('CATEGORY_SMALL_W') }}w,
                                                                                        {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_MEDIUM_W') }}w">
                                        <figcaption>
                                            <h2 class="p-0 m-0 text-center font-08 font-normal"> {{ $content->title }}</h2>
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
            <a class="prev2 prev-cat">&#10094;</a>
            <a class="next2 next-cat">&#10095;</a>
        </div>
    </section>




    <section class="category-section mt-1 mb-0 ">
        <div class="relative px-7 lg:px-10 bg-white shadow3">

            <div class="text-center">
                <h2>محصولات جدید</h2>
            </div>

            <div class="siema-products  ">
                {{--product&label=new&var=products&count=12 --}}
                @isset($products['data'])
                    @foreach ($products['data'] as $content)
                        <a href="{{ $content->slug }}" >
                            <div class=" hover p-0   h-full px-0.5">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                        @endif
                                        <img src="{{ $content->images['images']['large'] }}" alt="{{ $content->title }}"
                                            title="{{ $content->title }}" width="" height="300">
                                        <figcaption>
                                            <h3 class="px-1 py-0 m-0 text-center "
                                                style="white-space: nowrap;text-overflow: ellipsis; overflow: hidden;">
                                                {{ $content->title }}</h3>



                                            <div class="text-green">
                                                @isset($content->attr['weight'])
                                                    @convertCurrency(calcuteGoldPrice($content->attr['weight'] ?? 0, $content->attr['additionalprice'] ?? 0, $content->attr['ojrat'] ?? 18)['totalPrice']) تومان
                                                @else
                                                    تماس گرفته شود
                                                @endisset
                                            </div>
                                        </figcaption>
                                    </figure>
                                @else
                                    <figure class="image">
                                        @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                        @endif
                                        <img class="m-auto p-4" width="300" height="300"
                                            src="https://img.icons8.com/ios/100/cccccc/no-image.png" alt="company-no-image" />
                                    </figure>
                                    <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                @endif

                            </div>
                        </a>
                    @endforeach
                @endisset
            </div>
            <a class="prev2 prev-products">&#10094;</a>
            <a class="next2 next-products">&#10095;</a>


            {{--<div class="text-center my-1">
                <a class="btn bg-theme-color text-center border-radius-5" href="/محصولات">دیدن تمامی محصولات</a>
            </div> --}}
        </div>

    </section>


    <section class="bg-white mt-1 lg:py-10 lg:my-5">
        <div>
            <div class="flex one three-500 p-0">
                <div class="third-500 p-0">
                    <h2 class="text-center ">چرا گالری طلا ایدن را انتخاب نماییم؟</h2>
                </div>
                <div class="two-third-500 p-0 ">
                    <div class="flex on three-500  h-full p-0 text-center  home-items">
                        <div class="p-0 align-items-center"><span
                                class="p-0 bg-theme-color2 third-500 border-radius-5 w-1">1</span>
                            <div class="font-09"> خرید طلا بدون واسطه از طلا ساز</div>
                        </div>
                        <div class="p-0 align-items-center"><span
                                class="p-0 bg-theme-color2 third-500 border-radius-5">2</span>
                            <div class="font-09">ضمانت اصالت محصول</div>
                        </div>
                        <div class="p-0 align-items-center"><span
                                class="p-0 bg-theme-color2 third-500 border-radius-5">3</span>
                            <div class="font-09"> ضمانت بازگشت و تعویض</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="category-section mt-1 mb-0 ">
        <div class="relative px-7 lg:px-10 bg-white  shadow3">

            <div class="text-center">
                <h2> طلای بانوان</h2>
            </div>

            <div class="siema-products-women  ">
                {{--product&label=products_women&var=products_women&count=6 --}}
                @isset($products_women['data'])
                    @foreach ($products_women['data'] as $content)
                        <a href="{{ $content->slug }}">
                            <div class=" hover p-0   h-full px-0.5">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                        @endif
                                        <img src="{{ $content->images['images']['large'] }}" alt="{{ $content->title }}"
                                            title="{{ $content->title }}" width="" height="300">
                                        <figcaption>
                                            <h3 class="px-1 py-0 m-0 text-center "
                                                style="white-space: nowrap;text-overflow: ellipsis; overflow: hidden;">
                                                {{ $content->title }}</h3>



                                            <div class="text-green">
                                                @isset($content->attr['weight'])
                                                    @convertCurrency(calcuteGoldPrice($content->attr['weight'] ?? 0, $content->attr['additionalprice'] ?? 0, $content->attr['ojrat'] ?? 18)['totalPrice'] ) تومان
                                                @else
                                                    تماس گرفته شود
                                                @endisset
                                            </div>
                                        </figcaption>
                                    </figure>
                                @else
                                    <figure class="image">
                                        @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                        @endif
                                        <img class="m-auto p-4" width="300" height="300"
                                            src="https://img.icons8.com/ios/100/cccccc/no-image.png" alt="company-no-image" />
                                    </figure>
                                    <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                @endif

                            </div>
                        </a>
                    @endforeach
                @endisset
            </div>
            <a class="prev2 prev-products-women">&#10094;</a>
            <a class="next2 next-products-women">&#10095;</a>


            {{--<div class="text-center my-1">
                <a class="btn bg-theme-color text-center border-radius-5" href="/محصولات">دیدن تمامی محصولات</a>
            </div> --}}
        </div>

    </section>


    <section class="category-section mt-1 mb-0 lg:my-10 ">
        <div class="relative  shadow p-0">



            <div class="flex two six-500 p-0 ">
                <a class="  p-0 bg-gray-dark cat1-home" href="/انگشتر-طلا-زنانه"
                    style=" background-image:url({{ url('eden/img/دسته-بندی-انگشتر-طلا.jpg') }}) ">
                    <div class="h-full">
                        <h2 class="p-0">انگشتر</h2>
                    </div>
                </a>

                {{--product&label=procat1&var=procat1&count=4 --}}
                @isset($procat1['data'])
                    @foreach ($procat1['data'] as $content)
                        <a class="p-0" href="{{ $content->slug }}">
                            <div class="shadow hover p-0   h-full">

                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                        @endif
                                        <img src="{{ $content->images['images']['large'] }}" alt="{{ $content->title }}"
                                            title="{{ $content->title }}" width="" height="300">
                                        <figcaption>
                                            <h3 class="px-0 m-0 text-center"> {{ $content->title }}</h3>

                                            <div class="text-green">
                                                @isset($content->attr['weight'])
                                                    @convertCurrency(calcuteGoldPrice($content->attr['weight'] ?? 0, $content->attr['additionalprice'] ?? 0, $content->attr['ojrat'] ?? 18)['totalPrice']) تومان
                                                @else
                                                    تماس گرفته شود
                                                @endisset
                                            </div>

                                        </figcaption>
                                    </figure>
                                @else
                                    <figure class="image">
                                        @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                        @endif
                                        <img class="m-auto p-4" width="300" height="300"
                                            src="https://img.icons8.com/ios/100/cccccc/no-image.png" alt="company-no-image" />
                                    </figure>
                                    <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                @endif

                            </div>
                        </a>
                    @endforeach
                @endisset
            </div>



        </div>

    </section>

    <section class="category-section mt-1 mb-0 ">
        <div class="relative px-7 lg:px-10 bg-white  shadow3">

            <div class="text-center">
                <h2>طلای آقایان </h2>
            </div>

            <div class="siema-products2  ">
                {{--product&label=products2&var=products2&count=6 --}}
                @isset($products2['data'])
                    @foreach ($products2['data'] as $content)
                        <a href="{{ $content->slug }}">
                            <div class=" hover p-0   h-full px-0.5">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                        @endif
                                        <img src="{{ $content->images['images']['large'] }}" alt="{{ $content->title }}"
                                            title="{{ $content->title }}" width="" height="300">
                                        <figcaption>
                                            <h3 class="px-1 py-0 m-0 text-center "
                                                style="white-space: nowrap;text-overflow: ellipsis; overflow: hidden;">
                                                {{ $content->title }}</h3>



                                            <div class="text-green">
                                                @isset($content->attr['weight'])
                                                    @convertCurrency(calcuteGoldPrice($content->attr['weight'] ?? 0, $content->attr['additionalprice'] ?? 0, $content->attr['ojrat'] ?? 18)['totalPrice']) تومان
                                                @else
                                                    تماس گرفته شود
                                                @endisset
                                            </div>
                                        </figcaption>
                                    </figure>
                                @else
                                    <figure class="image">
                                        @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                        @endif
                                        <img class="m-auto p-4" width="300" height="300"
                                            src="https://img.icons8.com/ios/100/cccccc/no-image.png" alt="company-no-image" />
                                    </figure>
                                    <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                @endif

                            </div>
                        </a>
                    @endforeach
                @endisset
            </div>
            <a class="prev2 prev-products2">&#10094;</a>
            <a class="next2 next-products2">&#10095;</a>


            {{--<div class="text-center my-1">
                <a class="btn bg-theme-color text-center border-radius-5" href="/محصولات">دیدن تمامی محصولات</a>
            </div> --}}
        </div>

    </section>

    <section class="category-section mt-1 mb-0 ">
        <div class="relative px-7 lg:px-10 bg-white  shadow3">

            <div class="text-center">
                <h2> طلای بچگانه</h2>
            </div>

            <div class="siema-products3  ">
                {{--product&label=products3&var=products3&count=6 --}}
                @isset($products3['data'])
                    @foreach ($products3['data'] as $content)
                        <a href="{{ $content->slug }}">
                            <div class=" hover p-0   h-full px-0.5" >
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                        @endif
                                        <img src="{{ $content->images['images']['large'] }}" alt="{{ $content->title }}"
                                            title="{{ $content->title }}" width="" height="300">
                                        <figcaption>
                                            <h3 class="px-1 py-0 m-0 text-center "
                                                style="white-space: nowrap;text-overflow: ellipsis; overflow: hidden;">
                                                {{ $content->title }}</h3>



                                            <div class="text-green">
                                                @isset($content->attr['weight'])
                                                    @convertCurrency(calcuteGoldPrice($content->attr['weight'] ?? 0, $content->attr['additionalprice'] ?? 0, $content->attr['ojrat'] ?? 18)['totalPrice']) تومان
                                                @else
                                                    تماس گرفته شود
                                                @endisset
                                            </div>
                                        </figcaption>
                                    </figure>
                                @else
                                    <figure class="image">
                                        @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                        @endif
                                        <img class="m-auto p-4" width="300" height="300"
                                            src="https://img.icons8.com/ios/100/cccccc/no-image.png" alt="company-no-image" />
                                    </figure>
                                    <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                @endif

                            </div>
                        </a>
                    @endforeach
                @endisset
            </div>
            <a class="prev2 prev-products3">&#10094;</a>
            <a class="next2 next-products3">&#10095;</a>


            {{--<div class="text-center my-1">
                <a class="btn bg-theme-color text-center border-radius-5" href="/محصولات">دیدن تمامی محصولات</a>
            </div> --}}
        </div>

    </section>






    <section class="category-section mt-1 mb-3">
        <div class="relative px-2 bg-white  shadow3">

            <div class="text-center">
                <h2>مقالات</h2>
            </div>

            <div class="siema-products4  ">
                {{--post&label=articles&var=articles&count=4 --}}
                @isset($articles['data'])
                    @foreach ($articles['data'] as $content)
                        <a href="{{ $content->slug }}">
                            <div class=" hover p-0   h-full">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        <img src="{{ $content->images['images']['large'] }}" alt="{{ $content->title }}"
                                            title="{{ $content->title }}" width="" height="300">
                                        <figcaption>
                                            <h3 class="px-1 py-0 m-0 text-center "
                                                style="white-space: nowrap;text-overflow: ellipsis; overflow: hidden;">
                                                {{ $content->title }}</h3>
                                        </figcaption>
                                    </figure>
                                @else
                                    <figure class="image">

                                        <img class="m-auto p-4" width="300" height="300"
                                            src="https://img.icons8.com/ios/100/cccccc/no-image.png" alt="company-no-image" />
                                    </figure>
                                    <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                @endif

                            </div>
                        </a>
                    @endforeach
                @endisset
            </div>
            {{--<a class="prev2 prev-products4">&#10094;</a>
            <a class="next2 next-products4">&#10095;</a> --}}


            {{--<div class="text-center my-1">
                <a class="btn bg-theme-color text-center border-radius-5" href="/محصولات">دیدن تمامی محصولات</a>
            </div> --}}
        </div>

    </section>







    {{--<section class="mt-4">
        <div class="flex one two-500 three-900  ">
            <div style="flex:0 0 auto" class="text-center">

                <video style="max-width: 100%" width="400" height="400" preload="none" onclick="this.paused ? this.play() : this.pause()"
                    controlslist="nodownload nofullscreen " poster="{{ url('eden/video/cover.jpg') }}" controls="">
                    <source src="{{ url('eden/video/edengoldgallery.mp4') }}" type="video/mp4">
                    {{ -- <source src="movie.ogg" type="video/ogg"> --} }
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="two-third-900">

                <div class="flex h-full justify-content-center flex-column ">
                    <h1> خرید آنلاین طلا از فروشگاه اینترنتی ایدن</h1>
                    <div>کارگاه طلاسازی ایدن از سال ۱۴۰۰ فعالیت خود را در زمینه طراحی و تولید زیورآلات طلا آغاز کرد </div>
                </div>
            </div>
        </div>
    </section> --}}


    {{--<section>
        <div class="">
            <div class="flex one">
                @php
                    $gold = getGoldPrice();

                @endphp
                <div>قیمت روز طلا: {{ $gold['price'] }} تومان </div>
            </div>
        </div>
    </section> --}}
@endsection
