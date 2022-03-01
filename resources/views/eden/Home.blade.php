@extends(@env('TEMPLATE_NAME').'.App')

@section('footer')

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
                perPageNumber = 5;
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


    <section class="banner my-0 py-0">
        <div class="flex one">
            <img class="h-auto p-0" src="{{ url('eden/img/banner1.jpg') }}" alt="طلای ایدن" title="طلای ایدن" width="1200" height="344">
            {{-- <h1> گالری طلای ایدن - فروش طلا به قیمت بازار</h1> --}}
        </div>
    </section>





    <section class="index-item-top  mt-0 mb-0 pt-2 pb-2 bg-white category-section " onresize="onResize()">
        <div class="flex one  ">
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
            <a class="prev2">&#10094;</a>
            <a class="next2">&#10095;</a>
        </div>
    </section>




    <section class="bg-gray-black mt-0 mb-0">
        <div class="text-center">
            <h2>محصولات جدید</h2>
        </div>

        <div class="flex one five-500 center  ">
            {{--post&label=products&var=products&count=10 --}}
            @isset($products['data'])
                @foreach ($products['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="shadow hover p-0 border-radius-5 h-full">
                            @if (isset($content->images['images']['small']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['large'] }}"
                                        alt="{{ $content->title }}" title="{{ $content->title }}" width="300" height="300">
                                    <figcaption>
                                        <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                    </figcaption>
                                </figure>
                            @else
                                <figure class="image">
                                    <img class="m-auto p-4" width="300" height="300" src="https://img.icons8.com/ios/100/cccccc/no-image.png" alt="company-no-image"/>
                                </figure>
                                <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                            @endif

                        </div>
                    </a>
                @endforeach

                @endisset
        </div>
        <div class="text-center my-1">
            <a class="btn bg-theme-color text-center border-radius-5" href="/محصولات">دیدن تمامی محصولات</a>
        </div>

    </section>


@endsection
