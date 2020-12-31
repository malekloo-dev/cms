@extends(@env('TEMPLATE_NAME').'.App')

@section('head')
    <style>
        @media(max-width:500px) {
            .module_container {
                flex-flow: column wrap !important
            }
        }

    </style>
@endsection
@section('footer')

@endsection

@section('Content')


    {{--#anchor home --}}
    <div id="home"></div>
    <div id="header">

        <!-- HEADER -->
        <header id="t3-header" class="t3-header">
            <div class="t3-header-wrapper">
                <div class="container container-fullwidth">
                    <div class="row">
                        <div class="moduletable  ">
                            <div class="module_container">
                                <div id="swiper-slider_208" class="swiper-container slider1 swiper-slider swiper-slider__"
                                    data-autoplay="false" data-loop="true" data-simulate-touch="false"
                                    data-slide-effect="slide" style="height: 50vw">
                                    <div class="swiper-wrapper">
                                        {{--banner&label=Home Banner&var=banner&count=3--}}
                                        @isset($banner)
                                            @foreach ($banner['images'] as $content)

                                                @if ($banner['mimeType'] == 'image')

                                                    <div class="swiper-slide "
                                                        data-slide-bg="{{ $content }}">
                                                    @else
                                                    <div class="swiper-slide "
                                                        data-slide-bg="">
                                                        <style>
                                                            -->@media(max-width:700px) {
                                                                .swiper-container.slider1.swiper-slider.swiper-slider__ {
                                                                    min-height: 168px !important;
                                                                    height: 20vw !important;
                                                                }
                                                            }

                                                        </style>
                                                        <video autoplay muted loop
                                                            style="position:absolute; left:0; right:0; width:100%; top:0">
                                                            <source src="{{ $content }}" type="video/mp4">
                                                        </video>
                                                @endif

                                                <div class="slide-inner">
                                                    <div class="container">
                                                        <div class="swiper-slide-caption" data-caption-animate="fadeIn"
                                                            data-caption-delay="200">
                                                            <div class="camera_caption ">


                                                                <div class="row">
                                                                    <div class="moduletable   col-sm-5 ">
                                                                        <div class="module_container">
                                                                            <div class="mod-article-single mod-article-single__"
                                                                                id="module_285">
                                                                                <div class="item__module" id="item_180">
                                                                                    <!-- Item Title -->
                                                                                    <h1 class="item-title">

                                                                                        <span
                                                                                            style="color: #2a5d65;color: #2a5d65;
                                                                                                                                    background: -webkit-linear-gradient(90deg, #292929,#2a5d65 50%);
                                                                                                                                    -webkit-background-clip: text;
                                                                                                                                    -webkit-text-fill-color: transparent;"
                                                                                            class="item_title_part_1 item_title_part_even item_title_part_first_half">Largest</span>
                                                                                        <span
                                                                                            class="item_title_part_2 item_title_part_odd item_title_part_first_half">
                                                                                            Multi-Purpose </span>
                                                                                        <span
                                                                                            class="item_title_part_3 item_title_part_even item_title_part_second_half">
                                                                                            Port Facility </span>
                                                                                        <span
                                                                                            class="item_title_part_4 item_title_part_odd item_title_part_second_half item_title_part_last">In
                                                                                            <span
                                                                                                style="color: #2a5d65;">Iraq</span></span>
                                                                                    </h1>


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- Read More link -->
                                                                <div class="btn-wrapper">


                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>


                                        @endforeach

                                    @endisset



                                </div>
                                <!-- Swiper Pagination -->
                                <div class="swiper-pagination" data-clickable="" data-index-bullet="false">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </header>


    </div>

    {{--#anchor news --}}
    <div id="news" class="t3-mainbody new">

        <div class="container">
            <div class="row">
                <!-- MAIN CONTENT -->
                <div id="t3-content" class="t3-content col-sm-12">


                    <section class="page-category page-category__home">
                    </section>


                    <div class="content-bottom wrap t3-sl t3-sl-content-bottom ">
                        <div class="row">
                            <div class="moduletable center services  col-sm-12">
                                <div class="module_container">
                                    <div class='page_header'>
                                        <h2 class="moduleTitle "><span
                                                class="item_title_part_0 item_title_part_odd item_title_part_first_half item_title_part_first">NEWS
                                            </span>

                                        </h2>
                                    </div>
                                    <div class="mod-newsflash-adv mod-newsflash-adv__center services cols-3"
                                        id="module_288">

                                        {{--post&label=NEWS&var=news&count=3--}}
                                        @isset($news)
                                            <div class="row">
                                                @foreach ($news as $content)
                                                    <article class="col-sm-4 item item_num0 item__module  " id="item_182">

                                                        <!-- Intro Image -->
                                                        <figure class="item_img img-intro img-intro__none">
                                                            <img src="{{ $content->images['images']['small'] ?? '' }}" alt="">
                                                            <figcaption><a href="{{ $content->slug }}">{{ $content->title }}</a>
                                                                <br>
                                                                <br>
                                                                {!! $content->brief_description !!}
                                                            </figcaption>

                                                        </figure>

                                                        <div class="clearfix"></div>
                                                    </article>
                                                @endforeach


                                            </div>
                                            @if (isset($content))
                                                <a href="{{ idToSlug($content->parent_id) }}"
                                                    class="btn btn-primary mod_tm_ajax_contact_form_btn">
                                                    More News ...
                                                </a>
                                            @endif
                                        @endisset
                                        <div class="clearfix"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- //MAIN CONTENT -->
            </div>
        </div>

    </div>

    {{--#anchor about --}}
    <div id="about" class="position-2 wrap t3-sl t3-sl-2 ">
        <div class="container ">
            <div class="row">
                <div class="moduletable parallax1 ">
                    <div class="module_container" style="display: flex; flex-flow:wrap row">
                        {{--categoryDetail&label=ABOUT&var=about--}}
                        @if (is_object($about))
                            <div class="" style="padding: 2em; flex:1 50%">
                                <div class='page_header'>

                                    <h2 class="moduleTitle "><span
                                            class="item_title_part_0 item_title_part_odd item_title_part_first_half item_title_part_first">
                                            {{ $about->title }}
                                        </span>
                                    </h2>
                                    {!! $about->brief_description !!}
                                    @isset($about->parent_id)
                                        <a href="{{ $about->slug }}" class="btn btn-primary mod_tm_ajax_contact_form_btn">
                                            About us
                                        </a>
                                    @endisset

                                </div>

                            </div>
                            <div id="mod_tm_parallax_304" style="flex: 1 50%; "
                                class="parallax-container mod_tm_parallax__parallax1">

                                <div class="mod_tm_parallax">
                                    <img src="{{ $about->images['images']['original'] ?? '' }}" alt="">
                                </div>
                                <div class="parallax-content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="moduletable center  col-sm-6 col-sm-offset-3">
                                                <div class="module_container">
                                                    <div class='page_header'>

                                                    </div>
                                                    <div class="mod-article-single mod-article-single__center"
                                                        id="module_305">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div id="" class="position-3 wrap t3-sl t3-sl-3 ">
        <div class="container ">
            <div class="row">
                <div class="moduletable   col-sm-12">
                    <div class="module_container">
                        <div id="mod_tm_counters_291" class="mod_tm_counters mod_tm_counters__ cols-4">


                            <div class="row">
                                <div class="col-sm-3 counter_item item_num_0">

                                    <div class="counter-wrapper">
                                        <div class="counter-wrapper-box">
                                            <div class="counter-wrapper-box_content">
                                                <div class="counter-value-box">
                                                    <div class="counter-value" data-from="0" data-to="14" data-speed="6000"
                                                        data-decimals="0"></div>
                                                </div>
                                                <div class="counter-title">
                                                    Years of Experience
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3 counter_item item_num_1">

                                    <div class="counter-wrapper">
                                        <div class="counter-wrapper-box">
                                            <div class="counter-wrapper-box_content">
                                                <div class="counter-value-box">
                                                    <div class="counter-value" data-from="0" data-to="340" data-speed="6000"
                                                        data-decimals="0"></div>
                                                </div>
                                                <div class="counter-title">
                                                    Workers In Company
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3 counter_item item_num_2">

                                    <div class="counter-wrapper">
                                        <div class="counter-wrapper-box">
                                            <div class="counter-wrapper-box_content">
                                                <div class="counter-value-box">
                                                    <div class="counter-value" data-from="0" data-to="45" data-speed="6000"
                                                        data-decimals="0"></div>
                                                </div>
                                                <div class="counter-title">
                                                    Skilled Drivers in Our Fleet
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3 counter_item item_num_3">

                                    <div class="counter-wrapper">
                                        <div class="counter-wrapper-box">
                                            <div class="counter-wrapper-box_content">
                                                <div class="counter-value-box">
                                                    <div class="counter-value" data-from="0" data-to="600" data-speed="6000"
                                                        data-decimals="0"></div>
                                                </div>
                                                <div class="counter-title">
                                                    Corporate Clients
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--#anchor services --}}
    <div id="services" class="t3-mainbody">

        <div class="container">
            <div class="row">
                <!-- MAIN CONTENT -->
                <div id="t3-content" class="t3-content col-sm-12">


                    <section class="page-category page-category__home">
                    </section>


                    <div class="content-bottom wrap t3-sl t3-sl-content-bottom ">
                        <div class="row">
                            <div class="moduletable center services  col-sm-12">
                                <div class="module_container">
                                    <div class='page_header'>
                                        <h2 class="moduleTitle "><span
                                                class="item_title_part_0 item_title_part_odd item_title_part_first_half item_title_part_first">Servises
                                            </span>

                                        </h2>
                                    </div>
                                    <div class="mod-newsflash-adv mod-newsflash-adv__center services cols-3"
                                        id="module_288">
                                        <div class="row services">
                                            {{--post&label=services&var=services&count=6--}}
                                            @isset($services)
                                                @foreach ($services as $content)
                                                    <article class="col-sm-4 item item_num0 item__module" id="item_182">
                                                        <figure class="item_img img-intro img-intro__none">
                                                            <img src="{{ $content->images['images']['small'] ?? '' }}" alt="">
                                                            <figcaption>
                                                                <a href="{{ $content->slug }}">{{ $content->title }}</a>
                                                            </figcaption>
                                                        </figure>
                                                        <div class="clearfix"></div>
                                                    </article>
                                                @endforeach
                                                @if (isset($content))
                                                    <a href="{{ idToSlug($content->parent_id) }}"
                                                        class="btn btn-primary mod_tm_ajax_contact_form_btn">
                                                        More Services ...
                                                    </a>
                                                @endif
                                            @endisset

                                        </div>

                                        <div class="clearfix"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- //MAIN CONTENT -->
            </div>
        </div>

    </div>

    {{--#anchor careers --}}
    <div id="careers" class="footer-1 wrap t3-sl t3-sl-footer-1 " style="padding: 4em 0;background-color: #015c65;">
        <div class="container container-fullwidth">
            <div class="row">

                <div class="moduletable parallax3 ">

                    <div class="module_container">
                        <div id="mod_tm_parallax_299" class="parallax-container mod_tm_parallax__parallax3">

                            <div class="mod_tm_parallax">
                                <img src="{{ asset('images/parallax/parallax3.jpg') }}" alt="">
                            </div>
                            <div class="parallax-content" style="padding:150px 0">
                                <div class="container container-fullwidth">
                                    <div class="row">

                                        <div class="moduletable type1  col-sm-12" style="padding:0">
                                            <h2 class="moduleTitle  heading-style-2 visible-first"
                                                style="text-align: center; margin-bottom: 2em;">
                                                <span style="color: #333;">Our Cliens</span>
                                            </h2>
                                            <div class="module_container">
                                                <div class="mod-newsflash-adv mod-newsflash-adv__type1 cols-2"
                                                    id="module_298">
                                                    {{--post&label=OurClients&var=ourClients&count=4--}}
                                                    @isset($ourClients)
                                                        @foreach ($ourClients as $content)
                                                            <article>
                                                                <div class="item_content">
                                                                    <figure class=" img-intro img-intro__none">
                                                                        <img src="{{ $content->images['images']['original'] ?? '' }}"
                                                                            alt="">
                                                                        <figcaption>{{ $content->title }}</figcaption>
                                                                    </figure>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </article>
                                                        @endforeach
                                                    @endisset

                                                    <div class="clearfix"></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--#anchor contact --}}
    <div id="contact" class="t3-mainbody">
        <div id="ship-bg"></div>
        <div class="container">
            <div class="row">
                <!-- MAIN CONTENT -->
                <div id="t3-content" class="t3-content col-sm-12">


                    <section class="page-category page-category__home">
                    </section>


                    <div class="content-bottom wrap t3-sl t3-sl-content-bottom ">
                        <div class="row">
                            <div class="moduletable center services  col-sm-12">
                                <div class="module_container">
                                    <div class='page_header'>
                                        <h2 class="moduleTitle "><span
                                                class="item_title_part_0 item_title_part_odd item_title_part_first_half item_title_part_first">Contact
                                            </span>

                                        </h2>
                                    </div>
                                    <div class="mod-newsflash-adv mod-newsflash-adv__center services cols-3"
                                        id="module_288">
                                        <div class="col-md-4" style="text-align: left;">

                                            <div style="font-weight: bold; font-size: 1.1em;  margin-bottom: 1em;">
                                                <div style="font-weight: bold; font-size: 1.3em;">Head Office
                                                </div>
                                                <div>Basra Multipurposr Terminal</div>
                                                <div>Umm Qasr</div>
                                                <div>North Port</div>
                                                <div>Iraq</div>
                                            </div>
                                            <div style="font-weight: bold; font-size: 1.3em;">Employment</div>
                                            <p>
                                                To apply for a job with BMT, Please send a cover letter
                                                together with your C.V. to info@bmtiq.com
                                            </p>
                                            <div style="font-weight: bold; font-size: 1.3em;">Inquiries</div>
                                            <p>
                                                For any inquiries, questions, or commendations,
                                                Please call: +964 780 923 3237 or fill out the following form
                                            </p>
                                        </div>
                                        <div class="moduletable type1  col-sm-5">
                                            <div class="module_container" style="background:#ddd !important">
                                                <div class="page_header">
                                                    <h4 class="moduleTitle  heading-style-4 visible-first"><span
                                                            class="item_title_part_0 item_title_part_odd item_title_part_first_half item_title_part_first">Request</span>
                                                        <span
                                                            class="item_title_part_1 item_title_part_even item_title_part_first_half">a</span>
                                                        <span
                                                            class="item_title_part_2 item_title_part_odd item_title_part_second_half">Free</span>
                                                        <span
                                                            class="item_title_part_3 item_title_part_even item_title_part_second_half item_title_part_last">Quote</span>
                                                    </h4>
                                                </div>
                                                <div id="contact_293">
                                                    <form action="{{ route('contact.store') }}#contact" method="post"
                                                        class="mod_tm_ajax_contact_form custom" id="" novalidate="">
                                                        @csrf
                                                        @if (\Session::has('success'))
                                                            <div class="alert alert-success " style="text-align: left">
                                                                {!! \Session::get('success') !!}
                                                            </div>
                                                        @endif
                                                        @if (\Session::has('error'))
                                                            <div class="alert alert-danger " style="text-align: left">
                                                                {!! \Session::get('error') !!}
                                                            </div>
                                                        @endif
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger" style="text-align: left">
                                                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                                                            </div>
                                                        @endif

                                                        <fieldset>
                                                            <div class="row">
                                                                <div class="control control-group-input col-sm-12 ">
                                                                    <div class="control">
                                                                        <input type="text" value="{{ old('name') }}"
                                                                            placeholder="Name" name="name"
                                                                            class="mod_tm_ajax_contact_form_text"
                                                                            required="" title="Name">
                                                                    </div>
                                                                </div>
                                                                <div class="control control-group-input col-sm-12 ">
                                                                    <div class="control">
                                                                        <input type="text" value="{{ old('lastname') }}"
                                                                            placeholder="Last Name" name="lastname"
                                                                            class="mod_tm_ajax_contact_form_text"
                                                                            required="" title="Last Name">
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="control control-group-input col-sm-12 pull-right">
                                                                    <div class="control">
                                                                        <textarea name="comment" placeholder="Experience"
                                                                            class="mod_tm_ajax_contact_form_textarea"
                                                                            title="" data-autosize-on="true"
                                                                            style="overflow: hidden; overflow-wrap: break-word; height: 98px;">{{ old('comment') }}</textarea>
                                                                    </div>
                                                                </div> <!-- Submit Button -->
                                                                <div class="control control-group-button col-sm-6">
                                                                    <div class="control">
                                                                        <button
                                                                            class="btn btn-primary mod_tm_ajax_contact_form_btn">
                                                                            Send request
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- //MAIN CONTENT -->
            </div>
        </div>

    </div>





    <div id="fixed-sidebar-left">
        <div class="moduletable  ">
            <div class="module_container">
            </div>
        </div>
    </div>

    <div id="fixed-sidebar-right">

    </div>

@endsection
