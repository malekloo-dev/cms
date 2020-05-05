


@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')
    <link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/css/user/home.css') }}">
@endsection

@section('Content')

    
<section id="index-intro">
    
    <div class="flex one two-700 two-900">
        <div>
            <img style="width: 100%" src="{{ asset(@env('TEMPLATE_NAME').'/img/user/banner2.jpg') }}">
        </div>
        <div class="index-h1">
            <h1>مطالب کاربردی سئو</h1>
            <h3>… به دنیای شگفت انگیز وب خوش آمدید</h3>
            <a class="button button-blue">برای شروع کلیک کنید ...</a>
        </div>
    </div>
</section>

<section class="products" id="index-best">
        <div class="flex one">
            <div>
                
                    <h2>پر بازدیدترین مطالب در مورد سوئیچ و ریموت خودرو</h2>
                    <div class="flex one two-500 four-900 center ">

                        {{--$data['newPost']--}}
                        @foreach($topViewPost as $content)
                            <div>
                                <article>
                                    @if (isset($content->images['thumb']))
                                        <div><img src="{{ $content->images['thumb']}}"></div>
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
    <section class="wide" id="index-comment">
        <div>جدید ترین مطالب در مورد سوئیچ و ریموت خودرو</div>
    </section>
    <section class="products" id="index-best-view">
        <div class="flex one ">
            <div>
                
                    <h2>جدید ترین مطالب در مورد سوئیچ و ریموت خودرو</h2>
                    <div class="flex one two-500 four-900 center ">

                        {{--$data['newPost']--}}
                        @foreach($newPost as $content)
                            <div>
                                <article>

                                    @if (isset($content->images['thumb']))
                                        <div><img src="{{ $content->images['thumb']}}"></div>
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
