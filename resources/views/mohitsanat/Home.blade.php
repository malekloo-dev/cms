@extends(@env('TEMPLATE_NAME').'.App')

@section('head')

@endsection
@section('footer')

@endsection

@section('Content')
    <section class="index-item-top bg-green mt-0 mb-0">
        <div class="text-center">
            <h1>آزمایشگاه محیط و صنعت ایمن پایش </h1>
        </div>
    </section>

    <section>
        <div>

            <h1>آزمایشگاه معتمد محیط زیست</h1>
            <div class="flex one two-700">
                <div><img src="{{ asset('img/آزمایشگاه-محیط-زیست.jpg') }}" alt=""></div>
                <div>
                    محیط و صنعت ایمن پایش یکی از شرکت های دارای گواهینامه آزمایشگاه محیط زیست از سازمان محیط زیست می باشد. خدمات این شرکت در زمینه سنجش و آنالیز میزان آلودگی های هوا و صدا ، آب و پساب و خاک و پسماند می باشد.
                    <br>آزمایشگاه های زیست محیطی برای مشاوران ، مدیران ، تنظیم کنندگان ، متخصصان بهداشت و ایمنی و تیم های تحقیقاتی در مراکز مختلف ضروری است. تکنسین های آزمایشگاهی برای شناسایی و تعیین کمیت مواد ، آزمایشات آزمایشگاهی را انجام می دهند. آزمایشگاه محیط زیست آلودگی هایی را که بر محیط زیست و سلامت انسان و حیات وحش تأثیر می گذارد ، آزمایش می کنند. این آزمایشات با پیشرفته ترین ابزار در آزمایشگاه ایمن پایش انجام می شود.
                </div>
            </div>
            <div>
                آزمایشگاه محیط و صنعت ایمن پایش انواع برنامه های آزمایش و نظارت را ارائه می دهند. آزمایشگاه های کیفیت هوا ما برای طیف وسیعی از برنامه های محیطی از جمله شناسایی یا نظارت بر انتشار گازها مجهز هستند. ما امکانات نظارتی سفارشی را با تهیه نمونه و آنالیز آن فراهم می کنیم. این واحدها برای سیستم های بزرگ تصفیه آب ایده آل هستند. واحدهای سیار ما امکان تجزیه و تحلیل سریع خاک و پسماند را در سراسر ایران بر عهده دارند.
            </div>
        </div>
    </section>



    <section class="index-items home-top-view">
        <div class="flex one">
            <div>
                <div class="flex three    center ">
                    {{--category&label=topViewPost&var=topViewPost&count=10 --}}
                    @isset($topViewPost['data'])
                        @foreach ($topViewPost['data'] as $content)
                            <div>
                                <a class="hover shadow2 " href="{{ $content->slug }}">

                                    @if (isset($content->images['thumb']))
                                        <div><img alt="{{ $content->title }}"
                                                width="{{ env('CATEGORY_SMALL_W') }}" height="{{ env('CATEGORY_SMALL_H') }}"
                                                src="{{ $content->images['images']['small'] }}" srcset="
                                                {{ $content->images['images']['small'] }} 850w,
                                                {{ $content->images['images']['medium'] }} 1536w,
                                                {{ $content->images['images']['large'] }} 2880w
                                                    "
                                                    sizes="
                                                    (min-width:1366px) {{ env('CATEGORY_SMALL_W') }}px,
                                                    (min-width:1536px) {{ env('CATEGORY_MEDIUM_W') }}px,
                                                    (min-width:850px) {{ env('CATEGORY_LARGE_W') }}px
                                                    "
                                                    ></div>
                                    @endif
                                    <h3> {{ $content->title }}</h3>
                                </a>
                            </div>
                        @endforeach

                    @endisset
                </div>
            </div>
        </div>
    </section>

    <section class=" bg-gray-dark pt-3 pb-2 m-0">
        <div class="flex one center">
            <div class="text-center">
                شرکت محیط و صنعت ایمن پایش دارای گواهینامه آزمایشگاه معتمد سازمان محیط زیست – گواهینامه IMS –  گواهینامه ISO 9001- –  گواهینامهISO 14001 – گواهینامهISO 45001 می باشد.
            </div>
            <a class="button" href="/گواهینامه ها">گواهینامه ها</a>
        </div>
    </section>


    <section class="index-items  bg-gray  m-0">
        <div class="flex one">
            <div>
                <h2 class="text-center">پروژه های محیط و صنعت ایمن پایش</h2>
                <div class="text-center">
                    محیط و صنعت ایمن پایش دارای گواهینامه آزمایشگاه معتمد محیط زیست به شماره 0510-9606-18 با سال ها سابقه در زمینه پایش و آنالیز آلاینده های زیست محیطی میباشد و همچنین این شرکت در راستای بهبود کیفیت موفق به اخذ گواهینامه های IMS – ISO 9001 – ISO 14001 –  ISO 45001 گردیده.
                </div>
                {{--post&label=project&var=project&count=6--}}
                @isset($project['data'])
                    <div  class="flex one two-500  three-800 center mt-2">
                        @foreach ($project['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['thumb']))
                                        <div><img width="{{ env('ARTICLE_SMALL_W') }}" height="{{ env('ARTICLE_SMALL_H') }}" src="{{ $content->images['thumb'] }}"></div>
                                    @endif
                                    <footer>
                                        <h3> {{ $content->title }}</h3>
                                        <p>{{ $content->brief_description }}</p>
                                    </footer>

                                </a>
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
    </section>

    <section>
        <div class="flex one text-center">
            <h2>مشخصات آزمایشگاه معتمد محیط زیست</h2>
            <div>
                فعالیت های ما در زمینه آنالیز هوا و صدا سنجش گازها و ذرات دودکش ، صدای محیط زیستی ،ذرات و گاز های محیطی ، فلزات سنگین – آب و پساب و سنجش میکروب ، اندازه گیری فلزات سنگین و پارامترهای فیزیکی و شیمیایی – خاک و پسماند از جمله سنجش پارامترهای خاک و فلزات سنگین در خاک می باشد که با تجهیزات مناسب و مدرن در این زمینه علاوه بر شناسایی آلودگی های محیطی راه حل هایی برای رفع مشکلات شما نیز ارائه می دهد.
<br>امروزه با افزایش میزان آلودگی ها و ایجاد مشکلات و بیماری ها نیاز به آزمایشگاه ها برای سنجش آلودگی های محیطی بیشتر شده است تا علاوه بر سلامت بتوانیم استاندار ها را رعایت کنیم . ما با سال ها سابقه در زمینه خدمات آزمایشگاهی و آنالیز محیط زیست بهترین خدمات را به شما ارائه می دهیم.
<br>
شرکت های دارای گواهینامه آزمایشگاه معتمد محیط زیست خدماتی برای کاهش آلودگی های زیست محیطی انجام می دهند. این خدمات در زمینه هوا و صدا ، آب، پساب و فاضلاب ،خاک وپسماند میباشد.
<br>

مراکز دارای گواهینامه آزمایشگاه معتمد محیط زیست می توانند سنجش و آنالیز در زمینه آلاینده های محیط زیست را انجام دهند . از جمله این فعالیت ها پایش آلودگی های ناشی از فعالیت کارخانه ها و صنایع می باشد. پایش و آنالیز هوا، آب و فاضلاب ، پساب ، خاک و پسماند نیز از دیگر خدمات این مراکز برای حفظ و بهبود محیط زیست می باشد.
            </div>
        </div>
    </section>



    <section class="index-items articles bg-gray2 home-top-view mb-0">
        <div class="flex one">
            <div>
                <h2>مقالات</h2>
                <div class="flex one two-500  three-800 center ">
                    {{--post&label=articles&var=articles&count=9 --}}
                    @isset($articles['data'])
                        @foreach ($articles['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['thumb']))
                                        <div><img width="{{ env('ARTICLE_SMALL_W') }}" height="{{ env('ARTICLE_SMALL_H') }}" src="{{ $content->images['thumb'] }}"></div>
                                    @endif
                                    <footer>
                                        <h3> {{ $content->title }}</h3>
                                    </footer>

                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </section>

@endsection