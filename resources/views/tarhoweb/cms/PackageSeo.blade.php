@extends(@env('TEMPLATE_NAME').'.App')

@section('meta-title')
    پکیج های سئو |‌طرح و وب
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('/PackageSeo.css') }}">
@endsection

@section('Content')

    <section class="breadcrumb mb-0">
        <div class="flex one  ">
            <div class="p-0">
                <a href="/">خانه </a>
                @foreach ($breadcrumb as $key => $item)
                    <span>></span>
                    <a href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                @endforeach
            </div>
        </div>
    </section>



    <section class="pro-design-intro m-0 pt-0">
        <div class="flex one two-500 three-900">
            <div>
                <div class="price-list">
                    <div class="price-list-label">SEO</div>
                    <div class="head">
                        <h2>پایه</h2>
                    </div>
                    <div class="featur">
                        <div>تحقیق و تحلیل کلمات کلیدی</div>
                        <div>4 کلمه کلیدی کم رقابت </div>
                        <div>جستجوی ۵ و ۶ کلمه ای
                            <br><span class="font-07"> مانند:آزمایشگاه معتبر محیط زیست در تهران</span>
                        </div>
                        <div>بهینه سازی صفحه فرود</div>
                        <div>On Page SEO</div>
                        <div>Off Page SEO</div>
                        <div>قرار دادن محتوا ۴ صفحه ماهیانه
                            <br><span class="font-07">هزینه تولید محتوا جداگانه محاسبه می شود</span>

                        </div>
                        <div>گزارش ۶ ماهه</div>
                    </div>
                    <div class="price">
                        ماهیانه
                        <div class="font-2">
                            ۲،۰۰۰،۰۰۰ تومان
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="price-list">
                    <div class="price-list-label">SEO</div>
                    <div class="head">
                        <h2>اقتصادی</h2>
                    </div>

                    <div class="featur">
                        <div>تحقیق و تحلیل کلمات کلیدی</div>
                        <div>4 کلمه کلیدی پر رقابت </div>
                        <div>جستجوی ۴ و ۵ کلمه ای
                            <br><span class="font-07"> مانند:آزمایشگاه معتبر محیط زیست </span>

                        </div>
                        <div>بهینه سازی صفحه فرود</div>
                        <div>On Page SEO</div>
                        <div>Off Page SEO</div>
                        <div>قرار دادن محتوا ۸ صفحه ماهیانه
                            <br><span class="font-07">هزینه تولید محتوا جداگانه محاسبه می شود</span>
                        </div>
                        <div> ۲ بک لینک رایگان به صورت ماهیانه</div>
                        <div>گزارش ماهانه</div>
                    </div>
                    <div class="price">
                        ماهیانه
                        <div class="font-2">
                            ۳،۵۰۰،۰۰۰ تومان
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="price-list">
                    <div class="price-list-label">SEO</div>
                    <div class="head">
                        <h2>ویژه</h2>
                    </div>
                    <div class="featur">
                        <div>تحقیق و تحلیل کلمات کلیدی</div>
                        <div>6 کلمه کلیدی پر رقابت </div>
                        <div>جستجوی ۳ و ۴ کلمه ای
                            <br><span class="font-07"> مانند:آزمایشگاه محیط زیست </span>

                        </div>
                        <div>بهینه سازی صفحه فرود</div>
                        <div>On Page SEO</div>
                        <div>Off Page SEO</div>
                        <div>قرار دادن محتوا ۸ صفحه ماهیانه
                            <br><span class="font-07">هزینه تولید محتوا جداگانه محاسبه می شود</span>
                        </div>
                        <div> ۲ بک لینک رایگان به صورت ماهیانه</div>

                        <div>گزارش ماهانه</div>
                    </div>
                    <div class="price">
                        ماهیانه
                        <div class="font-2">
                            ۶،۵۰۰،۰۰۰ تومان
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>




@endsection
