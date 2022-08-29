@extends(@env('TEMPLATE_NAME') . '.App')

@section('footer')
    <script src="{{ asset('/siema.min.js') }}"></script>
    <script>
        var w;
        var perPageNumber,perPageNumberProducts;

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
            loop: false,
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
            loop: false,
            rtl: true,
            onInit: () => {},
            onChange: () => {

            },
        });
        document.querySelector('.prev-products').addEventListener('click', () => products.prev());
        document.querySelector('.next-products').addEventListener('click', () => products.next());
    </script>
@endsection

@section('Content')


    <section class="banner my-0 py-0">
        <div class="flex one">
            <img class="h-auto p-0" src="{{ url('eden/img/banner1.jpg') }}" alt="طلای ایدن" title="طلای ایدن"
                width="1200" height="344">

        </div>
    </section>





    <section class="index-item-top  mt-0 mb-0 pt-2 pb-2 bg-white category-section " onresize="onResize()">
        <div class="   relative p-2 ">
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
            <a class="prev2 prev-cat">&#10094;</a>
            <a class="next2 next-cat">&#10095;</a>
        </div>
    </section>




    <section class="category-section mt-0 mb-0 ">
        <div class="relative px-2 ">

            <div class="text-center">
                <h2>محصولات جدید</h2>
            </div>

            <div class="siema-products  ">
                {{--product&label=products&var=products&count=12 --}}
                @isset($products['data'])
                    @foreach ($products['data'] as $content)
                        <a href="{{ $content->slug }}" >
                            <div class="shadow hover p-0   h-full">
                                @if (isset($content->images['images']['small']))
                                    <figure class="image">
                                        <img src="{{ $content->images['images']['large'] }}" alt="{{ $content->title }}"
                                            title="{{ $content->title }}" width="" height="300">
                                        <figcaption>
                                            <h3 class="px-1 py-0 m-0 text-center " style="white-space: nowrap;text-overflow: ellipsis; overflow: hidden;"> {{ $content->title }}</h3>
                                            <div class="text-green">@convertCurrency(calcuteGoldPrice($content->attr['weight']?? 0,$content->attr['additionalprice']?? 0)['totalPrice']) تومان</div>
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
            <a class="prev2 prev-products">&#10094;</a>
            <a class="next2 next-products">&#10095;</a>


            {{-- <div class="text-center my-1">
                <a class="btn bg-theme-color text-center border-radius-5" href="/محصولات">دیدن تمامی محصولات</a>
            </div> --}}
        </div>

    </section>


    <section class="bg-white mt-3">
        <div>
            <div class="flex one three-500 p-0">
                <div class="third-500 p-0">
                    <h2 class="text-center ">چرا گالری طلا ایدن را انتخاب نماییم؟</h2>
                </div>
                <div class="two-third-500 p-0 ">
                    <div class="flex on three-500  h-full p-0 text-center  home-items">
                        <div class="p-0 align-items-center"><span
                                class="p-0 bg-theme-color2 third-500 border-radius-5 w-1">1</span>
                            <div> خرید طلا بدون واسطه از طلا ساز</div>
                        </div>
                        <div class="p-0 align-items-center"><span
                                class="p-0 bg-theme-color2 third-500 border-radius-5">2</span>
                            <div>ضمانت اصالت محصول</div>
                        </div>
                        <div class="p-0 align-items-center"><span
                                class="p-0 bg-theme-color2 third-500 border-radius-5">3</span>
                            <div> ضمانت بازگشت و تعویض</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="category-section mt-4 mb-0 ">
        <div class="relative  shadow p-0">



            <div class="flex two six-500 p-0 ">
                <a class="  p-0 bg-gray-dark cat1-home" href=""
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
                                        <img src="{{ $content->images['images']['large'] }}" alt="{{ $content->title }}"
                                            title="{{ $content->title }}" width="" height="300">
                                        <figcaption>
                                            <h3 class="px-0 m-0 text-center"> {{ $content->title }}</h3>
                                            <div class="text-green">@convertCurrency(calcuteGoldPrice($content->attr['weight']?? 0,$content->attr['additionalprice']?? 0)['totalPrice']) تومان</div>

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



        </div>

    </section>



    <section class="mt-4">
        <div class="flex one two-500 three-900  ">
            <div style="flex:0 0 auto" class="text-center">

                <video style="max-width: 100%" width="400" height="400" preload="none" onclick="this.paused ? this.play() : this.pause()"
                    controlslist="nodownload nofullscreen " poster="{{ url('eden/video/cover.jpg') }}" controls="">
                    <source src="{{ url('eden/video/edengoldgallery.mp4') }}" type="video/mp4">
                    {{-- <source src="movie.ogg" type="video/ogg"> --}}
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
    </section>


    {{-- <section>
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
