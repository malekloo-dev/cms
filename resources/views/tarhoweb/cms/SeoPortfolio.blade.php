@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')
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
                    <img class="g1" src="{{asset('img/resume/var1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/var2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/var3.jpg')}}">
                </div>
            </div>
            <div>
                <h3>Various artist</h3>
                <table class="table full m-0">
                    <tr>
                        <td>ساخت سوئیچ بی ام و</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>ساخت سوئیچ بنز</td>
                        <td>2</td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/var1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/var2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/var3.jpg')}}">
                </div>
            </div>
            <h3>Bonzelfi</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/var1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/var2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/var3.jpg')}}">
                </div>
            </div>
            <h3>Bonzelfi</h3>
        </div>
        <div>
            <div class="gallery">
                <div class="m-4">
                    <img class="g1" src="{{asset('img/resume/var1.jpg')}}">
                    <img class="g2" src="{{asset('img/resume/var2.jpg')}}">
                    <img class="g3" src="{{asset('img/resume/var3.jpg')}}">
                </div>
            </div>
            <h3>Bonzelfi</h3>
        </div>


    </div>
</section>



@endsection
