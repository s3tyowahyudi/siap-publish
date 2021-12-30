<script type="text/javascript">

var vo = new Vue({
    el: "#appSimtaru",
    data: {
        fileFoto: '#',
    },
    methods: {
        Awal: function () {
            this.ShowTabelFile();
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
                            ],
                        },
                    });
                },
            });
        },

        ShowTabelFile: function(){
            $.ajax({
                type: "get",
                url: "{{ url('showTabelFile') }}" ,
                success: function (msg) {
                    $("#isiTabelFile").dxDataGrid({
                        dataSource: msg["data"],
                        showRowLines: true,
                        rowAlternationEnabled: true,
                        filterRow: {
                            visible: true,
                        },
                        columns: [{
                            type: "buttons",
                            width: 130,
                            buttons: ["edit", "delete", {
                                hint: "view",
                                icon: 'fa fa-eye',
                                visible: function(e) {
                                    if(e.row.data.ekstensi=="jpg" || e.row.data.ekstensi=="png" || e.row.data.ekstensi=="pdf"){
                                        hasil=true;
                                    }else{
                                        hasil=false;
                                    }
                                    return hasil;
                                },
                                
                                onClick: function(e) {
                                    if(e.row.data.ekstensi=="pdf"){
                                        $('#w-pdf').window('open');
                                        PDFObject.embed("storage/dokumen/" + e.row.data.kategori + "/" + e.row.data.namafile, "#show-pdf");
                                    }else{
                                        $('#w-foto').window('open');
                                        $("#img-foto").attr("src","storage/dokumen/" + e.row.data.kategori + "/" + e.row.data.namafile );
                                    }
                                    
                                }
                            },{
                                hint: "download",
                                icon: 'fa fa-download',
                                onClick:function(e){
                                    var alamat_url="?nmFile=" + e.row.data.namafile + "&kategori=" + e.row.data.kategori;
                                    var base_url="{{ url('downloadDokumen') }}";
                                    window.open(base_url + alamat_url, "_blank");
                                }
                            }]
                        },{
                            dataField:"kategori",
                            dataType:"string",
                            groupIndex: 0
                        },{
                            dataField:"keterangan",
                            dataType:"string"
                        },{
                            dataField:"namafile",
                            dataType:"string",
                            width: 350,
                            allowEditing: false,
                        },{
                            dataField:"ekstensi",
                            dataType:"string",
                            width: 100,
                            allowEditing: false,
                        }],
                        paging: {
                            pageSize: 20,
                        },
                        pager: {
                            showInfo: true,
                            showPageSizeSelector: true,
                            infoText: "Page #{0}. Total: {1} ({2})",
                            allowedPageSizes: [20, 50, 100],
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
                        editing: {
                            mode: "row",
                            allowUpdating: true,
                            allowDeleting: true,
                            useIcons: true
                        },
                        export: {
                            enabled: true,
                            fileName: "DataGrid",
                        },

                        selection: {
                            mode: "single",
                        },
                        
                        onSelectionChanged: function (selectedItems) {
                            
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
        },

        uploadDokumen: function () {
            var formData = new FormData();
            formData.append("file", $("#new-file")[0].files[0]);
            formData.append("keterangan", $('#new-keterangan').val());
            formData.append('kategori',$('#new-kategori').val());
            if (formData.get("file") != "undefined") {
                $.ajax(
                    {
                        type: "POST",
                        enctype: "multipart/form-data",
                        url:  "{{ url('uploadDokumen') }}",
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
                            $("#new-file").val('');
                            $('#new-keterangan').val('');
                            $('#new-kategori').val('');
                            vo.ShowTabelFile();
                        },
                        beforeSend: function () {
                            // $("#mdlTunggu").modal("show");
                        },
                        complete: function () {
                            // setTimeout(function () {
                            //     VFoto.getFotoBangunan();
                            // }, 2000);
                        },
                    },
                    "json"
                );
            }
        },
    },
});


</script>