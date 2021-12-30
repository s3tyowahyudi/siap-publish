function ReadShp() {
    var shpFile = $("#input-shp").filebox("files")[0];
    var dbfFile = $("#input-dbf").filebox("files")[0];
    shapefile = new Shapefile(
        {
            shp: shpFile,
            dbf: dbfFile,
        },
        function (data) {
            // if (data["header"]["shapeType"] == "PolyLine") {
            if (data["geojson"]["features"].length) {
                var geojson_format = new ol.format.GeoJSON();
                lyrUploadSource.clear();
                lyrUploadSource.addFeatures(
                    geojson_format.readFeatures(data["geojson"])
                );
                var ViewExtent = lyrUploadSource.getExtent();
                view.fit(ViewExtent, map.getSize());
                $("#window-synchronize").window("open");
                $("#window-uploadShp").window("close");

                vo.fieldShp = [];
                vo.fieldShp = data["dbf"]["fields"];
                if (vo.fieldShp.length) {
                    vo.dsSynchronize = [];
                    vo.fieldShp.forEach(function (item, index) {
                        dsSynchronize = {
                            fldShp: item.name,
                            fldShp_type: item.type,
                            fldDatabase: "",
                        };
                        vo.dsSynchronize.push(dsSynchronize);
                    });
                }
            }
            // } else {
            //     Swal.fire({
            //         icon: "error",
            //         // title: "Oops...",
            //         text:
            //             "Data Anda bertype " +
            //             data["header"]["shapeType"] +
            //             ". Data yang bisa diproses harus bertype Polygon",
            //     });
            // }
        }
    );
}

var datagridSynchronize;
$("#cmbLayer-synchronize").combobox({
    onChange: function (newValue, oldValue) {
        $.ajax({
            type: "get",
            url: base_url + "/getFieldSynchronize",
            data: {
                tabel: newValue,
            },
            success: function (msg) {
                // console.log(msg);
                vo.nmFieldSource = [];
                vo.nmFieldSource = msg;
                datagridSynchronize = $("#tblSynchronize")
                    .dxDataGrid({
                        dataSource: vo.dsSynchronize,
                        columns: [
                            {
                                caption: "File Shp",
                                columns: [
                                    {
                                        dataField: "fldShp",
                                        caption: "Field",
                                        dataType: "string",
                                    },
                                    {
                                        dataField: "fldShp_type",
                                        caption: "Type",
                                        dataType: "string",
                                    },
                                ],
                            },
                            {
                                dataField: "fldDatabase",
                                caption: "Field Database",
                                lookup: {
                                    dataSource: msg,
                                    valueExpr: "dataField",
                                    displayExpr: function (item) {
                                        // console.log(item.dataField);
                                        if (item.dataField == "") {
                                            hasilSyn = "";
                                        } else {
                                            hasilSyn =
                                                item.dataField +
                                                "; " +
                                                item.dataType;
                                        }
                                        return hasilSyn;
                                    },
                                },
                            },
                        ],
                        showBorders: true,
                        editing: {
                            mode: "cell",
                            allowUpdating: true,
                            useIcons: true,
                        },
                        paging: {
                            pageSize: 100,
                        },
                    })
                    .dxDataGrid("instance");
            },
        });
    },
});

// var attt;
function checkFieldShp() {
    let rows = datagridSynchronize.getVisibleRows();
    var hasil = true;
    for (let i = 0; i < rows.length; i++) {
        if (rows[i].data.fldDatabase != "") {
            let typeDatabases = rows[i].cells[2].text.split(";");
            let typeDatabase = typeDatabases[1].trim();
            let typeShp = rows[i].data.fldShp_type;
            switch (typeShp) {
                case "Numeric":
                case "Float":
                case "Long":
                case "Double":
                case "Number":
                    if (typeDatabase != "number") {
                        hasil = false;
                    } else {
                        hasil = true;
                    }
                    break;
                case "Character":
                    if (typeDatabase != "string") {
                        hasil = false;
                    } else {
                        hasil = true;
                    }
                    break;
                case "Date":
                    if (typeDatabase != "date") {
                        hasil = false;
                    } else {
                        hasil = true;
                    }
                    break;
            }
            if (hasil == false) {
                Swal.fire({
                    icon: "error",
                    // title: "Oops...",
                    text:
                        'Synchronize data anda ada yang tidak satu type, cek field "' +
                        rows[i].data.fldShp +
                        '"',
                });
                return hasil;
            }
        }
    }
    return hasil;
}

function updateShpToDatabase() {
    let rows = datagridSynchronize.getVisibleRows();
    let datas = Array();
    for (let i = 0; i < rows.length; i++) {
        if (rows[i].data.fldDatabase != "") {
            data = {
                fldShp: rows[i].data.fldShp,
                fldShp_type: rows[i].data.fldShp_type,
                fldDatabase: rows[i].data.fldDatabase,
            };
            datas.push(data);
        }
    }
    // console.log(datas);
    var dataString = Array();
    lyrUpload.getSource().forEachFeature(function (f) {
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
        hasilgeom = "MULTILINESTRING(" + modifiedWkt + ")";
        atribute = featureClone.getProperties();
        // attt = featureClone.getProperties();
        // console.log(atribute);
        dataAdds = {};
        geomet = {
            geom: hasilgeom,
        };
        Object.assign(dataAdds, geomet);
        for (let i = 0; i < datas.length; i++) {
            dataAdd = {};
            if (datas[i].fldShp_type == "Number") {
                var fldDatabase1 = datas[i].fldDatabase;
                var fldShp1 = datas[i].fldShp;
                dataAdd[fldDatabase1] = parseFloat(atribute[fldShp1]);
            } else {
                var fldDatabase1 = datas[i].fldDatabase;
                var fldShp1 = datas[i].fldShp;
                dataAdd[fldDatabase1] = atribute[fldShp1];
            }
            Object.assign(dataAdds, dataAdd);
        }
        dataString.push(dataAdds);
        // console.log(dataString);
    });
    return dataString;
}

function SimpanShpToDatabase() {
    var statusField = checkFieldShp();
    if (statusField) {
        var data = updateShpToDatabase();
        var nmLayer = $("#cmbLayer-synchronize").combobox("getValue");
        $.ajax(
            {
                type: "POST",
                url: base_url + "/simpanNewObjectShp",
                data: {
                    dataString: data,
                    layerAktif: nmLayer,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (data) {
                    refreshLayer(nmLayer);
                    vo.Awal();

                    lyrUploadSource.clear();
                },
            },
            "json"
        );
    }
}
