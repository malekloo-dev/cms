<!DOCTYPE html>
<html lang="en-gb" dir="ltr" class='com_content view-category layout-theme3605category itemid-101 home j39 mm-hover'>

<head>
    <title>{{ $seo['meta_title'] ?? '' }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ $seo['meta_keywords'] ?? '' }}">
    <meta name="description" content="{{ $seo['meta_description'] ?? '' }}">

    {{--
    <link rel="manifest" href="{{ asset('/manifest.json') }}"> --}}
    <meta name="theme-color" content="#fa490e" />

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#fa490e">
    <meta name="apple-mobile-web-app-title" content="ریموت">
    <link rel="apple-touch-icon" href="{{ asset('/img/logo-96-96.png') }}">
    <link rel="apple-touch-icon" sizes="96x96" href="{{ asset('/img/logo-152-152.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/img/logo-152-152.png') }}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ asset('/img/logo-192-192.png') }}">
    <link rel="apple-touch-icon" sizes="256x256" href="{{ asset('/img/logo-256-256.png') }}">
    <link rel="apple-touch-startup-image" href="{{ asset('/img/logo-512-512.png') }}">

    <meta name="msapplication-TileImage" content="{{ asset('/img/logo-192-192.png') }}">
    <meta name="msapplication-TileColor" content="#fa490e">
    <meta name="msapplication-square96x96logo" content="{{ asset('/img/logo-96-96.png') }}">
    <meta name="msapplication-square152x152logo" content="{{ asset('/img/logo-152-152.png') }}">


    <link rel="icon" href="{{ asset('/img/fav.png') }}" type="image/png">
    <link rel="stylesheet" media="bogus">

    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="{{ $seo['og:type'] ?? '' }}">
    <meta property="og:title" content="{{ $seo['meta_title'] ?? '' }}">
    <meta property="og:description" content="{{ $seo['meta_description'] ?? '' }}">
    <meta property="og:url" content="{{ $seo['url'] ?? '' }}">
    <meta property="og:image" content="{{ asset('/img/logo2x.png') }}">

    <meta name="twitter:card" content="summary_large_image">





    {{-- template head --}}
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-mobile-web-app-capable" content="YES" />

    <link href="{{ asset('templates/theme3605/favicon.ico') }}" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link href="{{ asset('templates/theme3605/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('media/jui/css/chosenac7e.css?cab9993226ebdb1772448297537a6350') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('templates/theme3605/css/template.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/system/css/system.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/theme3605/css/megamenu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/system/t3/base-bs3/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('templates/theme3605/fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('templates/theme3605/fonts/material-design/css/material-design.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('templates/theme3605/fonts/material-icons/css/material-icons.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('templates/theme3605/fonts/thin/css/thin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templates/theme3605/fonts/glyphicons/css/glyphicons.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('templates/theme3605/fonts/linearicons/css/linearicons.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('templates/theme3605/css/custom-styles.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('modules/mod_bootstrap_collapse/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('modules/mod_tm_ajax_contact_form/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('modules/mod_swiper/css/animate.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .layout#kunena+div {
            display: block !important;
        }

        #kunena+div {
            display: block !important;
        }

        div.mod_search103 input[type="search"] {
            width: auto;
        }

    </style>

    <link rel="stylesheet" href="{{ asset('/style.css') }}">






    <script src="{{ asset('media/jui/js/jquery.minac7e.js?cab9993226ebdb1772448297537a6350') }}" type="text/javascript">
    </script>
    <script src="{{ asset('media/jui/js/jquery-noconflictac7e.js?cab9993226ebdb1772448297537a6350') }}"
        type="text/javascript"></script>
    <script src="{{ asset('media/jui/js/jquery-migrate.minac7e.js?cab9993226ebdb1772448297537a6350') }}"
        type="text/javascript"></script>
    <script src="{{ asset('media/system/js/html5fallbackac7e.js?cab9993226ebdb1772448297537a6350') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('plugins/system/t3/base-bs3/bootstrap/js/bootstrapac7e.js?cab9993226ebdb1772448297537a6350') }}"
        type="text/javascript"></script>
    <script src="{{ asset('media/jui/js/chosen.jquery.minac7e.js?cab9993226ebdb1772448297537a6350') }}"
        type="text/javascript"></script>
    <script src="{{ asset('templates/theme3605/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/system/t3/base-bs3/js/jquery.tap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/system/t3/base-bs3/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/system/t3/base-bs3/js/menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/system/t3/base-bs3/js/nav-collapse.js') }}" type="text/javascript"></script>
    <script src="{{ asset('media/com_acymailing/js/acymailing_module4d88.js?v=5101') }}" type="text/javascript"
        async="async"></script>
    <script src="{{ asset('templates/theme3605/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('templates/theme3605/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('modules/mod_articles_news_adv/js/masonry.pkgd.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('modules/mod_tm_parallax/js/jquery.materialize-parallax.js') }}" type="text/javascript">
    </script>
    <!-- <script src="{{ asset('modules/mod_tm_google_map/js/mod_tm_google_map.js') }}" type="text/javascript"></script> -->
    <!-- <script
        src="http://maps.google.com/maps/api/js?key=AIzaSyAwH60q5rWrS8bXwpkZwZwhw9Bw0pqKTZM&amp;sensor=false&amp;libraries=geometry,places&amp;v=3.7"
        type="text/javascript"></script> -->
    <script src="{{ asset('modules/mod_tm_ajax_contact_form/js/jquery.validate.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('modules/mod_tm_ajax_contact_form/js/additional-methods.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('modules/mod_tm_ajax_contact_form/js/autosize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('modules/mod_tm_ajax_contact_form/js/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('modules/mod_tm_ajax_contact_form/js/bootstrap-datetimepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('modules/mod_tm_ajax_contact_form/js/ajaxsendmail.js') }}" type="text/javascript"></script>
    <script src="{{ asset('modules/mod_tm_counters/js/mod_tm_counters.js') }}" type="text/javascript"></script>
    <script src="{{ asset('modules/mod_swiper/js/swiper.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(function($) {
            initTooltips();
            $("body").on("subform-row-add", initTooltips);

            function initTooltips(event, container) {
                container = container || document;
                $(container).find(".hasTooltip").tooltip({
                    "html": true,
                    "container": "body"
                });
            }
        });
        jQuery(function($) {
            initChosen();
            $("body").on("subform-row-add", initChosen);

            function initChosen(event, container) {
                container = container || document;
                $(container).find("select").chosen({
                    "disable_search_threshold": 10,
                    "search_contains": true,
                    "allow_single_deselect": true,
                    "placeholder_text_multiple": "Type or select some options",
                    "placeholder_text_single": "Select an option",
                    "no_results_text": "No results match"
                });
            }
        });

        var path = "templates/theme3605/js/index.html";

        ;
        (function($) {
            $(window).load(function() {
                $(document).on("click touchmove", function(e) {

                    var container = $("#t3-mainnav .t3-navbar-collapse");
                    if (!container.is(e.target) &&
                        container.has(e.target).length === 0 && container.hasClass("in")) {
                        $("#t3-mainnav .t3-navbar-collapse").toggleClass("in")
                    }
                })
                // check we miss any nav
                if ($(window).width() < 768) {
                    $('.t3-navbar-collapse ul.nav').has('.dropdown-menu').t3menu({
                        duration: 100,
                        timeout: 50,
                        hidedelay: 100,
                        hover: false,
                        sb_width: 20
                    });
                }
            });
        })(jQuery);

        if (typeof acymailingModule == 'undefined') {
            var acymailingModule = Array();
        }

        acymailingModule['emailRegex'] =
            /^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*\@([a-z0-9-]+\.)+[a-z0-9]{2,10}$/i;

        acymailingModule['NAMECAPTION'] = 'Name';
        acymailingModule['NAME_MISSING'] = 'Please enter your name';
        acymailingModule['EMAILCAPTION'] = 'Enter Your Email';
        acymailingModule['VALID_EMAIL'] = 'Please enter a valid e-mail address';
        acymailingModule['ACCEPT_TERMS'] = 'Please check the Terms and Conditions';
        acymailingModule['CAPTCHA_MISSING'] = 'The captcha is invalid, please try again';
        acymailingModule['NO_LIST_SELECTED'] = 'Please select the lists you want to subscribe to';

        (function($) {
            $(document).ready(function() {
                $("#formAcymailing91201").validate({
                    wrapper: "mark",
                    submitHandler: function(a) {
                        return submitacymailingform("optin", "formAcymailing91201")
                    }
                })
            })
        })(jQuery);
        (function($) {
            $(window).load(function() {
                $("#mod-newsflash-adv__masonry297").masonry({
                    itemSelector: ".item"
                })
            })
        })(jQuery);
        (function($) {
            $(window).load(function() {
                $("#mod-newsflash-adv__masonry298").masonry({
                    itemSelector: ".item"
                })
            })
        })(jQuery);;
        (function($) {
            $(window).load(function() {
                userAgent = navigator.userAgent.toLowerCase();
                isIE = userAgent.indexOf("msie") != -1 ? parseInt(userAgent.split("msie")[1], 10) :
                    userAgent.indexOf("trident") != -1 ? 11 : userAgent.indexOf("edge") != -1 ? 12 : false;

                isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator
                    .userAgent);


                if (!isIE && !isMobile) {
                    $("#mod_tm_parallax_299 .mod_tm_parallax").parallaxmat();
                } else {

                    if (!isMobile) {
                        imgPath = $("#mod_tm_parallax_299 .mod_tm_parallax").find("img").attr("src");

                        $("#mod_tm_parallax_299 .mod_tm_parallax").css({
                            "background-image": "url(" + imgPath + ")",
                            "background-size": "cover",
                            "background-attachment": "fixed"
                        });
                    } else {
                        imgPath = $("#mod_tm_parallax_299 .mod_tm_parallax").find("img").attr("src");

                        $("#mod_tm_parallax_299 .mod_tm_parallax").css({
                            "background-image": "url(" + imgPath + ")",
                            "background-size": "cover"
                        });
                    }

                }
            });
        })(jQuery);

        ;
        (function($, undefined) {

            $(window).on("load", function() {
                /**
                 * isScrolledIntoView
                 * @description  check the element whas been scrolled into the view
                 */
                function isScrolledIntoView(elem) {

                    return elem.offset().top + elem.outerHeight() >= $(window).scrollTop() && elem.offset()
                        .top <= $(window).scrollTop() + $(window).height();

                }

                /**
                 * initOnView
                 * @description  calls a function when element has been scrolled into the view
                 */
                function lazyInit(element, func) {
                    var $win = jQuery(window);

                    $(document).ready(function() {
                        if (element.offset().top < $(window).height()) {
                            var head = document.getElementsByTagName('head')[0],
                                insertBefore = head.insertBefore;

                            head.insertBefore = function(newElement, referenceElement) {
                                if (newElement.href && newElement.href.indexOf(
                                        '//fonts.googleapis.com/css?family=Roboto') != -1 ||
                                    newElement.innerHTML.indexOf('gm-style') != -1) {
                                    return;
                                }
                                insertBefore.call(head, newElement, referenceElement);
                            };
                            func.call();
                            element.addClass('lazy-loaded');
                        }
                    });

                    $win.on('load scroll', function() {
                        if ((!element.hasClass('lazy-loaded') && (isScrolledIntoView(element)))) {
                            var head = document.getElementsByTagName('head')[0],
                                insertBefore = head.insertBefore;

                            head.insertBefore = function(newElement, referenceElement) {
                                if (newElement.href && newElement.href.indexOf(
                                        '//fonts.googleapis.com/css?family=Roboto') != -1 ||
                                    newElement.innerHTML.indexOf('gm-style') != -1) {
                                    return;
                                }
                                insertBefore.call(head, newElement, referenceElement);
                            };
                            func.call();
                            element.addClass('lazy-loaded');
                        }
                    });
                }


                // var $googleMapItem = $("#mod_tm_google_map_269 .rd-google-map");

                // lazyInit($googleMapItem, $.proxy(function () {
                //     var $this = $(this),
                //         styles = $this.attr("data-styles");

                //     $this.googleMap({
                //         marker: {
                //             basic: $this.data('marker'),
                //             active: $this.data('marker-active')
                //         },
                //         styles: [{
                //             "featureType": "administrative.country",
                //             "elementType": "labels.text",
                //             "stylers": [{ "visibility": "on" }]
                //         }],
                //         onInit: function (map) {
                //             google.maps.event.addListener(map, 'tilesloaded', function (evt) {
                //                 $("#mod_tm_google_map_269").addClass('map-loaded');
                //             });
                //         }
                //     });
                // }, $googleMapItem));

            });

        })(jQuery);;
        (function($) {
            $(document).ready(function() {
                $(".accordion").collapse();
                $("#accordion145 .panel-heading").on("click", function() {
                    $("#accordion145").find(".panel").each(function() {
                        $(this).removeClass("active");
                    })

                    if ($(this).parent('.panel').find('.panel-collapse').hasClass('in')) {
                        $(this).parent('.panel').removeClass('active');
                    } else {
                        $(this).parent('.panel').addClass('active');
                    }

                    $(this).closest('.accordion-group').toggleClass("selected");
                    $(this).toggleClass("selected");
                });
            });


        })(jQuery);;
        (function($) {
            $(document).ready(function() {
                autosize($("textarea"));
                $(".no-edit").closest(".moduletable").addClass("no-edit");
            })
        })(jQuery);
        (function($) {
            $(document).ready(function() {
                var v = $("#contact-form_293").validate({
                    wrapper: "mark",
                    submitHandler: function(f) {
                        $(f).ajaxsendmail();
                        return false
                    }
                });
            })
        })(jQuery);;
        (function($) {
            $(window).load(function() {
                userAgent = navigator.userAgent.toLowerCase();
                isIE = userAgent.indexOf("msie") != -1 ? parseInt(userAgent.split("msie")[1], 10) :
                    userAgent.indexOf("trident") != -1 ? 11 : userAgent.indexOf("edge") != -1 ? 12 : false;

                isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator
                    .userAgent);


                if (!isIE && !isMobile) {
                    $("#mod_tm_parallax_294 .mod_tm_parallax").parallaxmat();
                } else {

                    if (!isMobile) {
                        imgPath = $("#mod_tm_parallax_294 .mod_tm_parallax").find("img").attr("src");

                        $("#mod_tm_parallax_294 .mod_tm_parallax").css({
                            "background-image": "url(" + imgPath + ")",
                            "background-size": "cover",
                            "background-attachment": "fixed"
                        });
                    } else {
                        imgPath = $("#mod_tm_parallax_294 .mod_tm_parallax").find("img").attr("src");

                        $("#mod_tm_parallax_294 .mod_tm_parallax").css({
                            "background-image": "url(" + imgPath + ")",
                            "background-size": "cover"
                        });
                    }

                }
            });
        })(jQuery);


        ;
        (function($, undefined) {

            $(document).ready(function() {
                function isScrolledIntoView(elem) {
                    var $window = $(window),
                        $elem = $(elem);
                    return $elem.offset().top + $elem.height() >= $window.scrollTop() && $elem.offset()
                        .top <= $window.scrollTop() + $window.height();
                }

                if (isScrolledIntoView("#mod_tm_counters_291 .counter-value") && !$(
                        "#mod_tm_counters_291 .counter-value").hasClass("animated")) {
                    $("#mod_tm_counters_291 .counter-value").countTo();
                    $("#mod_tm_counters_291 .counter-value").addClass("animated");
                }

                $(document).on("scroll", function() {
                    if (isScrolledIntoView("#mod_tm_counters_291 .counter-value") && !$(
                            "#mod_tm_counters_291 .counter-value").hasClass("animated")) {
                        $("#mod_tm_counters_291 .counter-value").countTo();
                        $("#mod_tm_counters_291 .counter-value").addClass("animated");
                    }
                });

            });

        })(jQuery);


        ;
        (function($) {
            $(window).load(function() {
                userAgent = navigator.userAgent.toLowerCase();
                isIE = userAgent.indexOf("msie") != -1 ? parseInt(userAgent.split("msie")[1], 10) :
                    userAgent.indexOf("trident") != -1 ? 11 : userAgent.indexOf("edge") != -1 ? 12 : false;

                isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator
                    .userAgent);


                if (!isIE && !isMobile) {
                    $("#mod_tm_parallax_304 .mod_tm_parallax").parallaxmat();
                } else {

                    if (!isMobile) {
                        imgPath = $("#mod_tm_parallax_304 .mod_tm_parallax").find("img").attr("src");

                        $("#mod_tm_parallax_304 .mod_tm_parallax").css({
                            "background-image": "url(" + imgPath + ")",
                            "background-size": "cover",
                            "background-attachment": "fixed"
                        });
                    } else {
                        imgPath = $("#mod_tm_parallax_304 .mod_tm_parallax").find("img").attr("src");

                        $("#mod_tm_parallax_304 .mod_tm_parallax").css({
                            "background-image": "url(" + imgPath + ")",
                            "background-size": "cover"
                        });
                    }

                }
            });
            $('a').click(function() {
                alert(1);
                // var top = $('html').find($(this).attr('href')).offset().top - 100;
                // // var top = $('html').find($(this).attr('href')).offset().top;
                // $('html, body').animate({scrollTop: top},1500, 'easeInOutCubic');
                // return false;
            });
        })(jQuery);

        ;
        (function($) {
            if ($(window).width() > 767) {
                jQuery("body").css({
                    padding: 0,
                    margin: 0
                });
                var f = function() {
                    var w1 = jQuery(".t3-sl .container").width();
                    var pl = parseInt(jQuery(".t3-sl .container .row").css("padding-left").replace("px", ""),
                        10);
                    var pr = parseInt(jQuery(".t3-sl .container .row").css("padding-right").replace("px", ""),
                        10);
                    var p = pr + pl;
                    var w2 = jQuery(window).width();
                    var d = w2 - w1;
                    var h = (d - p) / 2;
                    jQuery(".moduletable.imageRight .module_container").css({
                        marginRight: -h
                    });
                };
                setInterval(f, 1000);
                jQuery(window).resize(f);
            }


        })(jQuery);

        ;
        (function($, undefined) {
            $(window).load(function() {
                function isIE() {
                    var myNav = navigator.userAgent.toLowerCase();
                    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
                };
                var o = $("#swiper-slider_208");

                if (o.length) {

                    function getSwiperHeight(object, attr) {
                        var val = object.attr("data-" + attr),
                            dim;
                        if (!val) {
                            return undefined;
                        }
                        dim = val.match(/(px)|(%)|(vh)|(vw)$/i);
                        if (dim.length) {
                            switch (dim[0]) {
                                case "px":
                                    return parseFloat(val);
                                case "vh":
                                    return $window.height() * (parseFloat(val) / 100);
                                case "vw":
                                    return $window.width() * (parseFloat(val) / 100);
                                case "%":
                                    return object.width() * (parseFloat(val) / 100);
                            }
                        } else {
                            return undefined;
                        }
                    }

                    function toggleSwiperInnerVideos(swiper) {
                        var prevSlide = $(swiper.slides[swiper.previousIndex]),
                            nextSlide = $(swiper.slides[swiper.activeIndex]),
                            videos,
                            videoItems = prevSlide.find("video");

                        for (var i = 0; i < videoItems.length; i++) {
                            videoItems[i].pause();
                        }

                        videos = nextSlide.find("video");
                        if (videos.length) {
                            videos.get(0).play();
                        }
                    }

                    function toggleSwiperCaptionAnimation(swiper) {
                        var prevSlides = $(swiper.el).find("[data-caption-animate]"),
                            nextSlide = $(swiper.slides[swiper.activeIndex]).find("[data-caption-animate]"),
                            delay,
                            duration,
                            nextSlideItem,
                            prevSlideItem;

                        for (var i = 0; i < prevSlides.length; i++) {
                            prevSlideItem = $(prevSlides[i]);

                            prevSlideItem.removeClass("animated")
                                .removeClass(prevSlideItem.attr("data-caption-animate"))
                                .addClass("not-animated");
                        }


                        var tempFunction = function(nextSlideItem, duration) {
                            return function() {
                                nextSlideItem
                                    .removeClass("not-animated")
                                    .addClass(nextSlideItem.attr("data-caption-animate"))
                                    .addClass("animated");
                                if (duration) {
                                    nextSlideItem.css('animation-duration', duration + 'ms');
                                }
                            };
                        };

                        for (var i = 0; i < nextSlide.length; i++) {
                            nextSlideItem = $(nextSlide[i]);
                            delay = nextSlideItem.attr("data-caption-delay");
                            duration = nextSlideItem.attr('data-caption-duration');

                            if (delay) {
                                setTimeout(tempFunction(nextSlideItem, duration), parseInt(delay, 10));
                            } else {
                                setTimeout(tempFunction(nextSlideItem, duration), parseInt(delay, 0));
                            }
                        }
                    }

                    var s = $("#swiper-slider_208"),
                        pag = s.find(".swiper-pagination"),
                        next = s.find(".swiper-button-next"),
                        prev = s.find(".swiper-button-prev"),
                        bar = s.find(".swiper-scrollbar"),
                        swiperSlide = s.find(".swiper-slide");

                    for (var j = 0; j < swiperSlide.length; j++) {
                        var $this = $(swiperSlide[j]),
                            url;

                        if (url = $this.attr("data-slide-bg")) {
                            $this.css({
                                "background-image": "url(" + url + ")",
                                "background-size": "cover"
                            })
                        }
                    }

                    swiperSlide.end()
                        .find("[data-caption-animate]")
                        .addClass("not-animated")
                        .end();

                    var swiperOptions = {

                        direction: s.attr('data-direction') ? s.attr('data-direction') : "horizontal",
                        effect: s.attr('data-slide-effect') ? s.attr('data-slide-effect') : "slide",
                        speed: s.attr('data-slide-speed') ? s.attr('data-slide-speed') : 600,
                        loop: s.attr('data-loop'),
                        simulateTouch: s.attr('data-simulate-touch') ? s.attr('data-simulate-touch') :
                            false,
                        navigation: {
                            nextEl: next.length ? next.get(0) : null,
                            prevEl: prev.length ? prev.get(0) : null
                        },
                        pagination: {
                            el: pag.length ? pag.get(0) : null,
                            clickable: pag.length ? pag.attr("data-clickable") !== "false" : false,
                            renderBullet: pag.length ? pag.attr("data-index-bullet") === "true" ?
                                function(index, className) {
                                    return '<span class="' + className + '">' + ((index + 1) < 10 ? (
                                        '0' + (index + 1)) : (index + 1)) + '</span>';
                                } : null : null,
                        },
                        scrollbar: {
                            el: bar.length ? bar.get(0) : null,
                            draggable: bar.length ? bar.attr("data-draggable") !== "false" : true,
                            hide: bar.length ? bar.attr("data-draggable") === "false" : false
                        },
                        on: {
                            init: function() {
                                toggleSwiperInnerVideos(this);
                                toggleSwiperCaptionAnimation(this);
                            },

                            transitionStart: function() {
                                toggleSwiperInnerVideos(this);
                            },
                            transitionEnd: function() {
                                toggleSwiperCaptionAnimation(this)
                            }
                        }
                    };

                    mainSlider = new Swiper($("#swiper-slider_208"), swiperOptions);
                }


            });




        })(jQuery);

    </script>



    <!-- You can add Google Analytics here or use T3 Injection feature -->

    @yield('head')
</head>

<body class="body__home option-com_content view-category task- itemid-101">
    <div class="page-loader">
        <div>
            <div class="page-loader-body">
                <div class="loader"><span class="block-1"></span><span class="block-2"></span><span
                        class="block-3"></span><span class="block-4"></span><span class="block-5"></span><span
                        class="block-6"></span><span class="block-7"></span><span class="block-8"></span><span
                        class="block-9"></span><span class="block-10"></span><span class="block-11"></span><span
                        class="block-12"></span><span class="block-13"></span><span class="block-14"></span><span
                        class="block-15"></span><span class="block-16"></span></div>
            </div>
        </div>
    </div>
    <div id="color_preloader">
        <div class="loader_wrapper">
            <div class='uil-spin-css'>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
            </div>
            <p>Loading color scheme</p>
        </div>
    </div>
    <div class="flex-wrapper">
        <div class="t3-wrapper">
            <!-- Need this wrapper for off-canvas menu. Remove if you don't use of-canvas -->
