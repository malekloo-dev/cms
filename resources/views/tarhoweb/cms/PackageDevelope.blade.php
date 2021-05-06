@extends(@env('TEMPLATE_NAME').'.App')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('/PackageDevelope.css') }}">
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
    <h1 class="align-center">اجاره سایت حرفه ای</h1>
    <div class="flex one two-500 three-900 center">
        <div>
            <div class="price-list">
                <div class="head">
                    <h2>Plan A</h2>

                    <div>1-5 Pages</div>
                </div>
                <div class="featur">
                    <div>دامنه و هاست ۱ ساله</div>
                    <div>واکنشگرا</div>
                    <div>مدیریت محتوا</div>
                    <div>بهینه سازی صفحه فرود</div>
                    <div>فشرده سازی و بهینه سازی seo</div>
                    <div>هزینه طراحی قالب جداگانه محاسبه میشود</div>
                    <div>-</div>
                    <div>پشتیبانی ماهیانه ۱۵۰ هزار تومان</div>

                </div>
                <div class="price">
                    <div class="font-2">
                        ۵۰۰،۰۰۰ تومان
                    </div>
                </div>
            </div>
        </div>


    </div>

</section>

<section class="webdevelopment-custom-package">
    <div class="flex one two-500  center align-center">
        <div>
            <h2>طراحی سفارشی</h2>
            <h3>طراحی و پیاده سازی سایت و پرتال های تخصصی </h3>
            <p>شما می توانید بر اساس نیاز شرکت و موسسه خود، یا برای کسب و کار تجاری خود سایت و نرم افزاری طراحی کنید که متناسب با فعالیت شما باشد. هدف طرح و وب ایجاد پلتفرم های تحت وب برای سهولت انجام پروسه های کاری شما می باشد. ایجاد وب سایت مدارس، پرتال دانشگاهی، واسطه گری مالی، ERP و طراحی سایت سفارشی از جمله فعالیت ماست.</p>
            <div class="flex one  center">
                <div>
                    <div class="price-list">


                        <div class="price">
                            شروع قیمت از
                            <div class="font-2">
                                ۲۰،۰۰۰،۰۰۰ تومان
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="package-info pb-4 pt-4">
    <div class="flex one two-500 three-900 center align-center">
        <div>
            <h2>واکنشگرا</h2>
            <p>وب سایت های ما 100٪ سازگار به موبایل هستند، بنابراین اطمینان حاصل می کنند که در هر دستگاه عملکرد خوبی دارد.</p>
        </div>

        <div>
            <h2>سئو</h2>
            <p>تیم مشاوران SEO به عنوان افرادی مناسب که می توانند فرصت ها ، اهداف و اهداف را شناسایی کنند. آنها می توانند به شما در دستیابی به یک راهبرد استراتژیک و عملکرد و رتبه بندی موثر وب سایت خود کمک کنند.</p>
        </div>

        <div>
            <h2>فرم تماس با ما</h2>
            <p>ایجاد صفحه تماس با ما و افزودن فرم نظر سنجی برای گرفتن نظرات در جهت بهبود خدمت رسانی تجارت شما</p>
        </div>
        <div>
            <h2>فشرده سازی و بهینه سازی</h2>
            <p>همه بسته های وب سایت ما برای سرعت اجرا بهینه ساخته شده اند! این شماره 1 در لیست چک های Googles است تا اطمینان حاصل شود که وب سایت شما به خوبی رتبه بندی شده است.</p>
        </div>
        <div>
            <h2>مدیریت محتوا</h2>
            <p>امکان مدیریت صفحات و اضافه کردن صفحات دلخواه به تعداد نامحدود</p>
        </div>
        <div>
            <h2>طراحی سفارشی</h2>
            <p>ما اشتیاق به طراحی داریم و از این رو می خواهیم مشتری هایمان وب سایتی داشته باشند که نشان دهنده نام تجاری و دیداری منحصر به فرد باشد.
            </p>
        </div>

    </div>
</section>

<section class="pro-design-intro wordpress m-0 pt-0">
    <h1 class="align-center">پکیج طراحی سایت وردپرس</h1>
    <div class="flex one two-500 three-900 center">
        <div>
            <div class="price-list">
                <div class="head">
                    <h2>وردپرس</h2>

                    <div>1-5 Pages</div>
                </div>
                <div class="featur">
                    <div>دامنه و هاست ۱ ساله</div>
                    <div>واکنشگرا</div>
                    <div>مدیریت صفحات</div>
                    <div>فرم تماس با ما</div>
                    <div>فشرده سازی و بهینه سازی seo</div>
                    <div>پشتیبانی ماهیانه ۲۰۰ هزار تومان</div>
                    <div>-</div>
                </div>
                <div class="price">
                    <div class="font-2">
                        ۱،۵۰۰،۰۰۰ تومان
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="price-list">

                <div class="head">
                    <h2>وردپرس</h2>

                    <div>3-8 Pages</div>
                </div>

                <div class="featur">
                    <div>دامنه و هاست ۱ ساله</div>
                    <div>واکنشگرا</div>
                    <div>مدیریت صفحات</div>
                    <div>فرم تماس با ما</div>
                    <div>فشرده سازی و بهینه سازی seo</div>
                    <div>پشتیبانی ماهیانه ۲۰۰ هزار تومان</div>
                    <div>قرار دادن محتوا</div>


                </div>
                <div class="price">
                    <div class="font-2">
                        ۳،۰۰۰،۰۰۰ تومان
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>


@endsection
