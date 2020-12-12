{{--category&label=NEWS best&var=cat&count=3&query=last--}}
{{--post&amp;label=service&count=3&query=topView--}}
{{--product&amp;label=service&count=3&query=topView--}}
{{--product&amp;label=service&count=3&query=topView--}}

{{---gallery&label=NEWS&count=3&query=topView--}}

@extends(@env('TEMPLATE_NAME').'.App')

@section('head')

@endsection
@section('footer')

@endsection

@section('Content')


<div id="header">

    <!-- HEADER -->
    <header id="t3-header" class="t3-header">
        <div class="t3-header-wrapper">
            <div class="container container-fullwidth">
                <div class="row">
                    <div class="moduletable  ">
                        <div class="module_container">
                            <div id="swiper-slider_208"
                                class="swiper-container slider1 swiper-slider swiper-slider__"
                                data-autoplay="false" data-loop="true" data-simulate-touch="false"
                                data-slide-effect="slide" style="min-height: 420px;height: 40vw">
                                <div class="swiper-wrapper">

                                    <div class="swiper-slide " data-slide-bg="{{ asset('images/slider/1slide-1.jpg') }}">
                                        <div class="slide-inner">
                                            <div class="container">
                                                <div class="swiper-slide-caption"
                                                    data-caption-animate="fadeIn" data-caption-delay="200">
                                                    <div class="camera_caption ">


                                                        <div class="row">
                                                            <div class="moduletable   col-sm-5 ">
                                                                <div class="module_container">
                                                                    <div class="mod-article-single mod-article-single__"
                                                                        id="module_285">
                                                                        <div class="item__module"
                                                                            id="item_180">
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
                                    <div class="row">
                                        <article class="col-sm-4 item item_num0 item__module  "
                                            id="item_182">

                                            <!-- Intro Image -->
                                            <figure class="item_img img-intro img-intro__none">
                                                <img src="{{ asset('images/services/service-thumb01.jpg') }}" alt="">
                                                <figcaption>Container Operations
                                                    <br>
                                                    <br>
                                                    ha bdha bjafdhb Container Operations Container
                                                    Operations
                                                    Container Operations Container Operations Container
                                                    Operations
                                                    Container Operations
                                                </figcaption>

                                            </figure>

                                            <div class="clearfix"></div>
                                        </article>
                                        <article class="col-sm-4 item item_num1 item__module  "
                                            id="item_183">

                                            <!-- Intro Image -->
                                            <figure class="item_img img-intro img-intro__none">
                                                <img src="{{ asset('images/services/service-thumb02.jpg') }}" alt="">
                                                <figcaption>Container Operations
                                                    <br>
                                                    <br>
                                                    ha bdha bjafdhb Container Operations Container
                                                    Operations
                                                    Container Operations Container Operations Container
                                                    Operations
                                                    Container Operations
                                                </figcaption>
                                            </figure>
                                            <div class="clearfix"></div>
                                        </article>
                                        <article class="col-sm-4 item item_num2 item__module  "
                                            id="item_184">

                                            <!-- Intro Image -->
                                            <figure class="item_img img-intro img-intro__none">
                                                <img src="{{ asset('images/services/service-thumb03.jpg') }}" alt="">
                                                <figcaption>Container Operations
                                                    <br>
                                                    <br>
                                                    ha bdha bjafdhb Container Operations Container
                                                    Operations
                                                    Container Operations Container Operations Container
                                                    Operations
                                                    Container Operations
                                                </figcaption>
                                            </figure>
                                            <div class="clearfix"></div>
                                        </article>

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


