var base_url = window.location.origin + "/siap/public";
var base_url_wms = window.location.origin + ":8080";
// var base_url = window.location.origin;
// var base_url_wms = "http://202.157.187.108:8080/";
var statusClick = "Informasi";
var polygonDraw;
var pointDraw;
var lineDraw;
var select;
var modify;
var wkt = new ol.format.WKT();

var defaultBounds = new google.maps.LatLngBounds(
    new google.maps.LatLng(-10.250059987303041, 89.1650390625),
    new google.maps.LatLng(5.37539777447471, 148.18359375)
);
var options = {
    bounds: defaultBounds,
};
var input = document.getElementById("nav-search");
var autocomplete = new google.maps.places.Autocomplete(input, options);

autocomplete.addListener("place_changed", function () {
    var place = autocomplete.getPlace();
    if (!place.geometry) {
        window.alert("Autocomplete's returned place contains no geometry");
        return;
    }
    pencariankoordinat(place);
});

function pencariankoordinat(place) {
    var lat = place.geometry.location.lat();
    var long = place.geometry.location.lng();
    if (long != "" && lat != "") {
        vectorSource1.clear();
        vectorSource1.addFeature(
            new ol.Feature({
                geometry: new ol.geom.Point([
                    parseFloat(long),
                    parseFloat(lat),
                ]),
            })
        );
        map.getView().fit(vectorSource1.getExtent(), map.getSize());
        view.setZoom(19);
    }
}

var view = new ol.View({
    projection: "EPSG:4326",
    center: [113.51638568200048, -7.119952122710566],
    zoom: 13,
});

var viewOverViewMap = new ol.View({
    projection: "EPSG:4326",
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
        cartoDbVoyager,
        cartoDbPositron,
        cartoDbDarkMatter,
        esri,
        stamen,
    ],
    target: "map",
    view: view,
    controls: ol.control
        .defaults({
            zoom: false,
            attribution: false,
            rotate: false,
        })
        .extend([
            new ol.control.ScaleLine({
                className: "ol-scale-line",
                target: document.getElementById("scale-line"),
            }),
            new ol.control.OverviewMap({
                target: document.getElementById("overviewMap"),
                collapsed: true,
                view: viewOverViewMap,
            }),
        ]),
});

/*
-----------------------------------------------------------------------
    map di klik
-----------------------------------------------------------------------
*/
map.on("singleclick", function (evt) {
    var coordinate = evt.coordinate;
    switch (statusClick) {
        case "Informasi":
            vectorSource.clear();
            coordinate = evt.coordinate;
            var viewResolution = view.getResolution();
            var sourceWms = lyrBangunan.getSource();
            var url = sourceWms.getGetFeatureInfoUrl(
                evt.coordinate,
                viewResolution,
                "EPSG:4326",
                {
                    INFO_FORMAT: "text/javascript",
                }
            );
            urlfix = urlinfo(url);
            getInfoGeoserver(urlfix);
    }
});

var mousePositionControl = new ol.control.MousePosition({
    coordinateFormat: ol.coordinate.toStringHDMS,
    projection: "EPSG:4326",
    // comment the following two lines to have the mouse position
    // be placed within the map.
    className: "custom-mouse-position",
    target: document.getElementById("mouseposisi"),
    undefinedHTML: "&nbsp;",
});
map.addControl(mousePositionControl);

function urlinfo(url) {
    var urlarray = url.split("&");
    // console.log(urlarray);
    urlarray[5] =
        "QUERY_LAYERS=siap:bangunan,siap:bangunan_garis,siap:sta,siap:sungai";
    urlarray[6] =
        "LAYERS=siap:bangunan,siap:bangunan_garis,siap:sta,siap:sungai";
    var urlfix = "";
    for (i = 0; i < urlarray.length; i++) {
        urlfix = urlfix + urlarray[i] + "&";
    }
    return urlfix + "FEATURE_COUNT=10";
}

function getInfoGeoserver(url) {
    var hasil = null;
    var parser = new ol.format.GeoJSON();
    $.ajax({
        url: url,
        dataType: "jsonp",
        jsonpCallback: "parseResponse",
    }).then(function (response) {
        var result = parser.readFeatures(response);
        if (result.length) {
            var layernm = result[0].get("gid");
            // console.log(layernm);
            geojson_format = new ol.format.GeoJSON();
            vectorTerpilihSource.clear();
            vectorTerpilihSource.addFeatures(
                geojson_format.readFeatures(response)
            );
            vo.idGeomTerpilih = vectorTerpilihSource.getFeatures();
            vectorSource.clear();
            vectorSource.addFeature(vectorTerpilihSource.getFeatures()[0]);
            vo.ShowInformasi(0);
            showFeatureKlapKlip(0);
            vo.kondisiEdit = false;
            $("#wInformasi").window("open").window("refresh");
        } else {
            ClearInfo();
            $("#wInformasi").window("close");
        }
    });
}

