<script type="text/javascript">
    var statusClick = "Informasi";
    var polygonDraw;
    var pointDraw;
    var lineDraw;
    var select;
    var modify;

    var wkt = new ol.format.WKT();

    var view = new ol.View({
        projection: 'EPSG:4326',
        center: [112.6377190412104, -7.991407918028639],
        zoom: 10
    });

    var viewOverViewMap = new ol.View({
        projection: 'EPSG:4326'
    });

    var map = new ol.Map({
        layers: [
            mapquest,
            googleLayerSatellite,
            googleLayerRoadmap,
            googleLayerHybrid,
            googleLayerTerrain,
            googleLayerHybrid2,
            googleLayerOnlyRoad,
            bingmapsjalan,
            bingmaps,
            bingmapslabel,
            esri,
            stamen
        ],
        target: 'map',
        view: view,
        controls: ol.control.defaults({
            zoom: false,
            attribution: false,
            rotate: false
        }).extend([
            new ol.control.ScaleLine({
                className: 'ol-scale-line',
                target: document.getElementById('scale-line')
            }),
            
        ]),
    });

    function showFeatureKlapKlip(indekKlip) {
        vectorSource.clear();
        vectorSource.addFeature(vectorTerpilihSource.getFeatures()[indekKlip]);
        flash(vectorSource.getFeatures()[0], 1000);

    };

    function flash(feature, duration) {
        var start = +new Date();
        var listenerKey; // to remove the listener after the duration

        function animate(event) {
            // canvas context where the effect will be drawn
            var vectorContext = event.vectorContext;
            var frameState = event.frameState;

            // create a clone of the original ol.Feature
            // on each browser frame a new style will be applied
            //var flashGeom = feature.getGeometry().clone();
            var elapsed = frameState.time - start;
            var elapsedRatio = elapsed / duration;
            // radius will be 5 at start and 30 at end.
            var radius = ol.easing.easeOut(elapsedRatio) * 25 + 5;
            var opacity = ol.easing.easeOut(1 - elapsedRatio);

            // you can customize here the style
            // like color, width

            var style = new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: [255, 102, 0, opacity],
                    width: 10 + opacity

                }),
                image: new ol.style.Circle({
                    radius: radius,
                    snapToPixel: false,
                    stroke: new ol.style.Stroke({
                        color: [255, 102, 0, opacity],
                        width: 2 + opacity
                    })
                })
            });

            lvector.setStyle(style);
            if (elapsed > duration) { // stop the effect
                ol.Observable.unByKey(listenerKey);
                return;
            }
            // tell OL3 to continue postcompose animation
            map.render();
        }

        listenerKey = map.on('postcompose', animate);
    };

    setInterval(function () {
        var features = vectorSource.getFeatures();
        if (features.length > 0) {
            flash(features, 1000);
        } else {}
    }, 1000);

    var mousePositionControl = new ol.control.MousePosition({
        coordinateFormat: ol.coordinate.toStringHDMS,
        projection: 'EPSG:4326',
        // comment the following two lines to have the mouse position
        // be placed within the map.
        className: 'custom-mouse-position',
        target: document.getElementById('mouseposisi'),
        undefinedHTML: '&nbsp;'
    });
    map.addControl(mousePositionControl);

    function ClearInfo() {
        vectorSource.clear();
        vectorSource1.clear();
        vo.gidAktif = null;
        vo.jmlField=0;
        VFoto.fotos=[];
        vo.idGeomTerpilih=[];
        statusClick = "Informasi";
        vo.statusEdit = null;
        vo.layerAktif="survey";
        vo.koordinatSurvey=[];
        $('#widgetFormNewObject').hide();
        $('#widget-edit-info').hide();
        clearCustomInteractions();
    };

    function GeomToJson(data, kondisi) {
        datas = data.split(".");
        var lyrGeoserver = datas[0];
        var gid = datas[1];
        $.ajax({
            type: 'get',
            url: "{{ url('getFeature/') }}"  + "/" + lyrGeoserver + "/" + gid,
            success: function (msg) {
                featurecollection = msg;
                geojson_format = new ol.format.GeoJSON();
                vectorSource.clear();
                // vectorSource1.addFeatures(geojson_format.readFeatures(featurecollection));
                vectorSource.addFeatures(geojson_format.readFeatures(featurecollection));
                if (kondisi === 1) {
                    var ViewExtent = vectorSource.getExtent();
                    view.fit(ViewExtent, map.getSize());
                }
                //flash(geojson_format.readFeatures(featurecollection)[0],2000)

            },
            error: function (xhr, statusTeks, Kesalahan) {
                alert(Kesalahan);
            }
        });
    };

</script>