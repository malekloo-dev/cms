@extends(@env('TEMPLATE_NAME') . '.App')

@section('canonical', url(''))

@section('footer')
    <script src="{{ asset('/siema.min.js') }}"></script>
    <script>
        var w;
        var perPageNumber, perPageNumberProducts;

        allSiema = $('.siema');

        function perPage() {
            w = window.innerWidth;

            if (w <= 500) {
                perPageNumber = 3;
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

        if (allSiema.lenght > 0) {

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

        }
    </script>
@endsection

@section('Content')

    <section class="banner my-0 py-0">
        <div class="flex one max-w-max">
            <img class="h-auto p-0" srcset="{{ asset('/img/banner-mob.jpg') }} 800w, {{ asset('/img/banner.jpg') }} 1200w"
                src="{{ asset('/img/banner-mob.jpg') }}" alt=" " title=" " width="1200" height="344">
        </div>
    </section>

    <section class="mt-5">
        <div class="flex  gap-x-2">
            <img class=" p-0 lg:w-1/3 rounded" srcset="{{ asset('/img/کتاب-الکترونیکی1.jpg') }} 800w"
                src="{{ asset('/img/کتاب-الکترونیکی1.jpg') }}" alt=" " title=" " width=""
                height="">
            <img class="p-0  lg:w-1/3 rounded" srcset="{{ asset('/img/کتاب-صوتی.jpg') }} 800w"
                src="{{ asset('/img/کتاب-صوتی.jpg') }}" alt=" " title=" " width="" height="">
            <img class="p-0  lg:w-1/3 rounded" srcset="{{ asset('/img/کتاب-متنی.jpg') }} 800w"
                src="{{ asset('/img/کتاب-متنی.jpg') }}" alt=" " title=" " width="" height="">

        </div>
    </section>


    <section class=" mt-1 lg:py-10 lg:my-5">
        <div class="flex justify-around items-center border border-gray-900 rounded-md p-5">
            <h2 class="text-center ">ما به شما کمک میکنیم تا در پنل خود کتاب بفروشید. </h2>
            <a class="bg-purple-700 text-white px-5 py-2 rounded " href="">ثبت‌نام و ورود</a>
        </div>
    </section>



    <section class="category-section mt-1 mb-0 ">
        <div class="relative px-7 lg:px-10 bg-white shadow3">
            <h2 class="text-center">محصولات جدید</h2>
            <div class="siema-products">
                {{--product&label=new&var=products&count=12 --}}
                @isset($products['data'])
                    @foreach ($products['data'] as $content)
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
                                                {{ $content->title }}
                                            </h3>


                                            <div class="text-green">
                                                @isset($content->price)
                                                    @convertCurrency($content->price) تومان
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

        </div>
    </section>



@endsection
