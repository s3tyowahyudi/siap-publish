<script src="assets/ace/assets/js/jquery.js"></script>
<script type="text/javascript">
    if ("ontouchstart" in document.documentElement) document.write("<script src='assets/ace/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
</script>
<script src="assets/ace/assets/js/bootstrap.js"></script>
<script src="assets/ace/assets/js/holder.js"></script>


<script src="assets/ace/assets/js/ace.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAC5J8bvRYUZvE4u5TRMZVIcFhZiAsMBVs&libraries=places"></script>
<script type="text/javascript" src="assets/jqueryeasy/jquery.min.js"></script>
<script type="text/javascript" src="assets/jqueryeasy/jquery.easyui.min.js"></script>
<script type="text/javascript" src="assets/ol/ol.js"></script>
<script type="text/javascript" src="{{ url('assets/js/colorbox/jquery.colorbox-min.js') }}"></script>
{{-- <script src="assets/ace/assets/js/jquery.colorbox.js"></script> --}}
<script type="text/javascript" src="{{ url('shapefile.js') }}"></script>
<script type="text/javascript" src="{{ url('dbf.js') }}"></script>

<script type="text/javascript" src="assets/js/vue.min.js"></script>
<script type="text/javascript" src="assets/dx/jszip.min.js"></script>
<script type="text/javascript" src="assets/dx/dx.all.js"></script>

<script type="text/javascript" src="{{ url('assets/js/iconify.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/webgis/layerbasemap.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/webgis/pemetaan.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/webgis/layer.js') }}"></script>
<script type="text/javascript" src="assets/js/webgis/webgisVue.js"></script>
<script type="text/javascript" src="{{ url('assets/js/webgis/index.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/webgis/measure1.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/webgis/uploadShp.js') }}"></script>
<script type="text/javascript" src="assets/sweetalert2/sweetalert2.min.js"></script> 
<script type="text/javascript" src="assets/pdfObject/pdfobject.min.js"></script>

<script type="text/javascript">
    var colorbox_params = {
        rel: "colorbox",
        reposition: true,
        scalePhotos: true,
        scrolling: false,
        previous: '<i class="ace-icon fa fa-arrow-left"></i>',
        next: '<i class="ace-icon fa fa-arrow-right"></i>',
        close: "&times;",
        current: "{current} of {total}",
        maxWidth: "100%",
        maxHeight: "100%",
        onOpen: function () {
            $overflow = document.body.style.overflow;
            document.body.style.overflow = "hidden";
        },
        onClosed: function () {
            document.body.style.overflow = $overflow;
        },
        onComplete: function () {
            $.colorbox.resize();
        },
    };
</script>