function parseResponse(data) {
    // console.log(data);
    // vo.idGeomTerpilih = data.features;
    // $("#frmDaftarLayer").empty();
    // if (vo.idGeomTerpilih.length) {
    //     vo.ShowInformasi(0);
    //     geojson_format = new ol.format.GeoJSON();
    //     vectorTerpilihSource.clear();
    //     vectorTerpilihSource.addFeatures(geojson_format.readFeatures(data));
    //     vectorSource.clear();
    //     vectorSource.addFeature(vectorTerpilihSource.getFeatures()[0]);
    //     showFeatureKlapKlip(0);
    //     $("#wInformasi").window("open").window("refresh");
    // } else {
    //     $("#wInformasi").window("close");
    // }
}

function ClearInfo() {
    vectorSource.clear();
    vectorSource1.clear();
    lyrUploadSource.clear();
    clearCustomInteractions();
    vo.gidAktif = null;
    statusClick = "Informasi";
    // vo.layerAktif = "jalan";
}

function clearvector1() {
    $("#latitude").val("");
    $("#longitude").val("");
    $("#pac-input").val("");
    vectorSource1.clear();
}

function pencariankoordinat1() {
    var lat = $("#latitude").val();
    var long = $("#longitude").val();
    if (long != "" && lat != "") {
        vectorSource1.clear();
        vectorSource1.addFeature(
            new ol.Feature({
                geometry: new ol.geom.Point([
                    parseFloat(long),
                    parseFloat(lat),
                ]),
            })
        );
        map.getView().fit(vectorSource1.getExtent(), map.getSize());
        view.setZoom(19);
        if (vo.kondisiNew) {
            $("#widgetGambarObjectBaru").hide();
            $("#widgetFormNewObject").show();
            clearCustomInteractions();
            vo.emptyForm();
        }
    }
}

function showFeatureKlapKlip(indekKlip) {
    vectorSource.clear();
    vectorSource.addFeature(vectorTerpilihSource.getFeatures()[indekKlip]);
    flash(vectorSource.getFeatures()[0], 1000);
}

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
                color: [0, 0, 255, opacity],
                width: 10 + opacity,
            }),
            image: new ol.style.Circle({
                radius: radius,
                snapToPixel: false,
                stroke: new ol.style.Stroke({
                    color: [0, 0, 0, opacity],
                    width: 2 + opacity,
                }),
            }),
        });

        lvector.setStyle(style);
        if (elapsed > duration) {
            // stop the effect
            ol.Observable.unByKey(listenerKey);
            return;
        }
        // tell OL3 to continue postcompose animation
        map.render();
    }

    listenerKey = map.on("postcompose", animate);
}

function clearCustomInteractions() {
    KondisiInfo = 1;
    map.removeInteraction(select);
    map.removeInteraction(modify);
    map.removeInteraction(polygonDraw);
    map.removeInteraction(pointDraw);
    map.removeInteraction(lineDraw);
}

setInterval(function () {
    var features = vectorSource.getFeatures();
    if (features.length > 0) {
        flash(features, 1000);
    } else {
    }
}, 1000);

function GeomToJson(data, kondisi) {
    datas = data.split(".");
    var lyrGeoserver = datas[0];
    var gid = datas[1];
    $.ajax({
        type: "get",
        url: base_url + "/getFeature/" + lyrGeoserver + "/" + gid,
        success: function (msg) {
            featurecollection = msg;
            geojson_format = new ol.format.GeoJSON();
            vectorSource.clear();
            // vectorSource1.addFeatures(geojson_format.readFeatures(featurecollection));
            vectorSource.addFeatures(
                geojson_format.readFeatures(featurecollection)
            );
            // vo.idGeomTerpilih = vectorSource.getFeatures();
            if (kondisi === 1) {
                var ViewExtent = vectorSource.getExtent();
                view.fit(ViewExtent, map.getSize());
                if (lyrGeoserver == "bangunan" || lyrGeoserver == "sta") {
                    view.setZoom(23);
                }
            }
            //flash(geojson_format.readFeatures(featurecollection)[0],2000)
        },
        error: function (xhr, statusTeks, Kesalahan) {
            alert(Kesalahan);
        },
    });
}

