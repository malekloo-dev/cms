@extends('cms.App')
@section('Content')

    <section class="products" id="index-best">
        <div class="flex one">
            <div>
                <div class="shadow">
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
        </div>
    </section>
    <section class="wide" id="index-comment">
        <div>جدید ترین مطالب در مورد سوئیچ و ریموت خودرو</div>
    </section>
    <section class="products" id="index-best-view">
        <div class="flex one ">
            <div>
                <div class="shadow">
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
        </div>
    </section>
@endsection
