<div id="wb_LayoutGrid1">
    <div id="LayoutGrid1">
       <div class="row">
          <div class="col-1">
             <div id="wb_Image1" style="display:inline-block;width:198px;height:69px;z-index:0;">
                <img src="{{ asset('images/output-onlinepngtools.png') }}" id="Image1" alt="">
             </div>
          </div>
          <div class="col-2">
             <div id="wb_Text1">
                <span style="color:#000000;font-family:Arial;font-size:19px;"><strong><br></strong></span><span
                   style="color:#000000;font-family:Arial;font-size:24px;"><strong>Borderless Art
                      Inst.</strong></span>
             </div>
          </div>
          <div class="col-3">
             <a id="headerButton" href="#contact"
                style="display:inline-block;width:123px;height:35px;z-index:2;">Contact Us</a>
          </div>
       </div>
    </div>
 </div>
 <div id="wb_header">
    <div id="header">
       <div class="row">
          <div class="col-1">
             <div id="wb_headerMenu" style="display:inline-block;width:100%;z-index:1003;">
                <div id="headerMenu" class="headerMenu" style="width:100%;height:auto !important;">
                   <div class="container">
                      <div class="navbar-header">
                         <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".headerMenu-navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                         </button>
                      </div>
                      <div class="headerMenu-navbar-collapse collapse">
                         <ul class="nav navbar-nav">

                            @foreach (App\Menu::where('parent', '=', '0')
                        ->orderBy('sort')
                        ->get()
                    as $menuItem)
                        <?php $subMenu = App\Menu::where('menu', '=', '1')
                        ->where('parent', '=', $menuItem['id'])
                        ->orderBy('sort')
                        ->get(); ?>
                        @if (count($subMenu))
                            <li class="parent"><a href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a>
                                <div><img width="16" height="16" alt="arrow-down"
                                        src="{{ asset('/img/arrow-down.png') }}"></div>
                                <ul>
                                    @foreach ($subMenu as $subMenuItem)
                                        <li><a href="{{ ($subMenuItem['type'] == 'internal' || $subMenuItem['type'] == 'external') ? $subMenuItem['link'] : '/#'.$subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ ($menuItem['type'] == 'internal' || $menuItem['type'] == 'external') ? $menuItem['link'] : '/#'.$menuItem['link'] }}">{{ $menuItem['label'] }}</a></li>

                        @endif

                    @endforeach
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
          </div>

          <div class="col-3 social-link">
             <div id="wb_FontAwesomeIcon3"
                style="display:inline-block;width:23px;height:23px;text-align:center;z-index:4;">
                <a href="https://www.facebook.com/borderlessart.inst" target="_blank" title="Facebook">
                   <div id="FontAwesomeIcon3"><i class="fa fa-facebook"></i></div>
                </a>
             </div>
             <div id="wb_FontAwesomeIcon4"
                style="display:inline-block;width:23px;height:23px;text-align:center;z-index:5;">
                <a href="https://www.instagram.com/borderless_art/?hl=en" target="_blank" title="Instagram">
                   <div id="FontAwesomeIcon4"><i class="fa fa-instagram"></i></div>
                </a>
             </div>
             <div id="wb_FontAwesomeIcon5"
                style="display:inline-block;width:23px;height:23px;text-align:center;z-index:6;">
                <a href="https://www.youtube.com/channel/UCf-w0o7VCZnjTByx-rWgtqQ" target="_blank" title="Youtube">
                   <div id="FontAwesomeIcon5"><i class="fa fa-youtube-play"></i></div>
                </a>
             </div>
          </div>
       </div>
    </div>
 </div>