function EditLine() {
    clearCustomInteractions();
    statusClick = "edit";
    select = new ol.interaction.Select();
    modify = new ol.interaction.Modify({
        features: select.getFeatures(),
        deleteCondition: function (event) {
            return (
                ol.events.condition.shiftKeyOnly(event) &&
                ol.events.condition.singleClick(event)
            );
        },
    });
    map.addInteraction(select);
    map.addInteraction(modify);
    select.getFeatures().on("add", function (e) {
        var feature = e.element;
        feature.on("change", function (e) {
            var nilaiGeom;
            nilaiGeom = generateWktLine();
            $("#geom1").val(nilaiGeom);
        });
    });
    return false;
}

function generateWktLine() {
    var featureWkt, modifiedWkt;
    var unionFeatures = [];
    var hasilgeom;
    lvector1.getSource().forEachFeature(function (f) {
        var featureClone = f.clone();
        featureWkt = wkt.writeFeature(featureClone);
        if (featureWkt.match(/MULTILINESTRING/g)) {
            modifiedWkt = featureWkt
                .replace(/MULTILINESTRING/g, "")
                .slice(1, -1);
        } else {
            modifiedWkt = featureWkt
                .replace(/,/g, ",")
                .replace(/LINESTRING/g, "");
        }
        unionFeatures.push(modifiedWkt);
    });
    lvector1.getSource().getFeatures().length
        ? (hasilgeom = "MULTILINESTRING(" + unionFeatures + ")")
        : (hasilgeom = "");

    return hasilgeom;
}

function EditPoint() {
    clearCustomInteractions();
    statusClick = "edit";
    select = new ol.interaction.Select();
    modify = new ol.interaction.Modify({
        features: select.getFeatures(),
        deleteCondition: function (event) {
            return (
                ol.events.condition.shiftKeyOnly(event) &&
                ol.events.condition.singleClick(event)
            );
        },
    });
    map.addInteraction(select);
    map.addInteraction(modify);
    select.getFeatures().on("add", function (e) {
        var feature = e.element;
        feature.on("change", function (e) {
            var nilaiGeom;
            nilaiGeom = generateWktPoint();
            $("#geom1").val(nilaiGeom);
            console.log(nilaiGeom);
        });
    });
    return false;
}

function generateWktPoint() {
    var featureWkt, modifiedWkt;
    var unionFeatures = [];
    var hasilgeom;
    lvector1.getSource().forEachFeature(function (f) {
        var featureClone = f.clone();
        featureWkt = wkt.writeFeature(featureClone);
        tes = featureClone;
        if (featureWkt.match(/POINT/g)) {
            modifiedWkt = featureWkt.replace(/POINT/g, "").slice(1, -1);
        } else {
            modifiedWkt = featureWkt.replace(/,/g, ",").replace(/POINT/g, "");
        }
        unionFeatures.push(modifiedWkt);
    });
    lvector1.getSource().getFeatures().length
        ? (hasilgeom = "POINT(" + unionFeatures + ")")
        : (hasilgeom = "");
    if (unionFeatures.length) {
        var koordinats = unionFeatures[0].split(" ");
        var longlat = new ol.geom.Point([
            parseFloat(koordinats[0]),
            parseFloat(koordinats[1]),
        ]).transform("EPSG:4326", "EPSG:4326");
        $("#long").val(longlat.getCoordinates()[0]);
        $("#lat").val(longlat.getCoordinates()[1]);
        $("#new_long").val(longlat.getCoordinates()[0]);
        $("#new_lat").val(longlat.getCoordinates()[1]);
    }

    return hasilgeom;
}

function refreshLayer(layerAktif) {
    switch (layerAktif) {
        case "sungai":
            lyrSungai.getSource().updateParams({
                time: Date.now(),
            });
            break;
        case "sta":
            lyrSta.getSource().updateParams({
                time: Date.now(),
            });
            break;
        case "bangunan_garis":
            lyrBangunan_garis.getSource().updateParams({
                time: Date.now(),
            });
            break;
        case "bangunan":
            lyrBangunan.getSource().updateParams({
                time: Date.now(),
            });
            break;
    }
}
