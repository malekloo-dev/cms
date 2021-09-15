<!DOCTYPE html>

<html lang="en" class="no-js">
<!--<![endif]-->
<!-- <meta http-equiv="refresh" content="5; url=index.html#a_home" /> -->
<head>
    <!-- meta character set -->
    <meta charset="utf-8">
    <title>Basra Multipurpose Terminal</title>
    <!-- Meta Description -->
    <meta name="description" content="Basra Multipurpose Terminal is a company based in Iraq">
    <meta name="keywords"
          content="Basra, in Iraq, cargo, RORO, container handling, Heavy Lift, Break Bulk, Dry Bulk, Stripping, Stuffing">
    <meta name="author" content="BMT Development Team">

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset(@env('TEMPLATE_NAME').'/favicon.png') }}"/>

    <!-- CSS
    <!-- Fontawesome Icon font -->
    <link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/css/font-awesome.min.css') }}">
    <!-- bootstrap.min -->
    <link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/css/jquery.fancybox.css') }}">

    <!-- bootstrap.min -->
    <link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/css/bootstrap.min.css') }}">

    <!-- bootstrap.min -->
    <link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/css/owl.carousel.css') }}">

    <!-- bootstrap.min -->
    <link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/css/slit-slider.css') }}">

    <!-- bootstrap.min -->
    <link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/css/animate.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset(@env('TEMPLATE_NAME').'/css/main.css') }}">

    <!-- Modernizer Script for old Browsers -->
    <script src="{{ asset(@env('TEMPLATE_NAME').'/js/modernizr-2.6.2.min.js') }}"></script>

</head>

<body>


<!--
      Fixed Navigation
      ==================================== -->
<header id="navigation" class="navbar-inverse navbar-fixed-top animated-header">

    <div class="container" style="width: 90% !important;">
        <!-- main nav -->
        <div class="navbar-header">
            <!-- responsive nav button -->

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- /responsive nav button -->
            <a class="navbar-brand" href="https://www.bmtiq.com/#a_home#a_home">
                <img src="{{ asset(@env('TEMPLATE_NAME').'/BMT.svg') }}" alt="">
            </a>
            <!-- /logo -->
        </div>

        <nav class="collapse navbar-collapse navbar-left" role="navigation"
             style="border: none; float: left !important; ">

            <ul id="nav" class="nav navbar-nav">
                <li><a href="https://www.bmtiq.com/#a_home">Home</a></li>
                <li><a href="https://www.bmtiq.com/#a_about1">ABOUT</a></li>
                <li><a href="https://www.bmtiq.com/#a_services1">Services</a></li>
                <li><a href="https://www.bmtiq.com/#a_news1">NEWS</a></li>
                <li><a href="https://www.bmtiq.com/#a_careers1">CAREERS</a></li>
                <li><a href="https://www.bmtiq.com/#a_contact1">Contact</a></li>
                <li class="hrportal">
                    <a
                            href="javascript:void(0)" onclick="goToURL(); return false;" target="_blank"
                            class="btn btn-blue btn-effect">Employee Portal</a>
                </li>
            </ul>
        </nav>

        <!-- <div class="navbar-header" style="padding-left: 8%;">


          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="index.html#a_home">
            <img src="BMT.svg" alt=""  >
          </a>
        </div>   -->

    </div>
</header>
<!--
      End Fixed Navigation
      ==================================== -->

