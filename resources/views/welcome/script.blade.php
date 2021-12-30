<script type="text/javascript" src="assets/aos/aos.js"></script>
<script src="assets/ace/assets/js/jquery.js"></script>
<script src="assets/ace/assets/js/bootstrap.js"></script>
<script src="assets/ace/assets/js/holder.js"></script>
<script src="assets/layerslider/js/jquery.js" type="text/javascript"></script>
<script src="assets/layerslider/js/greensock.js" type="text/javascript"></script>
<script src="assets/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
<script src="assets/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>

<script type="text/javascript" src="assets/js/vue.min.js"></script>
<script type="text/javascript" src="assets/ol/ol.js"></script>
<script type="text/javascript" src="assets/dx/jszip.min.js"></script>
<script type="text/javascript" src="assets/dx/dx.all.js"></script>

<script type="text/javascript" src="assets/js/welcome/layerbasemap.min.js"></script>

<script type="text/javascript" src="assets/js/welcome/data.js"></script>
@include('welcome.js_pemetaan')
@include('welcome.js_layer')
@include('welcome.js_chart')
<script type="text/javascript">
    jQuery(function ($) {
        AOS.init();
        $("#layerslider").layerSlider({
            showCircleTimer: false,
            pauseOnHover: false,
            skin: "noskin",
            hoverPrevNext: false,
            skinsPath: "assets/layerslider/skins/",
        });
        $("#contact textarea").css("min-height", "150px");

        //make navbar compact when scrolling down
        var isCompact = false;
        $(window).on("scroll.scroll_nav", function () {
            var scroll = $(window).scrollTop();
            var h = $(window).height();
            var body_sH = document.body.scrollHeight;
            if (scroll > parseInt(h / 4) || (scroll > 0 && body_sH >= h && h + scroll >= body_sH - 1)) {
                //|| for smaller pages, when reached end of page
                if (!isCompact) $(".navbar").addClass("navbar-compact");
                isCompact = true;
            } else {
                $(".navbar").removeClass("navbar-compact");
                isCompact = false;
            }
        }).triggerHandler("scroll.scroll_nav");

        //optinal: when window is too small change background presentation
        $(window).on("resize.bg_update", function () {
            var width = $(window).width();

            if (width < 992) {
                $(".img-main-background").addClass("hide");
                $(".jumbotron").addClass("has-background");
            } else {
                $(".img-main-background").removeClass("hide");
                $(".jumbotron").removeClass("has-background");
            }
            })
            .triggerHandler("resize.bg_update");

      //animated scroll to a section
        $(document).on("click", "#navbar a", function () {
            var href = $(this).attr("href");
            var target = $(href);
            if (target.length == 1) {
                var offset = target.offset();
                var top = parseInt(Math.max(offset.top - 30, 0));
                $("html,body").animate({ scrollTop: top }, 250);
            }
        });
        showTabelPerumahan();
    });
</script>