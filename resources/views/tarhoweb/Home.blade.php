@extends(@env('TEMPLATE_NAME').'.App')

@section('assets')
<link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/css/user/home.css') }}">
@endsection

@section('Content')


<section id="index-intro">

    <div class="flex one two-700 two-900">
        <div class="align-left">
            <img style="width: 100%" src="{{ asset(@env('TEMPLATE_NAME').'/img/user/banner2.jpg') }}">
        </div>
        <div class="index-h1">
            <h1>مطالب کاربردی سئو</h1>
            <h3>… به دنیای شگفت انگیز وب خوش آمدید</h3>
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
            <h2 class="align-center">نظرات شما</h2>
            <div class="quotes mt-2 flex one  three-700 four-1000 center ">
                <div class="">
                    <div class="box box1">
                        <p>این دستگاه از تکنولوژی بالایی برخوردار است خصوصا دستگاه های مدل . داخل هد، برق کیلو ولت، های
                            ولتاژ ساخته و به دو سر لامپ رفته و اشعه ایکس بوجود میآید. به همین دلیل کوچکترین </p>
                        <h2>مهدی مرجانی</h2>
                    </div>
                    <div class="bg"></div>
                </div>
                <div class="">
                    <div class="box box2">
                        <p>بهترین نمونه کارها را دارند. بهترین نمونه کارها را دارند.</p>
                        <h2>محمود ملک لو</h2>
                    </div>
                    <div class="bg"></div>
                </div>
                <div class="">
                    <div class="box box3">
                        <p>های مدل . داخل هد، برق کیلو ولت، های ولتاژ ساخته و به دو سر لامپ رفته و اشعه ایکس بوجود
                            میآید.</p>
                        <h2>شیلا خداداد</h2>
                    </div>
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