<main class="site-content" role="main" style="margin-top: 4.5em">

    <!--
        Home Slider
        ==================================== -->


    <!--
        End Home SliderEnd
        ==================================== -->
    <!-- Social section -->

    <!-- <span  id="services"></span> -->
    <!-- portfolio section -->
    <a class="anchor1" id="a_services11"></a>
    <a class="anchorH" id="a_services1"></a>
    <section>
        <!-- /*style="padding-bottom: 30px;"*/ -->
        <div class="container">
            <div class="row">
                <div class="sec-title pad wow animated fadeInDown">
                    <h3>Please Insert Your Information </h3>
                </div>
            </div>
            <div class="row">
                <div style="min-height: 600px;" class="panel-body full-height">
                    <form action="{{ route('inventory.search') }}/" method="POST" name="add_content"
                          enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row">
                            <div class="col-md-2">
                                <div style="margin-left: 10px;margin-right: 10px;">
                                    <label for="name" class="col-form-label text-md-left">Name:</label>
                                    <input type="text" class="form-control"
                                           name="name"
                                           value="{{ $data['name'] ?? '' }}"/>
                                </div>

                            </div>

                            <div class="col-md-2">
                                <div style="margin-left: 10px;margin-right: 10px;">
                                    <label for="mobile" class="col-form-label text-md-left">Mobile:</label>
                                    <input type="text" class="form-control"
                                           name="mobile"
                                           value="{{ $data['mobile'] ?? '' }}"/>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div style="margin-left: 10px;margin-right: 10px;">
                                    <label for="email" class="col-form-label text-md-left">Email:</label>
                                    <input type="text" class="form-control"
                                           name="email"
                                           value="{{ $data['email'] ?? '' }}"/>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">


                            <div class="col-md-2">
                                <div style="margin-left: 10px;margin-right: 10px;">
                                    <label for="name" class=" col-form-label text-md-left">Status:</label>
                                    <select class="select2 form-control" name="status">
                                        <option value="4" @isset($data['status']){{ $data['status'] == "4" ? 'selected="selected"' : "" }}@endisset>
                                            Last Move
                                        </option>
                                        <option value="1" @isset($data['status']){{ $data['status'] == "1" ? 'selected="selected"' : "" }}@endisset>
                                            Import
                                        </option>
                                        <option value="2" @isset($data['status']){{ $data['status'] == "2" ? 'selected="selected"' : "" }}@endisset>
                                            Export Empty/Storage
                                        </option>
                                        <option value="3" @isset($data['status']){{ $data['status'] == "3" ? 'selected="selected"' : "" }}@endisset>
                                            Export Full/Storage
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div style="margin-left: 10px;margin-right: 10px;">
                                    <label for="extcaseno" class="col-form-label text-md-left">Insert BL or Container
                                        No.:</label>
                                    <input type="text" class="form-control"
                                           name="extcaseno"
                                           value="{{ $data['extcaseno'] ?? '' }}"/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div style="margin-left: 10px;margin-right: 10px;">
                                    <label for="email" class="col-form-label text-md-left">&nbsp;</label>
                                    <button type="submit"
                                            style="width: 100%;line-height: 2.6em"

                                            class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">
                                        Check
                                    </button>
                                </div>

                            </div>

                    </form>
                </div>


                @if (count($statusList) and $data['status']!=4)
                    <div class="sec-title pad wow animated fadeInDown">
                        <h3></h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Container No</th>
                                <th>Sz/Tp</th>
                                <th>Unit Status</th>
                                @if ($data['status']==1)
                                    <th>Vessel Name</th>
                                    <th>Vessel Voyage</th>
                                @endif

                                @if ($data['status']==2 or $data['status']==3)
                                    <th>Received Date</th>
                                @else
                                    <th>Discharge Date</th>
                                @endif

                                @if ($data['status']==1)
                                    <th>Gate Out Date</th>
                                    <th>Stripping Date</th>
                                @endif

                                {{--<th>Consignee Name</th>--}}
                                {{-- <th>Yard Position</th>--}}
                                {{--@if (!is_null($statusList['0']->SkuDate1))
                                    <th>Received Date</th>
                                @endif
                                @if (!is_null($statusList['0']->gate_out_date))

                                    <th>Gate Out Date</th>
                                @endif--}}

                                {{--<th>Stripping Date</th>--}}
                                <th>Shipping Line</th>


                                {{--<th>WONo</th>
                                <th>CurrentWO</th>
                                <th>ordertype</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($statusList as $key=>$fields)

                                <tr>
                                    <td>{{$fields->extcaseno}}</td>
                                    <td>{{$fields->sz_tp}}</td>
                                    <td>{{$fields->UnitStatus}}</td>
                                    @if ($data['status']==1)
                                        <td>{{$fields->VesselDesc}}</td>
                                        <td>{{$fields->VoyageID}}</td>
                                    @endif


                                    <td>
                                        @if (!is_null($fields->DischargeDt))
                                            {{date('d/m/Y', strtotime($fields->DischargeDt))}}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    @if ($data['status']==1)
                                        <td>
                                            @if (!is_null($fields->gate_out_date))
                                                {{date('d/m/Y', strtotime($fields->gate_out_date))}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if (!is_null($fields->stripping_date))
                                                {{date('d/m/Y', strtotime($fields->stripping_date))}}
                                            @else
                                                -
                                            @endif

                                        </td>
                                    @endif

                                    {{--<td>{{$fields->ConsigneeNameDL}}</td>--}}
                                    {{--<td>{{$fields->LocationCode}}</td>--}}
                                    {{--@if (!is_null($statusList['0']->SkuDate1))
                                        <td>{{date('d/m/Y h:m', strtotime($fields->SkuDate1))}}</td>
                                    @endif--}}

                                    {{--@if (!is_null($statusList['0']->gate_out_date))
                                        <td>{{date('d/m/Y h:m', strtotime($fields->gate_out_date))}}</td>

                                    @endif--}}

                                    {{--<td>{{$fields->stripping_date}}</td>--}}
                                    {{--<td>{{$fields->shipping_line}}</td>--}}
                                    <td>{{$fields->ClientName}}</td>

                                </tr>

                                {{--@if (isset($data['status']))
                                    @if ($data['status']=='-1')
                                        @if ($fields->ordertype=='MTR' || $fields->ordertype=='STR' || $fields->ordertype=='STF')
                                            @break

                                        @endif

                                    @endif
                                    @if ($data['status']=='1')
                                        @break
                                    @endif
                                @endif--}}


                            @endforeach


                            </tbody>
                        </table>


                    </div>
                @endif
                @if (count($statusList) and $data['status']==4)
                    <div class="sec-title pad wow animated fadeInDown">
                        <h3></h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                {{--<th>Inventory Id</th>--}}
                                <th>Container No</th>
                                <th>Sz/Tp</th>
                                <th>Unit Status</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Vessel Description</th>
                                <th>Voyage Id</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($statusList as $key=>$fields)
                                <tr>
                                    {{--<td>{{$fields->inventoryid}}</td>--}}
                                    <td>{{$fields->ExtCaseNo}}</td>
                                    <td>{{$fields->sz_tp}}</td>
                                    <td>{{$fields->UnitStatus}}</td>
                                    <td>{{$fields->description}}</td>
                                    <td>
                                        @if (!is_null($fields->date))
                                            {{date('d/m/Y', strtotime($fields->date))}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{$fields->vesseldescription}}</td>
                                    <td>{{$fields->VoyageID}}</td>

                                </tr>

                            @endforeach


                            </tbody>
                        </table>

                    </div>
                @endif
                @if ($isSearch=='1' and count($statusList)==0)
                    <div class="sec-title pad wow animated fadeInDown">

                        Result For Container No {{ $data['extcaseno']}} Not found
                    </div>


                @endif


            </div>
        </div>
    </section>

</main>

<footer id="footer">
    <div class="container">
        <div class="footer-social">
            <div class="col-md-9">
                <!-- col-sm-12 col-xs-12" -->
            </div>
            <div class=" col-md-3  list-inline  ">
                <!-- col-md-3 col-sm-12 col-xs-12 -->
                <ul>
                    <li><a class="facebookBtn smGlobalBtn"
                           href="https://www.facebook.com/Basra-Multipurpose-Terminal-110907407131484/?ref=aymt_homepage_panel&eid=ARAFKQuP98TyVI-v-YoundpX07P1IaWVHlL2NOC3OxeOETLju5VkRgfI4a_mTGg3ALr8_iOcCp2Gr1HZ"></a>
                    </li>
                    <li><a class="youtubeBtn smGlobalBtn"
                           href="https://www.youtube.com/channel/UCNwUYjAI6FM5FtH_Fl5YbnA?view_as=subscriber"></a></li>
                    <li><a class="linkedinBtn smGlobalBtn" href="https://www.linkedin.com/company/36980219"></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Essential jQuery Plugins
      ================================================== -->
<!-- Main jQuery -->

<!-- <script src="js/jquery-1.12.4.min.js"></script> -->
<script src="{{ asset(@env('TEMPLATE_NAME').'/js/jquery-1.11.1.min.js') }}"></script>
<!-- Fullscreen slider -->
<script src="{{ asset(@env('TEMPLATE_NAME').'/js/jquery.ba-cond.min.js') }}"></script>

{{--
<script src="{{ asset(@env('TEMPLATE_NAME').'/js/jquery.slitslider.js') }}"></script>
--}}


<!-- Twitter Bootstrap -->
<script src="{{ asset(@env('TEMPLATE_NAME').'/js/bootstrap.min.js') }}"></script>

<!-- <script src="js/jquery-1.11.1.min.js"></script> -->
<script src="{{ asset(@env('TEMPLATE_NAME').'/js/wow.min.js') }}"></script>

<!-- Single Page Nav -->

<script src="{{ asset(@env('TEMPLATE_NAME').'/js/jquery.singlePageNav.min.js') }}"></script>

<!-- jquery.fancybox.pack -->
<script src="{{ asset(@env('TEMPLATE_NAME').'/js/jquery.fancybox.pack.js') }}"></script>

<!--


<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
-->

<!--

   <script>

function myMap(){

  var mapProp= {
    center:new google.maps.LatLng(22.402789, 91.822156),
    zoom:15,
  };
  var map = new google.maps.Map(document.getElementById("map-canvas"),mapProp);
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqsKYysE16gV-850eZf6jcJOzQtagUTCw&callback=myMap"></script>
-->


<!-- Owl Carousel -->

<!--  -->
<script src="{{ asset(@env('TEMPLATE_NAME').'/js/owl.carousel.min.js') }}"></script>


<!-- jquery easing -->
<script src="{{ asset(@env('TEMPLATE_NAME').'/js/jquery.easing.min.js') }}"></script>


<!-- onscroll animation -->
<script src="{{ asset(@env('TEMPLATE_NAME').'/js/wow.min.js') }}"></script>

<!-- Custom Functions -->
<script src="{{ asset(@env('TEMPLATE_NAME').'/js/main.js') }}"></script>


{{--<script>
    setInterval(function () {
        $("#nav-arrows .sl-next").trigger("click")
    }, 4000);
</script>
<script>
    $('.navbar-nav>li>a').on('click', function () {
        $('.navbar-collapse').collapse('hide');
    });
</script>--}}
<script>
    function goToURL() {
        // location.href = 'http://hr.bmtiq.com/ess/Account/Login.aspx?ReturnUrl=%2fess%2fDefault.aspx';
        window.open('http://hr.bmtiq.com/ess/Account/Login.aspx?ReturnUrl=%2fess%2fDefault.aspx', '_blank');
    }
</script>

<!-- <script type="text/javascript">
  // window.onload = function() {
  //     setTimeout(function() {
  //         window.location = "index.html#a_home";
  //     }, 5000);
  // };
  window.scrollTo(0, 0);
  $('html, body').animate({

    scrollTop: $(window).scrollTop() + 0 /*60*/
  } );
</script> -->

<!------------------------------------------------------------------->

<!-- <script type="text/javascript">
  $(function() {

    var Page = (function() {

      var $nav = $( '#nav-dots > span' ),
        slitslider = $( '#slider' ).slitslider( {
          onBeforeChange : function( slide, pos ) {

            $nav.removeClass( 'nav-dot-current' );
            $nav.eq( pos ).addClass( 'nav-dot-current' );

          }
        } ),

        init = function() {

          initEvents();

        },
        initEvents = function() {

          $nav.each( function( i ) {

            $( this ).on( 'click', function( event ) {

              var $dot = $( this );

              if( !slitslider.isActive() ) {

                $nav.removeClass( 'nav-dot-current' );
                $dot.addClass( 'nav-dot-current' );

              }

              slitslider.jump( i + 1 );
              return false;

            } );

          } );

        };

        return { init : init };

    })();

    Page.init();

    /**
     * Notes:
     *
     * example how to add items:
     */

    /*

    var $items  = $('<div class="sl-slide sl-slide-color-2" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1"><div class="sl-slide-inner bg-1"><div class="sl-deco" data-icon="t"></div><h2>some text</h2><blockquote><p>bla bla</p><cite>Margi Clarke</cite></blockquote></div></div>');

    // call the plugin's add method
    ss.add($items);

    */

  });
</script> -->

<!------------------------------------------------------------------->

<!-- href="http://hr.bmtiq.com/ess/Account/Login.aspx?ReturnUrl=%2fess%2fDefault.aspx" -->
</body>

</html>
