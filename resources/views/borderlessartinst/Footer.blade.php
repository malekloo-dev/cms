<div id="wb_contact">
    <div id="contact">
        <div class="row">
            <div class="col-1">
                <label for="Card5" id="contactLabel1" style="display:block;width:100%;z-index:22;">Follow Us</label>
                <div id="wb_contactIcon2"
                    style="display:inline-block;width:28px;height:28px;text-align:center;z-index:23;">
                    <a href="https://www.facebook.com/borderlessart.inst" title="Facebook">
                        <div id="contactIcon2"><i class="fa fa-facebook"></i></div>
                    </a>
                </div>
                <div id="wb_contactIcon3"
                    style="display:inline-block;width:28px;height:28px;text-align:center;z-index:24;">
                    <a href="https://www.instagram.com/borderless_art/?hl=en" title="Instagram">
                        <div id="contactIcon3"><i class="fa fa-instagram"></i></div>
                    </a>
                </div>
                <div id="wb_contactIcon4"
                    style="display:inline-block;width:28px;height:28px;text-align:center;z-index:25;">
                    <a href="https://www.youtube.com/channel/UCf-w0o7VCZnjTByx-rWgtqQ" title="Youtube">
                        <div id="contactIcon4"><i class="fa fa-youtube-play"></i></div>
                    </a>
                </div>

                <div id="wb_contactAddress">
                    <label for="Card5" id="contactLabel4" style="display:inline-block;z-index:26;">Address</label>
                    <p style="font-size:13px;line-height:16px;color:#FFFFFF;"><span style="color:#FFFFFF;">Po Box.
                            1911713341</span><span style="color:#FFFFFF;"><br /></span><span
                            style="color:#FFFFFF;">Tehran-
                            Iran</span></p>
                    <p style="font-size:13px;line-height:16px;color:#FFFFFF;"><span style="color:#FFFFFF;">Phone: +98
                            939
                            649 13 60</span></p>
                    <p style="font-size:13px;line-height:16px;">&nbsp;</p>
                    <p style="font-size:13px;line-height:16px;color:#FFFFFF;"><span style="color:#FFFFFF;">Email:
                            info@borderlessartinst.com</span></p>
                </div>
            </div>
            <div class="col-2">
                <div id="wb_Image2" style="display:inline-block;width:282px;height:188px;z-index:28;">
                    <img src="{{ asset('images/pngflow.com.png') }}" id="Image2" alt="">
                </div>
            </div>
            <div class="col-3">
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <label for="Card5" id="contactLabel3" style="display:inline-block;z-index:29;">Contact Us</label>
                    <input type="text" id="contactName" style="display:block;width: 100%;height:38px;z-index:30;"
                        name="name" value="" spellcheck="false" placeholder="Name">
                    <input type="text" id="contactEmail" style="display:block;width: 100%;height:38px;z-index:31;"
                        name="email" value="" spellcheck="false" placeholder="Email">
                    <textarea name="message" id="contactMessage"
                        style="display:block;width: 100%;;height:85px;z-index:32;" rows="2" cols="25" spellcheck="false"
                        placeholder="Message"></textarea>
                    <a id="contactButton" href="mailto:info@borderlessartinst.com"
                        style="display:block;width: 100%;;height:32px;z-index:33;">Send</a>
                </form>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            Powered by <a href="https://tarhoweb.com" target="_blanck" style="color: #808080;">Tarhoweb</a>
        </div>
    </div>
</div>




@yield('footer')
<script>
    var TEMPLATE_NAME = `{{ env('TEMPLATE_NAME') }}`;

</script>
<script src="{{ url('/main.js') }}"></script>



<script src="{{ asset('jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('jquery-ui.min.js') }}"></script>
<script src="{{ asset('owl.carousel.min.js') }}"></script>
<script src="{{ asset('transition.min.js') }}"></script>
<script src="{{ asset('collapse.min.js') }}"></script>
<script src="{{ asset('dropdown.min.js') }}"></script>
<script src="{{ asset('wwb15.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#reviewsImage1').addClass('visibility-hidden');
        $('#portfolio-image2').addClass('visibility-hidden');
        $("a[href*='#LayoutGrid1']").click(function(event) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: $('#wb_LayoutGrid1').offset().top
            }, 600, 'easeOutCirc');
        });
        $("a[href*='#header']").click(function(event) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: $('#wb_header').offset().top
            }, 600, 'easeOutCirc');
        });
        $("a[href*='#intro']").click(function(event) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: $('#wb_intro').offset().top - 88
            }, 600, 'easeOutExpo');
        });
        $("a[href*='#introLayoutGrid']").click(function(event) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: $('#wb_introLayoutGrid').offset().top - 88
            }, 600, 'easeOutExpo');
        });

        function onScrollintroLayoutGrid() {
            var $obj = $("#wb_introLayoutGrid");
            if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false)) {
                $obj.addClass("in-viewport");
                AnimateCss('reviewsImage1', 'animate-fade-in-up', 0, 1000);
                AnimateCss('portfolio-image2', 'animate-fade-in-up', 500, 1000);
            }
        }
        onScrollintroLayoutGrid();
        $(window).scroll(function(event) {
            onScrollintroLayoutGrid();
        });
        $("a[href*='#coffee']").click(function(event) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: $('#coffee').offset().top
            }, 600, 'easeOutExpo');
        });
        $("#coffee").owlCarousel({
                autoplayTimeout: 5000,
                margin: 16,
                autoplay: true,
                nav: false,
                loop: true,
                dots: true,
                items: 3,
                slideBy: 1,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 3,
                        nav: true
                    }
                }
            }

        );
        $("a[href*='#about']").click(function(event) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: $('#wb_about').offset().top
            }, 600, 'easeOutExpo');
        });
        $("a[href*='#contact']").click(function(event) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: $('#wb_contact').offset().top
            }, 600, 'easeOutExpo');
        });
        $(document).on('click', '.headerMenu-navbar-collapse.in', function(e) {
            if ($(e.target).is('a') && ($(e.target).attr('class') != 'dropdown-toggle')) {
                $(this).collapse('hide');
            }
        });
        var iOS = !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform);
        if (iOS) {
            $('#wb_intro').css('background-attachment', 'scroll');
        }
    });

</script>
</body>

</html>
