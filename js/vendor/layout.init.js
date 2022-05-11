$.noConflict();
jQuery(document).ready(function () {
    var pCon = jQuery('.page-container'),
        sRight = jQuery('.right-aside'),
        aRight = jQuery('.right-aside'),
        mLbar = jQuery('.m-leftbar-show'),
        pBody = jQuery('body'),
        pHtml = jQuery('html');

    //Fixed TopBar
    function topbarFixed() {
        var fxHeader = jQuery('.page-container').hasClass('fixed-header');
        var conInnnerWidth = jQuery('.main-container').innerWidth();

        if (fxHeader) {
            jQuery('.top-bar').css({
                'width': conInnnerWidth + 'px'
            });
        }

    }
    topbarFixed();

    //List Menu View
    function ListMenuView() {
        jQuery('.leftbar-action').on('click', function (event) {
            event.preventDefault();

            if (pCon.hasClass('list-menu-view')) {
                pCon.removeClass('list-menu-view');
                pCon.addClass('hide-list-menu');
            } else {
                pCon.removeClass('hide-list-menu');
                pCon.addClass('list-menu-view');
            }

        });
        jQuery('.leftbar-action-mobile').on('click', function (event) {
            event.preventDefault();

            if (pCon.hasClass('list-menu-view')) {
                pCon.removeClass('list-menu-view');
                pCon.addClass('hide-list-menu');

            } else {
                pCon.removeClass('hide-list-menu');
                pCon.addClass('list-menu-view');
            }
        });

        jQuery('.rightbar-action').on('click', function (ev) {
            ev.preventDefault();
            if (aRight.hasClass('rightbar-show')) {
                aRight.removeClass('rightbar-show');

            } else {
                aRight.addClass('rightbar-show');

            }
        });

        jQuery('.aside-close').on('click', function (ev) {
            pCon.removeClass('hide-list-menu');
            pCon.addClass('list-menu-view');
        });

    }

    function ListMenuViewExit() {
        if (sRight.hasClass('rightbar-show')) {
            sRight.removeClass('rightbar-show');
        }
    }


    /*====Search Bar====*/
    function SearchBar() {
        if (jQuery('.search-bar').hasClass('search-show')) {
            jQuery('.search-bar').removeClass('search-show');

        } else {
            jQuery('.search-bar').addClass('search-show');
            jQuery('.search-input').focus();
        }
    }



    ListMenuView();



    var jRes = jRespond([
        {
            label: 'handheld',
            enter: 0,
            exit: 767
    }, {
            label: 'tablet',
            enter: 768,
            exit: 979
    }, {
            label: 'laptop',
            enter: 980,
            exit: 1199
    }, {
            label: 'desktop',
            enter: 1200,
            exit: 10000
    }
]);

    jRes.addFunc([
        {
            breakpoint: ['desktop', 'laptop'],
            enter: function () {


            },
            exit: function () {


            }
    },
        {
            breakpoint: ['handheld', 'tablet'],
            enter: function () {



            },
            exit: function () {
                ListMenuViewExit();
            }
    }
]);

    /*====Left Bar Accordion====*/
    if (jQuery.fn.dcAccordion) {
        jQuery('.list-accordion').each(function () {
            jQuery(this).dcAccordion({
                eventType: 'click',
                hoverDelay: 100,
                autoClose: true,
                saveState: false,
                disableLink: true,
                speed: 'fast',
                showCount: false,
                autoExpand: true,
                cookie: 'dcjq-accordion-1',
                classExpand: 'dcjq-current-parent'
            });
        });

    }


    /*====Collapsible Widgets====*/

    jQuery('.widget-collapse').on('click', function (e) {
        var widgetElem = jQuery(this).children('i');
        jQuery(this).parents('.widget-head')
            .next('.widget-container')
            .slideToggle(200);

        if (jQuery(widgetElem).hasClass('fa-angle-down')) {
            jQuery(widgetElem).removeClass('fa-angle-down');
            jQuery(widgetElem).addClass('fa-angle-left');


        } else {
            jQuery(widgetElem).removeClass('fa-angle-left');
            jQuery(widgetElem).addClass('fa-angle-down');

        }

        e.preventDefault();

    });


    /*--Wiget Loader--*/

    var ThisLoad;

    jQuery(".w-reload").click(function () {
        ThisLoad = jQuery(this);
        jQuery(this).parents('.widget-head')
            .next('.widget-container').mask("Loading...");
        setTimeout(UnMask, 1500);
    });


    function UnMask() {
        ThisLoad.parents('.widget-head')
            .next('.widget-container').unmask();
    }

    /*--
    * switchery.css
    * switchery.js
    --*/

    try {

        var on_off_w = Array.prototype.slice.call(document.querySelectorAll('.w-on-off'));
        on_off_w.forEach(function (html) {
            var switchery = new Switchery(html, {
                size: 'small',
                color: '#15bdc3',
                jackColor: '#fff',
                secondaryColor: '#eee',
                jackSecondaryColor: '#fff'
            });
        });


        var on_off_w_check = document.querySelector('.w-on-off');
        on_off_w_check.onchange = function () {
            var swithToggle = jQuery(this).parents('.widget-head')
                .next('.widget-container')
                .slideToggle(200);
            if (on_off_w_check.checked) {
                swithToggle
            } else {
                swithToggle
            }
        };

    } catch (e) {

    }


    /*--
     * iCheck
     * icheck.js
     * icheck.css
     * --- */
    try {

        jQuery('.w-i-check').iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal',
            increaseArea: '30%' // optional
        });
        var w_check_box = jQuery('.w-i-check');
        w_check_box.on('ifChecked ifUnchecked', function (event) {
            var swithToggle = jQuery(this).parents('.widget-head')
                .next('.widget-container')
                .slideToggle(200);
            if (event.type == 'ifChecked') {
                swithToggle

            } else {
                swithToggle
            }
        });

    } catch (e) {

    }


    /*====Widgets Remove====*/
    jQuery('.widget-remove').on('click', function (e) {
        jQuery(this).parents('.widget-module').remove();
        e.preventDefault();

    });


    jQuery('.search-btn').on('click', function () {
        SearchBar();
    });
    jQuery('.search-close').on('click', function () {
        SearchBar();
    });


    /*====Tooltip====*/
    jQuery('[data-tooltip="tooltip"]').tooltip();

    jQuery('.chat-close').on('click', function () {
        jQuery('.conv-container').removeClass('show-conv');
    });

    jQuery('.chat-list').on('click', function () {
        jQuery('.conv-container').addClass('show-conv');
    });


    function ChatHeight() {

        var MainHeight = jQuery(window).height();
        var ChatUserContainer = jQuery('.chat-user-list');
        if (ChatUserContainer.length) {
            var OffsetCal = ChatUserContainer.offset().top;
        }
        var CalHeight = MainHeight - OffsetCal;
        jQuery('.chat-user-list').css({
            'height': CalHeight + "px"
        });

    }
    ChatHeight();

    function ConvHeight() {

        var MainHeight = jQuery(window).height();

        var CovContainer = jQuery('.converstaion-list');
        if (CovContainer.length) {
            var OffsetCal = CovContainer.offset().top;
        }

        var InputFrmH = jQuery('.chat-input-form').height() + 40;
        var MinusH = OffsetCal + InputFrmH;
        var CalHeight = MainHeight - MinusH;
        jQuery('.converstaion-list').css({
            'height': CalHeight + "px"
        });

    }
    ConvHeight();

    function StatsHeight() {

        var MainHeight = jQuery(window).height();
        var OffsetCal = jQuery('.aside-branding').height();
        var CalHeight = MainHeight - OffsetCal;
        jQuery('.server-stats-content').css({
            'height': CalHeight + "px"
        });
    }
    StatsHeight();


    function NotifysHeight() {

        var MainHeight = jQuery(window).height();
        var OffsetCal = jQuery('.right-aside .aside-branding').height();
        var CalHeight = MainHeight - OffsetCal;
        jQuery('.aside-notifications-wrap').css({
            'height': CalHeight + "px"
        });
    }
    NotifysHeight();

    function LeftNavHeight() {

        var MainHeight = jQuery(window).height();
        var OffsetCal = jQuery('.left-aside .aside-branding').height();
        var CalHeight = MainHeight - OffsetCal;
        jQuery('.left-navigation').css({
            'height': CalHeight + "px"
        });



    }
    LeftNavHeight();

    jQuery(window).smartresize(function () {
        ChatHeight();
        ConvHeight();
        StatsHeight();
        NotifysHeight();
        LeftNavHeight();
        topbarFixed();
    });


    if (jQuery.fn.sparkline) {
        var sparkLine = function () {
            jQuery('.sparkline').each(function () {
                var data = jQuery(this).data();
                data.valueSpots = {
                    '0:': data.spotColor
                };

                jQuery(this).sparkline(data.data, data);
                var composite = data.compositedata;

                if (composite) {
                    var stlColor = jQuery(this).attr("data-stack-line-color"),
                        stfColor = jQuery(this).attr("data-stack-fill-color"),
                        sptColor = jQuery(this).attr("data-stack-spot-color"),
                        sptRadius = jQuery(this).attr("data-stack-spot-radius");

                    jQuery(this).sparkline(composite, {
                            composite: true,
                            lineColor: stlColor,
                            fillColor: stfColor,
                            spotColor: sptColor,
                            highlightSpotColor: sptColor,
                            spotRadius: sptRadius,
                            valueSpots: {
                                '0:': sptColor
                            }

                        }

                    );

                };
            });

        };

        var sparkResize;
        jQuery(window).smartresize(function (e) {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(function () {
                sparkLine(true)
            }, 100);
        });
        sparkLine(false);
    }

    jQuery('.progress-bar').each(function () {
        var PbarWidth = jQuery(this).data("progress");
        if (PbarWidth) {
            jQuery(this).css('width', PbarWidth + '%');
            jQuery(this).parents('.progress').parents('.progress-wrap').children('.progress-meta').children('.progress-percent').text(PbarWidth + '%');
        }

    });

    if (jQuery.fn.easyPieChart) {
        jQuery('.epie-chart').each(function () {
            var pbColor = jQuery(this).data("barcolor"),
                tColor = jQuery(this).data("tcolor"),
                sColor = jQuery(this).data("scalecolor"),
                lCap = jQuery(this).data("linecap"),
                lWidth = jQuery(this).data("linewidth"),
                pSize = jQuery(this).data("size"),
                pAnimate = jQuery(this).data("animate"),
                pPercent = jQuery(this).data("percent");

            jQuery(this).children('.percent').css({
                'width': pSize + 'px',
                'line-height': pSize + 'px'
            });

            if (pPercent === 100) {
                jQuery('<span class="p-done"><i class="fa fa-check"></i></span>').insertBefore(jQuery(this).children('.percent'));
                jQuery(this).children('.p-done').css({
                    'width': pSize + 'px',
                    'height': pSize + 'px',
                    'line-height': pSize + 'px',
                    'color': pbColor
                });
                jQuery(this).children('.percent').remove();
            }

            jQuery(this).easyPieChart({
                barColor: pbColor,
                trackColor: tColor,
                scaleColor: sColor,
                lineCap: lCap,
                lineWidth: lWidth,
                size: pSize,
                animate: pAnimate,
                onStep: function (from, to, percent) {
                    jQuery(this.el).find('.percent').text(Math.round(percent));


                }
            });

        });
    }

    try {
        jQuery.scrollUp({
            scrollName: 'scrollTop', // Element ID
            topDistance: '300', // Distance from top before showing element (px)
            topSpeed: 300, // Speed back to top (ms)
            animation: 'fade',
            animationInSpeed: 200, // Animation in speed (ms)
            animationOutSpeed: 200, // Animation out speed (ms)
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element
            activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
    } catch (err) {
        console.log('scrollTop is not found')
    }

});