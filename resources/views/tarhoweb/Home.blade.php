@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')
<link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/home.css') }}">
@endsection

@section('Content')


<section id="index-intro">

    <div class="flex one two-700 two-900 center">
        <div class="align-left">

        </div>
        <div class="index-h1">
            <h1>آژانس طراحی سایت</h1>
            <h3>تیم خلاق و حرفه ای برای طراحی سایت و سئو در طرح و وب </h3>
            <a class="button button-blue">برای شروع کلیک کنید ...</a>
        </div>
    </div>
</section>




<section class="index-items ">
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



<section class="wide mt-5 mb-0" id="index-comment">
    <div>خدمات طرح و وب</div>
</section>



<section class=" pb-5 m-0" style="position: relative">
    <div class="flex one">
        <div>

        </div>
    </div>
</section>


@endsection
