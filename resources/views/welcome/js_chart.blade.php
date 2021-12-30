<script type="text/javascript">
    $("#chartJmlPerumahan").dxPieChart({
        type:"doughnut",
        palette: "soft Pastel",
        dataSource: dsJmlPerumahan,
        legend: {
            horizontalAlignment: "center",
            verticalAlignment: "bottom"
        },
        "export": {
            enabled: true
        },
        series: [{
            argumentField: "kecamatan",
            valueField: "jml",
            label: {
                visible: true,
                format: "fixedPoint",
                customizeText: function (point) {
                    return point.argumentText + ": " + point.valueText + " Perumahan";
                },
                connector: {
                    visible: true,
                    width: 1
                }
            }
        }]
    });

    $("#chartJmlRumah").dxPieChart({
        type:"doughnut",
        palette: "soft Pastel",
        dataSource: dsJmlRumah,
        legend: {
            horizontalAlignment: "center",
            verticalAlignment: "bottom"
        },
        "export": {
            enabled: true
        },
        series: [{
            argumentField: "kecamatan",
            valueField: "jml",
            label: {
                visible: true,
                format: "fixedPoint",
                customizeText: function (point) {
                    return point.argumentText + ": " + point.valueText + " Rumah";
                },
                connector: {
                    visible: true,
                    width: 1
                }
            }
        }]
    });

    function showTabelPerumahan(){
        $.ajax({
            type: "get",
            url: "{{ url('ShowTabel/perumahan') }}",
            success: function (msg) {
                $("#tabelPerumahan").dxDataGrid({
                    dataSource: msg["data"],
                    showRowLines: true,
                    rowAlternationEnabled: true,
                    filterRow: {
                        visible: true,
                    },
                    columns: nmfieldPerumahan,
                    paging: {
                        pageSize: 10,
                    },
                    pager: {
                        showInfo: true,
                        showPageSizeSelector: true,
                        infoText: "Page #{0}. Total: {1} ({2})",
                        allowedPageSizes: [10, 50, 100],
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
                        width: 200,
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
                        enabled: true,
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
                                GeomToJson("perumahan." + data[i].gid, 1);
                            } else {
                                GeomToJson("perumahan." + data[i].gid, 0);
                            }
                        }
                    },
                    summary: {
                        groupItems: [
                            {
                                column: "gid",
                                summaryType: "count",
                            },
                        ],
                    },
                });
            },
        });

    }
    
</script>