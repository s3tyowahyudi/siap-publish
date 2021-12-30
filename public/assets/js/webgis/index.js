$("#tooltipsBeranda").dxTooltip({
    target: "#btnBeranda",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("#tooltipsZoomIn").dxTooltip({
    target: "#btnZoomIn",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("#tooltipsZoomOut").dxTooltip({
    target: "#btnZoomOut",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("#tooltipsZoomExtent").dxTooltip({
    target: "#btnZoomExtent",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("#tooltipsLegenda").dxTooltip({
    target: "#btnLegenda",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("#tooltipsBasemap").dxTooltip({
    target: "#btnBasemap",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("#tooltipsTabular").dxTooltip({
    target: "#btnTabular",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("#tooltipsRuler").dxTooltip({
    target: "#btnRuler",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("#tooltipsClear").dxTooltip({
    target: "#btnClear",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("#tooltipsNewObject").dxTooltip({
    target: "#btnNewObject",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("#tooltipsUploadShp").dxTooltip({
    target: "#btnUploadShp",
    showEvent: "mouseenter",
    hideEvent: "mouseleave",
    closeOnOutsideClick: false,
    position: "right",
});

$("input[name='BaseMap']").change(function () {
    layername = $(this).val();
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
});