<div id="about" class="position-2 wrap t3-sl t3-sl-2 ">
    <div class="container ">
        <div class="row">
            <div class="moduletable parallax1 ">
                <div class="module_container" style="display: flex;">
                    <div class="col-md-5 " style="padding: 2em;">

                        <div class='page_header'>
                            <h2 class="moduleTitle "><span
                                    class="item_title_part_0 item_title_part_odd item_title_part_first_half item_title_part_first">About
                                </span>

                            </h2>
                            <p>
                                ParagraphsLorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec
                                odio. Quisque volutpat mattis eros. Nullam malesuada
                                erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere
                                a, pede.

                                Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit
                                amet orci. Aenean dignissim pellentesque
                                felis.

                            </p>
                            <p>
                                ParagraphsLorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec
                                odio. Quisque volutpat mattis eros. Nullam malesuada
                                erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere
                                a, pede.

                                Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit
                                amet orci. Aenean dignissim pellentesque
                                felis.


                            </p>
                        </div>

                    </div>
                    <div id="mod_tm_parallax_304"
                        class="parallax-container mod_tm_parallax__parallax1 col-md-7">

                        <div class="mod_tm_parallax">
                            <img src="{{ asset('images/parallax/about.jpg') }}" alt="">
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
                                                <div class="counter-value" data-from="0" data-to="14"
                                                    data-speed="6000" data-decimals="0"></div>
                                            </div>
                                            <div class="counter-title">
                                                Years of Experience </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 counter_item item_num_1">

                                <div class="counter-wrapper">
                                    <div class="counter-wrapper-box">
                                        <div class="counter-wrapper-box_content">
                                            <div class="counter-value-box">
                                                <div class="counter-value" data-from="0" data-to="340"
                                                    data-speed="6000" data-decimals="0"></div>
                                            </div>
                                            <div class="counter-title">
                                                Workers In Company </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 counter_item item_num_2">

                                <div class="counter-wrapper">
                                    <div class="counter-wrapper-box">
                                        <div class="counter-wrapper-box_content">
                                            <div class="counter-value-box">
                                                <div class="counter-value" data-from="0" data-to="45"
                                                    data-speed="6000" data-decimals="0"></div>
                                            </div>
                                            <div class="counter-title">
                                                Skilled Drivers in Our Fleet </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 counter_item item_num_3">

                                <div class="counter-wrapper">
                                    <div class="counter-wrapper-box">
                                        <div class="counter-wrapper-box_content">
                                            <div class="counter-value-box">
                                                <div class="counter-value" data-from="0" data-to="600"
                                                    data-speed="6000" data-decimals="0"></div>
                                            </div>
                                            <div class="counter-title">
                                                Corporate Clients </div>
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
                                        <article class="col-sm-4 item item_num0 item__module" id="item_182">
                                            <figure class="item_img img-intro img-intro__none">
                                                <img src="{{ asset('images/services/1.png') }}" alt="">
                                                <figcaption>Container Operations</figcaption>
                                            </figure>
                                            <div class="clearfix"></div>
                                        </article>
                                        <article class="col-sm-4 item item_num0 item__module" id="item_182">
                                            <figure class="item_img img-intro img-intro__none">
                                                <img src="{{ asset('images/services/2.png') }}" alt="">
                                                <figcaption>Container Operations</figcaption>
                                            </figure>
                                            <div class="clearfix"></div>
                                        </article>
                                        <article class="col-sm-4 item item_num0 item__module" id="item_182">
                                            <figure class="item_img img-intro img-intro__none">
                                                <img src="{{ asset('images/services/3.png') }}" alt="">
                                                <figcaption>Container Operations</figcaption>
                                            </figure>
                                            <div class="clearfix"></div>
                                        </article>
                                        <article class="col-sm-4 item item_num0 item__module" id="item_182">
                                            <figure class="item_img img-intro img-intro__none">
                                                <img src="{{ asset('images/services/4.png') }}" alt="">
                                                <figcaption>Container Operations</figcaption>
                                            </figure>
                                            <div class="clearfix"></div>
                                        </article>
                                        <article class="col-sm-4 item item_num0 item__module" id="item_182">
                                            <figure class="item_img img-intro img-intro__none">
                                                <img src="{{ asset('images/services/5.png') }}" alt="">
                                                <figcaption>Container Operations</figcaption>
                                            </figure>
                                            <div class="clearfix"></div>
                                        </article>
                                        <article class="col-sm-4 item item_num0 item__module" id="item_182">
                                            <figure class="item_img img-intro img-intro__none">
                                                <img src="{{ asset('images/services/6.png') }}" alt="">
                                                <figcaption>Container Operations</figcaption>
                                            </figure>
                                            <div class="clearfix"></div>
                                        </article>

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
                                                <article>
                                                    <div class="item_content">
                                                        <figure class=" img-intro img-intro__none">
                                                            <img src="{{ asset('images/ourclients/tag.jpg') }}" alt="">
                                                            <figcaption>A world Leader In Shipping And
                                                                Logistics</figcaption>
                                                        </figure>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </article>
                                                <article>
                                                    <div class="item_content">
                                                        <figure class=" img-intro img-intro__none">
                                                            <img src="{{ asset('images/ourclients/tag.jpg') }}" alt="">
                                                            <figcaption>Container Operations</figcaption>
                                                        </figure>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </article>
                                                <article>
                                                    <div class="item_content">
                                                        <figure class=" img-intro img-intro__none">
                                                            <img src="{{ asset('images/ourclients/tag.jpg') }}" alt="">
                                                            <figcaption>Container Operations</figcaption>
                                                        </figure>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </article>
                                                <article>
                                                    <div class="item_content">
                                                        <figure class=" img-intro img-intro__none">
                                                            <img src="{{ asset('images/ourclients/tag.jpg') }}" alt="">
                                                            <figcaption>Container Operations</figcaption>
                                                        </figure>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </article>
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
                                    <div class="col-md-7" style="text-align: left;">

                                        <div
                                            style="font-weight: bold; font-size: 1.1em; text-align: center; margin-bottom: 1em;">
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
                                        <div class="module_container"
                                            style="background:rgba(0,0,0,0.6) !important">
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
                                                <form class="mod_tm_ajax_contact_form custom"
                                                    id="contact-form_293" novalidate="">
                                                    <input type="hidden" id="module_id" name="module_id"
                                                        value="293">
                                                    <div class="mod_tm_ajax_contact_form_message"
                                                        id="message_293">
                                                        <span class="s">Thank You! Your message has been
                                                            sent.</span>
                                                        <span class="e">Something went wrong, please try
                                                            again later.</span>
                                                        <span class="c">Please enter a correct Captcha
                                                            answer.</span>
                                                    </div>
                                                    <fieldset>
                                                        <div class="row">
                                                            <div
                                                                class="control control-group-input col-sm-12 ">
                                                                <div class="control"><input type="text"
                                                                        placeholder="Name" name="name"
                                                                        id="name_0_293"
                                                                        class="mod_tm_ajax_contact_form_text"
                                                                        required="" title="Name"></div>
                                                            </div>
                                                            <div
                                                                class="control control-group-input col-sm-12 ">
                                                                <div class="control"><input type="text"
                                                                        placeholder="Last Name"
                                                                        name="lastname" id="lastname_1_293"
                                                                        class="mod_tm_ajax_contact_form_text"
                                                                        required="" title="Last Name">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="control control-group-input col-sm-12 pull-right">
                                                                <div class="control"><textarea
                                                                        name="experience"
                                                                        placeholder="Experience"
                                                                        id="experience_5_293"
                                                                        class="mod_tm_ajax_contact_form_textarea"
                                                                        title="" data-autosize-on="true"
                                                                        style="overflow: hidden; overflow-wrap: break-word; height: 98px;"></textarea>
                                                                </div>
                                                            </div> <!-- Submit Button -->
                                                            <div
                                                                class="control control-group-button col-sm-6">
                                                                <div class="control">
                                                                    <button type="submit"
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
        {{--#anchor down --}}
@endsection