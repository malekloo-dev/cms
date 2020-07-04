@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')
<link rel="stylesheet" type="text/css" href="{{ asset('/ProDesign.css') }}">
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
    <div class="flex one">
        <div>
            <div class="flex one two-700 two-900 center">
                <div class="align-right web-design-title">
                    <h1>طراحی سایت حرفه ای</h1>
                    <h3>ما از طرح های جسورانه و کد نشانه گذاری فوق العاده تمیز برای تولید وب سایت هایی استفاده می کنیم که شگفت آور به نظر می رسند.
                    </h3>
                    <a class="button button-purple">تعرفه پکیج طراحی سایت حرفه ای</a>
                </div>
                <div class="index-h1">
                    <img src="{{ asset('img/home/pc.png') }}">
                </div>
            </div>

        </div>
    </div>

</section>






@endsection
