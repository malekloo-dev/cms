@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')

@endsection
@section('js')
    
@endsection

@section('Content')




<section class="index-item-top bg-orange mt-0 mb-0">
    <div class="text-center">
        <h1>مرکز ساخت سوئیچ و ریموت</h1>
    </div>
    <div class="flex one five-500 center  ">
        {{-- $data['newPost'] --}}
        @foreach($category as $content)
        <a href="{{ $content->slug }}">
            <div class="shadow hover">
                @if(isset($content->images['thumb']))
                    <figure class="image">
                        <img src="{{ $content->images['images']['small'] ?? $content->images['thumb']}}"
                        sizes="(max-width:{{ env('CATEGORY_SMALL') }}px) 100vw {{ env('CATEGORY_SMALL') }}px {{ ENV('CATEGORY_MEDIUM') }}px {{ ENV('CATEGORY_LARGE') }}px"
                        alt="{{$content->title}}"
                        width="200" height="200"
                        srcset="
                            {{ $content->images['images']['small'] ?? $content->images['thumb']}} {{ env('CATEGORY_SMALL') }}w,
                            {{ $content->images['images']['medium'] ?? $content->images['thumb']}} {{ env('CATEGORY_MEDIUM') }}w,
                            {{ $content->images['images']['large'] ?? $content->images['thumb']}} 2x" >
                        <figcaption>
                            <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                        </figcaption>
                    </figure>
                @endif

            </div>
        </a>
        @endforeach
    </div>
</section>



<section class="wide  m-0" id="index-comment">
    <div>خدمات طرح و وب</div>
</section>



<section class="index-items home-top-view">
    <div class="flex one">
        <div>
            <div class="flex one two-500  four-800 center  ">
                {{-- $data['newPost'] --}}
                @foreach($topViewPost as $content)
                <div>
                    <a class="hover" href="{{ $content->slug }}">
                    
                        @if(isset($content->images['thumb']))
                        <div><img src="{{ $content->images['thumb'] }}"></div>
                        @endif
                        <footer>
                            <h3> {{ $content->title }}</h3>
                            <div>
                                @if(isset($content->attr['rate']))
                                    <div class="rate mt-1">
                                        @for($i = $content->attr['rate']; $i >= 1; $i--)
                                            <img srcset="{{asset('/img/star2x.png')}} 2x , {{asset('/img/star1x.png')}} 1x" src="{{asset('/img/star1x.png')}}">
                                        @endfor
                                    </div>
                                @endif
                                @if(isset($content->attr['price']))
                                    @convertCurrency($content->attr['price']??0)  تومان
                                @endif
                            </div>
                        </footer>
                    
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


@endsection
