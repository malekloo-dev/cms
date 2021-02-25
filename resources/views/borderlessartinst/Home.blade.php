@extends(@env('TEMPLATE_NAME').'.App')

@section('head')

@endsection
@section('footer')

@endsection

@section('Content')

    <div id="wb_intro">
        <div id="intro">
            <div class="col-1">
                <div id="wb_introText">
                    <p style="font-size:19px;line-height:21px;font-weight:bold;font-style:italic;color:#FFFFFF;"><span
                            style="color:#FFFFFF;">"If it can be written or thought, it can be filmed" </span></p>
                    <p style="font-size:16px;line-height:18px;color:#FFFFFF;"><span style="color:#FFFFFF;">Standley
                            Kubrick</span></p>
                </div>
                <div id="wb_introShape" style="display:inline-block;width:120px;height:44px;z-index:8;position:relative;">
                    <a href="#about"><img src="images/img0001.png" id="introShape" alt=""
                            style="width:120px;height:44px;"></a>
                </div>
            </div>
        </div>
    </div>
    <div id="wb_introLayoutGrid">
        <div id="introLayoutGrid">
            <div class="row">
                <div class="col-1">
                    <div class="col-1-padding">
                        <div id="wb_introHeading" style="display:inline-block;width:100%;z-index:9;">
                            <h6 id="introHeading"> <br> <br></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="wb_coffee">
        <div id="coffee" class="owl-carousel owl-theme">
            {{--post&label=films&var=films&count=10 --}}

            @isset($films['data'])
                @foreach ($films['data'] as $content)
                    <div id="wb_Card6" style="">
                        <div id="Card6-card-body">
                            <a href="{{ url($content->slug) }}">
                                @if (isset($content->images['thumb']))
                                    <img id="Card6-card-item0" src="{{ $content->images['images']['small'] }}" alt="" title="">
                                @endif
                            </a>
                            <div id="Card6-card-item1">{{ $content->title }}<br></div>
                            <hr id="Card6-card-item2">
                            <div id="Card6-card-item3">By Behrang Dezfulizade<br></div>
                        </div>

                    </div>
                @endforeach

            @endisset
        </div>
    </div>
    <div id="wb_about">
        <div id="about">
            <div class="row">
                <div class="col-1">
                    <div class="col-1-padding">
                        <div id="wb_aboutText">
                            <p style="font-size:20px;line-height:22.5px;color:#59493C;"><span
                                    style="font-size:32px;line-height:36px;font-weight:bold;color:#59493C;">Our
                                    Company</span>
                            </p>
                            <p style="font-size:13px;line-height:16px;">&nbsp;</p>
                            <p style="font-size:15px;line-height:16.5px;color:#000000;"><span
                                    style="color:#000000;">Borderless
                                    Art is a young boutique Sales Agent company based in Tehran Iran, started its work from
                                    2016.
                                    Our goal is to introduce young talented independent filmmakers from Middle East to the
                                    World
                                    Cinema.</span></p>
                            <p style="font-size:13px;line-height:16px;">&nbsp;</p>
                        </div>
                        <a id="aboutButton" href="" style="display:inline-block;width:114px;height:34px;z-index:20;">Read
                            More</a>
                    </div>
                </div>
                <div class="col-2">
                    <div class="col-2-padding">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="upStickyLayer"
        style="position:fixed;text-align:left;left:auto;right:25px;top:auto;bottom:25px;width:50px;height:50px;z-index:40;">
        <div id="wb_upIcon" style="position:absolute;left:9px;top:9px;width:24px;height:24px;text-align:center;z-index:21;">
            <a href="#intro">
                <div id="upIcon"><i class="fa fa-angle-up"></i></div>
            </a>
        </div>
    </div>


@endsection
