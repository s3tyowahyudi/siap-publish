//Awal style untuk layer vektor1
var Style2 = new ol.style.Style({
    stroke: new ol.style.Stroke({
        color: "cyan",
        width: 10,
    }),
    fill: new ol.style.Fill({
        color: "rgba(255, 0, 0, 0.5)",
    }),
    image: new ol.style.Circle({
        radius: 7,
        stroke: new ol.style.Stroke({
            color: "cyan",
            width: 5,
        }),
        fill: new ol.style.Fill({
            color: "rgba(255, 0, 0, 0.5)",
        }),
    }),
});

var iconStyle = new ol.style.Style({
    image: new ol.style.Icon(
        /** @type {module:ol/style/Icon~Options} */ ({
            anchor: [12, 12],
            anchorXUnits: "pixels",
            anchorYUnits: "pixels",
            src: base_url + "/assets/img/marker_home24.png",
        })
    ),
});

/*================================================================
    Layer batas_admin
================================================================== */
var lyrBatasDesa = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        title: "Batas Desa",
        url: base_url_wms + "/geoserver/wms",
        params: {
            LAYERS: "siap:admin_desa",
            TILED: true,
        },
        serverType: "geoserver",
    }),
    visible: false,
});
map.addLayer(lyrBatasDesa);

/*================================================================
    Layer sungai
================================================================== */
var lyrSungai = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        title: "sungai",
        url: base_url_wms + "/geoserver/wms",
        params: {
            LAYERS: "siap:sungai",
            TILED: true,
        },
        serverType: "geoserver",
    }),
    visible: true,
});
map.addLayer(lyrSungai);

/*================================================================
    Layer Sta
================================================================== */
var lyrSta = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        title: "sta",
        url: base_url_wms + "/geoserver/wms",
        params: {
            LAYERS: "siap:sta",
            TILED: true,
        },
        serverType: "geoserver",
    }),
    visible: false,
});
map.addLayer(lyrSta);

/*================================================================
    Layer Bangunan garis
================================================================== */
var lyrBangunan_garis = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        title: "Bangunan Garis",
        url: base_url_wms + "/geoserver/wms",
        params: {
            LAYERS: "siap:bangunan_garis",
            TILED: true,
        },
        serverType: "geoserver",
    }),
    visible: true,
});
map.addLayer(lyrBangunan_garis);

/*================================================================
    Layer Bangunan titik
================================================================== */
var lyrBangunan = new ol.layer.Tile({
    source: new ol.source.TileWMS({
        title: "Bangunan Titik",
        url: base_url_wms + "/geoserver/wms",
        params: {
            LAYERS: "siap:bangunan",
            TILED: true,
        },
        serverType: "geoserver",
    }),
    visible: true,
});
map.addLayer(lyrBangunan);
var vectorSource1 = new ol.source.Vector();
var lvector1 = new ol.layer.Vector({
    source: vectorSource1,
    style: Style2,
});
map.addLayer(lvector1);

var vectorSource = new ol.source.Vector();
var lvector = new ol.layer.Vector({
    source: vectorSource,
    style: Style2,
    visible: true,
});
map.addLayer(lvector);

var vectorTerpilihSource = new ol.source.Vector();
var lvectorTerpilih = new ol.layer.Vector({
    source: vectorTerpilihSource,
    style: Style2,
    visible: false,
});
map.addLayer(lvectorTerpilih);

function ZoomTo() {
    var ViewExtent = vectorSource.getExtent();
    view.fit(ViewExtent, map.getSize());
}

function ZoomTo1() {
    var ViewExtent = vectorSource1.getExtent();
    view.fit(ViewExtent, map.getSize());
}

var lyrUploadSource = new ol.source.Vector();
var lyrUpload = new ol.layer.Vector({
    source: lyrUploadSource,
    // style: Style2,
    visible: true,
});
map.addLayer(lyrUpload);
