@extends(@env('TEMPLATE_NAME').'.App')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('/PackageSeo.css') }}">
@endsection

@section('Content')

<section class="breadcrumb mb-0">
    <div class="flex one  ">
        <div class="p-0">
            <a href="/">خانه </a>
            @foreach($breadcrumb as $key=>$item)
            <span>></span>
            <a href="{{$item['slug']}}">{{$item['title']}}</a>
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
                    <p>بسته پایه سئو ما مناسب برای مشاغل کوچک با بودجه محدود است، به ویژه آنهایی که در بازارهای خاص و با رقبای محدود هستند.</p>
                    <div>قرار داد ۶ ماهه</div>
                </div>
                <div class="featur">
                    <div>تحقیق و تحلیل کلمات کلیدی</div>
                    <div>جستجوی ۴ کلمه ای</div>
                    <div>بهینه سازی صفحه فرود</div>
                    <div>On Page SEO</div>
                    <div>Off Page SEO</div>
                    <div>قرار دادن محتوا ۴ صفحه ماهیانه</div>
                    <div>گزارش ماهیانه</div>
                </div>
                <div class="price">
                    ماهیانه
                    <div class="font-2">
                        ۷۰۰،۰۰۰ تومان
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="price-list">
                <div class="price-list-label">SEO</div>
                <div class="head">
                    <h2>اقتصادی</h2>
                    <p>تا 15 کلید واژه های رقابتی در یک شهر و کلمات کلیدی مبتنی بر حومه.</p>
                    <div>قرار داد ۶ ماهه</div>
                </div>

                <div class="featur">
                    <div>تحقیق و تحلیل کلمات کلیدی</div>
                    <div>جستجوی ۳ کلمه ای</div>
                    <div>بهینه سازی صفحه فرود</div>
                    <div>On Page SEO</div>
                    <div>Off Page SEO</div>
                    <div>قرار دادن محتوا ۸ صفحه ماهیانه</div>
                    <div>گزارش ماهیانه</div>
                </div>
                <div class="price">
                    ماهیانه
                    <div class="font-2">
                        ۱،۲۰۰،۰۰۰ تومان
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="price-list">
                <div class="price-list-label">SEO</div>
                <div class="head">
                    <h2>ویژه</h2>
                    <p>امکان رقابت با حداکثر ۲۵ کمپین جستجوگر در کلمات کلیدی و نتایج کسب و کار در سطح کشور.</p>
                    <div>قرار داد ۶ ماهه</div>
                </div>
                <div class="featur">
                    <div>تحقیق و تحلیل کلمات کلیدی</div>
                    <div>جستجوی ۲ کلمه ای</div>
                    <div>بهینه سازی صفحه فرود</div>
                    <div>On Page SEO</div>
                    <div>Off Page SEO</div>
                    <div>قرار دادن محتوا ۸ صفحه ماهیانه</div>
                    <div>گزارش ماهیانه</div>
                </div>
                <div class="price">
                    ماهیانه
                    <div class="font-2">
                        ۵،۰۰۰،۰۰۰ تومان
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>




@endsection
