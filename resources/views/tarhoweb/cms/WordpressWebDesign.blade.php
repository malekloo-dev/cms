@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')
<link rel="stylesheet" type="text/css" href="{{ asset('/WordpressWebDesign.css') }}">
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



<section class="wordpress-design-intro m-0 pt-0">
    <div class="flex one">
        <div>
            <div class="flex one two-700 two-900 center">
                <div class="align-right web-design-title">
                    <h1>طراحی سایت وردپرس</h1>
                    <h3>طراحی و ساخت و مدیریت راهکارهای توسعه وردپرس سفارشی برای مشاغل در ابعاد مختلف</h3>
                    <a class="button button-blue">تعرفه پکیج طراحی سایت وردپرس</a>
                </div>
                <div class="align-left">
                    <img src="{{ asset('img/CustomDesign/wordpress-logo.jpg') }}">
                </div>
            </div>

        </div>
    </div>

</section>

<section class="pro-design-feature mt-3">
    <div class="flex one two-500 three-900 center align-center">
        <div>
            <h2>کاربرد آسان</h2>
            <p>در دنیای دیجیتال پر از گزینه های سفارشی سازی ، تیم توسعه وردپرس ما به خاطر سابقه اثبات شده خود و تعداد وب سایت های طراحی شده برای مشتریان شناخته شده است.</p>
        </div>
        <div>
            <h2>انعطاف پذیر</h2>
            <p>هدف اصلی توسعه ما یک رابط کاربری قابل مدیریت و انعطاف پذیر است - کمک به شما در دستیابی به اهداف خود. وب سایت های تعاملی بیش از یک وب سایت هستند.</p>
        </div>
        <div>
            <h2>پلاگین های جذاب</h2>
            <p>ما می توانیم به شما در ایجاد وب سایتهای بسیار تعاملی و سرشار از ویژگی کمک کنیم. توسعه دهندگان وردپرس ما با سالها تجربه در ساختن وب سایتهای که پاسخگویی دارند تا مدیریت وب سایت ها را بدون هیچ گونه تخصص فنی برای شما ساده تر کنند.</p>
        </div>

    </div>
</section>




<svg viewbox="0 0 100 25">
    <path fill="#0D44FB" opacity="0.5" d="M0 30 V15 Q30 3 60 15 V30z" />
    <path fill="#0D44FB" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
</svg>
<section class="pro-design-website mt-0 mb-0  pb-0">
    <div class="flex one align-center ">
        <div class="p-0">
            <p>آیا به دنبال یک آژانس طراحی وب معتبر هستید؟<br>
                شما در صفحه صحیح فرود آمده اید - با تماس با ما امروز شروع کنید.
            </p>
            <a class="button button-white color-purple pl-5 pr-5">تماس با ما</a>
        </div>
    </div>

</section>
<svg class="svg-purple-bottom" viewbox="0 0 100 15">
    <path fill="#fff" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
</svg>


<section class="mt-7">
    <div class="flex one">
        <div>
            <div class="flex one two-500">
                <div>
                    <h3 class="font-3 p-0 pl-2">ما به مشاغل کوچک و متوسط ​​کمک می کنیم تا از فناوری وردپرس بهره مند شوند</h3>
                </div>
                <div>
                    <p>در حقیقت ، وردپرس می تواند یکی از قدرتمندترین ابزار برای مشاغل باشد. این برنامه از کاربران پشتیبانی می کند ، ابزارهایی را برای به روزرسانی و مدیریت مشاغل خود از هر مکانی فراهم می کند و برای مطابقت با اهداف تجاری آنها ایجاد شده است.
                    </p>
                    <p>وردپرس به عنوان یک راه حل نرم افزار منبع باز که به کاربران امکان می دهد محتوا را در وب سایت های خود ایجاد و مدیریت کنند ، محبوب ترین سیستم مدیریت محتوا (CMS) در جهان است.
                    </p>
                    <p>ما تخصص توسعه وردپرس فنی و خلاقانه خود را با پشتیبانی اختصاصی ترکیب می کنیم - برای شما خدمات توسعه فوق العاده وب متناسب با نیازهای شما.
                    </p>
                </div>
            </div>
        </div>
    </div>

</section>
<svg viewbox="0 0 100 15">
    <path fill="#ececec" d="M0 30 V12 Q30 17 70 12 T100 11 V30z" />
</svg>


@endsection
