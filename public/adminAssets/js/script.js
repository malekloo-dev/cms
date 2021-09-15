// function loadlazyimages() {
//     lazyLoadImage();
//     window.addEventListener("DOMContentLoaded", lazyLoadImage);
//     window.addEventListener("load", lazyLoadImage);
//     window.addEventListener("resize", lazyLoadImage);
//     window.addEventListener("scroll", lazyLoadImage)
// }
// function isElementInViewport(n) {
//     var t = n.getBoundingClientRect();
//     return t.top >= 0 && t.left >= 0 && t.bottom <= (window.innerHeight || document.documentElement.clientHeight) + (window.innerHeight || document.documentElement.clientHeight) * .2 && t.right <= (window.innerWidth || document.documentElement.clientWidth) + (window.innerWidth || document.documentElement.clientWidth) * .2
// }
// function lazyLoadImage() {
//     var n = document.querySelectorAll("img[data-lazysrc]");
//     [].forEach.call(n, function (n) {
//         alert(n);
//         isElementInViewport(n) && (n.setAttribute("src", n.getAttribute("data-lazysrc")), n.removeAttribute("data-lazysrc"), $("#" + n.id).removeClass("maxwh100"))
//     });
//     n.length == 0 && (window.removeEventListener("DOMContentLoaded", lazyLoadImage), window.removeEventListener("load", lazyLoadImage), window.removeEventListener("resize", lazyLoadImage), window.removeEventListener("scroll", lazyLoadImage))
// }
//
// (document).ready(function () {
//     alert('gg');
//    // MobileMenu();
//     //appclose();
//     loadlazyimages();
//     //pricelist_app_overlay()
// });

!function(window){
    var $q = function(q, res){
            if (document.querySelectorAll) {
                res = document.querySelectorAll(q);
            } else {
                var d=document
                    , a=d.styleSheets[0] || d.createStyleSheet();
                a.addRule(q,'f:b');
                for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
                    l[b].currentStyle.f && c.push(l[b]);

                a.removeRule(0);
                res = c;
            }
            return res;
        }
        , addEventListener = function(evt, fn){
            window.addEventListener
                ? this.addEventListener(evt, fn, false)
                : (window.attachEvent)
                ? this.attachEvent('on' + evt, fn)
                : this['on' + evt] = fn;
        }
        , _has = function(obj, key) {
            return Object.prototype.hasOwnProperty.call(obj, key);
        }
    ;

    function loadImage (el, fn) {
        var img = new Image()
            , src = el.getAttribute('data-src');
        el.removeAttribute('data-src');
        el.removeAttribute('class');

        img.onload = function() {
            if (!! el.parent)
                el.parent.replaceChild(img, el)
            else
                el.src = src;

            fn? fn() : null;
        }
        img.src = src;
        /*img.data-src='a';
        console.log(fn);*/

    }

    function elementInViewport(el) {
        var rect = el.getBoundingClientRect()

        return (
            rect.top    >= 0
            && rect.left   >= 0
            && rect.top <= (window.innerHeight || document.documentElement.clientHeight)
        )
    }

    var images = new Array()
        , query = $q('img.lazy')
        , processScroll = function(){
            for (var i = 0; i < images.length; i++) {
                if (elementInViewport(images[i])) {
                    src = images[i].getAttribute('data-src');
                    if(src!=null)
                    {
                        loadImage(images[i], function () {
                            images.splice(i, i);
                        });

                    }



                }
            };
        }
    ;
    // Array.prototype.slice.call is not callable under our lovely IE8
    for (var i = 0; i < query.length; i++) {
        images.push(query[i]);
    };

    processScroll();
    addEventListener('scroll',processScroll);

}(this);
