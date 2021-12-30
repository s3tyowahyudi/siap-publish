var vo = new Vue({
    el: "#appSimtaru",
    data: {
        idGeomTerpilih: [],
        gidAktif: null,
        layerAktif: "",
        indeks: 0,
        kunci: [], //NamaField
        jmlField: 0,
        DataInfo: [],
        strukturTabel: [],
        kondisiEdit: false,
        kondisiNew: false,
        kondisiInfo: true,
        statusL: 1,
        panjangRuas: null,
        koordinatAwalRuas: [],
        koordinatAkhirRuas: [],
        valFungsi: {
            "Strategis Nasional": "Strategis Nasional",
            "Jalan Kolektor Primer 2": "Jalan Kolektor Primer 2",
            "Jalan Kolektor Primer 3": "Jalan Kolektor Primer 3",
            "Kolektor Sekunder": "Kolektor Sekunder",
            "Lokal Primer": "Lokal Primer",
            "Lingkungan Primer": "Lingkungan Primer",
            Lingkungan: "Lingkungan",
        },
        valKondisi: {
            Baik: "Baik",
            Sedang: "Sedang",
            "Rusak Ringan": "Rusak Ringan",
            "Rusak Berat": "Rusak Berat",
        },
        valPerkerasan: {
            Aspal: "Aspal",
            "Rigid/Beton": "Rigid/Beton",
            "Kerikil/Telford": "Kerikil/Telford",
            "Lapisan Penetrasi Macadam": "Lapisan Penetrasi Macadam",
            Macadam: "Macadam",
            "Tanah/Belum Tembus": "Tanah/Belum Tembus",
        },
        statusFoto: 0,
        fotos: [],
        fpdf: [],
        gidObjek: null,
    },
    methods: {
        Awal: function () {},
        dateToYYYYMMDD(date) {
            if (date != undefined) {
                tgls = date.split("T");
                return tgls[0];
            } else {
                return "";
            }
        },
        ShowInformasi: function (index) {
            ClearInfo();
            var IdLayers = this.idGeomTerpilih[index].getId().split(".");
            var IdLayer = IdLayers[0];

            var gid = this.idGeomTerpilih[index].get("gid");
            this.gidAktif = gid;
            this.layerAktif = IdLayer;
            $.ajax({
                url: base_url + "/getDataByGid/" + gid + "/" + IdLayer,
                type: "get",
                success: function (msg) {
                    vectorSource.clear();
                    vectorSource.addFeature(
                        vectorTerpilihSource.getFeatures()[index]
                    );
                    showFeatureKlapKlip(index);
                    vo.DataInfo = msg["data"];
                    vo.kunci = msg["nmfield"];
                    vo.strukturTabel = msg["strukturField"];
                    vo.jmlField = msg["jmlField"];
                    for (var i = 0; i < vo.kunci.length - 1; i++) {
                        if (vo.kunci[i] == "geom") {
                            vo.kunci.splice(i, 1);
                        }
                        if (
                            vo.strukturTabel[i].dataType == "number" &&
                            vo.kunci[i] != "gid"
                        ) {
                            if (vo.kunci[i] != "gid") {
                                vo.DataInfo[vo.kunci[i]] = Number(
                                    vo.DataInfo[vo.kunci[i]]
                                ).toFixed(vo.strukturTabel[i].format.precision);
                            }
                        }
                    }
                    vo.indeks = index;
                },
            });
        },
        ShowTabel: function (nmlayer, idhtml) {
            $.ajax({
                type: "get",
                url: base_url + "/ShowTabel/" + nmlayer,
                success: function (msg) {
                    $("#" + idhtml).dxDataGrid({
                        dataSource: msg["data"],
                        showRowLines: true,
                        rowAlternationEnabled: true,
                        filterRow: {
                            visible: true,
                        },
                        columns: msg["nmfield"],
                        paging: {
                            pageSize: 10,
                        },
                        pager: {
                            showInfo: true,
                            showPageSizeSelector: true,
                            infoText: "Page #{0}. Total: {1} ({2})",
                            allowedPageSizes: [5, 10, 20],
                        },
                        onContentReady: function (e) {
                            var totalRecords = e.component.totalCount();
                            e.component.option(
                                "pager.infoText",
                                "Records: " + totalRecords + ". Page {0} of {1}"
                            );
                            $(".dx-texteditor-input").addClass(
                                "browser-default"
                            );
                        },
                        sorting: {
                            mode: "multiple",
                        },
                        allowColumnReordering: true,
                        allowColumnResizing: true,
                        columnAutoWidth: true,
                        columnResizingMode: "widget",
                        groupPanel: {
                            visible: true,
                        },
                        searchPanel: {
                            visible: true,
                            width: 300,
                            placeholder: "Search...",
                        },
                        columnChooser: {
                            enabled: true,
                            height: 300,
                            width: 400,
                            emptyPanelText:
                                "drag colomn ke sini untuk menyembunyikan",
                        },

                        export: {
                            enabled: vo.statusL,
                            fileName: "DataGrid",
                        },

                        selection: {
                            mode: "single",
                        },
                        onSelectionChanged: function (selectedItems) {
                            var data = selectedItems.selectedRowsData;
                            vectorSource1.clear();
                            if (data.length == 0) {
                                vectorSource1.clear();
                                vectorSource.clear();
                            }
                            for (i = 0; i < data.length; i++) {
                                if (i == data.length - 1) {
                                    GeomToJson(nmlayer + "." + data[i].gid, 1);
                                } else {
                                    GeomToJson(nmlayer + "." + data[i].gid, 0);
                                }
                            }
                        },
                        summary: {
                            groupItems: [
                                {
                                    column: "gid",
                                    summaryType: "count",
                                },
                                {
                                    column: "panjang",
                                    summaryType: "sum",
                                    showInGroupFooter: false,
                                    displayFormat: "Panjang {0} m",
                                    valueFormat: {
                                        type: "fixedPoint",
                                        precision: 3,
                                    },
                                },
                            ],
                            totalItems: [
                                {
                                    column: "panjang",
                                    summaryType: "sum",
                                    valueFormat: {
                                        type: "fixedPoint",
                                        precision: 3,
                                    },
                                    displayFormat: "Total Keseluruhan {0} m",
                                },
                            ],
                        },
                    });
                },
            });
        },
        cmdEdit_click: function () {
            $("#wInformasi").window("close");
            $("#window-infoEdit").window("open");
            // $("#panel-layer").panel("close");
            // $("#panel-infoterpilih").panel("close");
            this.kondisiEdit = true;
            statusClick = "edit";
            vectorSource1.clear();
            vectorSource.clear();
            vectorSource1.addFeature(
                vectorTerpilihSource.getFeatures()[this.indeks]
            );
            switch (this.layerAktif) {
                case "sungai":
                case "bangunan_garis":
                    EditLine();
                    break;
                case "sta":
                case "bangunan":
                    EditPoint();
                    break;
            }
        },
        cmdBatal_click: function () {
            this.kondisiEdit = false;
            $("#window-infoEdit").window("close");
            ClearInfo();
        },
        GambarNewObject: function () {
            clearCustomInteractions();
            // ClearInfo();
            statusClick = "create";
            switch (this.layerAktif) {
                case "sungai":
                case "bangunan_garis":
                    lineDraw = new ol.interaction.Draw({
                        source: vectorSource1,
                        type: "LineString",
                    });
                    map.addInteraction(lineDraw);
                    lineDraw.on("drawend", function (e) {
                        $("#wnewObject").window("close");
                        $("#wFormNewObject").window("open");
                        clearCustomInteractions();
                        vo.emptyForm();
                        var coordinates = e.feature
                            .getGeometry()
                            .getCoordinates();
                        jarak = 0;
                        var sourceProj = map.getView().getProjection();
                        for (
                            var i = 0, ii = coordinates.length - 1;
                            i < ii;
                            ++i
                        ) {
                            var c1 = ol.proj.transform(
                                coordinates[i],
                                sourceProj,
                                "EPSG:4326"
                            );
                            var c2 = ol.proj.transform(
                                coordinates[i + 1],
                                sourceProj,
                                "EPSG:4326"
                            );
                            jarak += ol.sphere.getDistance(c1, c2);
                        }
                        vo.panjangRuas = jarak.toFixed(2);
                        vo.koordinatAwalRuas = coordinates[0];
                        vo.koordinatAkhirRuas =
                            coordinates[coordinates.length - 1];
                    });
                    break;
                case "bangunan":
                case "sta":
                    pointDraw = new ol.interaction.Draw({
                        source: vectorSource1,
                        type: "Point",
                    });
                    map.addInteraction(pointDraw);
                    pointDraw.on("drawend", function (e) {
                        $("#wnewObject").window("close");
                        $("#wFormNewObject").window("open");
                        clearCustomInteractions();
                        vo.emptyForm();
                    });
                    break;
            }
        },
        emptyForm: function () {
            vo.strukturTabel = [];
            var urlField = base_url + "/NamaFieldTabel/" + this.layerAktif;
            $.ajax({
                url: urlField,
                type: "get",
                success: function (msg) {
                    vo.strukturTabel = [];
                    vo.strukturTabel = msg;
                    vo.strukturEdit = msg;
                    for (i = 0; i < vo.strukturTabel.length - 1; i++) {
                        try {
                            $("#new_" + vo.strukturTabel[i].dataField).val("");
                        } catch (e) {}
                    }
                },
            });
        },
        simpanObject: function () {
            var datastring =
                $("#frmEdit").serialize() + "&layerAktif=" + this.layerAktif;
            var formAction = $("#frmEdit").attr("action");
            $.ajax(
                {
                    type: "POST",
                    url: formAction,
                    data: datastring,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (data) {
                        refreshLayer(vo.layerAktif);
                        // vo.refreshTabel(vo.layerAktif);
                        clearCustomInteractions();
                        ClearInfo();
                        vo.kondisiEdit = false;
                        $("#window-infoEdit").window("close");
                    },
                },
                "json"
            );
        },
        simpanNewObject: function (e) {
            var nilaiGeom;
            // console.log($('#frmNew').valid());
            // if ($("#frmNew").valid()) {
            switch (this.layerAktif) {
                case "sungai":
                case "bangunan_garis":
                    nilaiGeom = generateWktLine();
                    break;
                case "bangunan":
                    nilaiGeom = generateWktPoint();
                    break;
            }
            $("#geom").val(nilaiGeom);
            // e.preventDefault();
            var datastring =
                $("#frmNew").serialize() + "&layerAktif=" + this.layerAktif;
            var formAction = $("#frmNew").attr("action");
            // console.log(datastring);
            $.ajax(
                {
                    type: "POST",
                    url: formAction,
                    data: datastring,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (data) {
                        refreshLayer(vo.layerAktif);
                        // vo.refreshTabel(vo.layerAktif);
                        statusClick = "Informasi";
                        vectorSource1.clear();
                        clearCustomInteractions();
                        vo.idGeomTerpilih = [];
                        vo.kondisiNew = false;
                        ClearInfo();
                        $("#wFormNewObject").window("close");
                    },
                },
                "json"
            );
            // }
        },
        deleteObject: function () {
            swal.fire({
                title: "Anda yakin untuk menghapus?",
                text: "Setelah dihapus, tidak bisa dikembalikan lagi",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
            }).then((result) => {
                if (result.value) {
                    var gid = vo.gidAktif;
                    $.ajax({
                        url: base_url + "/delete",
                        method: "POST",
                        data: {
                            gid: gid,
                            layerAktif: vo.layerAktif,
                        },
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function (response) {
                            refreshLayer(vo.layerAktif);
                            // vo.refreshTabel(vo.layerAktif);
                            clearCustomInteractions();
                            ClearInfo();
                            swal.fire(
                                "Terhapus!",
                                "Data sudah terhapus.",
                                "success"
                            );
                            $("#wInformasi").window("close");
                        },
                    });
                }
            });
        },
        cmbTabel: function (tabel) {
            this.ShowTabel(tabel, "tabelJalan");
            switch (tabel) {
                case "bangunan":
                    $("#jdlTabel").text("Tabel Bangunan Sungai");
                    break;
                case "sta":
                    $("#jdlTabel").text("Tabel STA");
                    break;
                case "sungai":
                    $("#jdlTabel").text("Tabel Sungai");
                    break;
            }
        },
        showTabelInfoDetail: function () {
            if (this.layerAktif != "titik_pengenal_jalan") {
                $.ajax({
                    type: "get",
                    url: base_url + "/ShowInfoDetail",
                    data: {
                        gidAktif: vo.gidAktif,
                        layerAktif: vo.layerAktif,
                    },
                    success: function (msg) {
                        $("#tblInfoDetail").dxDataGrid({
                            dataSource: msg["data"],
                            showRowLines: true,
                            rowAlternationEnabled: true,
                            filterRow: {
                                visible: true,
                            },
                            columns: msg["nmfield"],
                            paging: {
                                pageSize: 10,
                            },
                            pager: {
                                showInfo: true,
                                showPageSizeSelector: true,
                                infoText: "Page #{0}. Total: {1} ({2})",
                                allowedPageSizes: [5, 10, 20],
                            },
                            onContentReady: function (e) {
                                var totalRecords = e.component.totalCount();
                                e.component.option(
                                    "pager.infoText",
                                    "Records: " +
                                        totalRecords +
                                        ". Page {0} of {1}"
                                );
                                $(".dx-texteditor-input").addClass(
                                    "browser-default"
                                );
                            },
                            onEditorPrepared: function (e) {
                                if (e.dataField == "tanggal") {
                                    e.editorOptions = {
                                        type: "datetime",
                                    };
                                }
                            },
                            sorting: {
                                mode: "multiple",
                            },
                            allowColumnReordering: true,
                            allowColumnResizing: true,
                            columnAutoWidth: true,
                            columnResizingMode: "widget",
                            groupPanel: {
                                visible: true,
                            },
                            searchPanel: {
                                visible: true,
                                width: 300,
                                placeholder: "Search...",
                            },
                            columnChooser: {
                                enabled: true,
                                height: 300,
                                width: 400,
                                emptyPanelText:
                                    "drag colomn ke sini untuk menyembunyikan",
                            },
                            export: {
                                enabled: vo.statusL,
                                fileName: "DataGrid",
                            },
                            selection: {
                                mode: "single",
                            },
                            onSelectionChanged: function (selectedItems) {
                                vo.statusFoto = 1;
                                var data = selectedItems.selectedRowsData;
                                vo.gidObjek = data[0].gid;
                                // vo.getFoto();
                                // vectorSource1.clear();
                                // if (data.length == 0) {
                                //     vectorSource1.clear();
                                //     vectorSource.clear();
                                // }
                                // for (i = 0; i < data.length; i++) {
                                //     if (i == data.length - 1) {
                                //         GeomToJson(
                                //             nmlayer + "." + data[i].gid,
                                //             1
                                //         );
                                //     } else {
                                //         GeomToJson(
                                //             nmlayer + "." + data[i].gid,
                                //             0
                                //         );
                                //     }
                                // }
                            },
                            summary: {
                                groupItems: [
                                    {
                                        column: "gid",
                                        summaryType: "count",
                                    },
                                    {
                                        column: "panjang",
                                        summaryType: "sum",
                                        showInGroupFooter: false,
                                        displayFormat: "Panjang {0} m",
                                        valueFormat: {
                                            type: "fixedPoint",
                                            precision: 3,
                                        },
                                    },
                                ],
                                totalItems: [
                                    {
                                        column: "panjang",
                                        summaryType: "sum",
                                        valueFormat: {
                                            type: "fixedPoint",
                                            precision: 3,
                                        },
                                        displayFormat:
                                            "Total Keseluruhan {0} m",
                                    },
                                ],
                            },
                            editing: {
                                mode: "row",
                                allowUpdating: true,
                                allowDeleting: true,
                                allowAdding: true,
                            },
                            onInitNewRow: function (e) {
                                fieldAktif = "gid_" + vo.layerAktif;
                                e.data[fieldAktif] = vo.gidAktif;
                            },
                            onRowInserted: function (e) {
                                console.log(e.data);
                                $.ajax(
                                    {
                                        type: "POST",
                                        url: base_url + "/simpanNewDetail",
                                        data: {
                                            data: e.data,
                                            layerAktif: vo.layerAktif,
                                        },
                                        headers: {
                                            "X-CSRF-TOKEN": $(
                                                'meta[name="csrf-token"]'
                                            ).attr("content"),
                                        },
                                        success: function (data) {
                                            vo.showTabelInfoDetail();
                                        },
                                    },
                                    "json"
                                );
                            },
                            onRowUpdating: function (e) {
                                // console.log(e);
                                $.ajax(
                                    {
                                        type: "POST",
                                        url: base_url + "/updateDatail",
                                        data: {
                                            newData: e.newData,
                                            oldData: e.oldData,
                                            layerAktif: vo.layerAktif,
                                        },
                                        headers: {
                                            "X-CSRF-TOKEN": $(
                                                'meta[name="csrf-token"]'
                                            ).attr("content"),
                                        },
                                        success: function (data) {
                                            vo.showTabelInfoDetail();
                                        },
                                    },
                                    "json"
                                );
                            },
                            onRowRemoved: function (e) {
                                console.log(e);
                                $.ajax(
                                    {
                                        type: "POST",
                                        url: base_url + "/deleteDetail",
                                        data: {
                                            data: e.data,
                                            layerAktif: vo.layerAktif,
                                        },
                                        headers: {
                                            "X-CSRF-TOKEN": $(
                                                'meta[name="csrf-token"]'
                                            ).attr("content"),
                                        },
                                        success: function (data) {
                                            vo.showTabelInfoDetail();
                                        },
                                    },
                                    "json"
                                );
                            },
                        });
                        $("#tblInfoDetail").dxDataGrid("refresh");
                    },
                });
            } else {
                $("#tblInfoDetail")
                    .dxDataGrid("instance")
                    .option("dataSource", null);
                vo.statusFoto = 0;
            }
        },
        cmdinfo_detail_click: function () {
            $("#wInfoDetail").window("open");
            this.showTabelInfoDetail();
        },
        getFoto: function () {
            $.ajax({
                type: "get",
                url: base_url + "/getFoto",
                data: {
                    gid: this.gidAktif,
                    layerAktif: this.layerAktif,
                    gidObjek: this.gidObjek,
                },
                success: function (msg) {
                    vo.fotos = msg["fImage"];
                    vo.fpdf = msg["fPdf"];
                },
                complete: function () {
                    setTimeout(function () {
                        $('.ace-thumbnails [data-rel="colorbox"]').colorbox(
                            colorbox_params
                        );
                        $("#cboxLoadingGraphic").html(
                            "<i class='ace-icon fa fa-spinner orange fa-spin'></i>"
                        );
                    }, 2000);
                },
            });
        },
        uploadFoto: function () {
            var formData = new FormData();
            formData.append("file", $("#inpFileFoto")[0].files[0]);
            formData.append("gid", vo.gidAktif);
            formData.append("layerAktif", vo.layerAktif);
            if (formData.get("file") != "undefined") {
                $.ajax(
                    {
                        type: "POST",
                        enctype: "multipart/form-data",
                        url: base_url + "/uploadFoto",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function (data) {
                            $("#inpFileFoto").val("");
                            vo.getFoto();
                            //refreshFoto();
                        },
                        beforeSend: function () {
                            // $("#mdlTunggu").modal("show");
                        },
                        complete: function () {
                            setTimeout(function () {
                                // vo.getFoto();
                            }, 2000);
                        },
                    },
                    "json"
                );
            }
        },
        deleteFoto: function (fileFoto) {
            var r = confirm("Anda yakin untuk menghapus foto ini?");
            if (r == true) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/HapusFileFoto",
                    data: {
                        nmfile: fileFoto,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (data) {
                        vo.getFoto();
                    },
                });
            }
        },
    },
});
