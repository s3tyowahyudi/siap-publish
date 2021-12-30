// var wgs84Sphere = new ol.Sphere(6378137);
var sourceJarak = new ol.source.Vector();
var vectorJaarak = new ol.layer.Vector({
    source: sourceJarak,
    style: new ol.style.Style({
        fill: new ol.style.Fill({
            color: "rgba(255, 255, 255, 0.2)",
        }),
        stroke: new ol.style.Stroke({
            color: "#ffcc33",
            width: 2,
        }),
        image: new ol.style.Circle({
            radius: 7,
            fill: new ol.style.Fill({
                color: "#ffcc33",
            }),
        }),
    }),
});
map.addLayer(vectorJaarak);
var sketch;
var draw; // global so we can remove it later

var formatLength = function (line) {
    var length;
    var coordinates = line.getCoordinates();
    length = 0;
    var sourceProj = map.getView().getProjection();
    for (var i = 0, ii = coordinates.length - 1; i < ii; ++i) {
        var c1 = ol.proj.transform(coordinates[i], sourceProj, "EPSG:4326");
        var c2 = ol.proj.transform(coordinates[i + 1], sourceProj, "EPSG:4326");
        length += ol.sphere.getDistance(c1, c2);
    }

    var output;
    if (length > 100) {
        output = Math.round((length / 1000) * 100) / 100 + " " + "km";
    } else {
        output = Math.round(length * 100) / 100 + " " + "m";
    }
    return output;
};

var formatArea = function (polygon) {
    var area;
    var sourceProj = map.getView().getProjection();
    var geom = /** @type {ol.geom.Polygon} */ (
        polygon.clone().transform(sourceProj, "EPSG:4326")
    );
    var coordinates = geom.getLinearRing(0).getCoordinates();

    area = Math.abs(ol.sphere.getArea(geom, { projection: "EPSG:4326" }));
    var output;
    if (area > 10000) {
        output =
            Math.round((area / 1000000) * 100) / 100 + " " + "km<sup>2</sup>";
    } else {
        output = Math.round(area * 100) / 100 + " " + "m<sup>2</sup>";
    }
    return output;
};

function addInteraction() {
    var type =
        $("#typeMeasure").combobox("getValue") == "area"
            ? "Polygon"
            : "LineString";

    draw = new ol.interaction.Draw({
        source: sourceJarak,
        type: /** @type {ol.geom.GeometryType} */ (type),
        style: new ol.style.Style({
            fill: new ol.style.Fill({
                color: "rgba(255, 255, 255, 0.2)",
            }),
            stroke: new ol.style.Stroke({
                color: "rgba(0, 0, 0, 0.5)",
                lineDash: [10, 10],
                width: 2,
            }),
            image: new ol.style.Circle({
                radius: 5,
                stroke: new ol.style.Stroke({
                    color: "rgba(0, 0, 0, 0.7)",
                }),
                fill: new ol.style.Fill({
                    color: "rgba(255, 255, 255, 0.2)",
                }),
            }),
        }),
    });

    map.addInteraction(draw);

    // createMeasureTooltip();
    // createHelpTooltip();

    var listener;
    draw.on(
        "drawstart",
        function (evt) {
            // set sketch
            sketch = evt.feature;

            /** @type {ol.Coordinate|undefined} */
            // var tooltipCoord = evt.coordinate;

            listener = sketch.getGeometry().on("change", function (evt) {
                var geom = evt.target;
                var output;
                if (geom instanceof ol.geom.Polygon) {
                    output = formatArea(geom);
                } else if (geom instanceof ol.geom.LineString) {
                    output = formatLength(geom);
                }
                document.getElementById("alertHasilJarak").innerHTML = output;
            });
        },
        this
    );

    draw.on(
        "drawend",
        function () {
            // unset sketch
            sketch = null;
            // unset tooltip so that a new one can be created
            ol.Observable.unByKey(listener);
        },
        this
    );
}

// $('#typeMeasure').change(function(){
//     alert('tes');
//     map.removeInteraction(draw);
//     addInteraction();
// });
//

function BersihJarak() {
    map.removeInteraction(draw);
    sourceJarak.clear();
    document.getElementById("alertHasilJarak").innerHTML = "";
    statusClick = "Informasi";
}
