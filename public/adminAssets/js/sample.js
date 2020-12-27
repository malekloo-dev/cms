function pricelist_app_overlay() {
    function n() {
        if (orerlayhasbeenshown != !0 && $(".overlay-installapp-container").length != 0)try {
            $(".overlay-installapp-container").fadeIn();
            orerlayhasbeenshown = !0;
            var n = new Date;
            n.setTime(n.getTime() + 1728e5);
            document.cookie = "overlayappinstall=1;expires=" + n.toUTCString() + ";path=/"
        } catch (t) {
            return null
        }
    }

    function t() {
        var t = document.body.offsetHeight / 10;
        console.log(t);
        t < 1500 && (t = 1500);
        $(window).scroll(function () {
            if (window.innerHeight + window.scrollY >= t) {
                n();
                return
            }
        })
    }

    if ($("#overlayinstallappcontainer").length !== 0) {
        t();
        $(document).on("click", ".overlay-share .closebtn", function () {
            $(".overlay-installapp-container").fadeOut()
        });
        $(document).on("click", ".overlay-share #butinstallappoverlay", function () {
            $(".overlay-installapp-container").fadeOut()
        });
        $(document).on("click", ".showappinstalloverlay", function (n) {
            n.preventDefault()
        })
    }
}
function loadlazyimages() {
    lazyLoadImage();
    window.addEventListener("DOMContentLoaded", lazyLoadImage);
    window.addEventListener("load", lazyLoadImage);
    window.addEventListener("resize", lazyLoadImage);
    window.addEventListener("scroll", lazyLoadImage)
}
function isElementInViewport(n) {
    var t = n.getBoundingClientRect();
    return t.top >= 0 && t.left >= 0 && t.bottom <= (window.innerHeight || document.documentElement.clientHeight) && t.right <= (window.innerWidth || document.documentElement.clientWidth)
}
function lazyLoadImage() {
    var n = document.querySelectorAll("img[data-lazysrc]");
    [].forEach.call(n, function (n) {
        isElementInViewport(n) && (n.setAttribute("src", n.getAttribute("data-lazysrc")), n.removeAttribute("data-lazysrc"), $("#" + n.id).removeClass("maxwh100"))
    });
    n.length == 0 &&
    (window.removeEventListener("DOMContentLoaded", lazyLoadImage),
        window.removeEventListener("load", lazyLoadImage),
        window.removeEventListener("resize", lazyLoadImage),
        window.removeEventListener("scroll", lazyLoadImage))
}
function flickitypl() {
    $("#divTopBanner").flickity({cellAlign: "right", prevNextButtons: !1, pageDots: !1, autoPlay: 5e3})
}
function MobileMenu() {
    if ($("#hfildcatid").length != 0) {
        var n = $("#hfildcatid").val();
        $('*[data-id="' + n + '"]').show();
        $('*[data-id="' + n + '"]').parent().show();
        $('*[data-id="' + n + '"]').parent().parent().show();
        $('*[data-id="' + n + '"]').parent().parent().parent().show();
        $('*[data-id="' + n + '"]').parent().parent().parent().parent().show();
        $('*[data-id="' + n + '"]').css("color", "red");
        $(".transparent-screen").css("cursor", "pointer");
        $(".arrow").css("cursor", "pointer");
        $("#divmobile_menu_right .mobile-menu-item").each(function () {
            var n = $(this).next(), t = $(this).prev();
            n.is("ul") == !1 && t.hide()
        });
        $(document).on("click", ".mobile-menu-icon-left", function () {
            $(".mobile-menu").fadeOut();
            $(".mobile-menu-left").fadeIn();
            $(".transparent-screen").show()
        });
        $(document).on("click", ".mobile-menu-icon-right", function () {
            $(".mobile-menu").fadeOut();
            $(".mobile-menu-right").fadeIn();
            $(".transparent-screen").show()
        });
        $(document).on("click", ".transparent-screen", function () {
            $(this).hide();
            $(".mobile-menu-left").fadeOut();
            $(".mobile-menu-right").fadeOut()
        });
        $(document).on("click", ".mobile-menu-item", function (n) {
            var i = $(this).next(), t = $(this).prev(), r, u;
            n.target == this && (r = 0, u = 0, u = $(this).data("ln"), i.is("ul") && i.find("li").length == 0 && (r = $(this).data("id"), $(".loadingsubmenu").remove(), $(this).parent().prepend("<i class='loadingsubmenu fa fa-spinner fa-pulse fa-fw'><\/i>"), t.hide(), $.post("/swservice/menulist.ashx", {
                ln: u,
                catid: r,
                showbrand: 0,
                type: 2
            }, function (n) {
                if (t.show(), n.length != 0) {
                    var r = "";
                    for (t = 0; t < n.length; t++) {
                        for (r += "<li>", n[t].child.length > 0 && (r += "<i class='fa fa-angle-down fa-2x arrow' ><\/i>"), r += "<a data-id='" + n[t].id + "' href='" + n[t].link + "' class='mobile-menu-item mnul3'>" + n[t].title + "<\/a>", r += "<ul class='no-display'>", j = 0; j < n[t].child.length; j++)r += "<li>", r += "<a data-id='" + n[t].child[j].id + "' href='" + n[t].child[j].link + "' class='mobile-menu-item mnul4'>" + n[t].child[j].title + "<\/a>", r += "<\/li>";
                        r += "<\/ul>";
                        r += "<\/li>"
                    }
                    i.empty();
                    i.append(r);
                    $(".loadingsubmenu").remove()
                }
            })), i.css("display") === "block" ? (i.slideUp(), t.addClass("fa-angle-down"), t.removeClass("fa-angle-up")) : (i.slideDown(), t.removeClass("fa-angle-down"), t.addClass("fa-angle-up")))
        });
        $(document).on("click", ".arrow", function () {
            $(this).next().click()
        });
        $(".active-menu").parentsUntil("div.mobile-menu", "ul").css("display", "block");
        $(".show-menu").click(function () {
            $(".right-div").css("right", "0");
            $(".transparent-cover").show();
            $(".show-menu").css("left", "-100px")
        });
        $(".transparent-cover").mousedown(function () {
            $(".right-div").css("right", "-250px");
            $(".transparent-cover").hide();
            $(".show-menu").css("left", "20px")
        })
    }
}
function appclose() {
    $(document).on("click", "#appclose", function () {
        var n = new Date;
        n.setTime(n.getTime() + 86e5);
        document.cookie = "appclosednotification=1;expires=" + n.toUTCString();
        $(this).parent().hide()
    })
}
function nextpageonbottomofpage() {
    $(".paging_current_page").is(":visible") != !0 && (window.onscroll = function () {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 1e3) {
            if (moreitemloading === !0)return;
            moreitemloading = !0;
            var n = parseInt($(".paging_current_page").attr("data-val")) + 1;
            $("[data-val='" + n + "']").length == 1 && ($(".paging_current_page").attr("data-val", n), updatelist(!1, !0));
            clearTimeout(showmoretimer);
            showmoretimer = setTimeout(function () {
                moreitemloading = !1
            }, 2e3)
        }
    })
}
function filter_accordion_list() {
    var n, i, t;
    $(".menu-title").is(":visible") == !1 && (n = $("div.filter-wrapper .menu-title"));
    n = $("div.filter-wrapper .menu-title.close-default");
    i = n.next();
    t = n.prev();
    i.hide();
    t.addClass("fa-angle-up");
    t.removeClass("fa-angle-down");
    $(document).on("click", "div.filter-wrapper .menu-title ", function () {
        var n = $(this).next(), t = $(this).prev();
        n.css("display") == "block" ? ($(this).hasClass("noslide") ? n.hide() : n.slideUp(), t.addClass("fa-angle-up"), t.removeClass("fa-angle-down")) : ($(this).hasClass("noslide") ? n.show() : n.slideDown(), t.removeClass("fa-angle-up"), t.addClass("fa-angle-down"))
    })
}
function CreatepricerangeSlider(n, t, i) {
    function u(n) {
        if (n.keyCode == 13) {
            var u = t.val().replace(/[^\d.]/g, ""), f = i.val().replace(/[^\d.]/g, "");
            if (isNaN(u) || isNaN(f)) alert("فقط مقدار های عددی مجاز است"); else return r.noUiSlider.set([u, f]), $("#submitpricefilter").trigger("click"), !1
        }
    }

    var r = document.getElementById(n);
    noUiSlider.create(r, {
        start: [t.data("val"), i.data("val")],
        connect: !0,
        direction: "rtl",
        range: {min: t.data("range"), max: i.data("range")}
    });
    r.noUiSlider.on("update", function (n, r) {
        r ? (i.val(number_format(n[r], 0, ",", ",")), i.attr("data-val", Number(n[r]))) : (t.val(number_format(n[r], 0, ",", ",")), t.attr("data-val", Number(n[r])))
    });
    t.on("keypress", function (n) {
        u(n)
    });
    i.on("keypress", function (n) {
        u(n)
    })
}
function pricelist_category() {
    $(document).on("click", "#showallcat", function () {
        $(this).find("i").hasClass("fa-angle-down") ? ($(".mobile-menu-right").slideDown(), $(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up")) : ($(".mobile-menu-right").slideUp(), $(this).find("i").removeClass("fa-angle-up").addClass("fa-angle-down"))
    })
}
function updateselectedfiltercount() {
    var n = $(".selectedfilter-item").length;
    n == 0 ? $("#selelectedfiltercount").hide() : ($("#selelectedfiltercount").show(), $("#selelectedfiltercount").html(n))
}
function load_filter() {
    if ($(".sort-button").length != 0 && !($("#sort-price").length > 0)) {
        updateselectedfiltercount();
        pricelist_category();
        $(document).on("click", "#mobile-filter-btn", function (n) {
            n.preventDefault();
            $("#divmobile_menu_right").hide();
            $("#divmobile_menu_left").hide();
            $(".dark-screen").hide();
            $("#accordion").show();
            $(".pricelistrightmenu").show();
            $("#mobile-filter-btn").css("left", "-50px");
            $(".full-white").show();
            $(document).on("click", ".full-white", function () {
                $("#accordion").hide();
                $(".pricelistrightmenu").hide();
                $("#mobile-filter-btn").css("left", "25px");
                $(".full-white").hide()
            })
        });
        $("#priec-slider").length > 0 && price_slider();
        $(document).on("click", ".sort-button", function () {
            var n = $(this);
            $(".sort-button").removeClass("sort-active");
            n.addClass("sort-active");
            updatelist(!0, !1)
        });
        $(document).on("click", ".paging_number", function (n) {
            if (!($(".news-thumbnail").length > 0) && (n.preventDefault(), $(this).attr("data-val") != null && !$(this).hasClass("paging_current_page"))) {
                var t = $(this);
                $(".paging_number").removeClass("paging_current_page");
                t.addClass("paging_current_page");
                updatelist(!1, !1)
            }
        });
        $(document).on("click", ".filter-item ,.selectedfilter-item ,#submitpricefilter", function (n) {
            var t, i;
            n.preventDefault();
            t = $(this);
            t.hasClass("selectedfilter-item") && (t = t.find("a"));
            i = t.data("type");
            i == "brand" ? updateui(t, !0) : i == "price" ? (t.attr("data-val", $("#lblprice_min").attr("data-val")), t.attr("data-val2", $("#lblprice_max").attr("data-val")), t.attr("data-maxrange", $("#lblprice_max").attr("data-range")), t.attr("data-minrange", $("#lblprice_min").attr("data-range")), t.attr("data-display", "از " + $("#lblprice_min").val() + " تا " + $("#lblprice_max").val() + " تومان"), updateuiprice(t)) : i == "search" ? ($("#filtersearchinput").val(""), updateuisearchfilter(t)) : updateui(t, !1);
            updatelist(!0, !1)
        });
        $(document).on("keypress", "#filtersearchinput", function (n) {
            if (n.keyCode == 13) {
                var t = $(this);
                return updateuisearchfilter(t), updatelist(!0, !1), !1
            }
        });
        $(document).on("click", "#submitsearchfilter", function () {
            var n = $("#filtersearchinput");
            updateuisearchfilter(n);
            updatelist(!0, !1)
        })
    }
}
function price_slider() {
    if (CreatepricerangeSlider("priec-slider", $("#lblprice_min"), $("#lblprice_max")), $(".selectedfilter [data-type='price']").length != 0) {
        var n = $(".selectedfilter [data-type='price']"), t = document.getElementById("priec-slider"),
            i = n.attr("data-val"), r = n.attr("data-val2");
        t.noUiSlider.set([i, r])
    }
}
function showhideoading(n, t) {
    t == !1 ? n == !0 ? ($(".loading-logo").fadeIn(), $(".dark-screen-not-closable").fadeIn()) : ($(".loading-logo").fadeOut(), $(".dark-screen-not-closable").fadeOut()) : n == !0 ? $(".bottomloading").fadeIn() : $(".bottomloading").fadeOut()
}
function updatelist(n, t) {
    t === !1 && ($("html, body").animate({scrollTop: 0}, "fast"), updateselectedfiltercount());
    var h = window.location.href, r = "", u = 0, f = 0, e = 0, o = "", s = 0, c = $(".sort-active").attr("data-val");
    s = n == !0 ? 1 : $(".paging_current_page").attr("data-val");
    $(".selectedfilter a").each(function () {
        var n = $(this).attr("data-type"), t = $(this).attr("data-val"), i = $(this).attr("data-val2");
        n == "brand" ? e = t : n == "search" ? o = t : n == "price" ? (u = t, f = i) : n == "attfilter" && (r = r + t + ",")
    });
    showhideoading(!0, t);
    $.post("/_Search.ashx", {
        entekhab: "listitemv2",
        currenturl: h,
        attfilters: r,
        minprice: u,
        maxprice: f,
        brandid: e,
        findstr: o,
        pagenum: s,
        sort: c
    }, function (n) {
        if (n == null) {
            showhideoading(!1, t);
            return
        }
        showhideoading(!1, t);
        n.lstsearchresualt.length == 0 ? $("#DivNoItem").show() : $("#DivNoItem").hide();
        var r = "";
        if (n.pagetype.toString() == "pricelist.aspx") {
            for (i = 0; i < n.lstsearchresualt.length; i++)r += "<div class='row itemrow'>", r += "<div class='col-md-2 col-sm-2 col-3 imgContainer'>", r += "<img  src='" + n.lstsearchresualt[i].image + "'>", r += "<\/div>", r += "<div class='col-md-4 col- sm-7  col-6 '>", r += "<h5><a  class='maintitle' href='" + n.lstsearchresualt[i].link + "'>" + n.lstsearchresualt[i].title + "<\/a><\/h5>", n.lstsearchresualt[i].titlefa !== null && (r += "<span><a  class='subtitle' href='" + n.lstsearchresualt[i].link + "'>" + n.lstsearchresualt[i].titlefa + "<\/a><\/span>"), r += "<\/div>", r += "<div class='col-md-2 col-sm-12 col-12 item-price' >", n.lstsearchresualt[i].discountpercent != null && n.lstsearchresualt[i].discountpercent > 0 && (r += "<div  class='item-price-discount-box'><div class='shop-price-discount'>٪" + n.lstsearchresualt[i].discountpercent + "<\/div><del>" + n.lstsearchresualt[i].pprice + "<\/del><\/div>"), r += "<span>" + n.lstsearchresualt[i].price + "<\/span>", r += "<span> تومان <\/span>", r += "<div class='priceupdatetime'>" + n.lstsearchresualt[i].lupdate + "<\/div>", r += "<\/div>", r += "<div class='col-md-1 col-sm-12 col-12 center-align'>", r += "<a  class='btn btn-red w100p' href='" + n.lstsearchresualt[i].link + "'>فروشندگان (" + n.lstsearchresualt[i].offcount + ")<\/a>", r += "<\/div>", r += "<\/div>";
            t == !0 ? $("#mainlist").append(r) : $("#mainlist").html(r)
        } else {
            for (i = 0; i < n.lstsearchresualt.length; i++)r += "<div class='item'>", r += "<div class='item-image'>", r += "<a  title='" + n.lstsearchresualt[i].title + "' href='" + n.lstsearchresualt[i].link + "' ><img src='" + n.lstsearchresualt[i].image + "' alt='" + n.lstsearchresualt[i].title + "'><\/a>", r += "<\/div>", r += " <div class='item-title'>", r += "<a  title='" + n.lstsearchresualt[i].title + "' class='item-title-text' href='" + n.lstsearchresualt[i].link + "'>" + n.lstsearchresualt[i].title + "<\/a>", r += "<\/div>", n.lstsearchresualt[i].offcount == 0 ? r += "<span  class='offer-count inline-block' style='background-color:#bb1212;'>ناموجود<\/span>" : (n.lstsearchresualt[i].discountpercent != null && n.lstsearchresualt[i].discountpercent > 0 && (r += "<div  class='item-price-discount-box'><div class='shop-price-discount'>٪" + n.lstsearchresualt[i].discountpercent + "<\/div><del>" + n.lstsearchresualt[i].pprice + "<\/del><\/div>"), r += "<span  class='item-price'>" + n.lstsearchresualt[i].price + " تومان <\/span>"), r += "<\/div>";
            $("#listdiv").html(r)
        }
        if (r = "", n.lstpagingresualt.length > 0)for (i = 0; i < n.lstpagingresualt.length; i++)r += n.lstpagingresualt[i].isactive == "0" ? "<a class='paging_number paging_hyperlink' data-type='pagenumber' data-val='" + n.lstpagingresualt[i].page_number + "' href='" + n.lstpagingresualt[i].link + "'>" + n.lstpagingresualt[i].page_number + "<\/a>" : "<a class='paging_number paging_current_page' data-type='pagenumber' data-val='" + n.lstpagingresualt[i].page_number + "' >" + n.lstpagingresualt[i].page_number + "<\/a>", n.lstpagingresualt.length > 5 && i == 5 && (r += "<span  class='paging_number cursorDefault'>…<\/span>");
        $(".paging-wrapper").html(r);
        $("#lblCategoryTitle").html(n.pagetitle.toString());
        n.categoryshtml.toString().includes("<li>") ? $("#catdiv").html(n.categoryshtml.toString()) : $("#catselectdiv").hide();
        document.title = n.pagetitle.toString();
        window.history.pushState("string", "Title", n.pageurl.toString());
        window.history.pushState("string", "Title", n.pageurl.toString());
        $('link[rel="canonical"]').attr("href", n.canonical).toString()
    })
}
function load_item_div(n, t, r, u) {
    var e, f;
    t.preventDefault();
    e = window.location.href;
    data = n.attr("data");
    type = n.attr("type");
    data == null && (data = "");
    type == null && (type = "");
    f = $("#mainlist");
    f.css({display: "block"});
    $.post("/_Search.ashx", {
        currenturl: e,
        data: data,
        type: type,
        pageurl: r,
        iteminpage: u,
        hasprice: !1,
        entekhab: "listitem"
    }, function (n) {
        if (n == null) {
            f.css({display: "none"});
            $(".full-white").hide();
            $(".loading-logo").hide();
            return
        }
        var t = "";
        for (t += "<h1>", t += "<\/h1>", t += "<div class='mt10'>", t += "<div class='SortWrapper'>", t += "<div class='sort-field-wrapper'>", t += n.sortlink.sortfild.toLowerCase() != "date" ? "<a class='sort-button sort-by end' type='4' data='date' href='" + n.sortlink.sort_date + "'>تاریخ ثبت<\/a>" : "<a  class='sort-button sort-by active'>تاریخ ثبت<\/a>", t += n.sortlink.sortfild.toLowerCase() != "rate" ? "<a class='sort-button sort-by' type='4' data='rate' href='" + n.sortlink.sort_rate + "'>امتیاز<\/a>" : "<a  class='sort-button sort-by active'>امتیاز<\/a>", t += n.sortlink.sortfild.toLowerCase() != "visit" ? "<a class='sort-button sort-by' type='4' data='visit' href='" + n.sortlink.sort_visit + "'>بازدید<\/a>" : "<a  class='sort-button sort-by active'>بازدید<\/a>", t += n.sortlink.sortfild.toLowerCase() != "sale" ? "<a class='sort-button sort-by' type='4' data='sale' href='" + n.sortlink.sort_sale + "'>فروش<\/a>" : "<a  class='sort-button sort-by active'>فروش<\/a>", t += n.sortlink.sortfild.toLowerCase() != "price" ? "<a class='sort-button sort-by' type='4' data='price' href='" + n.sortlink.sort_price + "'>قیمت<\/a>" : "<a  class='sort-button sort-by active'>قیمت<\/a>", t += "<\/div>", t += "<div class='sort-direction-wrapper'>", n.sortlink.sortdirection.toLowerCase() == "true" ? (t += "<a class='sort-button end sort-direction active'>نزولی<\/a>", t += "<a class='sort-button sort-direction start' type='3' data='false' href='" + n.sortlink.sort_direction + "'>صعودی<\/a>") : (t += "<a class='sort-button end sort-direction' type='3' data='true'  href='" + n.sortlink.sort_direction + "'>نزولی<\/a>", t += "<a class='sort-button sort-direction  active'>صعودی<\/a>"), t += "<\/div>", t += "<\/div>", t += "<\/div>", t += " <div class='clear mb10'><\/div>", i = 0; i < n.lstsearchresualt.length; i++)t += "<div class='item'>", t += "<div class='item-image'>", t += "<a  title='" + n.lstsearchresualt[i].title + "' href='" + n.lstsearchresualt[i].link + "' ><img src='" + n.lstsearchresualt[i].image + "' alt='" + n.lstsearchresualt[i].title + "'><\/a>", t += "<\/div>", t += "<div style='width: 125px; margin: auto;' title='" + n.lstsearchresualt[i].title + "'>", t += "<div class='clear'><\/div>", t += "<\/div>", t += " <div class='item-title'>", t += "<h3 style='font-size: 120%; font-weight: normal;'>", t += "<a  title='" + n.lstsearchresualt[i].title + "' class='item-title-text' href='" + n.lstsearchresualt[i].link + "'>" + n.lstsearchresualt[i].title + "<\/a>", t += "<\/h3>", t += "<\/div>", n.lstsearchresualt[i].offcount == 0 ? t += "<span  class='offer-count inline-block' style='background-color:#bb1212;'>ناموجود<\/span>" : (t += "<span  class='offer-count inline-block' style='background-color:#64a000;'>" + n.lstsearchresualt[i].offcount + " پیشنهاد<\/span>", t += "<span class='item-price'>" + n.lstsearchresualt[i].price + " <\/span>"), t += "<\/div>";
        if (n.lstpagingresualt.length > 0)for (t += "<div class='clear'><\/div>", t += "<div class='paging-wrapper'>", i = 0; i < n.lstpagingresualt.length; i++)t += n.lstpagingresualt[i].isactive == "0" ? "<a class='paging_number paging_hyperlink' type='5' data='" + n.lstpagingresualt[i].page_number + "' href='" + n.lstpagingresualt[i].link + "'>" + n.lstpagingresualt[i].page_number + "<\/a>" : "<a class='paging_number paging_current_page' >" + n.lstpagingresualt[i].page_number + "<\/a>", n.lstpagingresualt.length > 5 && i == 5 && (t += "<span  class='paging_number cursorDefault' style='height: 18px;'>…<\/span>");
        t += "<\/div>";
        f.html(t);
        $(".full-white").hide();
        $(".loading-logo").hide()
    })
}
function updateuisearchfilter(n) {
    var t = n.attr("data-type"), i = n.val(), r = n.val();
    $("#txtSearch").val(r);
    $(".selectedfilter").find("[data-type='" + t + "']").parent().remove();
    i != "" && $(".selectedfilter").append("<div class='selectedfilter-item'>" + r + "<i class='fa fa-times'><\/i> <a data-type='" + t + "' data-val='" + i + "'><\/a> <\/div>");
    update_selected_filter_div_visiblity()
}
function updateuiprice(n) {
    var t = n.attr("data-type"), i = n.attr("data-val").toString(), r = n.attr("data-val2").toString(),
        f = n.attr("data-display").toString(), u;
    $(".selectedfilter a[data-type='" + t + "'][data-val ='" + i + "'][data-val2 ='" + r + "']").length > 0 && n.hasClass("btn") == !1 ? ($(".selectedfilter").find("[data-type='" + t + "']").parent().remove(), u = document.getElementById("priec-slider"), u.noUiSlider.set([n.data("minrange"), n.data("maxrange")])) : ($(".selectedfilter").find("[data-type='" + t + "']").parent().remove(), $(".selectedfilter").append("<div class='selectedfilter-item'>" + f + "<i class='fa fa-times'><\/i> <a data-type='" + t + "' data-val='" + i + "' data-val2='" + r + "'><\/a> <\/div>"));
    update_selected_filter_div_visiblity()
}
function updateui(n, t) {
    var i = n.data("type"), u = n.data("val"), r;
    t == !0 && ($("[data-type='" + i + "'][data-val !='" + u + "']").find("i").removeClass("fa-check-square").addClass("fa-square-o"), $(".selectedfilter").find("[data-type='" + i + "']").parent().remove());
    n.hasClass("filter-item") ? (r = n.find("i"), r.hasClass("fa-square-o") ? (r.removeClass("fa-square-o"), r.addClass("fa-check-square"), $(".selectedfilter").append("<div class='selectedfilter-item'>" + n.text() + "<i class='fa fa-times'><\/i> <a  data-type='" + i + "' data-val='" + u + "'><\/a> <\/div>")) : ($(".selectedfilter").find("[data-type='" + i + "'][data-val='" + u + "']").parent().remove(), r.removeClass("fa-check-square"), r.addClass("fa-square-o"))) : ($(".selectedfilter").find("[data-type='" + i + "'][data-val='" + u + "']").parent().remove(), $("[data-type='" + i + "'][data-val='" + u + "']").find("i").removeClass("fa-check-square").addClass("fa-square-o"));
    update_selected_filter_div_visiblity()
}
function update_selected_filter_div_visiblity() {
    $(".selectedfilter").children().length == 0 ? $(".selectedfilter").hide() : $(".selectedfilter").show()
}
function show_more_price_list() {
    if ($(".price-list-brand").length != 0) {
        $("div.filter-wrapper ul,div.pricelist-filter-wrapper ul,div.price-list-brand ul").each(function () {
            var n = 3, t;
            $(this).parent().hasClass("price-list-brand") && (n = 8);
            t = $(this).find("li").length;
            t > n && ($("li", this).eq(n - 1).nextAll().hide().addClass("toggleable"), $(this).append("<li class='more'><a href='#'>+ نمایش کامل<\/a><\/li>"))
        });
        $("div.filter-wrapper ul,div.pricelist-filter-wrapper ul,div.price-list-brand ul").on("click", ".more", function () {
            $(this).hasClass("less") ? $(this).html("<a href='#'>+ نمایش کامل<\/a>").removeClass("less") : $(this).html("<a href='#'>- نمایش خلاصه<\/a>").addClass("less");
            $(this).siblings("li.toggleable").toggle()
        })
    }
}
function brand_Search() {
    $(document).on("input", "#txtbrandsearch", function () {
        var t = $(this), n = t.val().trim();
        n == "" ? $("a[data-type='brand'].filter-item").parent().show() : ($("a[data-type='brand'].filter-item").parent().show(), $(".filter-item").not("a[title*='" + n + "']").parent().hide())
    })
}
function documentReady_filter() {
    filter_accordion_list();
    load_filter();
    show_more_price_list();
    nextpageonbottomofpage();
    brand_Search()
}
function documentReady_niazsiteproductservice() {
    $("#niazsiteproduct").length > 0 && window.addEventListener("scroll", lazyLoadniaz)
}
function lazyLoadniaz() {
    var n = $(".lazyloadniaz");
    [].forEach.call(n, function (t) {
        isElementInViewport(t) && (n.removeClass("lazyloadniaz"), loadasyncniaz())
    });
    n.length == 0 && window.removeEventListener("scroll", lazyLoadniaz)
}
function loadasyncniaz() {
    $.post("/swservice/niazsiteproductservice.ashx", {itemid: $("#hfitemid").val()}, function (n) {
        var t, r;
        if (n != null && n.length != 0) {
            for (t = "", i = 0; i < n.length; i++)if (n[i].niazitem.length > 0) {
                for (t += "<h3 class='outboxtitle'><i class='fa fa-lg fa-newspaper-o ml10'><\/i> <span>" + n[i].niazsitetitle + "<\/span> <\/h3>", t += "<div  class='mt20 niazmandiha block-niaz boxsegment'>", t += "<div class='flickityitem'>", j = 0; j < n[i].niazitem.length; j++)t += "<div class='niaz-item'>", t += "<a  rel='nofollow' href='" + n[i].niazitem[j].url + "' target='_blank'> <div> <img  onerror=\"this.src='/src/nophoto.svg'\" src='" + n[i].niazitem[j].imgurl + "' > <\/div><div class='niaz-title'> <span >" + n[i].niazitem[j].title + "<\/span> <\/div><span  class='minitext'><\/span><span  class='minitext'>" + n[i].niazitem[j].niazdate + "<\/span><span class='pricespecial'>" + n[i].niazitem[j].price + "<\/span><\/a>", t += "<\/div>";
                t += "<\/div>";
                t += "<\/div>"
            }
            $("#niazsiteproduct").html(t);
            r = $(".flickityitem").flickity({
                cellAlign: "right",
                wrapAround: !0,
                freeScroll: !1,
                prevNextButtons: !0,
                pageDots: !1,
                autoPlay: !1,
                rightToLeft: !0
            });
            r.on("settle.flickity", function () {
                lazyLoadImage()
            })
        }
    })
}
function documentReady_specialshopitem() {
    loadasyncspecialproduct()
}
function loadasyncspecialproduct() {
    $("#specialhead").length <= 0 || $.post("/swservice/specialshopproduct.ashx", {
        catid: $("#hfcatid").val(),
        brandid: $("#hfbrandid").val()
    }, function (n) {
        if ($("#specialloading").hide(), n == null || n.length == 0) {
            $("#specialhead").hide();
            $("#divspacial").hide();
            return
        }
        var t = "";
        for (i = 0; i < n.length; i++)t += "<div class='topspecialitem'>", n[i].discountpercent != "" && (t += "<div class='shop-price-discount item-discountpercent'>" + n[i].discountpercent + "<\/div>"), t += "<div>", t += "<a rel='nofollow' href='" + n[i].link + "' target='_blank'><img  src='" + n[i].imageurl + "' alt='" + n[i].title + "'><\/a>", t += "<\/div>", t += "<div class='specialitemtitle'>", t += "<a  rel='nofollow' href='" + n[i].link + "' target='_blank'>" + n[i].title + "<\/a>", t += "<\/div>", t += "<span class='topspecialprice block'>", n[i].previous_price != "" && (t += "<del>" + n[i].previous_price + "<\/del>"), t += n[i].price, t += "<\/span >", t += "<\/div>";
        $("#divspecialitems").html(t)
    })
}
function documentReady_similaritems() {
    $("#divsimilar").length > 0 && window.addEventListener("scroll", lazyLoadsimilar)
}
function lazyLoadsimilar() {
    var n = $(".lazyloadsimilar");
    [].forEach.call(n, function (t) {
        isElementInViewport(t) && (n.removeClass("lazyloadsimilar"), loadasyncsimilarproduct())
    });
    n.length == 0 && window.removeEventListener("scroll", lazyLoadniaz)
}
function loadasyncsimilarproduct() {
    $("#divsimilar").length <= 0 || $.post("/swservice/similarproduct.ashx", {itemid: $("#hfdItemID").val()}, function (n) {
        if (n == null || n.length == 0) {
            $("#divsimilar").hide();
            $("#hlksimilar").hide();
            $("#similarloading").hide();
            return
        }
        $("#similarloading").hide();
        var t = "";
        for (t += "<div class='topitems'>", i = 0; i < n.length; i++)t += "<div class='product-block'>", t += "<div>", n[i].discountpercent != "" && (t += "<div  class='shop-price-discount item-discountpercent'>" + n[i].discountpercent + "<\/div>"), t += "<a href='" + n[i].link + "'><img src='" + n[i].imageurl + "' alt='" + n[i].title + "' /><\/a>", t += "<\/div>", t += "<div class='pr5 pl5'>", t += "<a title='" + n[i].title + "' href='" + n[i].link + "'>" + n[i].title + "<\/a>", t += "<\/div>", t += "<span  class='price block'>", n[i].discountpercent != "" && (t += "<del>" + n[i].previous_price + "<\/del>"), t += n[i].price, t += "<\/div>";
        t += "<\/div>";
        $("#divsimilar").html(t);
        flickity()
    })
}
var orerlayhasbeenshown, moreitemloading, showmoretimer;
!function (n, t) {
    "use strict";
    "object" == typeof module && "object" == typeof module.exports ? module.exports = n.document ? t(n, !0) : function (n) {
        if (!n.document)throw new Error("jQuery requires a window with a document");
        return t(n)
    } : t(n)
}("undefined" != typeof window ? window : this, function (n, t) {
    "use strict";
    function hr(n, t, i) {
        var r, u = (t = t || f).createElement("script");
        if (u.text = n, i)for (r in df)i[r] && (u[r] = i[r]);
        t.head.appendChild(u).parentNode.removeChild(u)
    }

    function it(n) {
        return null == n ? n + "" : "object" == typeof n || "function" == typeof n ? bt[or.call(n)] || "object" : typeof n
    }

    function hi(n) {
        var t = !!n && "length" in n && n.length, i = it(n);
        return !u(n) && !tt(n) && ("array" === i || 0 === t || "number" == typeof t && t > 0 && t - 1 in n)
    }

    function v(n, t) {
        return n.nodeName && n.nodeName.toLowerCase() === t.toLowerCase()
    }

    function li(n, t, r) {
        return u(t) ? i.grep(n, function (n, i) {
            return !!t.call(n, i, n) !== r
        }) : t.nodeType ? i.grep(n, function (n) {
            return n === t !== r
        }) : "string" != typeof t ? i.grep(n, function (n) {
            return wt.call(t, n) > -1 !== r
        }) : i.filter(t, n, r)
    }

    function wr(n, t) {
        while ((n = n[t]) && 1 !== n.nodeType);
        return n
    }

    function ne(n) {
        var t = {};
        return i.each(n.match(l) || [], function (n, i) {
            t[i] = !0
        }), t
    }

    function ut(n) {
        return n
    }

    function dt(n) {
        throw n;
    }

    function br(n, t, i, r) {
        var f;
        try {
            n && u(f = n.promise) ? f.call(n).done(t).fail(i) : n && u(f = n.then) ? f.call(n, t, i) : t.apply(void 0, [n].slice(r))
        } catch (n) {
            i.apply(void 0, [n])
        }
    }

    function ni() {
        f.removeEventListener("DOMContentLoaded", ni);
        n.removeEventListener("load", ni);
        i.ready()
    }

    function re(n, t) {
        return t.toUpperCase()
    }

    function y(n) {
        return n.replace(te, "ms-").replace(ie, re)
    }

    function at() {
        this.expando = i.expando + at.uid++
    }

    function ee(n) {
        return "true" === n || "false" !== n && ("null" === n ? null : n === +n + "" ? +n : ue.test(n) ? JSON.parse(n) : n)
    }

    function dr(n, t, i) {
        var r;
        if (void 0 === i && 1 === n.nodeType)if (r = "data-" + t.replace(fe, "-$&").toLowerCase(), "string" == typeof(i = n.getAttribute(r))) {
            try {
                i = ee(i)
            } catch (n) {
            }
            o.set(n, t, i)
        } else i = void 0;
        return i
    }

    function tu(n, t, r, u) {
        var s, h, c = 20, l = u ? function () {
                return u.cur()
            } : function () {
                return i.css(n, t, "")
            }, o = l(), e = r && r[3] || (i.cssNumber[t] ? "" : "px"),
            f = (i.cssNumber[t] || "px" !== e && +o) && vt.exec(i.css(n, t));
        if (f && f[3] !== e) {
            for (o /= 2, e = e || f[3], f = +o || 1; c--;)i.style(n, t, f + e), (1 - h) * (1 - (h = l() / o || .5)) <= 0 && (c = 0), f /= h;
            f *= 2;
            i.style(n, t, f + e);
            r = r || []
        }
        return r && (f = +f || +o || 0, s = r[1] ? f + (r[1] + 1) * r[2] : +r[2], u && (u.unit = e, u.start = f, u.end = s)), s
    }

    function oe(n) {
        var r, f = n.ownerDocument, u = n.nodeName, t = ai[u];
        return t || (r = f.body.appendChild(f.createElement(u)), t = i.css(r, "display"), r.parentNode.removeChild(r), "none" === t && (t = "block"), ai[u] = t, t)
    }

    function ft(n, t) {
        for (var e, u, f = [], i = 0, o = n.length; i < o; i++)(u = n[i]).style && (e = u.style.display, t ? ("none" === e && (f[i] = r.get(u, "display") || null, f[i] || (u.style.display = "")), "" === u.style.display && ti(u) && (f[i] = oe(u))) : "none" !== e && (f[i] = "none", r.set(u, "display", e)));
        for (i = 0; i < o; i++)null != f[i] && (n[i].style.display = f[i]);
        return n
    }

    function s(n, t) {
        var r;
        return r = "undefined" != typeof n.getElementsByTagName ? n.getElementsByTagName(t || "*") : "undefined" != typeof n.querySelectorAll ? n.querySelectorAll(t || "*") : [], void 0 === t || t && v(n, t) ? i.merge([n], r) : r
    }

    function vi(n, t) {
        for (var i = 0, u = n.length; i < u; i++)r.set(n[i], "globalEval", !t || r.get(t[i], "globalEval"))
    }

    function eu(n, t, r, u, f) {
        for (var e, o, p, a, w, v, h = t.createDocumentFragment(), y = [], l = 0, b = n.length; l < b; l++)if ((e = n[l]) || 0 === e)if ("object" === it(e)) i.merge(y, e.nodeType ? [e] : e); else if (fu.test(e)) {
            for (o = o || h.appendChild(t.createElement("div")), p = (ru.exec(e) || ["", ""])[1].toLowerCase(), a = c[p] || c._default, o.innerHTML = a[1] + i.htmlPrefilter(e) + a[2], v = a[0]; v--;)o = o.lastChild;
            i.merge(y, o.childNodes);
            (o = h.firstChild).textContent = ""
        } else y.push(t.createTextNode(e));
        for (h.textContent = "", l = 0; e = y[l++];)if (u && i.inArray(e, u) > -1) f && f.push(e); else if (w = i.contains(e.ownerDocument, e), o = s(h.appendChild(e), "script"), w && vi(o), r)for (v = 0; e = o[v++];)uu.test(e.type || "") && r.push(e);
        return h
    }

    function ri() {
        return !0
    }

    function et() {
        return !1
    }

    function su() {
        try {
            return f.activeElement
        } catch (n) {
        }
    }

    function yi(n, t, r, u, f, e) {
        var o, s;
        if ("object" == typeof t) {
            "string" != typeof r && (u = u || r, r = void 0);
            for (s in t)yi(n, s, r, u, t[s], e);
            return n
        }
        if (null == u && null == f ? (f = r, u = r = void 0) : null == f && ("string" == typeof r ? (f = u, u = void 0) : (f = u, u = r, r = void 0)), !1 === f) f = et; else if (!f)return n;
        return 1 === e && (o = f, (f = function (n) {
            return i().off(n), o.apply(this, arguments)
        }).guid = o.guid || (o.guid = i.guid++)), n.each(function () {
            i.event.add(this, t, f, u, r)
        })
    }

    function hu(n, t) {
        return v(n, "table") && v(11 !== t.nodeType ? t : t.firstChild, "tr") ? i(n).children("tbody")[0] || n : n
    }

    function ye(n) {
        return n.type = (null !== n.getAttribute("type")) + "/" + n.type, n
    }

    function pe(n) {
        return "true/" === (n.type || "").slice(0, 5) ? n.type = n.type.slice(5) : n.removeAttribute("type"), n
    }

    function cu(n, t) {
        var u, c, f, s, h, l, a, e;
        if (1 === t.nodeType) {
            if (r.hasData(n) && (s = r.access(n), h = r.set(t, s), e = s.events)) {
                delete h.handle;
                h.events = {};
                for (f in e)for (u = 0, c = e[f].length; u < c; u++)i.event.add(t, f, e[f][u])
            }
            o.hasData(n) && (l = o.access(n), a = i.extend({}, l), o.set(t, a))
        }
    }

    function we(n, t) {
        var i = t.nodeName.toLowerCase();
        "input" === i && iu.test(n.type) ? t.checked = n.checked : "input" !== i && "textarea" !== i || (t.defaultValue = n.defaultValue)
    }

    function ot(n, t, f, o) {
        t = er.apply([], t);
        var l, w, a, v, h, b, c = 0, y = n.length, d = y - 1, p = t[0], k = u(p);
        if (k || y > 1 && "string" == typeof p && !e.checkClone && ae.test(p))return n.each(function (i) {
            var r = n.eq(i);
            k && (t[0] = p.call(this, i, r.html()));
            ot(r, t, f, o)
        });
        if (y && (l = eu(t, n[0].ownerDocument, !1, n, o), w = l.firstChild, 1 === l.childNodes.length && (l = w), w || o)) {
            for (v = (a = i.map(s(l, "script"), ye)).length; c < y; c++)h = l, c !== d && (h = i.clone(h, !0, !0), v && i.merge(a, s(h, "script"))), f.call(n[c], h, c);
            if (v)for (b = a[a.length - 1].ownerDocument, i.map(a, pe), c = 0; c < v; c++)h = a[c], uu.test(h.type || "") && !r.access(h, "globalEval") && i.contains(b, h) && (h.src && "module" !== (h.type || "").toLowerCase() ? i._evalUrl && i._evalUrl(h.src) : hr(h.textContent.replace(ve, ""), b, h))
        }
        return n
    }

    function lu(n, t, r) {
        for (var u, e = t ? i.filter(t, n) : n, f = 0; null != (u = e[f]); f++)r || 1 !== u.nodeType || i.cleanData(s(u)), u.parentNode && (r && i.contains(u.ownerDocument, u) && vi(s(u, "script")), u.parentNode.removeChild(u));
        return n
    }

    function yt(n, t, r) {
        var o, s, h, f, u = n.style;
        return (r = r || ui(n)) && ("" !== (f = r.getPropertyValue(t) || r[t]) || i.contains(n.ownerDocument, n) || (f = i.style(n, t)), !e.pixelBoxStyles() && pi.test(f) && be.test(t) && (o = u.width, s = u.minWidth, h = u.maxWidth, u.minWidth = u.maxWidth = u.width = f, f = r.width, u.width = o, u.minWidth = s, u.maxWidth = h)), void 0 !== f ? f + "" : f
    }

    function au(n, t) {
        return {
            get: function () {
                if (!n())return (this.get = t).apply(this, arguments);
                delete this.get
            }
        }
    }

    function ge(n) {
        if (n in wu)return n;
        for (var i = n[0].toUpperCase() + n.slice(1), t = pu.length; t--;)if ((n = pu[t] + i) in wu)return n
    }

    function bu(n) {
        var t = i.cssProps[n];
        return t || (t = i.cssProps[n] = ge(n) || n), t
    }

    function ku(n, t, i) {
        var r = vt.exec(t);
        return r ? Math.max(0, r[2] - (i || 0)) + (r[3] || "px") : t
    }

    function wi(n, t, r, u, f, e) {
        var o = "width" === t ? 1 : 0, h = 0, s = 0;
        if (r === (u ? "border" : "content"))return 0;
        for (; o < 4; o += 2)"margin" === r && (s += i.css(n, r + w[o], !0, f)), u ? ("content" === r && (s -= i.css(n, "padding" + w[o], !0, f)), "margin" !== r && (s -= i.css(n, "border" + w[o] + "Width", !0, f))) : (s += i.css(n, "padding" + w[o], !0, f), "padding" !== r ? s += i.css(n, "border" + w[o] + "Width", !0, f) : h += i.css(n, "border" + w[o] + "Width", !0, f));
        return !u && e >= 0 && (s += Math.max(0, Math.ceil(n["offset" + t[0].toUpperCase() + t.slice(1)] - e - s - h - .5))), s
    }

    function du(n, t, r) {
        var f = ui(n), u = yt(n, t, f), s = "border-box" === i.css(n, "boxSizing", !1, f), o = s;
        if (pi.test(u)) {
            if (!r)return u;
            u = "auto"
        }
        return o = o && (e.boxSizingReliable() || u === n.style[t]), ("auto" === u || !parseFloat(u) && "inline" === i.css(n, "display", !1, f)) && (u = n["offset" + t[0].toUpperCase() + t.slice(1)], o = !0), (u = parseFloat(u) || 0) + wi(n, t, r || (s ? "border" : "content"), o, f, u) + "px"
    }

    function h(n, t, i, r, u) {
        return new h.prototype.init(n, t, i, r, u)
    }

    function bi() {
        fi && (!1 === f.hidden && n.requestAnimationFrame ? n.requestAnimationFrame(bi) : n.setTimeout(bi, i.fx.interval), i.fx.tick())
    }

    function tf() {
        return n.setTimeout(function () {
            st = void 0
        }), st = Date.now()
    }

    function ei(n, t) {
        var u, r = 0, i = {height: n};
        for (t = t ? 1 : 0; r < 4; r += 2 - t)i["margin" + (u = w[r])] = i["padding" + u] = n;
        return t && (i.opacity = i.width = n), i
    }

    function rf(n, t, i) {
        for (var u, f = (a.tweeners[t] || []).concat(a.tweeners["*"]), r = 0, e = f.length; r < e; r++)if (u = f[r].call(i, t, n))return u
    }

    function no(n, t, u) {
        var f, y, w, c, b, h, o, l, k = "width" in t || "height" in t, v = this, p = {}, s = n.style,
            a = n.nodeType && ti(n), e = r.get(n, "fxshow");
        u.queue || (null == (c = i._queueHooks(n, "fx")).unqueued && (c.unqueued = 0, b = c.empty.fire, c.empty.fire = function () {
            c.unqueued || b()
        }), c.unqueued++, v.always(function () {
            v.always(function () {
                c.unqueued--;
                i.queue(n, "fx").length || c.empty.fire()
            })
        }));
        for (f in t)if (y = t[f], gu.test(y)) {
            if (delete t[f], w = w || "toggle" === y, y === (a ? "hide" : "show")) {
                if ("show" !== y || !e || void 0 === e[f])continue;
                a = !0
            }
            p[f] = e && e[f] || i.style(n, f)
        }
        if ((h = !i.isEmptyObject(t)) || !i.isEmptyObject(p)) {
            k && 1 === n.nodeType && (u.overflow = [s.overflow, s.overflowX, s.overflowY], null == (o = e && e.display) && (o = r.get(n, "display")), "none" === (l = i.css(n, "display")) && (o ? l = o : (ft([n], !0), o = n.style.display || o, l = i.css(n, "display"), ft([n]))), ("inline" === l || "inline-block" === l && null != o) && "none" === i.css(n, "float") && (h || (v.done(function () {
                s.display = o
            }), null == o && (l = s.display, o = "none" === l ? "" : l)), s.display = "inline-block"));
            u.overflow && (s.overflow = "hidden", v.always(function () {
                s.overflow = u.overflow[0];
                s.overflowX = u.overflow[1];
                s.overflowY = u.overflow[2]
            }));
            h = !1;
            for (f in p)h || (e ? "hidden" in e && (a = e.hidden) : e = r.access(n, "fxshow", {display: o}), w && (e.hidden = !a), a && ft([n], !0), v.done(function () {
                a || ft([n]);
                r.remove(n, "fxshow");
                for (f in p)i.style(n, f, p[f])
            })), h = rf(a ? e[f] : 0, f, v), f in e || (e[f] = h.start, a && (h.end = h.start, h.start = 0))
        }
    }

    function to(n, t) {
        var r, f, e, u, o;
        for (r in n)if (f = y(r), e = t[f], u = n[r], Array.isArray(u) && (e = u[1], u = n[r] = u[0]), r !== f && (n[f] = u, delete n[r]), (o = i.cssHooks[f]) && "expand" in o) {
            u = o.expand(u);
            delete n[f];
            for (r in u)r in n || (n[r] = u[r], t[r] = e)
        } else t[f] = e
    }

    function a(n, t, r) {
        var o, s, h = 0, v = a.prefilters.length, e = i.Deferred().always(function () {
            delete l.elem
        }), l = function () {
            if (s)return !1;
            for (var o = st || tf(), t = Math.max(0, f.startTime + f.duration - o), i = 1 - (t / f.duration || 0), r = 0, u = f.tweens.length; r < u; r++)f.tweens[r].run(i);
            return e.notifyWith(n, [f, i, t]), i < 1 && u ? t : (u || e.notifyWith(n, [f, 1, 0]), e.resolveWith(n, [f]), !1)
        }, f = e.promise({
            elem: n,
            props: i.extend({}, t),
            opts: i.extend(!0, {specialEasing: {}, easing: i.easing._default}, r),
            originalProperties: t,
            originalOptions: r,
            startTime: st || tf(),
            duration: r.duration,
            tweens: [],
            createTween: function (t, r) {
                var u = i.Tween(n, f.opts, t, r, f.opts.specialEasing[t] || f.opts.easing);
                return f.tweens.push(u), u
            },
            stop: function (t) {
                var i = 0, r = t ? f.tweens.length : 0;
                if (s)return this;
                for (s = !0; i < r; i++)f.tweens[i].run(1);
                return t ? (e.notifyWith(n, [f, 1, 0]), e.resolveWith(n, [f, t])) : e.rejectWith(n, [f, t]), this
            }
        }), c = f.props;
        for (to(c, f.opts.specialEasing); h < v; h++)if (o = a.prefilters[h].call(f, n, c, f.opts))return u(o.stop) && (i._queueHooks(f.elem, f.opts.queue).stop = o.stop.bind(o)), o;
        return i.map(c, rf, f), u(f.opts.start) && f.opts.start.call(n, f), f.progress(f.opts.progress).done(f.opts.done, f.opts.complete).fail(f.opts.fail).always(f.opts.always), i.fx.timer(i.extend(l, {
            elem: n,
            anim: f,
            queue: f.opts.queue
        })), f
    }

    function g(n) {
        return (n.match(l) || []).join(" ")
    }

    function nt(n) {
        return n.getAttribute && n.getAttribute("class") || ""
    }

    function ki(n) {
        return Array.isArray(n) ? n : "string" == typeof n ? n.match(l) || [] : []
    }

    function tr(n, t, r, u) {
        var f;
        if (Array.isArray(t)) i.each(t, function (t, i) {
            r || io.test(n) ? u(n, i) : tr(n + "[" + ("object" == typeof i && null != i ? t : "") + "]", i, r, u)
        }); else if (r || "object" !== it(t)) u(n, t); else for (f in t)tr(n + "[" + f + "]", t[f], r, u)
    }

    function af(n) {
        return function (t, i) {
            "string" != typeof t && (i = t, t = "*");
            var r, f = 0, e = t.toLowerCase().match(l) || [];
            if (u(i))while (r = e[f++])"+" === r[0] ? (r = r.slice(1) || "*", (n[r] = n[r] || []).unshift(i)) : (n[r] = n[r] || []).push(i)
        }
    }

    function vf(n, t, r, u) {
        function e(s) {
            var h;
            return f[s] = !0, i.each(n[s] || [], function (n, i) {
                var s = i(t, r, u);
                return "string" != typeof s || o || f[s] ? o ? !(h = s) : void 0 : (t.dataTypes.unshift(s), e(s), !1)
            }), h
        }

        var f = {}, o = n === ir;
        return e(t.dataTypes[0]) || !f["*"] && e("*")
    }

    function ur(n, t) {
        var r, u, f = i.ajaxSettings.flatOptions || {};
        for (r in t)void 0 !== t[r] && ((f[r] ? n : u || (u = {}))[r] = t[r]);
        return u && i.extend(!0, n, u), n
    }

    function lo(n, t, i) {
        for (var e, u, f, o, s = n.contents, r = n.dataTypes; "*" === r[0];)r.shift(), void 0 === e && (e = n.mimeType || t.getResponseHeader("Content-Type"));
        if (e)for (u in s)if (s[u] && s[u].test(e)) {
            r.unshift(u);
            break
        }
        if (r[0] in i) f = r[0]; else {
            for (u in i) {
                if (!r[0] || n.converters[u + " " + r[0]]) {
                    f = u;
                    break
                }
                o || (o = u)
            }
            f = f || o
        }
        if (f)return f !== r[0] && r.unshift(f), i[f]
    }

    function ao(n, t, i, r) {
        var h, u, f, s, e, o = {}, c = n.dataTypes.slice();
        if (c[1])for (f in n.converters)o[f.toLowerCase()] = n.converters[f];
        for (u = c.shift(); u;)if (n.responseFields[u] && (i[n.responseFields[u]] = t), !e && r && n.dataFilter && (t = n.dataFilter(t, n.dataType)), e = u, u = c.shift())if ("*" === u) u = e; else if ("*" !== e && e !== u) {
            if (!(f = o[e + " " + u] || o["* " + u]))for (h in o)if ((s = h.split(" "))[1] === u && (f = o[e + " " + s[0]] || o["* " + s[0]])) {
                !0 === f ? f = o[h] : !0 !== o[h] && (u = s[0], c.unshift(s[1]));
                break
            }
            if (!0 !== f)if (f && n.throws) t = f(t); else try {
                t = f(t)
            } catch (n) {
                return {state: "parsererror", error: f ? n : "No conversion from " + e + " to " + u}
            }
        }
        return {state: "success", data: t}
    }

    var k = [], f = n.document, bf = Object.getPrototypeOf, d = k.slice, er = k.concat, si = k.push, wt = k.indexOf,
        bt = {}, or = bt.toString, kt = bt.hasOwnProperty, sr = kt.toString, kf = sr.call(Object), e = {},
        u = function (n) {
            return "function" == typeof n && "number" != typeof n.nodeType
        }, tt = function (n) {
            return null != n && n === n.window
        }, df = {type: !0, src: !0, noModule: !0}, i = function (n, t) {
            return new i.fn.init(n, t)
        }, gf = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, b, ci, ar, vr, yr, pr, l, kr, gt, lt, ai, fu, st, fi, gu, nf, uf, ht,
        ff, ef, of, di, gi, yf, ct, fr, oi, pf, wf;
    i.fn = i.prototype = {
        jquery: "3.3.1", constructor: i, length: 0, toArray: function () {
            return d.call(this)
        }, get: function (n) {
            return null == n ? d.call(this) : n < 0 ? this[n + this.length] : this[n]
        }, pushStack: function (n) {
            var t = i.merge(this.constructor(), n);
            return t.prevObject = this, t
        }, each: function (n) {
            return i.each(this, n)
        }, map: function (n) {
            return this.pushStack(i.map(this, function (t, i) {
                return n.call(t, i, t)
            }))
        }, slice: function () {
            return this.pushStack(d.apply(this, arguments))
        }, first: function () {
            return this.eq(0)
        }, last: function () {
            return this.eq(-1)
        }, eq: function (n) {
            var i = this.length, t = +n + (n < 0 ? i : 0);
            return this.pushStack(t >= 0 && t < i ? [this[t]] : [])
        }, end: function () {
            return this.prevObject || this.constructor()
        }, push: si, sort: k.sort, splice: k.splice
    };
    i.extend = i.fn.extend = function () {
        var o, e, t, r, s, h, n = arguments[0] || {}, f = 1, l = arguments.length, c = !1;
        for ("boolean" == typeof n && (c = n, n = arguments[f] || {}, f++), "object" == typeof n || u(n) || (n = {}), f === l && (n = this, f--); f < l; f++)if (null != (o = arguments[f]))for (e in o)t = n[e], n !== (r = o[e]) && (c && r && (i.isPlainObject(r) || (s = Array.isArray(r))) ? (s ? (s = !1, h = t && Array.isArray(t) ? t : []) : h = t && i.isPlainObject(t) ? t : {}, n[e] = i.extend(c, h, r)) : void 0 !== r && (n[e] = r));
        return n
    };
    i.extend({
        expando: "jQuery" + ("3.3.1" + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (n) {
            throw new Error(n);
        }, noop: function () {
        }, isPlainObject: function (n) {
            var t, i;
            return !(!n || "[object Object]" !== or.call(n)) && (!(t = bf(n)) || "function" == typeof(i = kt.call(t, "constructor") && t.constructor) && sr.call(i) === kf)
        }, isEmptyObject: function (n) {
            var t;
            for (t in n)return !1;
            return !0
        }, globalEval: function (n) {
            hr(n)
        }, each: function (n, t) {
            var r, i = 0;
            if (hi(n)) {
                for (r = n.length; i < r; i++)if (!1 === t.call(n[i], i, n[i]))break
            } else for (i in n)if (!1 === t.call(n[i], i, n[i]))break;
            return n
        }, trim: function (n) {
            return null == n ? "" : (n + "").replace(gf, "")
        }, makeArray: function (n, t) {
            var r = t || [];
            return null != n && (hi(Object(n)) ? i.merge(r, "string" == typeof n ? [n] : n) : si.call(r, n)), r
        }, inArray: function (n, t, i) {
            return null == t ? -1 : wt.call(t, n, i)
        }, merge: function (n, t) {
            for (var u = +t.length, i = 0, r = n.length; i < u; i++)n[r++] = t[i];
            return n.length = r, n
        }, grep: function (n, t, i) {
            for (var f, u = [], r = 0, e = n.length, o = !i; r < e; r++)(f = !t(n[r], r)) !== o && u.push(n[r]);
            return u
        }, map: function (n, t, i) {
            var e, u, r = 0, f = [];
            if (hi(n))for (e = n.length; r < e; r++)null != (u = t(n[r], r, i)) && f.push(u); else for (r in n)null != (u = t(n[r], r, i)) && f.push(u);
            return er.apply([], f)
        }, guid: 1, support: e
    });
    "function" == typeof Symbol && (i.fn[Symbol.iterator] = k[Symbol.iterator]);
    i.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (n, t) {
        bt["[object " + t + "]"] = t.toLowerCase()
    });
    b = function (n) {
        function u(n, t, r, u) {
            var s, p, l, a, w, d, g, y = t && t.ownerDocument, v = t ? t.nodeType : 9;
            if (r = r || [], "string" != typeof n || !n || 1 !== v && 9 !== v && 11 !== v)return r;
            if (!u && ((t ? t.ownerDocument || t : c) !== i && b(t), t = t || i, h)) {
                if (11 !== v && (w = cr.exec(n)))if (s = w[1]) {
                    if (9 === v) {
                        if (!(l = t.getElementById(s)))return r;
                        if (l.id === s)return r.push(l), r
                    } else if (y && (l = y.getElementById(s)) && et(t, l) && l.id === s)return r.push(l), r
                } else {
                    if (w[2])return k.apply(r, t.getElementsByTagName(n)), r;
                    if ((s = w[3]) && e.getElementsByClassName && t.getElementsByClassName)return k.apply(r, t.getElementsByClassName(s)), r
                }
                if (e.qsa && !lt[n + " "] && (!o || !o.test(n))) {
                    if (1 !== v) y = t, g = n; else if ("object" !== t.nodeName.toLowerCase()) {
                        for ((a = t.getAttribute("id")) ? a = a.replace(vi, yi) : t.setAttribute("id", a = f), p = (d = ft(n)).length; p--;)d[p] = "#" + a + " " + yt(d[p]);
                        g = d.join(",");
                        y = ni.test(n) && ri(t.parentNode) || t
                    }
                    if (g)try {
                        return k.apply(r, y.querySelectorAll(g)), r
                    } catch (n) {
                    } finally {
                        a === f && t.removeAttribute("id")
                    }
                }
            }
            return si(n.replace(at, "$1"), t, r, u)
        }

        function ti() {
            function n(r, u) {
                return i.push(r + " ") > t.cacheLength && delete n[i.shift()], n[r + " "] = u
            }

            var i = [];
            return n
        }

        function l(n) {
            return n[f] = !0, n
        }

        function a(n) {
            var t = i.createElement("fieldset");
            try {
                return !!n(t)
            } catch (n) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t);
                t = null
            }
        }

        function ii(n, i) {
            for (var r = n.split("|"), u = r.length; u--;)t.attrHandle[r[u]] = i
        }

        function wi(n, t) {
            var i = t && n, r = i && 1 === n.nodeType && 1 === t.nodeType && n.sourceIndex - t.sourceIndex;
            if (r)return r;
            if (i)while (i = i.nextSibling)if (i === t)return -1;
            return n ? 1 : -1
        }

        function ar(n) {
            return function (t) {
                return "input" === t.nodeName.toLowerCase() && t.type === n
            }
        }

        function vr(n) {
            return function (t) {
                var i = t.nodeName.toLowerCase();
                return ("input" === i || "button" === i) && t.type === n
            }
        }

        function bi(n) {
            return function (t) {
                return "form" in t ? t.parentNode && !1 === t.disabled ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === n : t.disabled === n : t.isDisabled === n || t.isDisabled !== !n && lr(t) === n : t.disabled === n : "label" in t && t.disabled === n
            }
        }

        function it(n) {
            return l(function (t) {
                return t = +t, l(function (i, r) {
                    for (var u, f = n([], i.length, t), e = f.length; e--;)i[u = f[e]] && (i[u] = !(r[u] = i[u]))
                })
            })
        }

        function ri(n) {
            return n && "undefined" != typeof n.getElementsByTagName && n
        }

        function ki() {
        }

        function yt(n) {
            for (var t = 0, r = n.length, i = ""; t < r; t++)i += n[t].value;
            return i
        }

        function pt(n, t, i) {
            var r = t.dir, u = t.next, e = u || r, o = i && "parentNode" === e, s = di++;
            return t.first ? function (t, i, u) {
                while (t = t[r])if (1 === t.nodeType || o)return n(t, i, u);
                return !1
            } : function (t, i, h) {
                var c, l, a, y = [v, s];
                if (h) {
                    while (t = t[r])if ((1 === t.nodeType || o) && n(t, i, h))return !0
                } else while (t = t[r])if (1 === t.nodeType || o)if (a = t[f] || (t[f] = {}), l = a[t.uniqueID] || (a[t.uniqueID] = {}), u && u === t.nodeName.toLowerCase()) t = t[r] || t; else {
                    if ((c = l[e]) && c[0] === v && c[1] === s)return y[2] = c[2];
                    if (l[e] = y, y[2] = n(t, i, h))return !0
                }
                return !1
            }
        }

        function ui(n) {
            return n.length > 1 ? function (t, i, r) {
                for (var u = n.length; u--;)if (!n[u](t, i, r))return !1;
                return !0
            } : n[0]
        }

        function yr(n, t, i) {
            for (var r = 0, f = t.length; r < f; r++)u(n, t[r], i);
            return i
        }

        function wt(n, t, i, r, u) {
            for (var e, o = [], f = 0, s = n.length, h = null != t; f < s; f++)(e = n[f]) && (i && !i(e, r, u) || (o.push(e), h && t.push(f)));
            return o
        }

        function fi(n, t, i, r, u, e) {
            return r && !r[f] && (r = fi(r)), u && !u[f] && (u = fi(u, e)), l(function (f, e, o, s) {
                var l, c, a, p = [], y = [], w = e.length, b = f || yr(t || "*", o.nodeType ? [o] : o, []),
                    v = !n || !f && t ? b : wt(b, p, n, o, s), h = i ? u || (f ? n : w || r) ? [] : e : v;
                if (i && i(v, h, o, s), r)for (l = wt(h, y), r(l, [], o, s), c = l.length; c--;)(a = l[c]) && (h[y[c]] = !(v[y[c]] = a));
                if (f) {
                    if (u || n) {
                        if (u) {
                            for (l = [], c = h.length; c--;)(a = h[c]) && l.push(v[c] = a);
                            u(null, h = [], l, s)
                        }
                        for (c = h.length; c--;)(a = h[c]) && (l = u ? nt(f, a) : p[c]) > -1 && (f[l] = !(e[l] = a))
                    }
                } else h = wt(h === e ? h.splice(w, h.length) : h), u ? u(null, e, h, s) : k.apply(e, h)
            })
        }

        function ei(n) {
            for (var o, u, r, s = n.length, h = t.relative[n[0].type], c = h || t.relative[" "], i = h ? 1 : 0, l = pt(function (n) {
                return n === o
            }, c, !0), a = pt(function (n) {
                return nt(o, n) > -1
            }, c, !0), e = [function (n, t, i) {
                var r = !h && (i || t !== ht) || ((o = t).nodeType ? l(n, t, i) : a(n, t, i));
                return o = null, r
            }]; i < s; i++)if (u = t.relative[n[i].type]) e = [pt(ui(e), u)]; else {
                if ((u = t.filter[n[i].type].apply(null, n[i].matches))[f]) {
                    for (r = ++i; r < s; r++)if (t.relative[n[r].type])break;
                    return fi(i > 1 && ui(e), i > 1 && yt(n.slice(0, i - 1).concat({value: " " === n[i - 2].type ? "*" : ""})).replace(at, "$1"), u, i < r && ei(n.slice(i, r)), r < s && ei(n = n.slice(r)), r < s && yt(n))
                }
                e.push(u)
            }
            return ui(e)
        }

        function pr(n, r) {
            var f = r.length > 0, e = n.length > 0, o = function (o, s, c, l, a) {
                var y, nt, d, g = 0, p = "0", tt = o && [], w = [], it = ht, rt = o || e && t.find.TAG("*", a),
                    ut = v += null == it ? 1 : Math.random() || .1, ft = rt.length;
                for (a && (ht = s === i || s || a); p !== ft && null != (y = rt[p]); p++) {
                    if (e && y) {
                        for (nt = 0, s || y.ownerDocument === i || (b(y), c = !h); d = n[nt++];)if (d(y, s || i, c)) {
                            l.push(y);
                            break
                        }
                        a && (v = ut)
                    }
                    f && ((y = !d && y) && g--, o && tt.push(y))
                }
                if (g += p, f && p !== g) {
                    for (nt = 0; d = r[nt++];)d(tt, w, s, c);
                    if (o) {
                        if (g > 0)while (p--)tt[p] || w[p] || (w[p] = nr.call(l));
                        w = wt(w)
                    }
                    k.apply(l, w);
                    a && !o && w.length > 0 && g + r.length > 1 && u.uniqueSort(l)
                }
                return a && (v = ut, ht = it), tt
            };
            return f ? l(o) : o
        }

        var rt, e, t, st, oi, ft, bt, si, ht, w, ut, b, i, s, h, o, d, ct, et, f = "sizzle" + 1 * new Date,
            c = n.document, v = 0, di = 0, hi = ti(), ci = ti(), lt = ti(), kt = function (n, t) {
                return n === t && (ut = !0), 0
            }, gi = {}.hasOwnProperty, g = [], nr = g.pop, tr = g.push, k = g.push, li = g.slice, nt = function (n, t) {
                for (var i = 0, r = n.length; i < r; i++)if (n[i] === t)return i;
                return -1
            },
            dt = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            r = "[\\x20\\t\\r\\n\\f]", tt = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
            ai = "\\[" + r + "*(" + tt + ")(?:" + r + "*([*^$|!~]?=)" + r + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + tt + "))|)" + r + "*\\]",
            gt = ":(" + tt + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + ai + ")*)|.*)\\)|)",
            ir = new RegExp(r + "+", "g"), at = new RegExp("^" + r + "+|((?:^|[^\\\\])(?:\\\\.)*)" + r + "+$", "g"),
            rr = new RegExp("^" + r + "*," + r + "*"), ur = new RegExp("^" + r + "*([>+~]|" + r + ")" + r + "*"),
            fr = new RegExp("=" + r + "*([^\\]'\"]*?)" + r + "*\\]", "g"), er = new RegExp(gt),
            or = new RegExp("^" + tt + "$"), vt = {
                ID: new RegExp("^#(" + tt + ")"),
                CLASS: new RegExp("^\\.(" + tt + ")"),
                TAG: new RegExp("^(" + tt + "|[*])"),
                ATTR: new RegExp("^" + ai),
                PSEUDO: new RegExp("^" + gt),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + r + "*(even|odd|(([+-]|)(\\d*)n|)" + r + "*(?:([+-]|)" + r + "*(\\d+)|))" + r + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + dt + ")$", "i"),
                needsContext: new RegExp("^" + r + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + r + "*((?:-\\d)?\\d*)" + r + "*\\)|)(?=[^-]|$)", "i")
            }, sr = /^(?:input|select|textarea|button)$/i, hr = /^h\d$/i, ot = /^[^{]+\{\s*\[native \w/,
            cr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, ni = /[+~]/,
            y = new RegExp("\\\\([\\da-f]{1,6}" + r + "?|(" + r + ")|.)", "ig"), p = function (n, t, i) {
                var r = "0x" + t - 65536;
                return r !== r || i ? t : r < 0 ? String.fromCharCode(r + 65536) : String.fromCharCode(r >> 10 | 55296, 1023 & r | 56320)
            }, vi = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g, yi = function (n, t) {
                return t ? "\0" === n ? "�" : n.slice(0, -1) + "\\" + n.charCodeAt(n.length - 1).toString(16) + " " : "\\" + n
            }, pi = function () {
                b()
            }, lr = pt(function (n) {
                return !0 === n.disabled && ("form" in n || "label" in n)
            }, {dir: "parentNode", next: "legend"});
        try {
            k.apply(g = li.call(c.childNodes), c.childNodes);
            g[c.childNodes.length].nodeType
        } catch (n) {
            k = {
                apply: g.length ? function (n, t) {
                    tr.apply(n, li.call(t))
                } : function (n, t) {
                    for (var i = n.length, r = 0; n[i++] = t[r++];);
                    n.length = i - 1
                }
            }
        }
        e = u.support = {};
        oi = u.isXML = function (n) {
            var t = n && (n.ownerDocument || n).documentElement;
            return !!t && "HTML" !== t.nodeName
        };
        b = u.setDocument = function (n) {
            var v, u, l = n ? n.ownerDocument || n : c;
            return l !== i && 9 === l.nodeType && l.documentElement ? (i = l, s = i.documentElement, h = !oi(i), c !== i && (u = i.defaultView) && u.top !== u && (u.addEventListener ? u.addEventListener("unload", pi, !1) : u.attachEvent && u.attachEvent("onunload", pi)), e.attributes = a(function (n) {
                return n.className = "i", !n.getAttribute("className")
            }), e.getElementsByTagName = a(function (n) {
                return n.appendChild(i.createComment("")), !n.getElementsByTagName("*").length
            }), e.getElementsByClassName = ot.test(i.getElementsByClassName), e.getById = a(function (n) {
                return s.appendChild(n).id = f, !i.getElementsByName || !i.getElementsByName(f).length
            }), e.getById ? (t.filter.ID = function (n) {
                var t = n.replace(y, p);
                return function (n) {
                    return n.getAttribute("id") === t
                }
            }, t.find.ID = function (n, t) {
                if ("undefined" != typeof t.getElementById && h) {
                    var i = t.getElementById(n);
                    return i ? [i] : []
                }
            }) : (t.filter.ID = function (n) {
                var t = n.replace(y, p);
                return function (n) {
                    var i = "undefined" != typeof n.getAttributeNode && n.getAttributeNode("id");
                    return i && i.value === t
                }
            }, t.find.ID = function (n, t) {
                if ("undefined" != typeof t.getElementById && h) {
                    var r, u, f, i = t.getElementById(n);
                    if (i) {
                        if ((r = i.getAttributeNode("id")) && r.value === n)return [i];
                        for (f = t.getElementsByName(n), u = 0; i = f[u++];)if ((r = i.getAttributeNode("id")) && r.value === n)return [i]
                    }
                    return []
                }
            }), t.find.TAG = e.getElementsByTagName ? function (n, t) {
                return "undefined" != typeof t.getElementsByTagName ? t.getElementsByTagName(n) : e.qsa ? t.querySelectorAll(n) : void 0
            } : function (n, t) {
                var i, r = [], f = 0, u = t.getElementsByTagName(n);
                if ("*" === n) {
                    while (i = u[f++])1 === i.nodeType && r.push(i);
                    return r
                }
                return u
            }, t.find.CLASS = e.getElementsByClassName && function (n, t) {
                    if ("undefined" != typeof t.getElementsByClassName && h)return t.getElementsByClassName(n)
                }, d = [], o = [], (e.qsa = ot.test(i.querySelectorAll)) && (a(function (n) {
                s.appendChild(n).innerHTML = "<a id='" + f + "'><\/a><select id='" + f + "-\r\\' msallowcapture=''><option selected=''><\/option><\/select>";
                n.querySelectorAll("[msallowcapture^='']").length && o.push("[*^$]=" + r + "*(?:''|\"\")");
                n.querySelectorAll("[selected]").length || o.push("\\[" + r + "*(?:value|" + dt + ")");
                n.querySelectorAll("[id~=" + f + "-]").length || o.push("~=");
                n.querySelectorAll(":checked").length || o.push(":checked");
                n.querySelectorAll("a#" + f + "+*").length || o.push(".#.+[+~]")
            }), a(function (n) {
                n.innerHTML = "<a href='' disabled='disabled'><\/a><select disabled='disabled'><option/><\/select>";
                var t = i.createElement("input");
                t.setAttribute("type", "hidden");
                n.appendChild(t).setAttribute("name", "D");
                n.querySelectorAll("[name=d]").length && o.push("name" + r + "*[*^$|!~]?=");
                2 !== n.querySelectorAll(":enabled").length && o.push(":enabled", ":disabled");
                s.appendChild(n).disabled = !0;
                2 !== n.querySelectorAll(":disabled").length && o.push(":enabled", ":disabled");
                n.querySelectorAll("*,:x");
                o.push(",.*:")
            })), (e.matchesSelector = ot.test(ct = s.matches || s.webkitMatchesSelector || s.mozMatchesSelector || s.oMatchesSelector || s.msMatchesSelector)) && a(function (n) {
                e.disconnectedMatch = ct.call(n, "*");
                ct.call(n, "[s!='']:x");
                d.push("!=", gt)
            }), o = o.length && new RegExp(o.join("|")), d = d.length && new RegExp(d.join("|")), v = ot.test(s.compareDocumentPosition), et = v || ot.test(s.contains) ? function (n, t) {
                var r = 9 === n.nodeType ? n.documentElement : n, i = t && t.parentNode;
                return n === i || !(!i || 1 !== i.nodeType || !(r.contains ? r.contains(i) : n.compareDocumentPosition && 16 & n.compareDocumentPosition(i)))
            } : function (n, t) {
                if (t)while (t = t.parentNode)if (t === n)return !0;
                return !1
            }, kt = v ? function (n, t) {
                if (n === t)return ut = !0, 0;
                var r = !n.compareDocumentPosition - !t.compareDocumentPosition;
                return r || (1 & (r = (n.ownerDocument || n) === (t.ownerDocument || t) ? n.compareDocumentPosition(t) : 1) || !e.sortDetached && t.compareDocumentPosition(n) === r ? n === i || n.ownerDocument === c && et(c, n) ? -1 : t === i || t.ownerDocument === c && et(c, t) ? 1 : w ? nt(w, n) - nt(w, t) : 0 : 4 & r ? -1 : 1)
            } : function (n, t) {
                if (n === t)return ut = !0, 0;
                var r, u = 0, o = n.parentNode, s = t.parentNode, f = [n], e = [t];
                if (!o || !s)return n === i ? -1 : t === i ? 1 : o ? -1 : s ? 1 : w ? nt(w, n) - nt(w, t) : 0;
                if (o === s)return wi(n, t);
                for (r = n; r = r.parentNode;)f.unshift(r);
                for (r = t; r = r.parentNode;)e.unshift(r);
                while (f[u] === e[u])u++;
                return u ? wi(f[u], e[u]) : f[u] === c ? -1 : e[u] === c ? 1 : 0
            }, i) : i
        };
        u.matches = function (n, t) {
            return u(n, null, null, t)
        };
        u.matchesSelector = function (n, t) {
            if ((n.ownerDocument || n) !== i && b(n), t = t.replace(fr, "='$1']"), e.matchesSelector && h && !lt[t + " "] && (!d || !d.test(t)) && (!o || !o.test(t)))try {
                var r = ct.call(n, t);
                if (r || e.disconnectedMatch || n.document && 11 !== n.document.nodeType)return r
            } catch (n) {
            }
            return u(t, i, null, [n]).length > 0
        };
        u.contains = function (n, t) {
            return (n.ownerDocument || n) !== i && b(n), et(n, t)
        };
        u.attr = function (n, r) {
            (n.ownerDocument || n) !== i && b(n);
            var f = t.attrHandle[r.toLowerCase()],
                u = f && gi.call(t.attrHandle, r.toLowerCase()) ? f(n, r, !h) : void 0;
            return void 0 !== u ? u : e.attributes || !h ? n.getAttribute(r) : (u = n.getAttributeNode(r)) && u.specified ? u.value : null
        };
        u.escape = function (n) {
            return (n + "").replace(vi, yi)
        };
        u.error = function (n) {
            throw new Error("Syntax error, unrecognized expression: " + n);
        };
        u.uniqueSort = function (n) {
            var r, u = [], t = 0, i = 0;
            if (ut = !e.detectDuplicates, w = !e.sortStable && n.slice(0), n.sort(kt), ut) {
                while (r = n[i++])r === n[i] && (t = u.push(i));
                while (t--)n.splice(u[t], 1)
            }
            return w = null, n
        };
        st = u.getText = function (n) {
            var r, i = "", u = 0, t = n.nodeType;
            if (t) {
                if (1 === t || 9 === t || 11 === t) {
                    if ("string" == typeof n.textContent)return n.textContent;
                    for (n = n.firstChild; n; n = n.nextSibling)i += st(n)
                } else if (3 === t || 4 === t)return n.nodeValue
            } else while (r = n[u++])i += st(r);
            return i
        };
        (t = u.selectors = {
            cacheLength: 50,
            createPseudo: l,
            match: vt,
            attrHandle: {},
            find: {},
            relative: {
                ">": {dir: "parentNode", first: !0},
                " ": {dir: "parentNode"},
                "+": {dir: "previousSibling", first: !0},
                "~": {dir: "previousSibling"}
            },
            preFilter: {
                ATTR: function (n) {
                    return n[1] = n[1].replace(y, p), n[3] = (n[3] || n[4] || n[5] || "").replace(y, p), "~=" === n[2] && (n[3] = " " + n[3] + " "), n.slice(0, 4)
                }, CHILD: function (n) {
                    return n[1] = n[1].toLowerCase(), "nth" === n[1].slice(0, 3) ? (n[3] || u.error(n[0]), n[4] = +(n[4] ? n[5] + (n[6] || 1) : 2 * ("even" === n[3] || "odd" === n[3])), n[5] = +(n[7] + n[8] || "odd" === n[3])) : n[3] && u.error(n[0]), n
                }, PSEUDO: function (n) {
                    var i, t = !n[6] && n[2];
                    return vt.CHILD.test(n[0]) ? null : (n[3] ? n[2] = n[4] || n[5] || "" : t && er.test(t) && (i = ft(t, !0)) && (i = t.indexOf(")", t.length - i) - t.length) && (n[0] = n[0].slice(0, i), n[2] = t.slice(0, i)), n.slice(0, 3))
                }
            },
            filter: {
                TAG: function (n) {
                    var t = n.replace(y, p).toLowerCase();
                    return "*" === n ? function () {
                        return !0
                    } : function (n) {
                        return n.nodeName && n.nodeName.toLowerCase() === t
                    }
                }, CLASS: function (n) {
                    var t = hi[n + " "];
                    return t || (t = new RegExp("(^|" + r + ")" + n + "(" + r + "|$)")) && hi(n, function (n) {
                            return t.test("string" == typeof n.className && n.className || "undefined" != typeof n.getAttribute && n.getAttribute("class") || "")
                        })
                }, ATTR: function (n, t, i) {
                    return function (r) {
                        var f = u.attr(r, n);
                        return null == f ? "!=" === t : !t || (f += "", "=" === t ? f === i : "!=" === t ? f !== i : "^=" === t ? i && 0 === f.indexOf(i) : "*=" === t ? i && f.indexOf(i) > -1 : "$=" === t ? i && f.slice(-i.length) === i : "~=" === t ? (" " + f.replace(ir, " ") + " ").indexOf(i) > -1 : "|=" === t && (f === i || f.slice(0, i.length + 1) === i + "-"))
                    }
                }, CHILD: function (n, t, i, r, u) {
                    var s = "nth" !== n.slice(0, 3), o = "last" !== n.slice(-4), e = "of-type" === t;
                    return 1 === r && 0 === u ? function (n) {
                        return !!n.parentNode
                    } : function (t, i, h) {
                        var p, d, y, c, a, w, b = s !== o ? "nextSibling" : "previousSibling", k = t.parentNode,
                            nt = e && t.nodeName.toLowerCase(), g = !h && !e, l = !1;
                        if (k) {
                            if (s) {
                                while (b) {
                                    for (c = t; c = c[b];)if (e ? c.nodeName.toLowerCase() === nt : 1 === c.nodeType)return !1;
                                    w = b = "only" === n && !w && "nextSibling"
                                }
                                return !0
                            }
                            if (w = [o ? k.firstChild : k.lastChild], o && g) {
                                for (l = (a = (p = (d = (y = (c = k)[f] || (c[f] = {}))[c.uniqueID] || (y[c.uniqueID] = {}))[n] || [])[0] === v && p[1]) && p[2], c = a && k.childNodes[a]; c = ++a && c && c[b] || (l = a = 0) || w.pop();)if (1 === c.nodeType && ++l && c === t) {
                                    d[n] = [v, a, l];
                                    break
                                }
                            } else if (g && (l = a = (p = (d = (y = (c = t)[f] || (c[f] = {}))[c.uniqueID] || (y[c.uniqueID] = {}))[n] || [])[0] === v && p[1]), !1 === l)while (c = ++a && c && c[b] || (l = a = 0) || w.pop())if ((e ? c.nodeName.toLowerCase() === nt : 1 === c.nodeType) && ++l && (g && ((d = (y = c[f] || (c[f] = {}))[c.uniqueID] || (y[c.uniqueID] = {}))[n] = [v, l]), c === t))break;
                            return (l -= u) === r || l % r == 0 && l / r >= 0
                        }
                    }
                }, PSEUDO: function (n, i) {
                    var e, r = t.pseudos[n] || t.setFilters[n.toLowerCase()] || u.error("unsupported pseudo: " + n);
                    return r[f] ? r(i) : r.length > 1 ? (e = [n, n, "", i], t.setFilters.hasOwnProperty(n.toLowerCase()) ? l(function (n, t) {
                        for (var e, u = r(n, i), f = u.length; f--;)n[e = nt(n, u[f])] = !(t[e] = u[f])
                    }) : function (n) {
                        return r(n, 0, e)
                    }) : r
                }
            },
            pseudos: {
                not: l(function (n) {
                    var t = [], r = [], i = bt(n.replace(at, "$1"));
                    return i[f] ? l(function (n, t, r, u) {
                        for (var e, o = i(n, null, u, []), f = n.length; f--;)(e = o[f]) && (n[f] = !(t[f] = e))
                    }) : function (n, u, f) {
                        return t[0] = n, i(t, null, f, r), t[0] = null, !r.pop()
                    }
                }), has: l(function (n) {
                    return function (t) {
                        return u(n, t).length > 0
                    }
                }), contains: l(function (n) {
                    return n = n.replace(y, p), function (t) {
                        return (t.textContent || t.innerText || st(t)).indexOf(n) > -1
                    }
                }), lang: l(function (n) {
                    return or.test(n || "") || u.error("unsupported lang: " + n), n = n.replace(y, p).toLowerCase(), function (t) {
                        var i;
                        do if (i = h ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang"))return (i = i.toLowerCase()) === n || 0 === i.indexOf(n + "-"); while ((t = t.parentNode) && 1 === t.nodeType);
                        return !1
                    }
                }), target: function (t) {
                    var i = n.location && n.location.hash;
                    return i && i.slice(1) === t.id
                }, root: function (n) {
                    return n === s
                }, focus: function (n) {
                    return n === i.activeElement && (!i.hasFocus || i.hasFocus()) && !!(n.type || n.href || ~n.tabIndex)
                }, enabled: bi(!1), disabled: bi(!0), checked: function (n) {
                    var t = n.nodeName.toLowerCase();
                    return "input" === t && !!n.checked || "option" === t && !!n.selected
                }, selected: function (n) {
                    return n.parentNode && n.parentNode.selectedIndex, !0 === n.selected
                }, empty: function (n) {
                    for (n = n.firstChild; n; n = n.nextSibling)if (n.nodeType < 6)return !1;
                    return !0
                }, parent: function (n) {
                    return !t.pseudos.empty(n)
                }, header: function (n) {
                    return hr.test(n.nodeName)
                }, input: function (n) {
                    return sr.test(n.nodeName)
                }, button: function (n) {
                    var t = n.nodeName.toLowerCase();
                    return "input" === t && "button" === n.type || "button" === t
                }, text: function (n) {
                    var t;
                    return "input" === n.nodeName.toLowerCase() && "text" === n.type && (null == (t = n.getAttribute("type")) || "text" === t.toLowerCase())
                }, first: it(function () {
                    return [0]
                }), last: it(function (n, t) {
                    return [t - 1]
                }), eq: it(function (n, t, i) {
                    return [i < 0 ? i + t : i]
                }), even: it(function (n, t) {
                    for (var i = 0; i < t; i += 2)n.push(i);
                    return n
                }), odd: it(function (n, t) {
                    for (var i = 1; i < t; i += 2)n.push(i);
                    return n
                }), lt: it(function (n, t, i) {
                    for (var r = i < 0 ? i + t : i; --r >= 0;)n.push(r);
                    return n
                }), gt: it(function (n, t, i) {
                    for (var r = i < 0 ? i + t : i; ++r < t;)n.push(r);
                    return n
                })
            }
        }).pseudos.nth = t.pseudos.eq;
        for (rt in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0})t.pseudos[rt] = ar(rt);
        for (rt in{submit: !0, reset: !0})t.pseudos[rt] = vr(rt);
        return ki.prototype = t.filters = t.pseudos, t.setFilters = new ki, ft = u.tokenize = function (n, i) {
            var e, f, s, o, r, h, c, l = ci[n + " "];
            if (l)return i ? 0 : l.slice(0);
            for (r = n, h = [], c = t.preFilter; r;) {
                (!e || (f = rr.exec(r))) && (f && (r = r.slice(f[0].length) || r), h.push(s = []));
                e = !1;
                (f = ur.exec(r)) && (e = f.shift(), s.push({
                    value: e,
                    type: f[0].replace(at, " ")
                }), r = r.slice(e.length));
                for (o in t.filter)(f = vt[o].exec(r)) && (!c[o] || (f = c[o](f))) && (e = f.shift(), s.push({
                    value: e,
                    type: o,
                    matches: f
                }), r = r.slice(e.length));
                if (!e)break
            }
            return i ? r.length : r ? u.error(n) : ci(n, h).slice(0)
        }, bt = u.compile = function (n, t) {
            var r, u = [], e = [], i = lt[n + " "];
            if (!i) {
                for (t || (t = ft(n)), r = t.length; r--;)(i = ei(t[r]))[f] ? u.push(i) : e.push(i);
                (i = lt(n, pr(e, u))).selector = n
            }
            return i
        }, si = u.select = function (n, i, r, u) {
            var o, f, e, l, a, c = "function" == typeof n && n, s = !u && ft(n = c.selector || n);
            if (r = r || [], 1 === s.length) {
                if ((f = s[0] = s[0].slice(0)).length > 2 && "ID" === (e = f[0]).type && 9 === i.nodeType && h && t.relative[f[1].type]) {
                    if (!(i = (t.find.ID(e.matches[0].replace(y, p), i) || [])[0]))return r;
                    c && (i = i.parentNode);
                    n = n.slice(f.shift().value.length)
                }
                for (o = vt.needsContext.test(n) ? 0 : f.length; o--;) {
                    if (e = f[o], t.relative[l = e.type])break;
                    if ((a = t.find[l]) && (u = a(e.matches[0].replace(y, p), ni.test(f[0].type) && ri(i.parentNode) || i))) {
                        if (f.splice(o, 1), !(n = u.length && yt(f)))return k.apply(r, u), r;
                        break
                    }
                }
            }
            return (c || bt(n, s))(u, i, !h, r, !i || ni.test(n) && ri(i.parentNode) || i), r
        }, e.sortStable = f.split("").sort(kt).join("") === f, e.detectDuplicates = !!ut, b(), e.sortDetached = a(function (n) {
            return 1 & n.compareDocumentPosition(i.createElement("fieldset"))
        }), a(function (n) {
            return n.innerHTML = "<a href='#'><\/a>", "#" === n.firstChild.getAttribute("href")
        }) || ii("type|href|height|width", function (n, t, i) {
            if (!i)return n.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
        }), e.attributes && a(function (n) {
            return n.innerHTML = "<input/>", n.firstChild.setAttribute("value", ""), "" === n.firstChild.getAttribute("value")
        }) || ii("value", function (n, t, i) {
            if (!i && "input" === n.nodeName.toLowerCase())return n.defaultValue
        }), a(function (n) {
            return null == n.getAttribute("disabled")
        }) || ii(dt, function (n, t, i) {
            var r;
            if (!i)return !0 === n[t] ? t.toLowerCase() : (r = n.getAttributeNode(t)) && r.specified ? r.value : null
        }), u
    }(n);
    i.find = b;
    i.expr = b.selectors;
    i.expr[":"] = i.expr.pseudos;
    i.uniqueSort = i.unique = b.uniqueSort;
    i.text = b.getText;
    i.isXMLDoc = b.isXML;
    i.contains = b.contains;
    i.escapeSelector = b.escape;
    var rt = function (n, t, r) {
        for (var u = [], f = void 0 !== r; (n = n[t]) && 9 !== n.nodeType;)if (1 === n.nodeType) {
            if (f && i(n).is(r))break;
            u.push(n)
        }
        return u
    }, cr = function (n, t) {
        for (var i = []; n; n = n.nextSibling)1 === n.nodeType && n !== t && i.push(n);
        return i
    }, lr = i.expr.match.needsContext;
    ci = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;
    i.filter = function (n, t, r) {
        var u = t[0];
        return r && (n = ":not(" + n + ")"), 1 === t.length && 1 === u.nodeType ? i.find.matchesSelector(u, n) ? [u] : [] : i.find.matches(n, i.grep(t, function (n) {
            return 1 === n.nodeType
        }))
    };
    i.fn.extend({
        find: function (n) {
            var t, r, u = this.length, f = this;
            if ("string" != typeof n)return this.pushStack(i(n).filter(function () {
                for (t = 0; t < u; t++)if (i.contains(f[t], this))return !0
            }));
            for (r = this.pushStack([]), t = 0; t < u; t++)i.find(n, f[t], r);
            return u > 1 ? i.uniqueSort(r) : r
        }, filter: function (n) {
            return this.pushStack(li(this, n || [], !1))
        }, not: function (n) {
            return this.pushStack(li(this, n || [], !0))
        }, is: function (n) {
            return !!li(this, "string" == typeof n && lr.test(n) ? i(n) : n || [], !1).length
        }
    });
    vr = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
    (i.fn.init = function (n, t, r) {
        var e, o;
        if (!n)return this;
        if (r = r || ar, "string" == typeof n) {
            if (!(e = "<" === n[0] && ">" === n[n.length - 1] && n.length >= 3 ? [null, n, null] : vr.exec(n)) || !e[1] && t)return !t || t.jquery ? (t || r).find(n) : this.constructor(t).find(n);
            if (e[1]) {
                if (t = t instanceof i ? t[0] : t, i.merge(this, i.parseHTML(e[1], t && t.nodeType ? t.ownerDocument || t : f, !0)), ci.test(e[1]) && i.isPlainObject(t))for (e in t)u(this[e]) ? this[e](t[e]) : this.attr(e, t[e]);
                return this
            }
            return (o = f.getElementById(e[2])) && (this[0] = o, this.length = 1), this
        }
        return n.nodeType ? (this[0] = n, this.length = 1, this) : u(n) ? void 0 !== r.ready ? r.ready(n) : n(i) : i.makeArray(n, this)
    }).prototype = i.fn;
    ar = i(f);
    yr = /^(?:parents|prev(?:Until|All))/;
    pr = {children: !0, contents: !0, next: !0, prev: !0};
    i.fn.extend({
        has: function (n) {
            var t = i(n, this), r = t.length;
            return this.filter(function () {
                for (var n = 0; n < r; n++)if (i.contains(this, t[n]))return !0
            })
        }, closest: function (n, t) {
            var r, f = 0, o = this.length, u = [], e = "string" != typeof n && i(n);
            if (!lr.test(n))for (; f < o; f++)for (r = this[f]; r && r !== t; r = r.parentNode)if (r.nodeType < 11 && (e ? e.index(r) > -1 : 1 === r.nodeType && i.find.matchesSelector(r, n))) {
                u.push(r);
                break
            }
            return this.pushStack(u.length > 1 ? i.uniqueSort(u) : u)
        }, index: function (n) {
            return n ? "string" == typeof n ? wt.call(i(n), this[0]) : wt.call(this, n.jquery ? n[0] : n) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        }, add: function (n, t) {
            return this.pushStack(i.uniqueSort(i.merge(this.get(), i(n, t))))
        }, addBack: function (n) {
            return this.add(null == n ? this.prevObject : this.prevObject.filter(n))
        }
    });
    i.each({
        parent: function (n) {
            var t = n.parentNode;
            return t && 11 !== t.nodeType ? t : null
        }, parents: function (n) {
            return rt(n, "parentNode")
        }, parentsUntil: function (n, t, i) {
            return rt(n, "parentNode", i)
        }, next: function (n) {
            return wr(n, "nextSibling")
        }, prev: function (n) {
            return wr(n, "previousSibling")
        }, nextAll: function (n) {
            return rt(n, "nextSibling")
        }, prevAll: function (n) {
            return rt(n, "previousSibling")
        }, nextUntil: function (n, t, i) {
            return rt(n, "nextSibling", i)
        }, prevUntil: function (n, t, i) {
            return rt(n, "previousSibling", i)
        }, siblings: function (n) {
            return cr((n.parentNode || {}).firstChild, n)
        }, children: function (n) {
            return cr(n.firstChild)
        }, contents: function (n) {
            return v(n, "iframe") ? n.contentDocument : (v(n, "template") && (n = n.content || n), i.merge([], n.childNodes))
        }
    }, function (n, t) {
        i.fn[n] = function (r, u) {
            var f = i.map(this, t, r);
            return "Until" !== n.slice(-5) && (u = r), u && "string" == typeof u && (f = i.filter(u, f)), this.length > 1 && (pr[n] || i.uniqueSort(f), yr.test(n) && f.reverse()), this.pushStack(f)
        }
    });
    l = /[^\x20\t\r\n\f]+/g;
    i.Callbacks = function (n) {
        n = "string" == typeof n ? ne(n) : i.extend({}, n);
        var f, r, c, e, t = [], s = [], o = -1, l = function () {
            for (e = e || n.once, c = f = !0; s.length; o = -1)for (r = s.shift(); ++o < t.length;)!1 === t[o].apply(r[0], r[1]) && n.stopOnFalse && (o = t.length, r = !1);
            n.memory || (r = !1);
            f = !1;
            e && (t = r ? [] : "")
        }, h = {
            add: function () {
                return t && (r && !f && (o = t.length - 1, s.push(r)), function f(r) {
                    i.each(r, function (i, r) {
                        u(r) ? n.unique && h.has(r) || t.push(r) : r && r.length && "string" !== it(r) && f(r)
                    })
                }(arguments), r && !f && l()), this
            }, remove: function () {
                return i.each(arguments, function (n, r) {
                    for (var u; (u = i.inArray(r, t, u)) > -1;)t.splice(u, 1), u <= o && o--
                }), this
            }, has: function (n) {
                return n ? i.inArray(n, t) > -1 : t.length > 0
            }, empty: function () {
                return t && (t = []), this
            }, disable: function () {
                return e = s = [], t = r = "", this
            }, disabled: function () {
                return !t
            }, lock: function () {
                return e = s = [], r || f || (t = r = ""), this
            }, locked: function () {
                return !!e
            }, fireWith: function (n, t) {
                return e || (t = [n, (t = t || []).slice ? t.slice() : t], s.push(t), f || l()), this
            }, fire: function () {
                return h.fireWith(this, arguments), this
            }, fired: function () {
                return !!c
            }
        };
        return h
    };
    i.extend({
        Deferred: function (t) {
            var f = [["notify", "progress", i.Callbacks("memory"), i.Callbacks("memory"), 2], ["resolve", "done", i.Callbacks("once memory"), i.Callbacks("once memory"), 0, "resolved"], ["reject", "fail", i.Callbacks("once memory"), i.Callbacks("once memory"), 1, "rejected"]],
                o = "pending", e = {
                    state: function () {
                        return o
                    }, always: function () {
                        return r.done(arguments).fail(arguments), this
                    }, "catch": function (n) {
                        return e.then(null, n)
                    }, pipe: function () {
                        var n = arguments;
                        return i.Deferred(function (t) {
                            i.each(f, function (i, f) {
                                var e = u(n[f[4]]) && n[f[4]];
                                r[f[1]](function () {
                                    var n = e && e.apply(this, arguments);
                                    n && u(n.promise) ? n.promise().progress(t.notify).done(t.resolve).fail(t.reject) : t[f[0] + "With"](this, e ? [n] : arguments)
                                })
                            });
                            n = null
                        }).promise()
                    }, then: function (t, r, e) {
                        function s(t, r, f, e) {
                            return function () {
                                var h = this, c = arguments, a = function () {
                                    var n, i;
                                    if (!(t < o)) {
                                        if ((n = f.apply(h, c)) === r.promise())throw new TypeError("Thenable self-resolution");
                                        i = n && ("object" == typeof n || "function" == typeof n) && n.then;
                                        u(i) ? e ? i.call(n, s(o, r, ut, e), s(o, r, dt, e)) : (o++, i.call(n, s(o, r, ut, e), s(o, r, dt, e), s(o, r, ut, r.notifyWith))) : (f !== ut && (h = void 0, c = [n]), (e || r.resolveWith)(h, c))
                                    }
                                }, l = e ? a : function () {
                                    try {
                                        a()
                                    } catch (n) {
                                        i.Deferred.exceptionHook && i.Deferred.exceptionHook(n, l.stackTrace);
                                        t + 1 >= o && (f !== dt && (h = void 0, c = [n]), r.rejectWith(h, c))
                                    }
                                };
                                t ? l() : (i.Deferred.getStackHook && (l.stackTrace = i.Deferred.getStackHook()), n.setTimeout(l))
                            }
                        }

                        var o = 0;
                        return i.Deferred(function (n) {
                            f[0][3].add(s(0, n, u(e) ? e : ut, n.notifyWith));
                            f[1][3].add(s(0, n, u(t) ? t : ut));
                            f[2][3].add(s(0, n, u(r) ? r : dt))
                        }).promise()
                    }, promise: function (n) {
                        return null != n ? i.extend(n, e) : e
                    }
                }, r = {};
            return i.each(f, function (n, t) {
                var i = t[2], u = t[5];
                e[t[1]] = i.add;
                u && i.add(function () {
                    o = u
                }, f[3 - n][2].disable, f[3 - n][3].disable, f[0][2].lock, f[0][3].lock);
                i.add(t[3].fire);
                r[t[0]] = function () {
                    return r[t[0] + "With"](this === r ? void 0 : this, arguments), this
                };
                r[t[0] + "With"] = i.fireWith
            }), e.promise(r), t && t.call(r, r), r
        }, when: function (n) {
            var e = arguments.length, t = e, o = Array(t), f = d.call(arguments), r = i.Deferred(), s = function (n) {
                return function (t) {
                    o[n] = this;
                    f[n] = arguments.length > 1 ? d.call(arguments) : t;
                    --e || r.resolveWith(o, f)
                }
            };
            if (e <= 1 && (br(n, r.done(s(t)).resolve, r.reject, !e), "pending" === r.state() || u(f[t] && f[t].then)))return r.then();
            while (t--)br(f[t], s(t), r.reject);
            return r.promise()
        }
    });
    kr = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
    i.Deferred.exceptionHook = function (t, i) {
        n.console && n.console.warn && t && kr.test(t.name) && n.console.warn("jQuery.Deferred exception: " + t.message, t.stack, i)
    };
    i.readyException = function (t) {
        n.setTimeout(function () {
            throw t;
        })
    };
    gt = i.Deferred();
    i.fn.ready = function (n) {
        return gt.then(n)["catch"](function (n) {
            i.readyException(n)
        }), this
    };
    i.extend({
        isReady: !1, readyWait: 1, ready: function (n) {
            (!0 === n ? --i.readyWait : i.isReady) || (i.isReady = !0, !0 !== n && --i.readyWait > 0 || gt.resolveWith(f, [i]))
        }
    });
    i.ready.then = gt.then;
    "complete" === f.readyState || "loading" !== f.readyState && !f.documentElement.doScroll ? n.setTimeout(i.ready) : (f.addEventListener("DOMContentLoaded", ni), n.addEventListener("load", ni));
    var p = function (n, t, r, f, e, o, s) {
        var h = 0, l = n.length, c = null == r;
        if ("object" === it(r)) {
            e = !0;
            for (h in r)p(n, t, h, r[h], !0, o, s)
        } else if (void 0 !== f && (e = !0, u(f) || (s = !0), c && (s ? (t.call(n, f), t = null) : (c = t, t = function (n, t, r) {
                return c.call(i(n), r)
            })), t))for (; h < l; h++)t(n[h], r, s ? f : f.call(n[h], h, t(n[h], r)));
        return e ? n : c ? t.call(n) : l ? t(n[0], r) : o
    }, te = /^-ms-/, ie = /-([a-z])/g;
    lt = function (n) {
        return 1 === n.nodeType || 9 === n.nodeType || !+n.nodeType
    };
    at.uid = 1;
    at.prototype = {
        cache: function (n) {
            var t = n[this.expando];
            return t || (t = {}, lt(n) && (n.nodeType ? n[this.expando] = t : Object.defineProperty(n, this.expando, {
                value: t,
                configurable: !0
            }))), t
        }, set: function (n, t, i) {
            var r, u = this.cache(n);
            if ("string" == typeof t) u[y(t)] = i; else for (r in t)u[y(r)] = t[r];
            return u
        }, get: function (n, t) {
            return void 0 === t ? this.cache(n) : n[this.expando] && n[this.expando][y(t)]
        }, access: function (n, t, i) {
            return void 0 === t || t && "string" == typeof t && void 0 === i ? this.get(n, t) : (this.set(n, t, i), void 0 !== i ? i : t)
        }, remove: function (n, t) {
            var u, r = n[this.expando];
            if (void 0 !== r) {
                if (void 0 !== t)for (u = (t = Array.isArray(t) ? t.map(y) : (t = y(t)) in r ? [t] : t.match(l) || []).length; u--;)delete r[t[u]];
                (void 0 === t || i.isEmptyObject(r)) && (n.nodeType ? n[this.expando] = void 0 : delete n[this.expando])
            }
        }, hasData: function (n) {
            var t = n[this.expando];
            return void 0 !== t && !i.isEmptyObject(t)
        }
    };
    var r = new at, o = new at, ue = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, fe = /[A-Z]/g;
    i.extend({
        hasData: function (n) {
            return o.hasData(n) || r.hasData(n)
        }, data: function (n, t, i) {
            return o.access(n, t, i)
        }, removeData: function (n, t) {
            o.remove(n, t)
        }, _data: function (n, t, i) {
            return r.access(n, t, i)
        }, _removeData: function (n, t) {
            r.remove(n, t)
        }
    });
    i.fn.extend({
        data: function (n, t) {
            var f, u, e, i = this[0], s = i && i.attributes;
            if (void 0 === n) {
                if (this.length && (e = o.get(i), 1 === i.nodeType && !r.get(i, "hasDataAttrs"))) {
                    for (f = s.length; f--;)s[f] && 0 === (u = s[f].name).indexOf("data-") && (u = y(u.slice(5)), dr(i, u, e[u]));
                    r.set(i, "hasDataAttrs", !0)
                }
                return e
            }
            return "object" == typeof n ? this.each(function () {
                o.set(this, n)
            }) : p(this, function (t) {
                var r;
                if (i && void 0 === t) {
                    if (void 0 !== (r = o.get(i, n)) || void 0 !== (r = dr(i, n)))return r
                } else this.each(function () {
                    o.set(this, n, t)
                })
            }, null, t, arguments.length > 1, null, !0)
        }, removeData: function (n) {
            return this.each(function () {
                o.remove(this, n)
            })
        }
    });
    i.extend({
        queue: function (n, t, u) {
            var f;
            if (n)return t = (t || "fx") + "queue", f = r.get(n, t), u && (!f || Array.isArray(u) ? f = r.access(n, t, i.makeArray(u)) : f.push(u)), f || []
        }, dequeue: function (n, t) {
            t = t || "fx";
            var r = i.queue(n, t), e = r.length, u = r.shift(), f = i._queueHooks(n, t), o = function () {
                i.dequeue(n, t)
            };
            "inprogress" === u && (u = r.shift(), e--);
            u && ("fx" === t && r.unshift("inprogress"), delete f.stop, u.call(n, o, f));
            !e && f && f.empty.fire()
        }, _queueHooks: function (n, t) {
            var u = t + "queueHooks";
            return r.get(n, u) || r.access(n, u, {
                    empty: i.Callbacks("once memory").add(function () {
                        r.remove(n, [t + "queue", u])
                    })
                })
        }
    });
    i.fn.extend({
        queue: function (n, t) {
            var r = 2;
            return "string" != typeof n && (t = n, n = "fx", r--), arguments.length < r ? i.queue(this[0], n) : void 0 === t ? this : this.each(function () {
                var r = i.queue(this, n, t);
                i._queueHooks(this, n);
                "fx" === n && "inprogress" !== r[0] && i.dequeue(this, n)
            })
        }, dequeue: function (n) {
            return this.each(function () {
                i.dequeue(this, n)
            })
        }, clearQueue: function (n) {
            return this.queue(n || "fx", [])
        }, promise: function (n, t) {
            var u, e = 1, o = i.Deferred(), f = this, s = this.length, h = function () {
                --e || o.resolveWith(f, [f])
            };
            for ("string" != typeof n && (t = n, n = void 0), n = n || "fx"; s--;)(u = r.get(f[s], n + "queueHooks")) && u.empty && (e++, u.empty.add(h));
            return h(), o.promise(t)
        }
    });
    var gr = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, vt = new RegExp("^(?:([+-])=|)(" + gr + ")([a-z%]*)$", "i"),
        w = ["Top", "Right", "Bottom", "Left"], ti = function (n, t) {
            return "none" === (n = t || n).style.display || "" === n.style.display && i.contains(n.ownerDocument, n) && "none" === i.css(n, "display")
        }, nu = function (n, t, i, r) {
            var f, u, e = {};
            for (u in t)e[u] = n.style[u], n.style[u] = t[u];
            f = i.apply(n, r || []);
            for (u in t)n.style[u] = e[u];
            return f
        };
    ai = {};
    i.fn.extend({
        show: function () {
            return ft(this, !0)
        }, hide: function () {
            return ft(this)
        }, toggle: function (n) {
            return "boolean" == typeof n ? n ? this.show() : this.hide() : this.each(function () {
                ti(this) ? i(this).show() : i(this).hide()
            })
        }
    });
    var iu = /^(?:checkbox|radio)$/i, ru = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i, uu = /^$|^module$|\/(?:java|ecma)script/i,
        c = {
            option: [1, "<select multiple='multiple'>", "<\/select>"],
            thead: [1, "<table>", "<\/table>"],
            col: [2, "<table><colgroup>", "<\/colgroup><\/table>"],
            tr: [2, "<table><tbody>", "<\/tbody><\/table>"],
            td: [3, "<table><tbody><tr>", "<\/tr><\/tbody><\/table>"],
            _default: [0, "", ""]
        };
    c.optgroup = c.option;
    c.tbody = c.tfoot = c.colgroup = c.caption = c.thead;
    c.th = c.td;
    fu = /<|&#?\w+;/;
    !function () {
        var n = f.createDocumentFragment().appendChild(f.createElement("div")), t = f.createElement("input");
        t.setAttribute("type", "radio");
        t.setAttribute("checked", "checked");
        t.setAttribute("name", "t");
        n.appendChild(t);
        e.checkClone = n.cloneNode(!0).cloneNode(!0).lastChild.checked;
        n.innerHTML = "<textarea>x<\/textarea>";
        e.noCloneChecked = !!n.cloneNode(!0).lastChild.defaultValue
    }();
    var ii = f.documentElement, se = /^key/, he = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
        ou = /^([^.]*)(?:\.(.+)|)/;
    i.event = {
        global: {}, add: function (n, t, u, f, e) {
            var p, v, k, y, w, h, s, c, o, b, d, a = r.get(n);
            if (a)for (u.handler && (u = (p = u).handler, e = p.selector), e && i.find.matchesSelector(ii, e), u.guid || (u.guid = i.guid++), (y = a.events) || (y = a.events = {}), (v = a.handle) || (v = a.handle = function (t) {
                if ("undefined" != typeof i && i.event.triggered !== t.type)return i.event.dispatch.apply(n, arguments)
            }), w = (t = (t || "").match(l) || [""]).length; w--;)o = d = (k = ou.exec(t[w]) || [])[1], b = (k[2] || "").split(".").sort(), o && (s = i.event.special[o] || {}, o = (e ? s.delegateType : s.bindType) || o, s = i.event.special[o] || {}, h = i.extend({
                type: o,
                origType: d,
                data: f,
                handler: u,
                guid: u.guid,
                selector: e,
                needsContext: e && i.expr.match.needsContext.test(e),
                namespace: b.join(".")
            }, p), (c = y[o]) || ((c = y[o] = []).delegateCount = 0, s.setup && !1 !== s.setup.call(n, f, b, v) || n.addEventListener && n.addEventListener(o, v)), s.add && (s.add.call(n, h), h.handler.guid || (h.handler.guid = u.guid)), e ? c.splice(c.delegateCount++, 0, h) : c.push(h), i.event.global[o] = !0)
        }, remove: function (n, t, u, f, e) {
            var y, k, h, v, p, s, c, a, o, b, d, w = r.hasData(n) && r.get(n);
            if (w && (v = w.events)) {
                for (p = (t = (t || "").match(l) || [""]).length; p--;)if (h = ou.exec(t[p]) || [], o = d = h[1], b = (h[2] || "").split(".").sort(), o) {
                    for (c = i.event.special[o] || {}, a = v[o = (f ? c.delegateType : c.bindType) || o] || [], h = h[2] && new RegExp("(^|\\.)" + b.join("\\.(?:.*\\.|)") + "(\\.|$)"), k = y = a.length; y--;)s = a[y], !e && d !== s.origType || u && u.guid !== s.guid || h && !h.test(s.namespace) || f && f !== s.selector && ("**" !== f || !s.selector) || (a.splice(y, 1), s.selector && a.delegateCount--, c.remove && c.remove.call(n, s));
                    k && !a.length && (c.teardown && !1 !== c.teardown.call(n, b, w.handle) || i.removeEvent(n, o, w.handle), delete v[o])
                } else for (o in v)i.event.remove(n, o + t[p], u, f, !0);
                i.isEmptyObject(v) && r.remove(n, "handle events")
            }
        }, dispatch: function (n) {
            var t = i.event.fix(n), u, h, c, e, f, l, s = new Array(arguments.length),
                a = (r.get(this, "events") || {})[t.type] || [], o = i.event.special[t.type] || {};
            for (s[0] = t, u = 1; u < arguments.length; u++)s[u] = arguments[u];
            if (t.delegateTarget = this, !o.preDispatch || !1 !== o.preDispatch.call(this, t)) {
                for (l = i.event.handlers.call(this, t, a), u = 0; (e = l[u++]) && !t.isPropagationStopped();)for (t.currentTarget = e.elem, h = 0; (f = e.handlers[h++]) && !t.isImmediatePropagationStopped();)t.rnamespace && !t.rnamespace.test(f.namespace) || (t.handleObj = f, t.data = f.data, void 0 !== (c = ((i.event.special[f.origType] || {}).handle || f.handler).apply(e.elem, s)) && !1 === (t.result = c) && (t.preventDefault(), t.stopPropagation()));
                return o.postDispatch && o.postDispatch.call(this, t), t.result
            }
        }, handlers: function (n, t) {
            var f, h, u, e, o, c = [], s = t.delegateCount, r = n.target;
            if (s && r.nodeType && !("click" === n.type && n.button >= 1))for (; r !== this; r = r.parentNode || this)if (1 === r.nodeType && ("click" !== n.type || !0 !== r.disabled)) {
                for (e = [], o = {}, f = 0; f < s; f++)void 0 === o[u = (h = t[f]).selector + " "] && (o[u] = h.needsContext ? i(u, this).index(r) > -1 : i.find(u, this, null, [r]).length), o[u] && e.push(h);
                e.length && c.push({elem: r, handlers: e})
            }
            return r = this, s < t.length && c.push({elem: r, handlers: t.slice(s)}), c
        }, addProp: function (n, t) {
            Object.defineProperty(i.Event.prototype, n, {
                enumerable: !0, configurable: !0, get: u(t) ? function () {
                    if (this.originalEvent)return t(this.originalEvent)
                } : function () {
                    if (this.originalEvent)return this.originalEvent[n]
                }, set: function (t) {
                    Object.defineProperty(this, n, {enumerable: !0, configurable: !0, writable: !0, value: t})
                }
            })
        }, fix: function (n) {
            return n[i.expando] ? n : new i.Event(n)
        }, special: {
            load: {noBubble: !0}, focus: {
                trigger: function () {
                    if (this !== su() && this.focus)return this.focus(), !1
                }, delegateType: "focusin"
            }, blur: {
                trigger: function () {
                    if (this === su() && this.blur)return this.blur(), !1
                }, delegateType: "focusout"
            }, click: {
                trigger: function () {
                    if ("checkbox" === this.type && this.click && v(this, "input"))return this.click(), !1
                }, _default: function (n) {
                    return v(n.target, "a")
                }
            }, beforeunload: {
                postDispatch: function (n) {
                    void 0 !== n.result && n.originalEvent && (n.originalEvent.returnValue = n.result)
                }
            }
        }
    };
    i.removeEvent = function (n, t, i) {
        n.removeEventListener && n.removeEventListener(t, i)
    };
    i.Event = function (n, t) {
        if (!(this instanceof i.Event))return new i.Event(n, t);
        n && n.type ? (this.originalEvent = n, this.type = n.type, this.isDefaultPrevented = n.defaultPrevented || void 0 === n.defaultPrevented && !1 === n.returnValue ? ri : et, this.target = n.target && 3 === n.target.nodeType ? n.target.parentNode : n.target, this.currentTarget = n.currentTarget, this.relatedTarget = n.relatedTarget) : this.type = n;
        t && i.extend(this, t);
        this.timeStamp = n && n.timeStamp || Date.now();
        this[i.expando] = !0
    };
    i.Event.prototype = {
        constructor: i.Event,
        isDefaultPrevented: et,
        isPropagationStopped: et,
        isImmediatePropagationStopped: et,
        isSimulated: !1,
        preventDefault: function () {
            var n = this.originalEvent;
            this.isDefaultPrevented = ri;
            n && !this.isSimulated && n.preventDefault()
        },
        stopPropagation: function () {
            var n = this.originalEvent;
            this.isPropagationStopped = ri;
            n && !this.isSimulated && n.stopPropagation()
        },
        stopImmediatePropagation: function () {
            var n = this.originalEvent;
            this.isImmediatePropagationStopped = ri;
            n && !this.isSimulated && n.stopImmediatePropagation();
            this.stopPropagation()
        }
    };
    i.each({
        altKey: !0,
        bubbles: !0,
        cancelable: !0,
        changedTouches: !0,
        ctrlKey: !0,
        detail: !0,
        eventPhase: !0,
        metaKey: !0,
        pageX: !0,
        pageY: !0,
        shiftKey: !0,
        view: !0,
        char: !0,
        charCode: !0,
        key: !0,
        keyCode: !0,
        button: !0,
        buttons: !0,
        clientX: !0,
        clientY: !0,
        offsetX: !0,
        offsetY: !0,
        pointerId: !0,
        pointerType: !0,
        screenX: !0,
        screenY: !0,
        targetTouches: !0,
        toElement: !0,
        touches: !0,
        which: function (n) {
            var t = n.button;
            return null == n.which && se.test(n.type) ? null != n.charCode ? n.charCode : n.keyCode : !n.which && void 0 !== t && he.test(n.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : n.which
        }
    }, i.event.addProp);
    i.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function (n, t) {
        i.event.special[n] = {
            delegateType: t, bindType: t, handle: function (n) {
                var u, f = this, r = n.relatedTarget, e = n.handleObj;
                return r && (r === f || i.contains(f, r)) || (n.type = e.origType, u = e.handler.apply(this, arguments), n.type = t), u
            }
        }
    });
    i.fn.extend({
        on: function (n, t, i, r) {
            return yi(this, n, t, i, r)
        }, one: function (n, t, i, r) {
            return yi(this, n, t, i, r, 1)
        }, off: function (n, t, r) {
            var u, f;
            if (n && n.preventDefault && n.handleObj)return u = n.handleObj, i(n.delegateTarget).off(u.namespace ? u.origType + "." + u.namespace : u.origType, u.selector, u.handler), this;
            if ("object" == typeof n) {
                for (f in n)this.off(f, t, n[f]);
                return this
            }
            return !1 !== t && "function" != typeof t || (r = t, t = void 0), !1 === r && (r = et), this.each(function () {
                i.event.remove(this, n, r, t)
            })
        }
    });
    var ce = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
        le = /<script|<style|<link/i, ae = /checked\s*(?:[^=]|=\s*.checked.)/i,
        ve = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
    i.extend({
        htmlPrefilter: function (n) {
            return n.replace(ce, "<$1><\/$2>")
        }, clone: function (n, t, r) {
            var u, c, o, f, h = n.cloneNode(!0), l = i.contains(n.ownerDocument, n);
            if (!(e.noCloneChecked || 1 !== n.nodeType && 11 !== n.nodeType || i.isXMLDoc(n)))for (f = s(h), u = 0, c = (o = s(n)).length; u < c; u++)we(o[u], f[u]);
            if (t)if (r)for (o = o || s(n), f = f || s(h), u = 0, c = o.length; u < c; u++)cu(o[u], f[u]); else cu(n, h);
            return (f = s(h, "script")).length > 0 && vi(f, !l && s(n, "script")), h
        }, cleanData: function (n) {
            for (var u, t, f, s = i.event.special, e = 0; void 0 !== (t = n[e]); e++)if (lt(t)) {
                if (u = t[r.expando]) {
                    if (u.events)for (f in u.events)s[f] ? i.event.remove(t, f) : i.removeEvent(t, f, u.handle);
                    t[r.expando] = void 0
                }
                t[o.expando] && (t[o.expando] = void 0)
            }
        }
    });
    i.fn.extend({
        detach: function (n) {
            return lu(this, n, !0)
        }, remove: function (n) {
            return lu(this, n)
        }, text: function (n) {
            return p(this, function (n) {
                return void 0 === n ? i.text(this) : this.empty().each(function () {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = n)
                })
            }, null, n, arguments.length)
        }, append: function () {
            return ot(this, arguments, function (n) {
                1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || hu(this, n).appendChild(n)
            })
        }, prepend: function () {
            return ot(this, arguments, function (n) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = hu(this, n);
                    t.insertBefore(n, t.firstChild)
                }
            })
        }, before: function () {
            return ot(this, arguments, function (n) {
                this.parentNode && this.parentNode.insertBefore(n, this)
            })
        }, after: function () {
            return ot(this, arguments, function (n) {
                this.parentNode && this.parentNode.insertBefore(n, this.nextSibling)
            })
        }, empty: function () {
            for (var n, t = 0; null != (n = this[t]); t++)1 === n.nodeType && (i.cleanData(s(n, !1)), n.textContent = "");
            return this
        }, clone: function (n, t) {
            return n = null != n && n, t = null == t ? n : t, this.map(function () {
                return i.clone(this, n, t)
            })
        }, html: function (n) {
            return p(this, function (n) {
                var t = this[0] || {}, r = 0, u = this.length;
                if (void 0 === n && 1 === t.nodeType)return t.innerHTML;
                if ("string" == typeof n && !le.test(n) && !c[(ru.exec(n) || ["", ""])[1].toLowerCase()]) {
                    n = i.htmlPrefilter(n);
                    try {
                        for (; r < u; r++)1 === (t = this[r] || {}).nodeType && (i.cleanData(s(t, !1)), t.innerHTML = n);
                        t = 0
                    } catch (n) {
                    }
                }
                t && this.empty().append(n)
            }, null, n, arguments.length)
        }, replaceWith: function () {
            var n = [];
            return ot(this, arguments, function (t) {
                var r = this.parentNode;
                i.inArray(this, n) < 0 && (i.cleanData(s(this)), r && r.replaceChild(t, this))
            }, n)
        }
    });
    i.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (n, t) {
        i.fn[n] = function (n) {
            for (var u, f = [], e = i(n), o = e.length - 1, r = 0; r <= o; r++)u = r === o ? this : this.clone(!0), i(e[r])[t](u), si.apply(f, u.get());
            return this.pushStack(f)
        }
    });
    var pi = new RegExp("^(" + gr + ")(?!px)[a-z%]+$", "i"), ui = function (t) {
        var i = t.ownerDocument.defaultView;
        return i && i.opener || (i = n), i.getComputedStyle(t)
    }, be = new RegExp(w.join("|"), "i");
    !function () {
        function r() {
            if (t) {
                o.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0";
                t.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%";
                ii.appendChild(o).appendChild(t);
                var i = n.getComputedStyle(t);
                s = "1%" !== i.top;
                a = 12 === u(i.marginLeft);
                t.style.right = "60%";
                l = 36 === u(i.right);
                h = 36 === u(i.width);
                t.style.position = "absolute";
                c = 36 === t.offsetWidth || "absolute";
                ii.removeChild(o);
                t = null
            }
        }

        function u(n) {
            return Math.round(parseFloat(n))
        }

        var s, h, c, l, a, o = f.createElement("div"), t = f.createElement("div");
        t.style && (t.style.backgroundClip = "content-box", t.cloneNode(!0).style.backgroundClip = "", e.clearCloneStyle = "content-box" === t.style.backgroundClip, i.extend(e, {
            boxSizingReliable: function () {
                return r(), h
            }, pixelBoxStyles: function () {
                return r(), l
            }, pixelPosition: function () {
                return r(), s
            }, reliableMarginLeft: function () {
                return r(), a
            }, scrollboxSize: function () {
                return r(), c
            }
        }))
    }();
    var ke = /^(none|table(?!-c[ea]).+)/, vu = /^--/,
        de = {position: "absolute", visibility: "hidden", display: "block"},
        yu = {letterSpacing: "0", fontWeight: "400"}, pu = ["Webkit", "Moz", "ms"], wu = f.createElement("div").style;
    i.extend({
        cssHooks: {
            opacity: {
                get: function (n, t) {
                    if (t) {
                        var i = yt(n, "opacity");
                        return "" === i ? "1" : i
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {},
        style: function (n, t, r, u) {
            if (n && 3 !== n.nodeType && 8 !== n.nodeType && n.style) {
                var f, h, o, c = y(t), l = vu.test(t), s = n.style;
                if (l || (t = bu(c)), o = i.cssHooks[t] || i.cssHooks[c], void 0 === r)return o && "get" in o && void 0 !== (f = o.get(n, !1, u)) ? f : s[t];
                "string" == (h = typeof r) && (f = vt.exec(r)) && f[1] && (r = tu(n, t, f), h = "number");
                null != r && r === r && ("number" === h && (r += f && f[3] || (i.cssNumber[c] ? "" : "px")), e.clearCloneStyle || "" !== r || 0 !== t.indexOf("background") || (s[t] = "inherit"), o && "set" in o && void 0 === (r = o.set(n, r, u)) || (l ? s.setProperty(t, r) : s[t] = r))
            }
        },
        css: function (n, t, r, u) {
            var f, e, o, s = y(t);
            return vu.test(t) || (t = bu(s)), (o = i.cssHooks[t] || i.cssHooks[s]) && "get" in o && (f = o.get(n, !0, r)), void 0 === f && (f = yt(n, t, u)), "normal" === f && t in yu && (f = yu[t]), "" === r || r ? (e = parseFloat(f), !0 === r || isFinite(e) ? e || 0 : f) : f
        }
    });
    i.each(["height", "width"], function (n, t) {
        i.cssHooks[t] = {
            get: function (n, r, u) {
                if (r)return !ke.test(i.css(n, "display")) || n.getClientRects().length && n.getBoundingClientRect().width ? du(n, t, u) : nu(n, de, function () {
                    return du(n, t, u)
                })
            }, set: function (n, r, u) {
                var s, f = ui(n), h = "border-box" === i.css(n, "boxSizing", !1, f), o = u && wi(n, t, u, h, f);
                return h && e.scrollboxSize() === f.position && (o -= Math.ceil(n["offset" + t[0].toUpperCase() + t.slice(1)] - parseFloat(f[t]) - wi(n, t, "border", !1, f) - .5)), o && (s = vt.exec(r)) && "px" !== (s[3] || "px") && (n.style[t] = r, r = i.css(n, t)), ku(n, r, o)
            }
        }
    });
    i.cssHooks.marginLeft = au(e.reliableMarginLeft, function (n, t) {
        if (t)return (parseFloat(yt(n, "marginLeft")) || n.getBoundingClientRect().left - nu(n, {marginLeft: 0}, function () {
                return n.getBoundingClientRect().left
            })) + "px"
    });
    i.each({margin: "", padding: "", border: "Width"}, function (n, t) {
        i.cssHooks[n + t] = {
            expand: function (i) {
                for (var r = 0, f = {}, u = "string" == typeof i ? i.split(" ") : [i]; r < 4; r++)f[n + w[r] + t] = u[r] || u[r - 2] || u[0];
                return f
            }
        };
        "margin" !== n && (i.cssHooks[n + t].set = ku)
    });
    i.fn.extend({
        css: function (n, t) {
            return p(this, function (n, t, r) {
                var f, e, o = {}, u = 0;
                if (Array.isArray(t)) {
                    for (f = ui(n), e = t.length; u < e; u++)o[t[u]] = i.css(n, t[u], !1, f);
                    return o
                }
                return void 0 !== r ? i.style(n, t, r) : i.css(n, t)
            }, n, t, arguments.length > 1)
        }
    });
    i.Tween = h;
    h.prototype = {
        constructor: h, init: function (n, t, r, u, f, e) {
            this.elem = n;
            this.prop = r;
            this.easing = f || i.easing._default;
            this.options = t;
            this.start = this.now = this.cur();
            this.end = u;
            this.unit = e || (i.cssNumber[r] ? "" : "px")
        }, cur: function () {
            var n = h.propHooks[this.prop];
            return n && n.get ? n.get(this) : h.propHooks._default.get(this)
        }, run: function (n) {
            var t, r = h.propHooks[this.prop];
            return this.pos = this.options.duration ? t = i.easing[this.easing](n, this.options.duration * n, 0, 1, this.options.duration) : t = n, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), r && r.set ? r.set(this) : h.propHooks._default.set(this), this
        }
    };
    h.prototype.init.prototype = h.prototype;
    h.propHooks = {
        _default: {
            get: function (n) {
                var t;
                return 1 !== n.elem.nodeType || null != n.elem[n.prop] && null == n.elem.style[n.prop] ? n.elem[n.prop] : (t = i.css(n.elem, n.prop, "")) && "auto" !== t ? t : 0
            }, set: function (n) {
                i.fx.step[n.prop] ? i.fx.step[n.prop](n) : 1 !== n.elem.nodeType || null == n.elem.style[i.cssProps[n.prop]] && !i.cssHooks[n.prop] ? n.elem[n.prop] = n.now : i.style(n.elem, n.prop, n.now + n.unit)
            }
        }
    };
    h.propHooks.scrollTop = h.propHooks.scrollLeft = {
        set: function (n) {
            n.elem.nodeType && n.elem.parentNode && (n.elem[n.prop] = n.now)
        }
    };
    i.easing = {
        linear: function (n) {
            return n
        }, swing: function (n) {
            return .5 - Math.cos(n * Math.PI) / 2
        }, _default: "swing"
    };
    i.fx = h.prototype.init;
    i.fx.step = {};
    gu = /^(?:toggle|show|hide)$/;
    nf = /queueHooks$/;
    i.Animation = i.extend(a, {
        tweeners: {
            "*": [function (n, t) {
                var i = this.createTween(n, t);
                return tu(i.elem, n, vt.exec(t), i), i
            }]
        }, tweener: function (n, t) {
            u(n) ? (t = n, n = ["*"]) : n = n.match(l);
            for (var i, r = 0, f = n.length; r < f; r++)i = n[r], a.tweeners[i] = a.tweeners[i] || [], a.tweeners[i].unshift(t)
        }, prefilters: [no], prefilter: function (n, t) {
            t ? a.prefilters.unshift(n) : a.prefilters.push(n)
        }
    });
    i.speed = function (n, t, r) {
        var f = n && "object" == typeof n ? i.extend({}, n) : {
            complete: r || !r && t || u(n) && n,
            duration: n,
            easing: r && t || t && !u(t) && t
        };
        return i.fx.off ? f.duration = 0 : "number" != typeof f.duration && (f.duration = f.duration in i.fx.speeds ? i.fx.speeds[f.duration] : i.fx.speeds._default), null != f.queue && !0 !== f.queue || (f.queue = "fx"), f.old = f.complete, f.complete = function () {
            u(f.old) && f.old.call(this);
            f.queue && i.dequeue(this, f.queue)
        }, f
    };
    i.fn.extend({
        fadeTo: function (n, t, i, r) {
            return this.filter(ti).css("opacity", 0).show().end().animate({opacity: t}, n, i, r)
        }, animate: function (n, t, u, f) {
            var s = i.isEmptyObject(n), o = i.speed(t, u, f), e = function () {
                var t = a(this, i.extend({}, n), o);
                (s || r.get(this, "finish")) && t.stop(!0)
            };
            return e.finish = e, s || !1 === o.queue ? this.each(e) : this.queue(o.queue, e)
        }, stop: function (n, t, u) {
            var f = function (n) {
                var t = n.stop;
                delete n.stop;
                t(u)
            };
            return "string" != typeof n && (u = t, t = n, n = void 0), t && !1 !== n && this.queue(n || "fx", []), this.each(function () {
                var s = !0, t = null != n && n + "queueHooks", o = i.timers, e = r.get(this);
                if (t) e[t] && e[t].stop && f(e[t]); else for (t in e)e[t] && e[t].stop && nf.test(t) && f(e[t]);
                for (t = o.length; t--;)o[t].elem !== this || null != n && o[t].queue !== n || (o[t].anim.stop(u), s = !1, o.splice(t, 1));
                !s && u || i.dequeue(this, n)
            })
        }, finish: function (n) {
            return !1 !== n && (n = n || "fx"), this.each(function () {
                var t, e = r.get(this), u = e[n + "queue"], o = e[n + "queueHooks"], f = i.timers, s = u ? u.length : 0;
                for (e.finish = !0, i.queue(this, n, []), o && o.stop && o.stop.call(this, !0), t = f.length; t--;)f[t].elem === this && f[t].queue === n && (f[t].anim.stop(!0), f.splice(t, 1));
                for (t = 0; t < s; t++)u[t] && u[t].finish && u[t].finish.call(this);
                delete e.finish
            })
        }
    });
    i.each(["toggle", "show", "hide"], function (n, t) {
        var r = i.fn[t];
        i.fn[t] = function (n, i, u) {
            return null == n || "boolean" == typeof n ? r.apply(this, arguments) : this.animate(ei(t, !0), n, i, u)
        }
    });
    i.each({
        slideDown: ei("show"),
        slideUp: ei("hide"),
        slideToggle: ei("toggle"),
        fadeIn: {opacity: "show"},
        fadeOut: {opacity: "hide"},
        fadeToggle: {opacity: "toggle"}
    }, function (n, t) {
        i.fn[n] = function (n, i, r) {
            return this.animate(t, n, i, r)
        }
    });
    i.timers = [];
    i.fx.tick = function () {
        var r, n = 0, t = i.timers;
        for (st = Date.now(); n < t.length; n++)(r = t[n])() || t[n] !== r || t.splice(n--, 1);
        t.length || i.fx.stop();
        st = void 0
    };
    i.fx.timer = function (n) {
        i.timers.push(n);
        i.fx.start()
    };
    i.fx.interval = 13;
    i.fx.start = function () {
        fi || (fi = !0, bi())
    };
    i.fx.stop = function () {
        fi = null
    };
    i.fx.speeds = {slow: 600, fast: 200, _default: 400};
    i.fn.delay = function (t, r) {
        return t = i.fx ? i.fx.speeds[t] || t : t, r = r || "fx", this.queue(r, function (i, r) {
            var u = n.setTimeout(i, t);
            r.stop = function () {
                n.clearTimeout(u)
            }
        })
    }, function () {
        var n = f.createElement("input"), t = f.createElement("select").appendChild(f.createElement("option"));
        n.type = "checkbox";
        e.checkOn = "" !== n.value;
        e.optSelected = t.selected;
        (n = f.createElement("input")).value = "t";
        n.type = "radio";
        e.radioValue = "t" === n.value
    }();
    ht = i.expr.attrHandle;
    i.fn.extend({
        attr: function (n, t) {
            return p(this, i.attr, n, t, arguments.length > 1)
        }, removeAttr: function (n) {
            return this.each(function () {
                i.removeAttr(this, n)
            })
        }
    });
    i.extend({
        attr: function (n, t, r) {
            var f, u, e = n.nodeType;
            if (3 !== e && 8 !== e && 2 !== e)return "undefined" == typeof n.getAttribute ? i.prop(n, t, r) : (1 === e && i.isXMLDoc(n) || (u = i.attrHooks[t.toLowerCase()] || (i.expr.match.bool.test(t) ? uf : void 0)), void 0 !== r ? null === r ? void i.removeAttr(n, t) : u && "set" in u && void 0 !== (f = u.set(n, r, t)) ? f : (n.setAttribute(t, r + ""), r) : u && "get" in u && null !== (f = u.get(n, t)) ? f : null == (f = i.find.attr(n, t)) ? void 0 : f)
        }, attrHooks: {
            type: {
                set: function (n, t) {
                    if (!e.radioValue && "radio" === t && v(n, "input")) {
                        var i = n.value;
                        return n.setAttribute("type", t), i && (n.value = i), t
                    }
                }
            }
        }, removeAttr: function (n, t) {
            var i, u = 0, r = t && t.match(l);
            if (r && 1 === n.nodeType)while (i = r[u++])n.removeAttribute(i)
        }
    });
    uf = {
        set: function (n, t, r) {
            return !1 === t ? i.removeAttr(n, r) : n.setAttribute(r, r), r
        }
    };
    i.each(i.expr.match.bool.source.match(/\w+/g), function (n, t) {
        var r = ht[t] || i.find.attr;
        ht[t] = function (n, t, i) {
            var f, e, u = t.toLowerCase();
            return i || (e = ht[u], ht[u] = f, f = null != r(n, t, i) ? u : null, ht[u] = e), f
        }
    });
    ff = /^(?:input|select|textarea|button)$/i;
    ef = /^(?:a|area)$/i;
    i.fn.extend({
        prop: function (n, t) {
            return p(this, i.prop, n, t, arguments.length > 1)
        }, removeProp: function (n) {
            return this.each(function () {
                delete this[i.propFix[n] || n]
            })
        }
    });
    i.extend({
        prop: function (n, t, r) {
            var f, u, e = n.nodeType;
            if (3 !== e && 8 !== e && 2 !== e)return 1 === e && i.isXMLDoc(n) || (t = i.propFix[t] || t, u = i.propHooks[t]), void 0 !== r ? u && "set" in u && void 0 !== (f = u.set(n, r, t)) ? f : n[t] = r : u && "get" in u && null !== (f = u.get(n, t)) ? f : n[t]
        }, propHooks: {
            tabIndex: {
                get: function (n) {
                    var t = i.find.attr(n, "tabindex");
                    return t ? parseInt(t, 10) : ff.test(n.nodeName) || ef.test(n.nodeName) && n.href ? 0 : -1
                }
            }
        }, propFix: {"for": "htmlFor", "class": "className"}
    });
    e.optSelected || (i.propHooks.selected = {
        get: function (n) {
            var t = n.parentNode;
            return t && t.parentNode && t.parentNode.selectedIndex, null
        }, set: function (n) {
            var t = n.parentNode;
            t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
        }
    });
    i.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
        i.propFix[this.toLowerCase()] = this
    });
    i.fn.extend({
        addClass: function (n) {
            var o, t, r, f, e, s, h, c = 0;
            if (u(n))return this.each(function (t) {
                i(this).addClass(n.call(this, t, nt(this)))
            });
            if ((o = ki(n)).length)while (t = this[c++])if (f = nt(t), r = 1 === t.nodeType && " " + g(f) + " ") {
                for (s = 0; e = o[s++];)r.indexOf(" " + e + " ") < 0 && (r += e + " ");
                f !== (h = g(r)) && t.setAttribute("class", h)
            }
            return this
        }, removeClass: function (n) {
            var o, r, t, f, e, s, h, c = 0;
            if (u(n))return this.each(function (t) {
                i(this).removeClass(n.call(this, t, nt(this)))
            });
            if (!arguments.length)return this.attr("class", "");
            if ((o = ki(n)).length)while (r = this[c++])if (f = nt(r), t = 1 === r.nodeType && " " + g(f) + " ") {
                for (s = 0; e = o[s++];)while (t.indexOf(" " + e + " ") > -1)t = t.replace(" " + e + " ", " ");
                f !== (h = g(t)) && r.setAttribute("class", h)
            }
            return this
        }, toggleClass: function (n, t) {
            var f = typeof n, e = "string" === f || Array.isArray(n);
            return "boolean" == typeof t && e ? t ? this.addClass(n) : this.removeClass(n) : u(n) ? this.each(function (r) {
                i(this).toggleClass(n.call(this, r, nt(this), t), t)
            }) : this.each(function () {
                var t, o, u, s;
                if (e)for (o = 0, u = i(this), s = ki(n); t = s[o++];)u.hasClass(t) ? u.removeClass(t) : u.addClass(t); else void 0 !== n && "boolean" !== f || ((t = nt(this)) && r.set(this, "__className__", t), this.setAttribute && this.setAttribute("class", t || !1 === n ? "" : r.get(this, "__className__") || ""))
            })
        }, hasClass: function (n) {
            for (var t, r = 0, i = " " + n + " "; t = this[r++];)if (1 === t.nodeType && (" " + g(nt(t)) + " ").indexOf(i) > -1)return !0;
            return !1
        }
    });
    of = /\r/g;
    i.fn.extend({
        val: function (n) {
            var t, r, e, f = this[0];
            return arguments.length ? (e = u(n), this.each(function (r) {
                var u;
                1 === this.nodeType && (null == (u = e ? n.call(this, r, i(this).val()) : n) ? u = "" : "number" == typeof u ? u += "" : Array.isArray(u) && (u = i.map(u, function (n) {
                        return null == n ? "" : n + ""
                    })), (t = i.valHooks[this.type] || i.valHooks[this.nodeName.toLowerCase()]) && "set" in t && void 0 !== t.set(this, u, "value") || (this.value = u))
            })) : f ? (t = i.valHooks[f.type] || i.valHooks[f.nodeName.toLowerCase()]) && "get" in t && void 0 !== (r = t.get(f, "value")) ? r : "string" == typeof(r = f.value) ? r.replace(of, "") : null == r ? "" : r : void 0
        }
    });
    i.extend({
        valHooks: {
            option: {
                get: function (n) {
                    var t = i.find.attr(n, "value");
                    return null != t ? t : g(i.text(n))
                }
            }, select: {
                get: function (n) {
                    for (var e, t, o = n.options, u = n.selectedIndex, f = "select-one" === n.type, s = f ? null : [], h = f ? u + 1 : o.length, r = u < 0 ? h : f ? u : 0; r < h; r++)if (((t = o[r]).selected || r === u) && !t.disabled && (!t.parentNode.disabled || !v(t.parentNode, "optgroup"))) {
                        if (e = i(t).val(), f)return e;
                        s.push(e)
                    }
                    return s
                }, set: function (n, t) {
                    for (var r, u, f = n.options, e = i.makeArray(t), o = f.length; o--;)((u = f[o]).selected = i.inArray(i.valHooks.option.get(u), e) > -1) && (r = !0);
                    return r || (n.selectedIndex = -1), e
                }
            }
        }
    });
    i.each(["radio", "checkbox"], function () {
        i.valHooks[this] = {
            set: function (n, t) {
                if (Array.isArray(t))return n.checked = i.inArray(i(n).val(), t) > -1
            }
        };
        e.checkOn || (i.valHooks[this].get = function (n) {
            return null === n.getAttribute("value") ? "on" : n.value
        })
    });
    e.focusin = "onfocusin" in n;
    di = /^(?:focusinfocus|focusoutblur)$/;
    gi = function (n) {
        n.stopPropagation()
    };
    i.extend(i.event, {
        trigger: function (t, e, o, s) {
            var k, c, l, d, v, y, a, p, w = [o || f], h = kt.call(t, "type") ? t.type : t,
                b = kt.call(t, "namespace") ? t.namespace.split(".") : [];
            if (c = p = l = o = o || f, 3 !== o.nodeType && 8 !== o.nodeType && !di.test(h + i.event.triggered) && (h.indexOf(".") > -1 && (h = (b = h.split(".")).shift(), b.sort()), v = h.indexOf(":") < 0 && "on" + h, t = t[i.expando] ? t : new i.Event(h, "object" == typeof t && t), t.isTrigger = s ? 2 : 3, t.namespace = b.join("."), t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + b.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = o), e = null == e ? [t] : i.makeArray(e, [t]), a = i.event.special[h] || {}, s || !a.trigger || !1 !== a.trigger.apply(o, e))) {
                if (!s && !a.noBubble && !tt(o)) {
                    for (d = a.delegateType || h, di.test(d + h) || (c = c.parentNode); c; c = c.parentNode)w.push(c), l = c;
                    l === (o.ownerDocument || f) && w.push(l.defaultView || l.parentWindow || n)
                }
                for (k = 0; (c = w[k++]) && !t.isPropagationStopped();)p = c, t.type = k > 1 ? d : a.bindType || h, (y = (r.get(c, "events") || {})[t.type] && r.get(c, "handle")) && y.apply(c, e), (y = v && c[v]) && y.apply && lt(c) && (t.result = y.apply(c, e), !1 === t.result && t.preventDefault());
                return t.type = h, s || t.isDefaultPrevented() || a._default && !1 !== a._default.apply(w.pop(), e) || !lt(o) || v && u(o[h]) && !tt(o) && ((l = o[v]) && (o[v] = null), i.event.triggered = h, t.isPropagationStopped() && p.addEventListener(h, gi), o[h](), t.isPropagationStopped() && p.removeEventListener(h, gi), i.event.triggered = void 0, l && (o[v] = l)), t.result
            }
        }, simulate: function (n, t, r) {
            var u = i.extend(new i.Event, r, {type: n, isSimulated: !0});
            i.event.trigger(u, null, t)
        }
    });
    i.fn.extend({
        trigger: function (n, t) {
            return this.each(function () {
                i.event.trigger(n, t, this)
            })
        }, triggerHandler: function (n, t) {
            var r = this[0];
            if (r)return i.event.trigger(n, t, r, !0)
        }
    });
    e.focusin || i.each({focus: "focusin", blur: "focusout"}, function (n, t) {
        var u = function (n) {
            i.event.simulate(t, n.target, i.event.fix(n))
        };
        i.event.special[t] = {
            setup: function () {
                var i = this.ownerDocument || this, f = r.access(i, t);
                f || i.addEventListener(n, u, !0);
                r.access(i, t, (f || 0) + 1)
            }, teardown: function () {
                var i = this.ownerDocument || this, f = r.access(i, t) - 1;
                f ? r.access(i, t, f) : (i.removeEventListener(n, u, !0), r.remove(i, t))
            }
        }
    });
    var pt = n.location, sf = Date.now(), nr = /\?/;
    i.parseXML = function (t) {
        var r;
        if (!t || "string" != typeof t)return null;
        try {
            r = (new n.DOMParser).parseFromString(t, "text/xml")
        } catch (n) {
            r = void 0
        }
        return r && !r.getElementsByTagName("parsererror").length || i.error("Invalid XML: " + t), r
    };
    var io = /\[\]$/, hf = /\r?\n/g, ro = /^(?:submit|button|image|reset|file)$/i,
        uo = /^(?:input|select|textarea|keygen)/i;
    i.param = function (n, t) {
        var r, f = [], e = function (n, t) {
            var i = u(t) ? t() : t;
            f[f.length] = encodeURIComponent(n) + "=" + encodeURIComponent(null == i ? "" : i)
        };
        if (Array.isArray(n) || n.jquery && !i.isPlainObject(n)) i.each(n, function () {
            e(this.name, this.value)
        }); else for (r in n)tr(r, n[r], t, e);
        return f.join("&")
    };
    i.fn.extend({
        serialize: function () {
            return i.param(this.serializeArray())
        }, serializeArray: function () {
            return this.map(function () {
                var n = i.prop(this, "elements");
                return n ? i.makeArray(n) : this
            }).filter(function () {
                var n = this.type;
                return this.name && !i(this).is(":disabled") && uo.test(this.nodeName) && !ro.test(n) && (this.checked || !iu.test(n))
            }).map(function (n, t) {
                var r = i(this).val();
                return null == r ? null : Array.isArray(r) ? i.map(r, function (n) {
                    return {name: t.name, value: n.replace(hf, "\r\n")}
                }) : {name: t.name, value: r.replace(hf, "\r\n")}
            }).get()
        }
    });
    var fo = /%20/g, eo = /#.*$/, oo = /([?&])_=[^&]*/, so = /^(.*?):[ \t]*([^\r\n]*)$/gm, ho = /^(?:GET|HEAD)$/,
        co = /^\/\//, cf = {}, ir = {}, lf = "*/".concat("*"), rr = f.createElement("a");
    return rr.href = pt.href, i.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: pt.href,
            type: "GET",
            isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(pt.protocol),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": lf,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/},
            responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
            converters: {"* text": String, "text html": !0, "text json": JSON.parse, "text xml": i.parseXML},
            flatOptions: {url: !0, context: !0}
        },
        ajaxSetup: function (n, t) {
            return t ? ur(ur(n, i.ajaxSettings), t) : ur(i.ajaxSettings, n)
        },
        ajaxPrefilter: af(cf),
        ajaxTransport: af(ir),
        ajax: function (t, r) {
            function b(t, r, f, c) {
                var v, rt, b, p, g, l = r;
                s || (s = !0, d && n.clearTimeout(d), a = void 0, k = c || "", e.readyState = t > 0 ? 4 : 0, v = t >= 200 && t < 300 || 304 === t, f && (p = lo(u, e, f)), p = ao(u, p, e, v), v ? (u.ifModified && ((g = e.getResponseHeader("Last-Modified")) && (i.lastModified[o] = g), (g = e.getResponseHeader("etag")) && (i.etag[o] = g)), 204 === t || "HEAD" === u.type ? l = "nocontent" : 304 === t ? l = "notmodified" : (l = p.state, rt = p.data, v = !(b = p.error))) : (b = l, !t && l || (l = "error", t < 0 && (t = 0))), e.status = t, e.statusText = (r || l) + "", v ? tt.resolveWith(h, [rt, l, e]) : tt.rejectWith(h, [e, l, b]), e.statusCode(w), w = void 0, y && nt.trigger(v ? "ajaxSuccess" : "ajaxError", [e, u, v ? rt : b]), it.fireWith(h, [e, l]), y && (nt.trigger("ajaxComplete", [e, u]), --i.active || i.event.trigger("ajaxStop")))
            }

            "object" == typeof t && (r = t, t = void 0);
            r = r || {};
            var a, o, k, v, d, c, s, y, g, p, u = i.ajaxSetup({}, r), h = u.context || u,
                nt = u.context && (h.nodeType || h.jquery) ? i(h) : i.event, tt = i.Deferred(),
                it = i.Callbacks("once memory"), w = u.statusCode || {}, rt = {}, ut = {}, ft = "canceled", e = {
                    readyState: 0, getResponseHeader: function (n) {
                        var t;
                        if (s) {
                            if (!v)for (v = {}; t = so.exec(k);)v[t[1].toLowerCase()] = t[2];
                            t = v[n.toLowerCase()]
                        }
                        return null == t ? null : t
                    }, getAllResponseHeaders: function () {
                        return s ? k : null
                    }, setRequestHeader: function (n, t) {
                        return null == s && (n = ut[n.toLowerCase()] = ut[n.toLowerCase()] || n, rt[n] = t), this
                    }, overrideMimeType: function (n) {
                        return null == s && (u.mimeType = n), this
                    }, statusCode: function (n) {
                        var t;
                        if (n)if (s) e.always(n[e.status]); else for (t in n)w[t] = [w[t], n[t]];
                        return this
                    }, abort: function (n) {
                        var t = n || ft;
                        return a && a.abort(t), b(0, t), this
                    }
                };
            if (tt.promise(e), u.url = ((t || u.url || pt.href) + "").replace(co, pt.protocol + "//"), u.type = r.method || r.type || u.method || u.type, u.dataTypes = (u.dataType || "*").toLowerCase().match(l) || [""], null == u.crossDomain) {
                c = f.createElement("a");
                try {
                    c.href = u.url;
                    c.href = c.href;
                    u.crossDomain = rr.protocol + "//" + rr.host != c.protocol + "//" + c.host
                } catch (n) {
                    u.crossDomain = !0
                }
            }
            if (u.data && u.processData && "string" != typeof u.data && (u.data = i.param(u.data, u.traditional)), vf(cf, u, r, e), s)return e;
            (y = i.event && u.global) && 0 == i.active++ && i.event.trigger("ajaxStart");
            u.type = u.type.toUpperCase();
            u.hasContent = !ho.test(u.type);
            o = u.url.replace(eo, "");
            u.hasContent ? u.data && u.processData && 0 === (u.contentType || "").indexOf("application/x-www-form-urlencoded") && (u.data = u.data.replace(fo, "+")) : (p = u.url.slice(o.length), u.data && (u.processData || "string" == typeof u.data) && (o += (nr.test(o) ? "&" : "?") + u.data, delete u.data), !1 === u.cache && (o = o.replace(oo, "$1"), p = (nr.test(o) ? "&" : "?") + "_=" + sf++ + p), u.url = o + p);
            u.ifModified && (i.lastModified[o] && e.setRequestHeader("If-Modified-Since", i.lastModified[o]), i.etag[o] && e.setRequestHeader("If-None-Match", i.etag[o]));
            (u.data && u.hasContent && !1 !== u.contentType || r.contentType) && e.setRequestHeader("Content-Type", u.contentType);
            e.setRequestHeader("Accept", u.dataTypes[0] && u.accepts[u.dataTypes[0]] ? u.accepts[u.dataTypes[0]] + ("*" !== u.dataTypes[0] ? ", " + lf + "; q=0.01" : "") : u.accepts["*"]);
            for (g in u.headers)e.setRequestHeader(g, u.headers[g]);
            if (u.beforeSend && (!1 === u.beforeSend.call(h, e, u) || s))return e.abort();
            if (ft = "abort", it.add(u.complete), e.done(u.success), e.fail(u.error), a = vf(ir, u, r, e)) {
                if (e.readyState = 1, y && nt.trigger("ajaxSend", [e, u]), s)return e;
                u.async && u.timeout > 0 && (d = n.setTimeout(function () {
                    e.abort("timeout")
                }, u.timeout));
                try {
                    s = !1;
                    a.send(rt, b)
                } catch (n) {
                    if (s)throw n;
                    b(-1, n)
                }
            } else b(-1, "No Transport");
            return e
        },
        getJSON: function (n, t, r) {
            return i.get(n, t, r, "json")
        },
        getScript: function (n, t) {
            return i.get(n, void 0, t, "script")
        }
    }), i.each(["get", "post"], function (n, t) {
        i[t] = function (n, r, f, e) {
            return u(r) && (e = e || f, f = r, r = void 0), i.ajax(i.extend({
                url: n,
                type: t,
                dataType: e,
                data: r,
                success: f
            }, i.isPlainObject(n) && n))
        }
    }), i._evalUrl = function (n) {
        return i.ajax({url: n, type: "GET", dataType: "script", cache: !0, async: !1, global: !1, throws: !0})
    }, i.fn.extend({
        wrapAll: function (n) {
            var t;
            return this[0] && (u(n) && (n = n.call(this[0])), t = i(n, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                for (var n = this; n.firstElementChild;)n = n.firstElementChild;
                return n
            }).append(this)), this
        }, wrapInner: function (n) {
            return u(n) ? this.each(function (t) {
                i(this).wrapInner(n.call(this, t))
            }) : this.each(function () {
                var t = i(this), r = t.contents();
                r.length ? r.wrapAll(n) : t.append(n)
            })
        }, wrap: function (n) {
            var t = u(n);
            return this.each(function (r) {
                i(this).wrapAll(t ? n.call(this, r) : n)
            })
        }, unwrap: function (n) {
            return this.parent(n).not("body").each(function () {
                i(this).replaceWith(this.childNodes)
            }), this
        }
    }), i.expr.pseudos.hidden = function (n) {
        return !i.expr.pseudos.visible(n)
    }, i.expr.pseudos.visible = function (n) {
        return !!(n.offsetWidth || n.offsetHeight || n.getClientRects().length)
    }, i.ajaxSettings.xhr = function () {
        try {
            return new n.XMLHttpRequest
        } catch (n) {
        }
    }, yf = {
        0: 200,
        1223: 204
    }, ct = i.ajaxSettings.xhr(), e.cors = !!ct && "withCredentials" in ct, e.ajax = ct = !!ct, i.ajaxTransport(function (t) {
        var i, r;
        if (e.cors || ct && !t.crossDomain)return {
            send: function (u, f) {
                var o, e = t.xhr();
                if (e.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields)for (o in t.xhrFields)e[o] = t.xhrFields[o];
                t.mimeType && e.overrideMimeType && e.overrideMimeType(t.mimeType);
                t.crossDomain || u["X-Requested-With"] || (u["X-Requested-With"] = "XMLHttpRequest");
                for (o in u)e.setRequestHeader(o, u[o]);
                i = function (n) {
                    return function () {
                        i && (i = r = e.onload = e.onerror = e.onabort = e.ontimeout = e.onreadystatechange = null, "abort" === n ? e.abort() : "error" === n ? "number" != typeof e.status ? f(0, "error") : f(e.status, e.statusText) : f(yf[e.status] || e.status, e.statusText, "text" !== (e.responseType || "text") || "string" != typeof e.responseText ? {binary: e.response} : {text: e.responseText}, e.getAllResponseHeaders()))
                    }
                };
                e.onload = i();
                r = e.onerror = e.ontimeout = i("error");
                void 0 !== e.onabort ? e.onabort = r : e.onreadystatechange = function () {
                    4 === e.readyState && n.setTimeout(function () {
                        i && r()
                    })
                };
                i = i("abort");
                try {
                    e.send(t.hasContent && t.data || null)
                } catch (n) {
                    if (i)throw n;
                }
            }, abort: function () {
                i && i()
            }
        }
    }), i.ajaxPrefilter(function (n) {
        n.crossDomain && (n.contents.script = !1)
    }), i.ajaxSetup({
        accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
        contents: {script: /\b(?:java|ecma)script\b/},
        converters: {
            "text script": function (n) {
                return i.globalEval(n), n
            }
        }
    }), i.ajaxPrefilter("script", function (n) {
        void 0 === n.cache && (n.cache = !1);
        n.crossDomain && (n.type = "GET")
    }), i.ajaxTransport("script", function (n) {
        if (n.crossDomain) {
            var r, t;
            return {
                send: function (u, e) {
                    r = i("<script>").prop({charset: n.scriptCharset, src: n.url}).on("load error", t = function (n) {
                        r.remove();
                        t = null;
                        n && e("error" === n.type ? 404 : 200, n.type)
                    });
                    f.head.appendChild(r[0])
                }, abort: function () {
                    t && t()
                }
            }
        }
    }), fr = [], oi = /(=)\?(?=&|$)|\?\?/, i.ajaxSetup({
        jsonp: "callback", jsonpCallback: function () {
            var n = fr.pop() || i.expando + "_" + sf++;
            return this[n] = !0, n
        }
    }), i.ajaxPrefilter("json jsonp", function (t, r, f) {
        var e, o, s,
            h = !1 !== t.jsonp && (oi.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && oi.test(t.data) && "data");
        if (h || "jsonp" === t.dataTypes[0])return e = t.jsonpCallback = u(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, h ? t[h] = t[h].replace(oi, "$1" + e) : !1 !== t.jsonp && (t.url += (nr.test(t.url) ? "&" : "?") + t.jsonp + "=" + e), t.converters["script json"] = function () {
            return s || i.error(e + " was not called"), s[0]
        }, t.dataTypes[0] = "json", o = n[e], n[e] = function () {
            s = arguments
        }, f.always(function () {
            void 0 === o ? i(n).removeProp(e) : n[e] = o;
            t[e] && (t.jsonpCallback = r.jsonpCallback, fr.push(e));
            s && u(o) && o(s[0]);
            s = o = void 0
        }), "script"
    }), e.createHTMLDocument = function () {
        var n = f.implementation.createHTMLDocument("").body;
        return n.innerHTML = "<form><\/form><form><\/form>", 2 === n.childNodes.length
    }(), i.parseHTML = function (n, t, r) {
        if ("string" != typeof n)return [];
        "boolean" == typeof t && (r = t, t = !1);
        var s, u, o;
        return t || (e.createHTMLDocument ? ((s = (t = f.implementation.createHTMLDocument("")).createElement("base")).href = f.location.href, t.head.appendChild(s)) : t = f), u = ci.exec(n), o = !r && [], u ? [t.createElement(u[1])] : (u = eu([n], t, o), o && o.length && i(o).remove(), i.merge([], u.childNodes))
    }, i.fn.load = function (n, t, r) {
        var f, s, h, e = this, o = n.indexOf(" ");
        return o > -1 && (f = g(n.slice(o)), n = n.slice(0, o)), u(t) ? (r = t, t = void 0) : t && "object" == typeof t && (s = "POST"), e.length > 0 && i.ajax({
            url: n,
            type: s || "GET",
            dataType: "html",
            data: t
        }).done(function (n) {
            h = arguments;
            e.html(f ? i("<div>").append(i.parseHTML(n)).find(f) : n)
        }).always(r && function (n, t) {
                e.each(function () {
                    r.apply(this, h || [n.responseText, t, n])
                })
            }), this
    }, i.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (n, t) {
        i.fn[t] = function (n) {
            return this.on(t, n)
        }
    }), i.expr.pseudos.animated = function (n) {
        return i.grep(i.timers, function (t) {
            return n === t.elem
        }).length
    }, i.offset = {
        setOffset: function (n, t, r) {
            var v, o, s, h, f, c, y, l = i.css(n, "position"), a = i(n), e = {};
            "static" === l && (n.style.position = "relative");
            f = a.offset();
            s = i.css(n, "top");
            c = i.css(n, "left");
            (y = ("absolute" === l || "fixed" === l) && (s + c).indexOf("auto") > -1) ? (h = (v = a.position()).top, o = v.left) : (h = parseFloat(s) || 0, o = parseFloat(c) || 0);
            u(t) && (t = t.call(n, r, i.extend({}, f)));
            null != t.top && (e.top = t.top - f.top + h);
            null != t.left && (e.left = t.left - f.left + o);
            "using" in t ? t.using.call(n, e) : a.css(e)
        }
    }, i.fn.extend({
        offset: function (n) {
            if (arguments.length)return void 0 === n ? this : this.each(function (t) {
                i.offset.setOffset(this, n, t)
            });
            var r, u, t = this[0];
            if (t)return t.getClientRects().length ? (r = t.getBoundingClientRect(), u = t.ownerDocument.defaultView, {
                top: r.top + u.pageYOffset,
                left: r.left + u.pageXOffset
            }) : {top: 0, left: 0}
        }, position: function () {
            if (this[0]) {
                var n, r, u, t = this[0], f = {top: 0, left: 0};
                if ("fixed" === i.css(t, "position")) r = t.getBoundingClientRect(); else {
                    for (r = this.offset(), u = t.ownerDocument, n = t.offsetParent || u.documentElement; n && (n === u.body || n === u.documentElement) && "static" === i.css(n, "position");)n = n.parentNode;
                    n && n !== t && 1 === n.nodeType && ((f = i(n).offset()).top += i.css(n, "borderTopWidth", !0), f.left += i.css(n, "borderLeftWidth", !0))
                }
                return {
                    top: r.top - f.top - i.css(t, "marginTop", !0),
                    left: r.left - f.left - i.css(t, "marginLeft", !0)
                }
            }
        }, offsetParent: function () {
            return this.map(function () {
                for (var n = this.offsetParent; n && "static" === i.css(n, "position");)n = n.offsetParent;
                return n || ii
            })
        }
    }), i.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (n, t) {
        var r = "pageYOffset" === t;
        i.fn[n] = function (i) {
            return p(this, function (n, i, u) {
                var f;
                if (tt(n) ? f = n : 9 === n.nodeType && (f = n.defaultView), void 0 === u)return f ? f[t] : n[i];
                f ? f.scrollTo(r ? f.pageXOffset : u, r ? u : f.pageYOffset) : n[i] = u
            }, n, i, arguments.length)
        }
    }), i.each(["top", "left"], function (n, t) {
        i.cssHooks[t] = au(e.pixelPosition, function (n, r) {
            if (r)return r = yt(n, t), pi.test(r) ? i(n).position()[t] + "px" : r
        })
    }), i.each({Height: "height", Width: "width"}, function (n, t) {
        i.each({padding: "inner" + n, content: t, "": "outer" + n}, function (r, u) {
            i.fn[u] = function (f, e) {
                var o = arguments.length && (r || "boolean" != typeof f),
                    s = r || (!0 === f || !0 === e ? "margin" : "border");
                return p(this, function (t, r, f) {
                    var e;
                    return tt(t) ? 0 === u.indexOf("outer") ? t["inner" + n] : t.document.documentElement["client" + n] : 9 === t.nodeType ? (e = t.documentElement, Math.max(t.body["scroll" + n], e["scroll" + n], t.body["offset" + n], e["offset" + n], e["client" + n])) : void 0 === f ? i.css(t, r, s) : i.style(t, r, f, s)
                }, t, o ? f : void 0, o)
            }
        })
    }), i.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function (n, t) {
        i.fn[t] = function (n, i) {
            return arguments.length > 0 ? this.on(t, null, n, i) : this.trigger(t)
        }
    }), i.fn.extend({
        hover: function (n, t) {
            return this.mouseenter(n).mouseleave(t || n)
        }
    }), i.fn.extend({
        bind: function (n, t, i) {
            return this.on(n, null, t, i)
        }, unbind: function (n, t) {
            return this.off(n, null, t)
        }, delegate: function (n, t, i, r) {
            return this.on(t, n, i, r)
        }, undelegate: function (n, t, i) {
            return 1 === arguments.length ? this.off(n, "**") : this.off(t, n || "**", i)
        }
    }), i.proxy = function (n, t) {
        var f, e, r;
        if ("string" == typeof t && (f = n[t], t = n, n = f), u(n))return e = d.call(arguments, 2), r = function () {
            return n.apply(t || this, e.concat(d.call(arguments)))
        }, r.guid = n.guid = n.guid || i.guid++, r
    }, i.holdReady = function (n) {
        n ? i.readyWait++ : i.ready(!0)
    }, i.isArray = Array.isArray, i.parseJSON = JSON.parse, i.nodeName = v, i.isFunction = u, i.isWindow = tt, i.camelCase = y, i.type = it, i.now = Date.now, i.isNumeric = function (n) {
        var t = i.type(n);
        return ("number" === t || "string" === t) && !isNaN(n - parseFloat(n))
    }, "function" == typeof define && define.amd && define("jquery", [], function () {
        return i
    }), pf = n.jQuery, wf = n.$, i.noConflict = function (t) {
        return n.$ === i && (n.$ = wf), t && n.jQuery === i && (n.jQuery = pf), i
    }, t || (n.jQuery = n.$ = i), i
}), function (n, t, i, r, u, f, e) {
    n.GoogleAnalyticsObject = u;
    n[u] = n[u] || function () {
            (n[u].q = n[u].q || []).push(arguments)
        };
    n[u].l = 1 * new Date;
    f = t.createElement(i);
    e = t.getElementsByTagName(i)[0];
    f.async = 1;
    f.src = r;
    e.parentNode.insertBefore(f, e)
}(window, document, "script", "https://www.google-analytics.com/analytics.js", "ga");
ga("create", "UA-36178016-1", "auto");
ga("send", "pageview");
!function (n, t) {
    "function" == typeof define && define.amd ? define("jquery-bridget/jquery-bridget", ["jquery"], function (i) {
        return t(n, i)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("jquery")) : n.jQueryBridget = t(n, n.jQuery)
}(window, function (n, t) {
    "use strict";
    function u(i, u, o) {
        (o = o || t || n.jQuery) && (u.prototype.option || (u.prototype.option = function (n) {
            o.isPlainObject(n) && (this.options = o.extend(!0, this.options, n))
        }), o.fn[i] = function (n) {
            return "string" == typeof n ? function (n, t, u) {
                var f, e = "$()." + i + '("' + t + '")';
                return n.each(function (n, s) {
                    var h = o.data(s, i), c, l;
                    h ? (c = h[t], c && "_" != t.charAt(0) ? (l = c.apply(h, u), f = void 0 === f ? l : f) : r(e + " is not a valid method")) : r(i + " not initialized. Cannot call methods, i.e. " + e)
                }), void 0 !== f ? f : n
            }(this, n, e.call(arguments, 1)) : (function (n, t) {
                n.each(function (n, r) {
                    var f = o.data(r, i);
                    f ? (f.option(t), f._init()) : (f = new u(r, t), o.data(r, i, f))
                })
            }(this, n), this)
        }, f(o))
    }

    function f(n) {
        !n || n && n.bridget || (n.bridget = u)
    }

    var e = Array.prototype.slice, i = n.console, r = void 0 === i ? function () {
    } : function (n) {
        i.error(n)
    };
    return f(t || n.jQuery), u
}), function (n, t) {
    "function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", t) : "object" == typeof module && module.exports ? module.exports = t() : n.EvEmitter = t()
}("undefined" != typeof window ? window : this, function () {
    function t() {
    }

    var n = t.prototype;
    return n.on = function (n, t) {
        if (n && t) {
            var i = this._events = this._events || {}, r = i[n] = i[n] || [];
            return -1 == r.indexOf(t) && r.push(t), this
        }
    }, n.once = function (n, t) {
        if (n && t) {
            this.on(n, t);
            var i = this._onceEvents = this._onceEvents || {};
            return (i[n] = i[n] || {})[t] = !0, this
        }
    }, n.off = function (n, t) {
        var i = this._events && this._events[n], r;
        if (i && i.length)return r = i.indexOf(t), -1 != r && i.splice(r, 1), this
    }, n.emitEvent = function (n, t) {
        var i = this._events && this._events[n], u, f, r;
        if (i && i.length) {
            for (i = i.slice(0), t = t || [], u = this._onceEvents && this._onceEvents[n], f = 0; f < i.length; f++)r = i[f], u && u[r] && (this.off(n, r), delete u[r]), r.apply(this, t);
            return this
        }
    }, n.allOff = function () {
        delete this._events;
        delete this._onceEvents
    }, t
}), function (n, t) {
    "function" == typeof define && define.amd ? define("get-size/get-size", t) : "object" == typeof module && module.exports ? module.exports = t() : n.getSize = t()
}(window, function () {
    "use strict";
    function n(n) {
        var t = parseFloat(n);
        return -1 == n.indexOf("%") && !isNaN(t) && t
    }

    function u(n) {
        var t = getComputedStyle(n);
        return t || o("Style returned " + t + ". Are you running this code in a hidden iframe on Firefox? See https://bit.ly/getsizebug1"), t
    }

    function e(o) {
        var h, s, a, c, l;
        if (function () {
                var t, r, o;
                f || (f = !0, t = document.createElement("div"), t.style.width = "200px", t.style.padding = "1px 2px 3px 4px", t.style.borderStyle = "solid", t.style.borderWidth = "1px 2px 3px 4px", t.style.boxSizing = "border-box", r = document.body || document.documentElement, r.appendChild(t), o = u(t), i = 200 == Math.round(n(o.width)), e.isBoxSizeOuter = i, r.removeChild(t))
            }(), "string" == typeof o && (o = document.querySelector(o)), o && "object" == typeof o && o.nodeType) {
            if (h = u(o), "none" == h.display)return function () {
                for (var i = {
                    width: 0,
                    height: 0,
                    innerWidth: 0,
                    innerHeight: 0,
                    outerWidth: 0,
                    outerHeight: 0
                }, n = 0; n < r; n++)i[t[n]] = 0;
                return i
            }();
            for (s = {}, s.width = o.offsetWidth, s.height = o.offsetHeight, a = s.isBorderBox = "border-box" == h.boxSizing, c = 0; c < r; c++) {
                var v = t[c], nt = h[v], y = parseFloat(nt);
                s[v] = isNaN(y) ? 0 : y
            }
            var p = s.paddingLeft + s.paddingRight, w = s.paddingTop + s.paddingBottom,
                tt = s.marginLeft + s.marginRight, it = s.marginTop + s.marginBottom,
                b = s.borderLeftWidth + s.borderRightWidth, k = s.borderTopWidth + s.borderBottomWidth, d = a && i,
                g = n(h.width);
            return !1 !== g && (s.width = g + (d ? 0 : p + b)), l = n(h.height), !1 !== l && (s.height = l + (d ? 0 : w + k)), s.innerWidth = s.width - (p + b), s.innerHeight = s.height - (w + k), s.outerWidth = s.width + tt, s.outerHeight = s.height + it, s
        }
    }

    var o = "undefined" == typeof console ? function () {
        } : function (n) {
            console.error(n)
        },
        t = ["paddingLeft", "paddingRight", "paddingTop", "paddingBottom", "marginLeft", "marginRight", "marginTop", "marginBottom", "borderLeftWidth", "borderRightWidth", "borderTopWidth", "borderBottomWidth"],
        r = t.length, i, f = !1;
    return e
}), function (n, t) {
    "use strict";
    "function" == typeof define && define.amd ? define("desandro-matches-selector/matches-selector", t) : "object" == typeof module && module.exports ? module.exports = t() : n.matchesSelector = t()
}(window, function () {
    "use strict";
    var n = function () {
        var t = window.Element.prototype, i, n, r;
        if (t.matches)return "matches";
        if (t.matchesSelector)return "matchesSelector";
        for (i = ["webkit", "moz", "ms", "o"], n = 0; n < i.length; n++)if (r = i[n] + "MatchesSelector", t[r])return r
    }();
    return function (t, i) {
        return t[n](i)
    }
}), function (n, t) {
    "function" == typeof define && define.amd ? define("fizzy-ui-utils/utils", ["desandro-matches-selector/matches-selector"], function (i) {
        return t(n, i)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("desandro-matches-selector")) : n.fizzyUIUtils = t(n, n.matchesSelector)
}(window, function (n, t) {
    var i = {
        extend: function (n, t) {
            for (var i in t)n[i] = t[i];
            return n
        }, modulo: function (n, t) {
            return (n % t + t) % t
        }
    }, u = Array.prototype.slice, r;
    return i.makeArray = function (n) {
        return Array.isArray(n) ? n : null == n ? [] : "object" == typeof n && "number" == typeof n.length ? u.call(n) : [n]
    }, i.removeFrom = function (n, t) {
        var i = n.indexOf(t);
        -1 != i && n.splice(i, 1)
    }, i.getParent = function (n, i) {
        for (; n.parentNode && n != document.body;)if (n = n.parentNode, t(n, i))return n
    }, i.getQueryElement = function (n) {
        return "string" == typeof n ? document.querySelector(n) : n
    }, i.handleEvent = function (n) {
        var t = "on" + n.type;
        this[t] && this[t](n)
    }, i.filterFindElements = function (n, r) {
        n = i.makeArray(n);
        var u = [];
        return n.forEach(function (n) {
            if (n instanceof HTMLElement)if (r) {
                t(n, r) && u.push(n);
                for (var f = n.querySelectorAll(r), i = 0; i < f.length; i++)u.push(f[i])
            } else u.push(n)
        }), u
    }, i.debounceMethod = function (n, t, i) {
        i = i || 100;
        var u = n.prototype[t], r = t + "Timeout";
        n.prototype[t] = function () {
            var f = this[r], t, n;
            clearTimeout(f);
            t = arguments;
            n = this;
            this[r] = setTimeout(function () {
                u.apply(n, t);
                delete n[r]
            }, i)
        }
    }, i.docReady = function (n) {
        var t = document.readyState;
        "complete" == t || "interactive" == t ? setTimeout(n) : document.addEventListener("DOMContentLoaded", n)
    }, i.toDashed = function (n) {
        return n.replace(/(.)([A-Z])/g, function (n, t, i) {
            return t + "-" + i
        }).toLowerCase()
    }, r = n.console, i.htmlInit = function (t, u) {
        i.docReady(function () {
            var e = i.toDashed(u), f = "data-" + e, s = document.querySelectorAll("[" + f + "]"),
                h = document.querySelectorAll(".js-" + e), c = i.makeArray(s).concat(i.makeArray(h)),
                l = f + "-options", o = n.jQuery;
            c.forEach(function (n) {
                var i, e = n.getAttribute(f) || n.getAttribute(l), s;
                try {
                    i = e && JSON.parse(e)
                } catch (i) {
                    return void(r && r.error("Error parsing " + f + " on " + n.className + ": " + i))
                }
                s = new t(n, i);
                o && o.data(n, u, s)
            })
        })
    }, i
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity/js/cell", ["get-size/get-size"], function (i) {
        return t(n, i)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("get-size")) : (n.Flickity = n.Flickity || {}, n.Flickity.Cell = t(n, n.getSize))
}(window, function (n, t) {
    function r(n, t) {
        this.element = n;
        this.parent = t;
        this.create()
    }

    var i = r.prototype;
    return i.create = function () {
        this.element.style.position = "absolute";
        this.element.setAttribute("aria-hidden", "true");
        this.x = 0;
        this.shift = 0
    }, i.destroy = function () {
        this.unselect();
        this.element.style.position = "";
        var n = this.parent.originSide;
        this.element.style[n] = ""
    }, i.getSize = function () {
        this.size = t(this.element)
    }, i.setPosition = function (n) {
        this.x = n;
        this.updateTarget();
        this.renderPosition(n)
    }, i.updateTarget = i.setDefaultTarget = function () {
        var n = "left" == this.parent.originSide ? "marginLeft" : "marginRight";
        this.target = this.x + this.size[n] + this.size.width * this.parent.cellAlign
    }, i.renderPosition = function (n) {
        var t = this.parent.originSide;
        this.element.style[t] = this.parent.getPositionValue(n)
    }, i.select = function () {
        this.element.classList.add("is-selected");
        this.element.removeAttribute("aria-hidden")
    }, i.unselect = function () {
        this.element.classList.remove("is-selected");
        this.element.setAttribute("aria-hidden", "true")
    }, i.wrapShift = function (n) {
        this.shift = n;
        this.renderPosition(this.x + this.parent.slideableWidth * n)
    }, i.remove = function () {
        this.element.parentNode.removeChild(this.element)
    }, r
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity/js/slide", t) : "object" == typeof module && module.exports ? module.exports = t() : (n.Flickity = n.Flickity || {}, n.Flickity.Slide = t())
}(window, function () {
    "use strict";
    function t(n) {
        this.parent = n;
        this.isOriginLeft = "left" == n.originSide;
        this.cells = [];
        this.outerWidth = 0;
        this.height = 0
    }

    var n = t.prototype;
    return n.addCell = function (n) {
        if (this.cells.push(n), this.outerWidth += n.size.outerWidth, this.height = Math.max(n.size.outerHeight, this.height), 1 == this.cells.length) {
            this.x = n.x;
            var t = this.isOriginLeft ? "marginLeft" : "marginRight";
            this.firstMargin = n.size[t]
        }
    }, n.updateTarget = function () {
        var t = this.isOriginLeft ? "marginRight" : "marginLeft", n = this.getLastCell(), i = n ? n.size[t] : 0,
            r = this.outerWidth - (this.firstMargin + i);
        this.target = this.x + this.firstMargin + r * this.parent.cellAlign
    }, n.getLastCell = function () {
        return this.cells[this.cells.length - 1]
    }, n.select = function () {
        this.cells.forEach(function (n) {
            n.select()
        })
    }, n.unselect = function () {
        this.cells.forEach(function (n) {
            n.unselect()
        })
    }, n.getCellElements = function () {
        return this.cells.map(function (n) {
            return n.element
        })
    }, t
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity/js/animate", ["fizzy-ui-utils/utils"], function (i) {
        return t(n, i)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("fizzy-ui-utils")) : (n.Flickity = n.Flickity || {}, n.Flickity.animatePrototype = t(n, n.fizzyUIUtils))
}(window, function (n, t) {
    return {
        startAnimation: function () {
            this.isAnimating || (this.isAnimating = !0, this.restingFrames = 0, this.animate())
        }, animate: function () {
            var n, t;
            this.applyDragForce();
            this.applySelectedAttraction();
            n = this.x;
            (this.integratePhysics(), this.positionSlider(), this.settle(n), this.isAnimating) && (t = this, requestAnimationFrame(function () {
                t.animate()
            }))
        }, positionSlider: function () {
            var n = this.x;
            this.options.wrapAround && 1 < this.cells.length && (n = t.modulo(n, this.slideableWidth), n -= this.slideableWidth, this.shiftWrapCells(n));
            this.setTranslateX(n, this.isAnimating);
            this.dispatchScrollEvent()
        }, setTranslateX: function (n, t) {
            n += this.cursorPosition;
            n = this.options.rightToLeft ? -n : n;
            var i = this.getPositionValue(n);
            this.slider.style.transform = t ? "translate3d(" + i + ",0,0)" : "translateX(" + i + ")"
        }, dispatchScrollEvent: function () {
            var t = this.slides[0], n, i;
            t && (n = -this.x - t.target, i = n / this.slidesWidth, this.dispatchEvent("scroll", null, [i, n]))
        }, positionSliderAtSelected: function () {
            this.cells.length && (this.x = -this.selectedSlide.target, this.velocity = 0, this.positionSlider())
        }, getPositionValue: function (n) {
            return this.options.percentPosition ? .01 * Math.round(n / this.size.innerWidth * 1e4) + "%" : Math.round(n) + "px"
        }, settle: function (n) {
            this.isPointerDown || Math.round(100 * this.x) != Math.round(100 * n) || this.restingFrames++;
            2 < this.restingFrames && (this.isAnimating = !1, delete this.isFreeScrolling, this.positionSlider(), this.dispatchEvent("settle", null, [this.selectedIndex]))
        }, shiftWrapCells: function (n) {
            var i = this.cursorPosition + n, t;
            this._shiftCells(this.beforeShiftCells, i, -1);
            t = this.size.innerWidth - (n + this.slideableWidth + this.cursorPosition);
            this._shiftCells(this.afterShiftCells, t, 1)
        }, _shiftCells: function (n, t, i) {
            for (var u, f, r = 0; r < n.length; r++)u = n[r], f = 0 < t ? i : 0, u.wrapShift(f), t -= u.size.outerWidth
        }, _unshiftCells: function (n) {
            if (n && n.length)for (var t = 0; t < n.length; t++)n[t].wrapShift(0)
        }, integratePhysics: function () {
            this.x += this.velocity;
            this.velocity *= this.getFrictionFactor()
        }, applyForce: function (n) {
            this.velocity += n
        }, getFrictionFactor: function () {
            return 1 - this.options[this.isFreeScrolling ? "freeScrollFriction" : "friction"]
        }, getRestingPosition: function () {
            return this.x + this.velocity / (1 - this.getFrictionFactor())
        }, applyDragForce: function () {
            if (this.isDraggable && this.isPointerDown) {
                var n = this.dragX - this.x - this.velocity;
                this.applyForce(n)
            }
        }, applySelectedAttraction: function () {
            if (!(this.isDraggable && this.isPointerDown) && !this.isFreeScrolling && this.slides.length) {
                var n = (-1 * this.selectedSlide.target - this.x) * this.options.selectedAttraction;
                this.applyForce(n)
            }
        }
    }
}), function (n, t) {
    if ("function" == typeof define && define.amd) define("flickity/js/flickity", ["ev-emitter/ev-emitter", "get-size/get-size", "fizzy-ui-utils/utils", "./cell", "./slide", "./animate"], function (i, r, u, f, e, o) {
        return t(n, i, r, u, f, e, o)
    }); else if ("object" == typeof module && module.exports) module.exports = t(n, require("ev-emitter"), require("get-size"), require("fizzy-ui-utils"), require("./cell"), require("./slide"), require("./animate")); else {
        var i = n.Flickity;
        n.Flickity = t(n, n.EvEmitter, n.getSize, n.fizzyUIUtils, i.Cell, i.Slide, i.animatePrototype)
    }
}(window, function (n, t, i, r, u, f, e) {
    function a(n, t) {
        for (n = r.makeArray(n); n.length;)t.appendChild(n.shift())
    }

    function s(n, t) {
        var i = r.getQueryElement(n), u;
        if (i) {
            if (this.element = i, this.element.flickityGUID)return u = c[this.element.flickityGUID], u.option(t), u;
            h && (this.$element = h(this.element));
            this.options = r.extend({}, this.constructor.defaults);
            this.option(t);
            this._create()
        } else l && l.error("Bad element for Flickity: " + (i || n))
    }

    var h = n.jQuery, y = n.getComputedStyle, l = n.console, p = 0, c = {}, o, v;
    return s.defaults = {
        accessibility: !0,
        cellAlign: "center",
        freeScrollFriction: .075,
        friction: .28,
        namespaceJQueryEvents: !0,
        percentPosition: !0,
        resize: !0,
        selectedAttraction: .025,
        setGallerySize: !0
    }, s.createMethods = [], o = s.prototype, r.extend(o, t.prototype), o._create = function () {
        var i = this.guid = ++p, t, r;
        for (t in this.element.flickityGUID = i, (c[i] = this).selectedIndex = 0, this.restingFrames = 0, this.x = 0, this.velocity = 0, this.originSide = this.options.rightToLeft ? "right" : "left", this.viewport = document.createElement("div"), this.viewport.className = "flickity-viewport", this._createSlider(), (this.options.resize || this.options.watchCSS) && n.addEventListener("resize", this), this.options.on) {
            r = this.options.on[t];
            this.on(t, r)
        }
        s.createMethods.forEach(function (n) {
            this[n]()
        }, this);
        this.options.watchCSS ? this.watchCSS() : this.activate()
    }, o.option = function (n) {
        r.extend(this.options, n)
    }, o.activate = function () {
        this.isActive || (this.isActive = !0, this.element.classList.add("flickity-enabled"), this.options.rightToLeft && this.element.classList.add("flickity-rtl"), this.getSize(), a(this._filterFindCellElements(this.element.children), this.slider), this.viewport.appendChild(this.slider), this.element.appendChild(this.viewport), this.reloadCells(), this.options.accessibility && (this.element.tabIndex = 0, this.element.addEventListener("keydown", this)), this.emitEvent("activate"), this.selectInitialIndex(), this.isInitActivated = !0, this.dispatchEvent("ready"))
    }, o._createSlider = function () {
        var n = document.createElement("div");
        n.className = "flickity-slider";
        n.style[this.originSide] = 0;
        this.slider = n
    }, o._filterFindCellElements = function (n) {
        return r.filterFindElements(n, this.options.cellSelector)
    }, o.reloadCells = function () {
        this.cells = this._makeCells(this.slider.children);
        this.positionCells();
        this._getWrapShiftCells();
        this.setGallerySize()
    }, o._makeCells = function (n) {
        return this._filterFindCellElements(n).map(function (n) {
            return new u(n, this)
        }, this)
    }, o.getLastCell = function () {
        return this.cells[this.cells.length - 1]
    }, o.getLastSlide = function () {
        return this.slides[this.slides.length - 1]
    }, o.positionCells = function () {
        this._sizeCells(this.cells);
        this._positionCells(0)
    }, o._positionCells = function (n) {
        var t, u, f, i, r;
        for (n = n || 0, this.maxCellHeight = n && this.maxCellHeight || 0, t = 0, 0 < n && (u = this.cells[n - 1], t = u.x + u.size.outerWidth), f = this.cells.length, i = n; i < f; i++)r = this.cells[i], r.setPosition(t), t += r.size.outerWidth, this.maxCellHeight = Math.max(r.size.outerHeight, this.maxCellHeight);
        this.slideableWidth = t;
        this.updateSlides();
        this._containSlides();
        this.slidesWidth = f ? this.getLastSlide().target - this.slides[0].target : 0
    }, o._sizeCells = function (n) {
        n.forEach(function (n) {
            n.getSize()
        })
    }, o.updateSlides = function () {
        var n, t, i;
        (this.slides = [], this.cells.length) && (n = new f(this), this.slides.push(n), t = "left" == this.originSide ? "marginRight" : "marginLeft", i = this._getCanCellFit(), this.cells.forEach(function (r, u) {
            if (n.cells.length) {
                var e = n.outerWidth - n.firstMargin + (r.size.outerWidth - r.size[t]);
                i.call(this, u, e) || (n.updateTarget(), n = new f(this), this.slides.push(n));
                n.addCell(r)
            } else n.addCell(r)
        }, this), n.updateTarget(), this.updateSelectedSlide())
    }, o._getCanCellFit = function () {
        var n = this.options.groupCells, i, t, r;
        return n ? "number" == typeof n ? (i = parseInt(n, 10), function (n) {
            return n % i != 0
        }) : (t = "string" == typeof n && n.match(/^(\d+)%$/), r = t ? parseInt(t[1], 10) / 100 : 1, function (n, t) {
            return t <= (this.size.innerWidth + 1) * r
        }) : function () {
            return !1
        }
    }, o._init = o.reposition = function () {
        this.positionCells();
        this.positionSliderAtSelected()
    }, o.getSize = function () {
        this.size = i(this.element);
        this.setCellAlign();
        this.cursorPosition = this.size.innerWidth * this.cellAlign
    }, v = {
        center: {left: .5, right: .5},
        left: {left: 0, right: 1},
        right: {right: 0, left: 1}
    }, o.setCellAlign = function () {
        var n = v[this.options.cellAlign];
        this.cellAlign = n ? n[this.originSide] : this.options.cellAlign
    }, o.setGallerySize = function () {
        if (this.options.setGallerySize) {
            var n = this.options.adaptiveHeight && this.selectedSlide ? this.selectedSlide.height : this.maxCellHeight;
            this.viewport.style.height = n + "px"
        }
    }, o._getWrapShiftCells = function () {
        if (this.options.wrapAround) {
            this._unshiftCells(this.beforeShiftCells);
            this._unshiftCells(this.afterShiftCells);
            var n = this.cursorPosition, t = this.cells.length - 1;
            this.beforeShiftCells = this._getGapCells(n, t, -1);
            n = this.size.innerWidth - this.cursorPosition;
            this.afterShiftCells = this._getGapCells(n, 0, 1)
        }
    }, o._getGapCells = function (n, t, i) {
        for (var r, u = []; 0 < n;) {
            if (r = this.cells[t], !r)break;
            u.push(r);
            t += i;
            n -= r.size.outerWidth
        }
        return u
    }, o._containSlides = function () {
        if (this.options.contain && !this.options.wrapAround && this.cells.length) {
            var t = this.options.rightToLeft, i = t ? "marginRight" : "marginLeft",
                r = t ? "marginLeft" : "marginRight", n = this.slideableWidth - this.getLastCell().size[r],
                u = n < this.size.innerWidth, f = this.cursorPosition + this.cells[0].size[i],
                e = n - this.size.innerWidth * (1 - this.cellAlign);
            this.slides.forEach(function (t) {
                u ? t.target = n * this.cellAlign : (t.target = Math.max(t.target, f), t.target = Math.min(t.target, e))
            }, this)
        }
    }, o.dispatchEvent = function (n, t, i) {
        var f = t ? [t].concat(i) : i, r, u;
        (this.emitEvent(n, f), h && this.$element) && (r = n += this.options.namespaceJQueryEvents ? ".flickity" : "", t && (u = h.Event(t), u.type = n, r = u), this.$element.trigger(r, i))
    }, o.select = function (n, t, i) {
        if (this.isActive && (n = parseInt(n, 10), this._wrapSelect(n), (this.options.wrapAround || t) && (n = r.modulo(n, this.slides.length)), this.slides[n])) {
            var u = this.selectedIndex;
            this.selectedIndex = n;
            this.updateSelectedSlide();
            i ? this.positionSliderAtSelected() : this.startAnimation();
            this.options.adaptiveHeight && this.setGallerySize();
            this.dispatchEvent("select", null, [n]);
            n != u && this.dispatchEvent("change", null, [n]);
            this.dispatchEvent("cellSelect")
        }
    }, o._wrapSelect = function (n) {
        var t = this.slides.length;
        if (!(this.options.wrapAround && 1 < t))return n;
        var i = r.modulo(n, t), u = Math.abs(i - this.selectedIndex), f = Math.abs(i + t - this.selectedIndex),
            e = Math.abs(i - t - this.selectedIndex);
        !this.isDragSelect && f < u ? n += t : !this.isDragSelect && e < u && (n -= t);
        n < 0 ? this.x -= this.slideableWidth : t <= n && (this.x += this.slideableWidth)
    }, o.previous = function (n, t) {
        this.select(this.selectedIndex - 1, n, t)
    }, o.next = function (n, t) {
        this.select(this.selectedIndex + 1, n, t)
    }, o.updateSelectedSlide = function () {
        var n = this.slides[this.selectedIndex];
        n && (this.unselectSelectedSlide(), (this.selectedSlide = n).select(), this.selectedCells = n.cells, this.selectedElements = n.getCellElements(), this.selectedCell = n.cells[0], this.selectedElement = this.selectedElements[0])
    }, o.unselectSelectedSlide = function () {
        this.selectedSlide && this.selectedSlide.unselect()
    }, o.selectInitialIndex = function () {
        var n = this.options.initialIndex, t;
        if (this.isInitActivated) this.select(this.selectedIndex, !1, !0); else {
            if (n && "string" == typeof n && this.queryCell(n))return void this.selectCell(n, !1, !0);
            t = 0;
            n && this.slides[n] && (t = n);
            this.select(t, !1, !0)
        }
    }, o.selectCell = function (n, t, i) {
        var r = this.queryCell(n), u;
        r && (u = this.getCellSlideIndex(r), this.select(u, t, i))
    }, o.getCellSlideIndex = function (n) {
        for (var t = 0; t < this.slides.length; t++)if (-1 != this.slides[t].cells.indexOf(n))return t
    }, o.getCell = function (n) {
        for (var i, t = 0; t < this.cells.length; t++)if (i = this.cells[t], i.element == n)return i
    }, o.getCells = function (n) {
        n = r.makeArray(n);
        var t = [];
        return n.forEach(function (n) {
            var i = this.getCell(n);
            i && t.push(i)
        }, this), t
    }, o.getCellElements = function () {
        return this.cells.map(function (n) {
            return n.element
        })
    }, o.getParentCell = function (n) {
        var t = this.getCell(n);
        return t || (n = r.getParent(n, ".flickity-slider > *"), this.getCell(n))
    }, o.getAdjacentCellElements = function (n, t) {
        var f, u, i, o, e;
        if (!n)return this.selectedSlide.getCellElements();
        if (t = void 0 === t ? this.selectedIndex : t, f = this.slides.length, f <= 1 + 2 * n)return this.getCellElements();
        for (u = [], i = t - n; i <= t + n; i++)o = this.options.wrapAround ? r.modulo(i, f) : i, e = this.slides[o], e && (u = u.concat(e.getCellElements()));
        return u
    }, o.queryCell = function (n) {
        if ("number" == typeof n)return this.cells[n];
        if ("string" == typeof n) {
            if (n.match(/^[#\.]?[\d\/]/))return;
            n = this.element.querySelector(n)
        }
        return this.getCell(n)
    }, o.uiChange = function () {
        this.emitEvent("uiChange")
    }, o.childUIPointerDown = function (n) {
        "touchstart" != n.type && n.preventDefault();
        this.focus()
    }, o.onresize = function () {
        this.watchCSS();
        this.resize()
    }, r.debounceMethod(s, "onresize", 150), o.resize = function () {
        if (this.isActive) {
            this.getSize();
            this.options.wrapAround && (this.x = r.modulo(this.x, this.slideableWidth));
            this.positionCells();
            this._getWrapShiftCells();
            this.setGallerySize();
            this.emitEvent("resize");
            var n = this.selectedElements && this.selectedElements[0];
            this.selectCell(n, !1, !0)
        }
    }, o.watchCSS = function () {
        this.options.watchCSS && (-1 != y(this.element, ":after").content.indexOf("flickity") ? this.activate() : this.deactivate())
    }, o.onkeydown = function (n) {
        var i = document.activeElement && document.activeElement != this.element, t;
        this.options.accessibility && !i && (t = s.keyboardHandlers[n.keyCode], t && t.call(this))
    }, s.keyboardHandlers = {
        37: function () {
            var n = this.options.rightToLeft ? "next" : "previous";
            this.uiChange();
            this[n]()
        }, 39: function () {
            var n = this.options.rightToLeft ? "previous" : "next";
            this.uiChange();
            this[n]()
        }
    }, o.focus = function () {
        var t = n.pageYOffset;
        this.element.focus({preventScroll: !0});
        n.pageYOffset != t && n.scrollTo(n.pageXOffset, t)
    }, o.deactivate = function () {
        this.isActive && (this.element.classList.remove("flickity-enabled"), this.element.classList.remove("flickity-rtl"), this.unselectSelectedSlide(), this.cells.forEach(function (n) {
            n.destroy()
        }), this.element.removeChild(this.viewport), a(this.slider.children, this.element), this.options.accessibility && (this.element.removeAttribute("tabIndex"), this.element.removeEventListener("keydown", this)), this.isActive = !1, this.emitEvent("deactivate"))
    }, o.destroy = function () {
        this.deactivate();
        n.removeEventListener("resize", this);
        this.allOff();
        this.emitEvent("destroy");
        h && this.$element && h.removeData(this.element, "flickity");
        delete this.element.flickityGUID;
        delete c[this.guid]
    }, r.extend(o, e), s.data = function (n) {
        var t = (n = r.getQueryElement(n)) && n.flickityGUID;
        return t && c[t]
    }, r.htmlInit(s, "flickity"), h && h.bridget && h.bridget("flickity", s), s.setJQuery = function (n) {
        h = n
    }, s.Cell = u, s.Slide = f, s
}), function (n, t) {
    "function" == typeof define && define.amd ? define("unipointer/unipointer", ["ev-emitter/ev-emitter"], function (i) {
        return t(n, i)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("ev-emitter")) : n.Unipointer = t(n, n.EvEmitter)
}(window, function (n, t) {
    function r() {
    }

    var i = r.prototype = Object.create(t.prototype), u;
    return i.bindStartEvent = function (n) {
        this._bindStartEvent(n, !0)
    }, i.unbindStartEvent = function (n) {
        this._bindStartEvent(n, !1)
    }, i._bindStartEvent = function (t, i) {
        var u = (i = void 0 === i || i) ? "addEventListener" : "removeEventListener", r = "mousedown";
        n.PointerEvent ? r = "pointerdown" : "ontouchstart" in n && (r = "touchstart");
        t[u](r, this)
    }, i.handleEvent = function (n) {
        var t = "on" + n.type;
        this[t] && this[t](n)
    }, i.getTouch = function (n) {
        for (var i, t = 0; t < n.length; t++)if (i = n[t], i.identifier == this.pointerIdentifier)return i
    }, i.onmousedown = function (n) {
        var t = n.button;
        t && 0 !== t && 1 !== t || this._pointerDown(n, n)
    }, i.ontouchstart = function (n) {
        this._pointerDown(n, n.changedTouches[0])
    }, i.onpointerdown = function (n) {
        this._pointerDown(n, n)
    }, i._pointerDown = function (n, t) {
        n.button || this.isPointerDown || (this.isPointerDown = !0, this.pointerIdentifier = void 0 !== t.pointerId ? t.pointerId : t.identifier, this.pointerDown(n, t))
    }, i.pointerDown = function (n, t) {
        this._bindPostStartEvents(n);
        this.emitEvent("pointerDown", [n, t])
    }, u = {
        mousedown: ["mousemove", "mouseup"],
        touchstart: ["touchmove", "touchend", "touchcancel"],
        pointerdown: ["pointermove", "pointerup", "pointercancel"]
    }, i._bindPostStartEvents = function (t) {
        if (t) {
            var i = u[t.type];
            i.forEach(function (t) {
                n.addEventListener(t, this)
            }, this);
            this._boundPointerEvents = i
        }
    }, i._unbindPostStartEvents = function () {
        this._boundPointerEvents && (this._boundPointerEvents.forEach(function (t) {
            n.removeEventListener(t, this)
        }, this), delete this._boundPointerEvents)
    }, i.onmousemove = function (n) {
        this._pointerMove(n, n)
    }, i.onpointermove = function (n) {
        n.pointerId == this.pointerIdentifier && this._pointerMove(n, n)
    }, i.ontouchmove = function (n) {
        var t = this.getTouch(n.changedTouches);
        t && this._pointerMove(n, t)
    }, i._pointerMove = function (n, t) {
        this.pointerMove(n, t)
    }, i.pointerMove = function (n, t) {
        this.emitEvent("pointerMove", [n, t])
    }, i.onmouseup = function (n) {
        this._pointerUp(n, n)
    }, i.onpointerup = function (n) {
        n.pointerId == this.pointerIdentifier && this._pointerUp(n, n)
    }, i.ontouchend = function (n) {
        var t = this.getTouch(n.changedTouches);
        t && this._pointerUp(n, t)
    }, i._pointerUp = function (n, t) {
        this._pointerDone();
        this.pointerUp(n, t)
    }, i.pointerUp = function (n, t) {
        this.emitEvent("pointerUp", [n, t])
    }, i._pointerDone = function () {
        this._pointerReset();
        this._unbindPostStartEvents();
        this.pointerDone()
    }, i._pointerReset = function () {
        this.isPointerDown = !1;
        delete this.pointerIdentifier
    }, i.pointerDone = function () {
    }, i.onpointercancel = function (n) {
        n.pointerId == this.pointerIdentifier && this._pointerCancel(n, n)
    }, i.ontouchcancel = function (n) {
        var t = this.getTouch(n.changedTouches);
        t && this._pointerCancel(n, t)
    }, i._pointerCancel = function (n, t) {
        this._pointerDone();
        this.pointerCancel(n, t)
    }, i.pointerCancel = function (n, t) {
        this.emitEvent("pointerCancel", [n, t])
    }, r.getPointerPoint = function (n) {
        return {x: n.pageX, y: n.pageY}
    }, r
}), function (n, t) {
    "function" == typeof define && define.amd ? define("unidragger/unidragger", ["unipointer/unipointer"], function (i) {
        return t(n, i)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("unipointer")) : n.Unidragger = t(n, n.Unipointer)
}(window, function (n, t) {
    function r() {
    }

    var i = r.prototype = Object.create(t.prototype), u, f;
    return i.bindHandles = function () {
        this._bindHandles(!0)
    }, i.unbindHandles = function () {
        this._bindHandles(!1)
    }, i._bindHandles = function (t) {
        for (var i, u = (t = void 0 === t || t) ? "addEventListener" : "removeEventListener", f = t ? this._touchActionValue : "", r = 0; r < this.handles.length; r++)i = this.handles[r], this._bindStartEvent(i, t), i[u]("click", this), n.PointerEvent && (i.style.touchAction = f)
    }, i._touchActionValue = "none", i.pointerDown = function (n, t) {
        this.okayPointerDown(n) && (this.pointerDownPointer = t, n.preventDefault(), this.pointerDownBlur(), this._bindPostStartEvents(n), this.emitEvent("pointerDown", [n, t]))
    }, u = {TEXTAREA: !0, INPUT: !0, SELECT: !0, OPTION: !0}, f = {
        radio: !0,
        checkbox: !0,
        button: !0,
        submit: !0,
        image: !0,
        file: !0
    }, i.okayPointerDown = function (n) {
        var i = u[n.target.nodeName], r = f[n.target.type], t = !i || r;
        return t || this._pointerReset(), t
    }, i.pointerDownBlur = function () {
        var n = document.activeElement;
        n && n.blur && n != document.body && n.blur()
    }, i.pointerMove = function (n, t) {
        var i = this._dragPointerMove(n, t);
        this.emitEvent("pointerMove", [n, t, i]);
        this._dragMove(n, t, i)
    }, i._dragPointerMove = function (n, t) {
        var i = {x: t.pageX - this.pointerDownPointer.pageX, y: t.pageY - this.pointerDownPointer.pageY};
        return !this.isDragging && this.hasDragStarted(i) && this._dragStart(n, t), i
    }, i.hasDragStarted = function (n) {
        return 3 < Math.abs(n.x) || 3 < Math.abs(n.y)
    }, i.pointerUp = function (n, t) {
        this.emitEvent("pointerUp", [n, t]);
        this._dragPointerUp(n, t)
    }, i._dragPointerUp = function (n, t) {
        this.isDragging ? this._dragEnd(n, t) : this._staticClick(n, t)
    }, i._dragStart = function (n, t) {
        this.isDragging = !0;
        this.isPreventingClicks = !0;
        this.dragStart(n, t)
    }, i.dragStart = function (n, t) {
        this.emitEvent("dragStart", [n, t])
    }, i._dragMove = function (n, t, i) {
        this.isDragging && this.dragMove(n, t, i)
    }, i.dragMove = function (n, t, i) {
        n.preventDefault();
        this.emitEvent("dragMove", [n, t, i])
    }, i._dragEnd = function (n, t) {
        this.isDragging = !1;
        setTimeout(function () {
            delete this.isPreventingClicks
        }.bind(this));
        this.dragEnd(n, t)
    }, i.dragEnd = function (n, t) {
        this.emitEvent("dragEnd", [n, t])
    }, i.onclick = function (n) {
        this.isPreventingClicks && n.preventDefault()
    }, i._staticClick = function (n, t) {
        this.isIgnoringMouseUp && "mouseup" == n.type || (this.staticClick(n, t), "mouseup" != n.type && (this.isIgnoringMouseUp = !0, setTimeout(function () {
            delete this.isIgnoringMouseUp
        }.bind(this), 400)))
    }, i.staticClick = function (n, t) {
        this.emitEvent("staticClick", [n, t])
    }, r.getPointerPoint = t.getPointerPoint, r
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity/js/drag", ["./flickity", "unidragger/unidragger", "fizzy-ui-utils/utils"], function (i, r, u) {
        return t(n, i, r, u)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("./flickity"), require("unidragger"), require("fizzy-ui-utils")) : n.Flickity = t(n, n.Flickity, n.Unidragger, n.fizzyUIUtils)
}(window, function (n, t, i, r) {
    function s() {
        return {x: n.pageXOffset, y: n.pageYOffset}
    }

    var u, o, f, e;
    return r.extend(t.defaults, {
        draggable: ">1",
        dragThreshold: 3
    }), t.createMethods.push("_createDrag"), u = t.prototype, r.extend(u, i.prototype), u._touchActionValue = "pan-y", o = "createTouch" in document, f = !1, u._createDrag = function () {
        this.on("activate", this.onActivateDrag);
        this.on("uiChange", this._uiChangeDrag);
        this.on("deactivate", this.onDeactivateDrag);
        this.on("cellChange", this.updateDraggable);
        o && !f && (n.addEventListener("touchmove", function () {
        }), f = !0)
    }, u.onActivateDrag = function () {
        this.handles = [this.viewport];
        this.bindHandles();
        this.updateDraggable()
    }, u.onDeactivateDrag = function () {
        this.unbindHandles();
        this.element.classList.remove("is-draggable")
    }, u.updateDraggable = function () {
        this.isDraggable = ">1" == this.options.draggable ? 1 < this.slides.length : this.options.draggable;
        this.isDraggable ? this.element.classList.add("is-draggable") : this.element.classList.remove("is-draggable")
    }, u.bindDrag = function () {
        this.options.draggable = !0;
        this.updateDraggable()
    }, u.unbindDrag = function () {
        this.options.draggable = !1;
        this.updateDraggable()
    }, u._uiChangeDrag = function () {
        delete this.isFreeScrolling
    }, u.pointerDown = function (t, i) {
        this.isDraggable ? this.okayPointerDown(t) && (this._pointerDownPreventDefault(t), this.pointerDownFocus(t), document.activeElement != this.element && this.pointerDownBlur(), this.dragX = this.x, this.viewport.classList.add("is-pointer-down"), this.pointerDownScroll = s(), n.addEventListener("scroll", this), this._pointerDownDefault(t, i)) : this._pointerDownDefault(t, i)
    }, u._pointerDownDefault = function (n, t) {
        this.pointerDownPointer = {pageX: t.pageX, pageY: t.pageY};
        this._bindPostStartEvents(n);
        this.dispatchEvent("pointerDown", n, [t])
    }, e = {INPUT: !0, TEXTAREA: !0, SELECT: !0}, u.pointerDownFocus = function (n) {
        e[n.target.nodeName] || this.focus()
    }, u._pointerDownPreventDefault = function (n) {
        var t = "touchstart" == n.type, i = "touch" == n.pointerType, r = e[n.target.nodeName];
        t || i || r || n.preventDefault()
    }, u.hasDragStarted = function (n) {
        return Math.abs(n.x) > this.options.dragThreshold
    }, u.pointerUp = function (n, t) {
        delete this.isTouchScrolling;
        this.viewport.classList.remove("is-pointer-down");
        this.dispatchEvent("pointerUp", n, [t]);
        this._dragPointerUp(n, t)
    }, u.pointerDone = function () {
        n.removeEventListener("scroll", this);
        delete this.pointerDownScroll
    }, u.dragStart = function (t, i) {
        this.isDraggable && (this.dragStartPosition = this.x, this.startAnimation(), n.removeEventListener("scroll", this), this.dispatchEvent("dragStart", t, [i]))
    }, u.pointerMove = function (n, t) {
        var i = this._dragPointerMove(n, t);
        this.dispatchEvent("pointerMove", n, [t, i]);
        this._dragMove(n, t, i)
    }, u.dragMove = function (n, t, i) {
        var e, r, u, f;
        this.isDraggable && (n.preventDefault(), this.previousDragX = this.dragX, e = this.options.rightToLeft ? -1 : 1, this.options.wrapAround && (i.x = i.x % this.slideableWidth), r = this.dragStartPosition + i.x * e, !this.options.wrapAround && this.slides.length && (u = Math.max(-this.slides[0].target, this.dragStartPosition), r = u < r ? .5 * (r + u) : r, f = Math.min(-this.getLastSlide().target, this.dragStartPosition), r = r < f ? .5 * (r + f) : r), this.dragX = r, this.dragMoveTime = new Date, this.dispatchEvent("dragMove", n, [t, i]))
    }, u.dragEnd = function (n, t) {
        var i, r;
        this.isDraggable && (this.options.freeScroll && (this.isFreeScrolling = !0), i = this.dragEndRestingSelect(), this.options.freeScroll && !this.options.wrapAround ? (r = this.getRestingPosition(), this.isFreeScrolling = -r > this.slides[0].target && -r < this.getLastSlide().target) : this.options.freeScroll || i != this.selectedIndex || (i += this.dragEndBoostSelect()), delete this.previousDragX, this.isDragSelect = this.options.wrapAround, this.select(i), delete this.isDragSelect, this.dispatchEvent("dragEnd", n, [t]))
    }, u.dragEndRestingSelect = function () {
        var n = this.getRestingPosition(), t = Math.abs(this.getSlideDistance(-n, this.selectedIndex)),
            i = this._getClosestResting(n, t, 1), r = this._getClosestResting(n, t, -1);
        return i.distance < r.distance ? i.index : r.index
    }, u._getClosestResting = function (n, t, i) {
        for (var r = this.selectedIndex, u = 1 / 0, f = this.options.contain && !this.options.wrapAround ? function (n, t) {
            return n <= t
        } : function (n, t) {
            return n < t
        }; f(t, u) && (r += i, u = t, null !== (t = this.getSlideDistance(-n, r)));)t = Math.abs(t);
        return {distance: u, index: r - i}
    }, u.getSlideDistance = function (n, t) {
        var i = this.slides.length, u = this.options.wrapAround && 1 < i, o = u ? r.modulo(t, i) : t,
            f = this.slides[o], e;
        return f ? (e = u ? this.slideableWidth * Math.floor(t / i) : 0, n - (f.target + e)) : null
    }, u.dragEndBoostSelect = function () {
        if (void 0 === this.previousDragX || !this.dragMoveTime || 100 < new Date - this.dragMoveTime)return 0;
        var n = this.getSlideDistance(-this.dragX, this.selectedIndex), t = this.previousDragX - this.dragX;
        return 0 < n && 0 < t ? 1 : n < 0 && t < 0 ? -1 : 0
    }, u.staticClick = function (n, t) {
        var i = this.getParentCell(n.target), r = i && i.element, u = i && this.cells.indexOf(i);
        this.dispatchEvent("staticClick", n, [t, r, u])
    }, u.onscroll = function () {
        var n = s(), t = this.pointerDownScroll.x - n.x, i = this.pointerDownScroll.y - n.y;
        (3 < Math.abs(t) || 3 < Math.abs(i)) && this._pointerDone()
    }, t
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity/js/prev-next-button", ["./flickity", "unipointer/unipointer", "fizzy-ui-utils/utils"], function (i, r, u) {
        return t(n, i, r, u)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("./flickity"), require("unipointer"), require("fizzy-ui-utils")) : t(n, n.Flickity, n.Unipointer, n.fizzyUIUtils)
}(window, function (n, t, i, r) {
    "use strict";
    function u(n, t) {
        this.direction = n;
        this.parent = t;
        this._create()
    }

    var e = "http://www.w3.org/2000/svg", f;
    return (u.prototype = Object.create(i.prototype))._create = function () {
        var t, n, i;
        this.isEnabled = !0;
        this.isPrevious = -1 == this.direction;
        t = this.parent.options.rightToLeft ? 1 : -1;
        this.isLeft = this.direction == t;
        n = this.element = document.createElement("button");
        n.className = "flickity-button flickity-prev-next-button";
        n.className += this.isPrevious ? " previous" : " next";
        n.setAttribute("type", "button");
        this.disable();
        n.setAttribute("aria-label", this.isPrevious ? "Previous" : "Next");
        i = this.createSVG();
        n.appendChild(i);
        this.parent.on("select", this.update.bind(this));
        this.on("pointerDown", this.parent.childUIPointerDown.bind(this.parent))
    }, u.prototype.activate = function () {
        this.bindStartEvent(this.element);
        this.element.addEventListener("click", this);
        this.parent.element.appendChild(this.element)
    }, u.prototype.deactivate = function () {
        this.parent.element.removeChild(this.element);
        this.unbindStartEvent(this.element);
        this.element.removeEventListener("click", this)
    }, u.prototype.createSVG = function () {
        var t = document.createElementNS(e, "svg"), n, i;
        return t.setAttribute("class", "flickity-button-icon"), t.setAttribute("viewBox", "0 0 100 100"), n = document.createElementNS(e, "path"), i = function (n) {
            return "string" != typeof n ? "M " + n.x0 + ",50 L " + n.x1 + "," + (n.y1 + 50) + " L " + n.x2 + "," + (n.y2 + 50) + " L " + n.x3 + ",50  L " + n.x2 + "," + (50 - n.y2) + " L " + n.x1 + "," + (50 - n.y1) + " Z" : n
        }(this.parent.options.arrowShape), n.setAttribute("d", i), n.setAttribute("class", "arrow"), this.isLeft || n.setAttribute("transform", "translate(100, 100) rotate(180) "), t.appendChild(n), t
    }, u.prototype.handleEvent = r.handleEvent, u.prototype.onclick = function () {
        if (this.isEnabled) {
            this.parent.uiChange();
            var n = this.isPrevious ? "previous" : "next";
            this.parent[n]()
        }
    }, u.prototype.enable = function () {
        this.isEnabled || (this.element.disabled = !1, this.isEnabled = !0)
    }, u.prototype.disable = function () {
        this.isEnabled && (this.element.disabled = !0, this.isEnabled = !1)
    }, u.prototype.update = function () {
        var n = this.parent.slides, t, i;
        this.parent.options.wrapAround && 1 < n.length ? this.enable() : (t = n.length ? n.length - 1 : 0, i = this.isPrevious ? 0 : t, this[this.parent.selectedIndex == i ? "disable" : "enable"]())
    }, u.prototype.destroy = function () {
        this.deactivate();
        this.allOff()
    }, r.extend(t.defaults, {
        prevNextButtons: !0,
        arrowShape: {x0: 10, x1: 60, y1: 50, x2: 70, y2: 40, x3: 30}
    }), t.createMethods.push("_createPrevNextButtons"), f = t.prototype, f._createPrevNextButtons = function () {
        this.options.prevNextButtons && (this.prevButton = new u(-1, this), this.nextButton = new u(1, this), this.on("activate", this.activatePrevNextButtons))
    }, f.activatePrevNextButtons = function () {
        this.prevButton.activate();
        this.nextButton.activate();
        this.on("deactivate", this.deactivatePrevNextButtons)
    }, f.deactivatePrevNextButtons = function () {
        this.prevButton.deactivate();
        this.nextButton.deactivate();
        this.off("deactivate", this.deactivatePrevNextButtons)
    }, t.PrevNextButton = u, t
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity/js/page-dots", ["./flickity", "unipointer/unipointer", "fizzy-ui-utils/utils"], function (i, r, u) {
        return t(n, i, r, u)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("./flickity"), require("unipointer"), require("fizzy-ui-utils")) : t(n, n.Flickity, n.Unipointer, n.fizzyUIUtils)
}(window, function (n, t, i, r) {
    function u(n) {
        this.parent = n;
        this._create()
    }

    (u.prototype = Object.create(i.prototype))._create = function () {
        this.holder = document.createElement("ol");
        this.holder.className = "flickity-page-dots";
        this.dots = [];
        this.handleClick = this.onClick.bind(this);
        this.on("pointerDown", this.parent.childUIPointerDown.bind(this.parent))
    };
    u.prototype.activate = function () {
        this.setDots();
        this.holder.addEventListener("click", this.handleClick);
        this.bindStartEvent(this.holder);
        this.parent.element.appendChild(this.holder)
    };
    u.prototype.deactivate = function () {
        this.holder.removeEventListener("click", this.handleClick);
        this.unbindStartEvent(this.holder);
        this.parent.element.removeChild(this.holder)
    };
    u.prototype.setDots = function () {
        var n = this.parent.slides.length - this.dots.length;
        0 < n ? this.addDots(n) : n < 0 && this.removeDots(-n)
    };
    u.prototype.addDots = function (n) {
        for (var t, r = document.createDocumentFragment(), u = [], f = this.dots.length, e = f + n, i = f; i < e; i++)t = document.createElement("li"), t.className = "dot", t.setAttribute("aria-label", "Page dot " + (i + 1)), r.appendChild(t), u.push(t);
        this.holder.appendChild(r);
        this.dots = this.dots.concat(u)
    };
    u.prototype.removeDots = function (n) {
        this.dots.splice(this.dots.length - n, n).forEach(function (n) {
            this.holder.removeChild(n)
        }, this)
    };
    u.prototype.updateSelected = function () {
        this.selectedDot && (this.selectedDot.className = "dot", this.selectedDot.removeAttribute("aria-current"));
        this.dots.length && (this.selectedDot = this.dots[this.parent.selectedIndex], this.selectedDot.className = "dot is-selected", this.selectedDot.setAttribute("aria-current", "step"))
    };
    u.prototype.onTap = u.prototype.onClick = function (n) {
        var t = n.target, i;
        "LI" == t.nodeName && (this.parent.uiChange(), i = this.dots.indexOf(t), this.parent.select(i))
    };
    u.prototype.destroy = function () {
        this.deactivate();
        this.allOff()
    };
    t.PageDots = u;
    r.extend(t.defaults, {pageDots: !0});
    t.createMethods.push("_createPageDots");
    var f = t.prototype;
    return f._createPageDots = function () {
        this.options.pageDots && (this.pageDots = new u(this), this.on("activate", this.activatePageDots), this.on("select", this.updateSelectedPageDots), this.on("cellChange", this.updatePageDots), this.on("resize", this.updatePageDots), this.on("deactivate", this.deactivatePageDots))
    }, f.activatePageDots = function () {
        this.pageDots.activate()
    }, f.updateSelectedPageDots = function () {
        this.pageDots.updateSelected()
    }, f.updatePageDots = function () {
        this.pageDots.setDots()
    }, f.deactivatePageDots = function () {
        this.pageDots.deactivate()
    }, t.PageDots = u, t
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity/js/player", ["ev-emitter/ev-emitter", "fizzy-ui-utils/utils", "./flickity"], function (n, i, r) {
        return t(n, i, r)
    }) : "object" == typeof module && module.exports ? module.exports = t(require("ev-emitter"), require("fizzy-ui-utils"), require("./flickity")) : t(n.EvEmitter, n.fizzyUIUtils, n.Flickity)
}(window, function (n, t, i) {
    function r(n) {
        this.parent = n;
        this.state = "stopped";
        this.onVisibilityChange = this.visibilityChange.bind(this);
        this.onVisibilityPlay = this.visibilityPlay.bind(this)
    }

    (r.prototype = Object.create(n.prototype)).play = function () {
        "playing" != this.state && (document.hidden ? document.addEventListener("visibilitychange", this.onVisibilityPlay) : (this.state = "playing", document.addEventListener("visibilitychange", this.onVisibilityChange), this.tick()))
    };
    r.prototype.tick = function () {
        var n, t;
        "playing" == this.state && (n = this.parent.options.autoPlay, n = "number" == typeof n ? n : 3e3, t = this, this.clear(), this.timeout = setTimeout(function () {
            t.parent.next(!0);
            t.tick()
        }, n))
    };
    r.prototype.stop = function () {
        this.state = "stopped";
        this.clear();
        document.removeEventListener("visibilitychange", this.onVisibilityChange)
    };
    r.prototype.clear = function () {
        clearTimeout(this.timeout)
    };
    r.prototype.pause = function () {
        "playing" == this.state && (this.state = "paused", this.clear())
    };
    r.prototype.unpause = function () {
        "paused" == this.state && this.play()
    };
    r.prototype.visibilityChange = function () {
        this[document.hidden ? "pause" : "unpause"]()
    };
    r.prototype.visibilityPlay = function () {
        this.play();
        document.removeEventListener("visibilitychange", this.onVisibilityPlay)
    };
    t.extend(i.defaults, {pauseAutoPlayOnHover: !0});
    i.createMethods.push("_createPlayer");
    var u = i.prototype;
    return u._createPlayer = function () {
        this.player = new r(this);
        this.on("activate", this.activatePlayer);
        this.on("uiChange", this.stopPlayer);
        this.on("pointerDown", this.stopPlayer);
        this.on("deactivate", this.deactivatePlayer)
    }, u.activatePlayer = function () {
        this.options.autoPlay && (this.player.play(), this.element.addEventListener("mouseenter", this))
    }, u.playPlayer = function () {
        this.player.play()
    }, u.stopPlayer = function () {
        this.player.stop()
    }, u.pausePlayer = function () {
        this.player.pause()
    }, u.unpausePlayer = function () {
        this.player.unpause()
    }, u.deactivatePlayer = function () {
        this.player.stop();
        this.element.removeEventListener("mouseenter", this)
    }, u.onmouseenter = function () {
        this.options.pauseAutoPlayOnHover && (this.player.pause(), this.element.addEventListener("mouseleave", this))
    }, u.onmouseleave = function () {
        this.player.unpause();
        this.element.removeEventListener("mouseleave", this)
    }, i.Player = r, i
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity/js/add-remove-cell", ["./flickity", "fizzy-ui-utils/utils"], function (i, r) {
        return t(n, i, r)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("./flickity"), require("fizzy-ui-utils")) : t(n, n.Flickity, n.fizzyUIUtils)
}(window, function (n, t, i) {
    var r = t.prototype;
    return r.insert = function (n, t) {
        var i = this._makeCells(n), r, u, f, e, o;
        i && i.length && (r = this.cells.length, t = void 0 === t ? r : t, u = function (n) {
            var t = document.createDocumentFragment();
            return n.forEach(function (n) {
                t.appendChild(n.element)
            }), t
        }(i), f = t == r, f ? this.slider.appendChild(u) : (e = this.cells[t].element, this.slider.insertBefore(u, e)), 0 === t ? this.cells = i.concat(this.cells) : f ? this.cells = this.cells.concat(i) : (o = this.cells.splice(t, r - t), this.cells = this.cells.concat(i).concat(o)), this._sizeCells(i), this.cellChange(t, !0))
    }, r.append = function (n) {
        this.insert(n, this.cells.length)
    }, r.prepend = function (n) {
        this.insert(n, 0)
    }, r.remove = function (n) {
        var r = this.getCells(n), t;
        r && r.length && (t = this.cells.length - 1, r.forEach(function (n) {
            n.remove();
            var r = this.cells.indexOf(n);
            t = Math.min(r, t);
            i.removeFrom(this.cells, n)
        }, this), this.cellChange(t, !0))
    }, r.cellSizeChange = function (n) {
        var t = this.getCell(n), i;
        t && (t.getSize(), i = this.cells.indexOf(t), this.cellChange(i))
    }, r.cellChange = function (n, t) {
        var r = this.selectedElement, i;
        this._positionCells(n);
        this._getWrapShiftCells();
        this.setGallerySize();
        i = this.getCell(r);
        i && (this.selectedIndex = this.getCellSlideIndex(i));
        this.selectedIndex = Math.min(this.slides.length - 1, this.selectedIndex);
        this.emitEvent("cellChange", [n]);
        this.select(this.selectedIndex);
        t && this.positionSliderAtSelected()
    }, t
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity/js/lazyload", ["./flickity", "fizzy-ui-utils/utils"], function (i, r) {
        return t(n, i, r)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("./flickity"), require("fizzy-ui-utils")) : t(n, n.Flickity, n.fizzyUIUtils)
}(window, function (n, t, i) {
    "use strict";
    function r(n, t) {
        this.img = n;
        this.flickity = t;
        this.load()
    }

    t.createMethods.push("_createLazyload");
    var u = t.prototype;
    return u._createLazyload = function () {
        this.on("select", this.lazyLoad)
    }, u.lazyLoad = function () {
        var n = this.options.lazyLoad;
        if (n) {
            var u = "number" == typeof n ? n : 0, f = this.getAdjacentCellElements(u), t = [];
            f.forEach(function (n) {
                var r = function (n) {
                    var t;
                    if ("IMG" == n.nodeName) {
                        var r = n.getAttribute("data-flickity-lazyload"),
                            u = n.getAttribute("data-flickity-lazyload-src"),
                            f = n.getAttribute("data-flickity-lazyload-srcset");
                        if (r || u || f)return [n]
                    }
                    return t = n.querySelectorAll("img[data-flickity-lazyload], img[data-flickity-lazyload-src], img[data-flickity-lazyload-srcset]"), i.makeArray(t)
                }(n);
                t = t.concat(r)
            });
            t.forEach(function (n) {
                new r(n, this)
            }, this)
        }
    }, r.prototype.handleEvent = i.handleEvent, r.prototype.load = function () {
        this.img.addEventListener("load", this);
        this.img.addEventListener("error", this);
        var t = this.img.getAttribute("data-flickity-lazyload") || this.img.getAttribute("data-flickity-lazyload-src"),
            n = this.img.getAttribute("data-flickity-lazyload-srcset");
        this.img.src = t;
        n && this.img.setAttribute("srcset", n);
        this.img.removeAttribute("data-flickity-lazyload");
        this.img.removeAttribute("data-flickity-lazyload-src");
        this.img.removeAttribute("data-flickity-lazyload-srcset")
    }, r.prototype.onload = function (n) {
        this.complete(n, "flickity-lazyloaded")
    }, r.prototype.onerror = function (n) {
        this.complete(n, "flickity-lazyerror")
    }, r.prototype.complete = function (n, t) {
        this.img.removeEventListener("load", this);
        this.img.removeEventListener("error", this);
        var i = this.flickity.getParentCell(this.img), r = i && i.element;
        this.flickity.cellSizeChange(r);
        this.img.classList.add(t);
        this.flickity.dispatchEvent("lazyLoad", n, r)
    }, t.LazyLoader = r, t
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity/js/index", ["./flickity", "./drag", "./prev-next-button", "./page-dots", "./player", "./add-remove-cell", "./lazyload"], t) : "object" == typeof module && module.exports && (module.exports = t(require("./flickity"), require("./drag"), require("./prev-next-button"), require("./page-dots"), require("./player"), require("./add-remove-cell"), require("./lazyload")))
}(window, function (n) {
    return n
}), function (n, t) {
    "function" == typeof define && define.amd ? define("flickity-as-nav-for/as-nav-for", ["flickity/js/index", "fizzy-ui-utils/utils"], t) : "object" == typeof module && module.exports ? module.exports = t(require("flickity"), require("fizzy-ui-utils")) : n.Flickity = t(n.Flickity, n.fizzyUIUtils)
}(window, function (n, t) {
    n.createMethods.push("_createAsNavFor");
    var i = n.prototype;
    return i._createAsNavFor = function () {
        var n, t;
        this.on("activate", this.activateAsNavFor);
        this.on("deactivate", this.deactivateAsNavFor);
        this.on("destroy", this.destroyAsNavFor);
        n = this.options.asNavFor;
        n && (t = this, setTimeout(function () {
            t.setNavCompanion(n)
        }))
    }, i.setNavCompanion = function (i) {
        var r, u;
        i = t.getQueryElement(i);
        r = n.data(i);
        r && r != this && (this.navCompanion = r, u = this, this.onNavCompanionSelect = function () {
            u.navCompanionSelect()
        }, r.on("select", this.onNavCompanionSelect), this.on("staticClick", this.onNavStaticClick), this.navCompanionSelect(!0))
    }, i.navCompanionSelect = function (n) {
        var t = this.navCompanion && this.navCompanion.selectedCells, f;
        if (t) {
            var e = t[0], i = this.navCompanion.cells.indexOf(e), r = i + t.length - 1,
                u = Math.floor(function (n, t, i) {
                    return (t - n) * i + n
                }(i, r, this.navCompanion.cellAlign));
            (this.selectCell(u, !1, n), this.removeNavSelectedElements(), u >= this.cells.length) || (f = this.cells.slice(i, 1 + r), this.navSelectedElements = f.map(function (n) {
                return n.element
            }), this.changeNavSelectedClass("add"))
        }
    }, i.changeNavSelectedClass = function (n) {
        this.navSelectedElements.forEach(function (t) {
            t.classList[n]("is-nav-selected")
        })
    }, i.activateAsNavFor = function () {
        this.navCompanionSelect(!0)
    }, i.removeNavSelectedElements = function () {
        this.navSelectedElements && (this.changeNavSelectedClass("remove"), delete this.navSelectedElements)
    }, i.onNavStaticClick = function (n, t, i, r) {
        "number" == typeof r && this.navCompanion.selectCell(r)
    }, i.deactivateAsNavFor = function () {
        this.removeNavSelectedElements()
    }, i.destroyAsNavFor = function () {
        this.navCompanion && (this.navCompanion.off("select", this.onNavCompanionSelect), this.off("staticClick", this.onNavStaticClick), delete this.navCompanion)
    }, n
}), function (n, t) {
    "use strict";
    "function" == typeof define && define.amd ? define("imagesloaded/imagesloaded", ["ev-emitter/ev-emitter"], function (i) {
        return t(n, i)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("ev-emitter")) : n.imagesLoaded = t(n, n.EvEmitter)
}("undefined" != typeof window ? window : this, function (n, t) {
    function o(n, t) {
        for (var i in t)n[i] = t[i];
        return n
    }

    function i(n, t, r) {
        if (!(this instanceof i))return new i(n, t, r);
        var f = n;
        "string" == typeof n && (f = document.querySelectorAll(n));
        f ? (this.elements = function (n) {
            return Array.isArray(n) ? n : "object" == typeof n && "number" == typeof n.length ? h.call(n) : [n]
        }(f), this.options = o({}, this.options), "function" == typeof t ? r = t : o(this.options, t), r && this.on("always", r), this.getImages(), u && (this.jqDeferred = new u.Deferred), setTimeout(this.check.bind(this))) : e.error("Bad element for imagesLoaded " + (f || n))
    }

    function r(n) {
        this.img = n
    }

    function f(n, t) {
        this.url = n;
        this.element = t;
        this.img = new Image
    }

    var u = n.jQuery, e = n.console, h = Array.prototype.slice, s;
    return (i.prototype = Object.create(t.prototype)).options = {}, i.prototype.getImages = function () {
        this.images = [];
        this.elements.forEach(this.addElementImages, this)
    }, i.prototype.addElementImages = function (n) {
        var i, r, t, f, u, e;
        if ("IMG" == n.nodeName && this.addImage(n), !0 === this.options.background && this.addElementBackgroundImages(n), i = n.nodeType, i && s[i]) {
            for (r = n.querySelectorAll("img"), t = 0; t < r.length; t++)f = r[t], this.addImage(f);
            if ("string" == typeof this.options.background)for (u = n.querySelectorAll(this.options.background), t = 0; t < u.length; t++)e = u[t], this.addElementBackgroundImages(e)
        }
    }, s = {1: !0, 9: !0, 11: !0}, i.prototype.addElementBackgroundImages = function (n) {
        var i = getComputedStyle(n), r, t, u;
        if (i)for (r = /url\((['"])?(.*?)\1\)/gi, t = r.exec(i.backgroundImage); null !== t;)u = t && t[2], u && this.addBackground(u, n), t = r.exec(i.backgroundImage)
    }, i.prototype.addImage = function (n) {
        var t = new r(n);
        this.images.push(t)
    }, i.prototype.addBackground = function (n, t) {
        var i = new f(n, t);
        this.images.push(i)
    }, i.prototype.check = function () {
        function t(t, i, r) {
            setTimeout(function () {
                n.progress(t, i, r)
            })
        }

        var n = this;
        this.progressedCount = 0;
        this.hasAnyBroken = !1;
        this.images.length ? this.images.forEach(function (n) {
            n.once("progress", t);
            n.check()
        }) : this.complete()
    }, i.prototype.progress = function (n, t, i) {
        this.progressedCount++;
        this.hasAnyBroken = this.hasAnyBroken || !n.isLoaded;
        this.emitEvent("progress", [this, n, t]);
        this.jqDeferred && this.jqDeferred.notify && this.jqDeferred.notify(this, n);
        this.progressedCount == this.images.length && this.complete();
        this.options.debug && e && e.log("progress: " + i, n, t)
    }, i.prototype.complete = function () {
        var t = this.hasAnyBroken ? "fail" : "done", n;
        (this.isComplete = !0, this.emitEvent(t, [this]), this.emitEvent("always", [this]), this.jqDeferred) && (n = this.hasAnyBroken ? "reject" : "resolve", this.jqDeferred[n](this))
    }, (r.prototype = Object.create(t.prototype)).check = function () {
        this.getIsImageComplete() ? this.confirm(0 !== this.img.naturalWidth, "naturalWidth") : (this.proxyImage = new Image, this.proxyImage.addEventListener("load", this), this.proxyImage.addEventListener("error", this), this.img.addEventListener("load", this), this.img.addEventListener("error", this), this.proxyImage.src = this.img.src)
    }, r.prototype.getIsImageComplete = function () {
        return this.img.complete && this.img.naturalWidth
    }, r.prototype.confirm = function (n, t) {
        this.isLoaded = n;
        this.emitEvent("progress", [this, this.img, t])
    }, r.prototype.handleEvent = function (n) {
        var t = "on" + n.type;
        this[t] && this[t](n)
    }, r.prototype.onload = function () {
        this.confirm(!0, "onload");
        this.unbindEvents()
    }, r.prototype.onerror = function () {
        this.confirm(!1, "onerror");
        this.unbindEvents()
    }, r.prototype.unbindEvents = function () {
        this.proxyImage.removeEventListener("load", this);
        this.proxyImage.removeEventListener("error", this);
        this.img.removeEventListener("load", this);
        this.img.removeEventListener("error", this)
    }, (f.prototype = Object.create(r.prototype)).check = function () {
        this.img.addEventListener("load", this);
        this.img.addEventListener("error", this);
        this.img.src = this.url;
        this.getIsImageComplete() && (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"), this.unbindEvents())
    }, f.prototype.unbindEvents = function () {
        this.img.removeEventListener("load", this);
        this.img.removeEventListener("error", this)
    }, f.prototype.confirm = function (n, t) {
        this.isLoaded = n;
        this.emitEvent("progress", [this, this.element, t])
    }, i.makeJQueryPlugin = function (t) {
        (t = t || n.jQuery) && ((u = t).fn.imagesLoaded = function (n, t) {
            return new i(this, n, t).jqDeferred.promise(u(this))
        })
    }, i.makeJQueryPlugin(), i
}), function (n, t) {
    "function" == typeof define && define.amd ? define(["flickity/js/index", "imagesloaded/imagesloaded"], function (i, r) {
        return t(n, i, r)
    }) : "object" == typeof module && module.exports ? module.exports = t(n, require("flickity"), require("imagesloaded")) : n.Flickity = t(n, n.Flickity, n.imagesLoaded)
}(window, function (n, t, i) {
    "use strict";
    t.createMethods.push("_createImagesLoaded");
    var r = t.prototype;
    return r._createImagesLoaded = function () {
        this.on("activate", this.imagesLoaded)
    }, r.imagesLoaded = function () {
        if (this.options.imagesLoaded) {
            var n = this;
            i(this.slider).on("progress", function (t, i) {
                var r = n.getParentCell(i.img);
                n.cellSizeChange(r && r.element);
                n.options.freeScroll || n.positionSliderAtSelected()
            })
        }
    }, t
}), function (n) {
    "use strict";
    var t = function (t, i, r) {
        function l(n) {
            if (f.body)return n();
            setTimeout(function () {
                l(n)
            })
        }

        function c() {
            u.addEventListener && u.removeEventListener("load", c);
            u.media = r || "all"
        }

        var f = n.document, u = f.createElement("link"), e, s, h, o;
        return i ? e = i : (s = (f.body || f.getElementsByTagName("head")[0]).childNodes, e = s[s.length - 1]), h = f.styleSheets, u.rel = "stylesheet", u.href = t, u.media = "only x", l(function () {
            e.parentNode.insertBefore(u, i ? e : e.nextSibling)
        }), o = function (n) {
            for (var i = u.href, t = h.length; t--;)if (h[t].href === i)return n();
            setTimeout(function () {
                o(n)
            })
        }, u.addEventListener && u.addEventListener("load", c), u.onloadcssdefined = o, o(c), u
    };
    typeof exports != "undefined" ? exports.loadCSS = t : n.loadCSS = t
}(typeof global != "undefined" ? global : this), function (n) {
    var t, i;
    n.loadCSS && (t = loadCSS.relpreload = {}, t.support = function () {
        try {
            return n.document.createElement("link").relList.supports("preload")
        } catch (t) {
            return !1
        }
    }, t.poly = function () {
        for (var r = n.document.getElementsByTagName("link"), t, i = 0; i < r.length; i++)t = r[i], t.rel === "preload" && t.getAttribute("as") === "style" && (n.loadCSS(t.href, t, t.getAttribute("media")), t.rel = null)
    }, t.support() || (t.poly(), i = n.setInterval(t.poly, 300), n.addEventListener && n.addEventListener("load", function () {
        t.poly();
        n.clearInterval(i)
    }), n.attachEvent && n.attachEvent("onload", function () {
        n.clearInterval(i)
    })))
}(this);
orerlayhasbeenshown = !1;
$(document).ready(function () {
    MobileMenu();
    appclose();
    loadlazyimages();
    pricelist_app_overlay()
});
$(document).ready(documentReady_filter);
moreitemloading = !1, function (n) {
    "use strict";
    function l() {
        var n = !1;
        return function (t) {
            (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(t) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0, 4))) && (n = !0)
        }(navigator.userAgent || navigator.vendor || window.opera), n
    }

    function e(n, t, i) {
        return n === t ? n = t : n === i && (n = i), n
    }

    function a(n, t, i) {
        var r = n >= t && n <= i;
        if (!r)throw Error("Invalid Rating, expected value between " + t + " and " + i);
        return n
    }

    function t(n) {
        return typeof n != "undefined"
    }

    function r(n, t, i) {
        var r = (t - n) * (i / 100);
        return r = Math.round(n + r).toString(16), r.length === 1 && (r = "0" + r), r
    }

    function v(n, i, u) {
        if (!n || !i)return null;
        u = t(u) ? u : 0;
        n = s(n);
        i = s(i);
        var f = r(n.r, i.r, u), e = r(n.b, i.b, u), o = r(n.g, i.g, u);
        return "#" + f + o + e
    }

    function i(r, o) {
        function p(n) {
            t(n) || (n = o.rating);
            st = n;
            var r = n / h, i = r * b;
            r > 1 && (i += (Math.ceil(r) - 1) * rt);
            et(o.ratedFill);
            i = o.rtl ? 100 - i : i;
            i < 0 ? i = 0 : i > 100 && (i = 100);
            c.css("width", i + "%")
        }

        function ct() {
            g = it * o.numStars + d * (o.numStars - 1);
            b = it / g * 100;
            rt = d / g * 100;
            r.width(g);
            p()
        }

        function lt(n) {
            var t = o.starWidth = n;
            return it = window.parseFloat(o.starWidth.replace("px", "")), s.find("svg").attr({
                width: o.starWidth,
                height: t
            }), c.find("svg").attr({width: o.starWidth, height: t}), ct(), r
        }

        function at(n) {
            return o.spacing = n, d = parseFloat(o.spacing.replace("px", "")), s.find("svg:not(:first-child)").css({"margin-left": n}), c.find("svg:not(:first-child)").css({"margin-left": n}), ct(), r
        }

        function ut(n) {
            o.normalFill = n;
            var t = (o.rtl ? c : s).find("svg");
            return t.attr({fill: o.normalFill}), r
        }

        function et(n) {
            var i;
            if (o.multiColor) {
                var u = st - k, e = u / o.maxValue * 100, t = o.multiColor || {}, h = t.startColor || f.startColor,
                    l = t.endColor || f.endColor;
                n = v(h, l, e)
            } else ft = n;
            return o.ratedFill = n, i = (o.rtl ? s : c).find("svg"), i.attr({fill: o.ratedFill}), r
        }

        function vt(n) {
            n = !!n;
            o.rtl = n;
            ut(o.normalFill);
            p()
        }

        function ri(n) {
            o.multiColor = n;
            et(n ? n : ft)
        }

        function yt(t) {
            o.numStars = t;
            h = o.maxValue / o.numStars;
            s.empty();
            c.empty();
            for (var i = 0; i < o.numStars; i++)s.append(n(o.starSvg || u)), c.append(n(o.starSvg || u));
            return lt(o.starWidth), ut(o.normalFill), at(o.spacing), p(), r
        }

        function pt(n) {
            return o.maxValue = n, h = o.maxValue / o.numStars, o.rating > n && nt(n), p(), r
        }

        function ui(n) {
            return o.precision = n, nt(o.rating), r
        }

        function fi(n) {
            return o.halfStar = n, r
        }

        function ei(n) {
            return o.fullStar = n, r
        }

        function oi(n) {
            var t = n % h, i = h / 2, r = o.halfStar, u = o.fullStar;
            return !u && !r ? n : (u || r && t > i ? n += h - t : (n = n - t, t > 0 && (n += i)), n)
        }

        function wt(n) {
            var l = s.offset(), r = l.left, e = r + s.width(), c = o.maxValue, f = n.pageX, t = 0, u, i;
            if (f < r) t = k; else if (f > e) t = c; else {
                if (u = (f - r) / (e - r), d > 0)for (u *= 100, i = u; i > 0;)i > b ? (t += h, i -= b + rt) : (t += i / b * h, i = 0); else t = u * o.maxValue;
                t = oi(t)
            }
            return o.rtl && (t = c - t), parseFloat(t)
        }

        function bt(n) {
            return o.readOnly = n, r.attr("readonly", !0), ii(), n || (r.removeAttr("readonly"), li()), r
        }

        function nt(n) {
            var t = n, i = o.maxValue;
            return typeof t == "string" && (t[t.length - 1] === "%" && (t = t.substr(0, t.length - 1), i = 100, pt(i)), t = parseFloat(t)), a(t, k, i), t = parseFloat(t.toFixed(o.precision)), e(parseFloat(t), k, i), o.rating = t, p(), ht && r.trigger("rateyo.set", {rating: t}), r
        }

        function si(n) {
            return o.onInit = n, r
        }

        function hi(n) {
            return o.onSet = n, r
        }

        function ci(n) {
            return o.onChange = n, r
        }

        function tt(n) {
            var t = wt(n).toFixed(o.precision), i = o.maxValue;
            t = e(parseFloat(t), k, i);
            p(t);
            r.trigger("rateyo.change", {rating: t})
        }

        function kt() {
            l() || (p(), r.trigger("rateyo.change", {rating: o.rating}))
        }

        function dt(n) {
            var t = wt(n).toFixed(o.precision);
            t = parseFloat(t);
            w.rating(t)
        }

        function gt(n, t) {
            o.onInit && typeof o.onInit == "function" && o.onInit.apply(this, [t.rating, w])
        }

        function ni(n, t) {
            o.onChange && typeof o.onChange == "function" && o.onChange.apply(this, [t.rating, w])
        }

        function ti(n, t) {
            o.onSet && typeof o.onSet == "function" && o.onSet.apply(this, [t.rating, w])
        }

        function li() {
            r.on("mousemove", tt).on("mouseenter", tt).on("mouseleave", kt).on("click", dt).on("rateyo.init", gt).on("rateyo.change", ni).on("rateyo.set", ti)
        }

        function ii() {
            r.off("mousemove", tt).off("mouseenter", tt).off("mouseleave", kt).off("click", dt).off("rateyo.init", gt).off("rateyo.change", ni).off("rateyo.set", ti)
        }

        var w, ft;
        this.node = r.get(0);
        w = this;
        r.empty().addClass("jq-ry-container");
        var ot = n("<div/>").addClass("jq-ry-group-wrapper").appendTo(r),
            s = n("<div/>").addClass("jq-ry-normal-group").addClass("jq-ry-group").appendTo(ot),
            c = n("<div/>").addClass("jq-ry-rated-group").addClass("jq-ry-group").appendTo(ot), h, it, b, d, rt, g,
            k = 0, st = o.rating, ht = !1;
        ft = o.ratedFill;
        this.rating = function (n) {
            return t(n) ? (nt(n), r) : o.rating
        };
        this.destroy = function () {
            return o.readOnly || ii(), i.prototype.collection = y(r.get(0), this.collection), r.removeClass("jq-ry-container").children().remove(), r
        };
        this.method = function (n) {
            if (!n)throw Error("Method name not specified!");
            if (!t(this[n]))throw Error("Method " + n + " doesn't exist!");
            var i = Array.prototype.slice.apply(arguments, []), r = i.slice(1), u = this[n];
            return u.apply(this, r)
        };
        this.option = function (n, i) {
            if (!t(n))return o;
            var r;
            switch (n) {
                case"starWidth":
                    r = lt;
                    break;
                case"numStars":
                    r = yt;
                    break;
                case"normalFill":
                    r = ut;
                    break;
                case"ratedFill":
                    r = et;
                    break;
                case"multiColor":
                    r = ri;
                    break;
                case"maxValue":
                    r = pt;
                    break;
                case"precision":
                    r = ui;
                    break;
                case"rating":
                    r = nt;
                    break;
                case"halfStar":
                    r = fi;
                    break;
                case"fullStar":
                    r = ei;
                    break;
                case"readOnly":
                    r = bt;
                    break;
                case"spacing":
                    r = at;
                    break;
                case"rtl":
                    r = vt;
                    break;
                case"onInit":
                    r = si;
                    break;
                case"onSet":
                    r = hi;
                    break;
                case"onChange":
                    r = ci;
                    break;
                default:
                    throw Error("No such option as " + n);
            }
            return t(i) ? r(i) : o[n]
        };
        yt(o.numStars);
        bt(o.readOnly);
        o.rtl && vt(o.rtl);
        this.collection.push(this);
        this.rating(o.rating, !0);
        ht = !0;
        r.trigger("rateyo.init", {rating: o.rating})
    }

    function h(t, i) {
        var r;
        return n.each(i, function () {
            if (t === this.node)return r = this, !1
        }), r
    }

    function y(t, i) {
        return n.each(i, function (n) {
            if (t === this.node) {
                var r = i.slice(0, n), u = i.slice(n + 1, i.length);
                return i = r.concat(u), !1
            }
        }), i
    }

    function p(t) {
        var e = i.prototype.collection, f = n(this), r;
        if (f.length === 0)return f;
        if (r = Array.prototype.slice.apply(arguments, []), r.length === 0) t = r[0] = {}; else if (r.length === 1 && typeof r[0] == "object") t = r[0]; else {
            if (r.length >= 1 && typeof r[0] == "string") {
                var o = r[0], s = r.slice(1), u = [];
                return n.each(f, function (n, t) {
                    var i = h(t, e), r, f;
                    if (!i)throw Error("Trying to set options before even initialization");
                    if (r = i[o], !r)throw Error("Method " + o + " does not exist!");
                    f = r.apply(i, s);
                    u.push(f)
                }), u = u.length === 1 ? u[0] : u
            }
            throw Error("Invalid Arguments");
        }
        return t = n.extend({}, c, t), n.each(f, function () {
            var r = h(this, e);
            if (r)return r;
            var o = n(this), u = {}, f = n.extend({}, t);
            return n.each(o.data(), function (n, t) {
                if (n.indexOf("rateyo") === 0) {
                    var i = n.replace(/^rateyo/, "");
                    i = i[0].toLowerCase() + i.slice(1);
                    u[i] = t;
                    delete f[i]
                }
            }), new i(n(this), n.extend({}, u, f))
        })
    }

    function w() {
        return p.apply(this, Array.prototype.slice.apply(arguments, []))
    }

    var u = '<?xml version="1.0" encoding="utf-8"?><svg version="1.1"xmlns="http://www.w3.org/2000/svg"viewBox="0 12.705 512 486.59"x="0px" y="0px"xml:space="preserve"><polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566 "/><\/svg>',
        c = {
            starWidth: "32px",
            normalFill: "gray",
            ratedFill: "#f39c12",
            numStars: 5,
            maxValue: 5,
            precision: 1,
            rating: 0,
            fullStar: !1,
            halfStar: !1,
            readOnly: !1,
            spacing: "0px",
            rtl: !1,
            multiColor: null,
            onInit: null,
            onChange: null,
            onSet: null,
            starSvg: null
        }, f = {startColor: "#c0392b", endColor: "#f1c40f"}, o = /^#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i,
        s = function (n) {
            if (!o.test(n))return null;
            var t = o.exec(n), i = parseInt(t[1], 16), r = parseInt(t[2], 16), u = parseInt(t[3], 16);
            return {r: i, g: r, b: u}
        };
    i.prototype.collection = [];
    window.RateYo = i;
    n.fn.rateYo = w
}(window.jQuery);
$(document).ready(documentReady_niazsiteproductservice);
$(document).ready(documentReady_specialshopitem);
$(document).ready(documentReady_similaritems)