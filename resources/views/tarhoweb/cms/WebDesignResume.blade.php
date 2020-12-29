@extends(@env('TEMPLATE_NAME').'.App')

@section('head')
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
    <h1 class="align-center">نمونه سایت های طراحی شده توسط شرکت طرح و وب</h1>
    <div class="flex one two-500  three-900 center align-center">
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/darb1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/darb2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/darb3.jpg')}}">
                </div>
            </div>
            <h3>درب کالا</h3>
        </div>

        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/corepo1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/corepo2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/corepo3.jpg')}}">
                </div>
            </div>
            <h3>coRepo</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/remot1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/remot2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/remot3.jpg')}}">
                </div>
            </div>
            <h3>ریموت یدک</h3>
        </div>
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
            <h3>نمایندگی ۲۶۴ MVM</h3>
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
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/bmtiq1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/bmtiq2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/bmtiq3.jpg')}}">
                </div>
            </div>
            <h3>bmtiq</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/border1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/border2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/border3.jpg')}}">
                </div>
            </div>
            <h3>border less artinst</h3>
        </div>

    </div>
</section>



@endsection
