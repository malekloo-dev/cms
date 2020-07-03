@extends(@env('TEMPLATE_NAME').'.App')


@section('assets')

<link rel="stylesheet" type="text/css" href="{{ asset('/CustomDesign.css') }}">
@endsection

@section('Content')


<section class="breadcrumb">
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

<section class="index-items ">
    <div class="flex one">
        <div>
            <div class="flex one three-500   ">

                ddd

            </div>

        </div>
    </div>
</section>



@endsection
