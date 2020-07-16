@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')
<link rel="stylesheet" type="text/css" href="{{ asset('/WebDesignResume.css') }}">
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

<section class="custom-web-design mb-0 mt-3 ">
    <div class="flex one two-700 three-900 center align-center">
        <div>
            <a href="{{url('/طراحی-سایت-حرفه-ای')}}">
                <img src="{{asset('img/home/design.jpg')}}">
                <h2>سفارش سایت حرفه ای</h2>
            </a>
        </div>
        <div>
            <a href="{{ url('/طراحی-سایت-وردپرس') }}">
                <img src="{{asset('img/home/moshavere.jpg')}}">
                <h2>سفارش سایت وردپرس</h2>
            </a>
        </div>

    </div>


</section>

<svg viewbox="0 0 100 25">
    <path fill="#5E16B0" opacity="0.5" d="M0 30 V15 Q30 3 60 15 V30z" />
    <path fill="#5E16B0" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
</svg>


<section class="resume mt-0 mb-0 pb-5">
    <h2 class="align-center">نمونه کار</h2>
    <div class="flex one two-500  three-900 center align-center">
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/var1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/var2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/var3.jpg')}}">
                </div>
            </div>
            <h3>Various artist</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/alzahra1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/alzahra2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/alzahra3.jpg')}}">
                </div>
            </div>
            <h3>پرتال ارزیابی دانشگاه الزهرا</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/decor1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/decor2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/decor3.jpg')}}">
                </div>
            </div>
            <h3>دکورنما</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/bonz1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/bonz2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/bonz3.jpg')}}">
                </div>
            </div>
            <h3>Bonzelfi</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/mvm1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/mvm2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/mvm3.jpg')}}">
                </div>
            </div>
            <h3>MVM نمایندگی ۲۶۴</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/mohit1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/mohit2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/mohit3.jpg')}}">
                </div>
            </div>
            <h3>mohitsanat</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/ele1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/ele2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/ele3.jpg')}}">
                </div>
            </div>
            <h3>electromah</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/ms1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/ms2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/ms3.jpg')}}">
                </div>
            </div>
            <h3>mschef</h3>
        </div>

    </div>
</section>



@endsection
