@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')
<link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/home.css') }}">
@endsection

@section('Content')




<section class="index-item-top bg-orange mt-0 mb-0">
    <div class="text-center"><h1>مرکز ساخت سوئیچ و ریموت</h1></div>
    <div class="flex one five-500 center  ">
        {{-- $data['newPost'] --}}
        @foreach($category as $content)
        <a href="{{ $content->slug }}">
            <div class="shadow hover">
                @if(isset($content->images['thumb']))
                <img src="{{ $content->images['thumb'] }}">
                @endif
                <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
            </div>
        </a>
        @endforeach
    </div>
</section>



<section class="wide  m-0" id="index-comment">
    <div>خدمات طرح و وب</div>
</section>



<section class="index-items">
    <div class="flex one">
        <div>
            <div class="flex one three-500   ">
                {{-- $data['newPost'] --}}
                @foreach($topViewPost as $content)
                <div>
                    <article>
                        @if(isset($content->images['thumb']))
                        <div><img src="{{ $content->images['thumb'] }}"></div>
                        @endif
                        <footer>
                            <h2><a href="{{ $content->slug }}"> {{ $content->title }}</a></h2>
                            {!! $content->brief_description !!}
                        </footer>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


@endsection
