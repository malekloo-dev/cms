@extends(@env('TEMPLATE_NAME').'.App')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('/SeoPortfolio.css') }}">
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



<svg viewbox="0 0 100 25">
    <path fill="#00C31F" opacity="0.5" d="M0 30 V15 Q30 3 60 15 V30z" />
    <path fill="#00C31F" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
</svg>


<section class="resume mt-0 mb-0 pb-5">
    <h2 class="align-center"> نمونه کار سئو</h2>
    <div class="flex one two-500  four-900 center align-center">
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/iran1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/iran2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/iran3.jpg')}}">
                </div>
            </div>
            <div>
                <h3>Iran unlock</h3>
                <table class="table full m-0 align-right">
                    <tr>
                        <td>۱</td>
                        <td>ساخت سوئیچ بی ام و</td>
                    </tr>
                    <tr>
                        <td>۱</td>
                        <td>ساخت سوئیچ بنز</td>
                    </tr>
                    <tr>
                        <td>۱</td>
                        <td>ساخت سوئیچ رنو</td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/sakhrem1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/sakhrem2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/sakhrem3.jpg')}}">
                </div>
            </div>
            <h3>sakhteremote</h3>
            <table class="table full m-0 align-right">
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ بی ام و</td>
                </tr>
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ بنز</td>
                </tr>
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ رنو</td>
                </tr>
            </table>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/sakhs1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/sakhs2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/sakhs3.jpg')}}">
                </div>
            </div>
            <h3>sakhteswitch</h3>
            <table class="table full m-0 align-right">
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ بی ام و</td>
                </tr>
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ بنز</td>
                </tr>
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ رنو</td>
                </tr>
            </table>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/rem1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/rem2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/rem3.jpg')}}">
                </div>
            </div>
            <h3>remotekhodro</h3>
            <table class="table full m-0 align-right">
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ بی ام و</td>
                </tr>
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ بنز</td>
                </tr>
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ رنو</td>
                </tr>
            </table>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/sw1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/sw2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/sw3.jpg')}}">
                </div>
            </div>
            <h3>switchkhodro</h3>
            <table class="table full m-0 align-right">
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ بی ام و</td>
                </tr>
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ بنز</td>
                </tr>
                <tr>
                    <td>۱</td>
                    <td>ساخت سوئیچ رنو</td>
                </tr>
            </table>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/tel1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/tel2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/tel3.jpg')}}">
                </div>
            </div>
            <h3>teletraining</h3>
            <table class="table full m-0 align-left">
                <tr>
                    <td>6</td>
                    <td>Training</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Steel Structures Construction</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Engineering</td>
                </tr>
            </table>
        </div>


    </div>
</section>



@endsection
