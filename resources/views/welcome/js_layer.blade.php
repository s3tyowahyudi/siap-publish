<script type="text/javascript">
    //Awal style untuk layer vektor1
    var base_url_wms = window.location.origin + ":8080";
    var Style2 = new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'cyan',
            width: 10
        }),
        fill: new ol.style.Fill({
            color: 'rgba(255, 0, 0, 0.5)'
        }),
        image: new ol.style.Circle({
            radius: 7,
            stroke: new ol.style.Stroke({
                color: 'cyan',
                width: 5
            }),
            fill: new ol.style.Fill({
                color: 'rgba(255, 0, 0, 0.5)'
            })
        })
    });

    /*================================================================
        Layer Perumahan
    ================================================================== */

    var lyrPerumahan = new ol.layer.Tile({
        source: new ol.source.TileWMS({
            title: "Perumahan",
            url: base_url_wms + "/geoserver/wms",
            params: {
                LAYERS: 'si-perkasa-kabmalang:perumahan',
                TILED: false
            },
            serverType: 'geoserver'
        }),
        visible: true,
    });
    map.addLayer(lyrPerumahan);

    
    var vectorSource1 = new ol.source.Vector();
    var lvector1 = new ol.layer.Vector({
        source: vectorSource1,
        style: Style2
    });
    map.addLayer(lvector1);

    var vectorSource = new ol.source.Vector();
    var lvector = new ol.layer.Vector({
        source: vectorSource,
        style: Style2,
        visible: true
    });
    map.addLayer(lvector);

    var vectorTerpilihSource = new ol.source.Vector();
    var lvectorTerpilih = new ol.layer.Vector({
        source: vectorTerpilihSource,
        style: Style2,
        visible: false
    });
    map.addLayer(lvectorTerpilih);


    function ZoomTo() {
        var ViewExtent = vectorSource.getExtent();
        view.fit(ViewExtent, map.getSize());
    };

    function ZoomTo1() {
        var ViewExtent = vectorSource1.getExtent();
        view.fit(ViewExtent, map.getSize());
    };

</script>