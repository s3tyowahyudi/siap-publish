var mapquest = new ol.layer.Tile({
    source: new ol.source.OSM(),
    visible: true,
    title: "Open Street Map",
    type: "basemap",
});

var googleLayerSatellite = new ol.layer.Tile({
    title: "Google Satellite",
    source: new ol.source.TileImage({
        url: "http://khm0.googleapis.com/kh?v=717&hl=pl&&x={x}&y={y}&z={z}",
    }),
    visible: false,
});
// url: 'http://khm{0-3}.googleapis.com/kh?v=742&hl=pl&&x={x}&y={y}&z={z}'
var googleLayerRoadmap = new ol.layer.Tile({
    title: "Google Road Map",
    source: new ol.source.TileImage({
        url: "http://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
        projection: "EPSG:3857",
    }),
    visible: false,
});

var googleLayerHybrid = new ol.layer.Tile({
    title: "Google Satellite & Roads",
    source: new ol.source.TileImage({
        url: "http://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}",
        projection: "EPSG:3857",
    }),
    visible: false,
});

var googleLayerTerrain = new ol.layer.Tile({
    title: "Google Terrain",
    source: new ol.source.TileImage({
        url: "http://mt1.google.com/vt/lyrs=t&x={x}&y={y}&z={z}",
        projection: "EPSG:3857",
    }),
    visible: false,
});

var googleLayerHybrid2 = new ol.layer.Tile({
    title: "Google Terrain & Roads",
    source: new ol.source.TileImage({
        url: "http://mt1.google.com/vt/lyrs=p&x={x}&y={y}&z={z}",
        projection: "EPSG:3857",
    }),
    visible: false,
});

var googleLayerOnlyRoad = new ol.layer.Tile({
    title: "Google Road without Building",
    source: new ol.source.TileImage({
        url: "http://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}",
        projection: "EPSG:3857",
    }),
    visible: false,
});

//BEGIN SETTING LAYER BINGMAP
var bingmapsjalan = new ol.layer.Tile({
    source: new ol.source.BingMaps({
        key: "AuTA6PnAI3n8Bnd5w4NfxcPSPwx5yITWk6JAum3AO8bSU1LgKAvDuEGZOMRFqDQL",
        imagerySet: "Road",
    }),
    visible: false,
    title: "Bing Roads",
});
//END SETTING LAYER BINGMAP

//BEGIN SETTING LAYER BINGMAP
var bingmaps = new ol.layer.Tile({
    source: new ol.source.BingMaps({
        key: "AuTA6PnAI3n8Bnd5w4NfxcPSPwx5yITWk6JAum3AO8bSU1LgKAvDuEGZOMRFqDQL",
        imagerySet: "Aerial",
    }),
    visible: false,
    title: "Bing Satellite",
});
//END SETTING LAYER BINGMAP

//BEGIN SETTING LAYER BINGMAP
var bingmapslabel = new ol.layer.Tile({
    source: new ol.source.BingMaps({
        key: "AuTA6PnAI3n8Bnd5w4NfxcPSPwx5yITWk6JAum3AO8bSU1LgKAvDuEGZOMRFqDQL",
        imagerySet: "AerialWithLabels",
    }),
    visible: false,
    title: "Bing Satellite & Roads",
});
//END SETTING LAYER BINGMAP

var cartoDbVoyager = new ol.layer.Tile({
    source: new ol.source.XYZ({
        url: "http://{1-4}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}.png",
    }),
    visible: false,
    title: "cartoDbVoyager",
});

var cartoDbPositron = new ol.layer.Tile({
    source: new ol.source.XYZ({
        url: "http://{1-4}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png",
    }),
    visible: false,
    title: "cartoDbPositron",
});

var cartoDbDarkMatter = new ol.layer.Tile({
    source: new ol.source.XYZ({
        url: "http://{1-4}.basemaps.cartocdn.com/rastertiles/dark_all/{z}/{x}/{y}.png",
    }),
    visible: false,
    title: "cartoDbDarkMatter",
});

//BEGIN SETTING LAYER ESRI
var esri = new ol.layer.Tile({
    source: new ol.source.XYZ({
        attributions:
            'Tile &copy; <a href="http://services.arcgisonline.com/ArcGIS/' +
            'rest/services/World_Topo_Map/MapServer">ArcGIS</a>',
        url:
            "http://server.arcgisonline.com/ArcGIS/rest/services/" +
            "World_Topo_Map/MapServer/tile/{z}/{y}/{x}",
    }),
    visible: false,
    title: "esri",
});
//END SETTING LAYER ESRI

//BEGIN SETTING LAYER STAMEN
var stamen = new ol.layer.Group({
    layers: [
        new ol.layer.Tile({
            source: new ol.source.Stamen({
                layer: "watercolor",
            }),
        }),
        new ol.layer.Tile({
            source: new ol.source.Stamen({
                layer: "terrain-labels",
            }),
        }),
    ],
    visible: false,
    title: "stamen",
});
//END SETTING LAYER STAMEN

//Awal Setting penyajian basemap
function basemap(layername) {
    var name;
    map.getLayers()
        .getArray()
        .forEach(function (e) {
            name = e.get("title");
            if (
                name == "Open Street Map" ||
                name == "Google Satellite" ||
                name == "Google Road Map" ||
                name == "Google Satellite & Roads" ||
                name == "Google Terrain" ||
                name == "Google Terrain & Roads" ||
                name == "Google Road without Building" ||
                name == "Bing Roads" ||
                name == "Bing Satellite" ||
                name == "Bing Satellite & Roads" ||
                name == "cartoDbVoyager" ||
                name == "cartoDbPositron" ||
                name == "cartoDbDarkMatter" ||
                name == "esri" ||
                name == "stamen"
            ) {
                e.setVisible(name == layername);
            }
        });
}
//Akhir Setting penyajian basemap
