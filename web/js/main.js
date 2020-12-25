(function ($) { "use strict";
$(document).ready(function () {
     if ($("#property-detail-large").length && $("#property-detail-thumbs").length) {
                    var sync1 = $("#property-detail-large"),
                        sync2 = $("#property-detail-thumbs"),

                      syncPosition=function(el) {
                        //if you set loop to false, you have to restore this next line
                        //var current = el.item.index;

                        //if you disable loop you have to comment this block
                        var count = el.item.count-1;
                        var current = Math.round(el.item.index - (el.item.count/2) - .5);

                        if(current < 0) {
                          current = count;
                        }
                        if(current > count) {
                          current = 0;
                        }

                        //end block

                        sync2
                          .find(".owl-item")
                          .removeClass("current")
                          .eq(current)
                          .addClass("current");
                        var onscreen = sync2.find('.owl-item.active').length - 1;
                        var start = sync2.find('.owl-item.active').first().index();
                        var end = sync2.find('.owl-item.active').last().index();

                        if (current > end) {
                          sync2.data('owl.carousel').to(current, 100, true);
                        }
                        if (current < start) {
                          sync2.data('owl.carousel').to(current - onscreen, 100, true);
                        }
                      },

                      syncPosition2=function (el) {
                          var number = el.item.index;
                          sync1.data('owl.carousel').to(number, 100, true);
                      },
                    setCurrent=function () {
                        sync2.find(".owl-item").eq(0).addClass("current");
                    };

                    sync1.owlCarousel({
                        autoplay: true,
                        loop:true,
                        items: 1,
                        slideSpeed : 1000,
                        nav: true,
                        navText: ["",""],
                        dots: false,
                        autoHeight : true,
                        responsiveRefreshRate : 200
                    });
                    sync1.on('changed.owl.carousel', syncPosition);

                    sync2.owlCarousel({
                        items: 4,
                        dots: false,
                        responsiveRefreshRate : 100,
                        onInitialized: setCurrent
                    });
                    sync2.on('changed.owl.carousel', syncPosition2);

                    sync2.on("click", ".owl-item", function (e) {
                        e.preventDefault();
                        var number = $(this).index();
                        sync1.data('owl.carousel').to(number, 300, true);
                    });
                }
});
}(jQuery));