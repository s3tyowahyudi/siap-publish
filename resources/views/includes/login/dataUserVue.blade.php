<script type="text/javascript">

    var vo = new Vue({
        el: "#app",
        data: {
            fileFoto: '#',
        },
        methods: {
            Awal: function () {
                this.ShowTabel("users", "IsiTabel");
            },
            
            ShowTabel: function (nmlayer, idhtml) {
                $.ajax({
                    type: "get",
                    url: "{{ url('') }}/ShowTabelUser",
                    success: function (msg) {
                        $("#" + idhtml).dxDataGrid({
                        dataSource: msg,
                        showRowLines: true,
                        rowAlternationEnabled: true,
                        filterRow: {
                            visible: true,
                        },
                        columns: [
                            {
                                type: "buttons",
                                buttons: [
                                    {
                                        name: "save",
                                        cssClass: "my-class",
                                    },
                                    "edit",
                                    "delete",
                                ],
                            },
                            {
                                caption: "Id",
                                dataField: "id",
                                dataType: "number",
                                allowEditing: false,
                            },
                            {
                                caption: "Nama",
                                dataField: "nama",
                                dataType: "string",
                            },
                            {
                                caption: "Email",
                                dataField: "email",
                                dataType: "string",
                            },
                            {
                                caption: "Level",
                                dataField: "level",
                                dataType: "string",
                                lookup: {
                                    dataSource: [
                                        {
                                            id: "Administrator",
                                            value: "Administrator",
                                        },
                                        {
                                            id: "Entry",
                                            value: "Entry",
                                        },
                                    ],
                                    displayExpr: "value",
                                    valueExpr: "id",
                                },
                            },
                        ],
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
                        columnAutoWidth: true,

                        selection: {
                            mode: "single",
                        },
                        summary: {
                            groupItems: [
                                {
                                    column: "gid",
                                    summaryType: "count",
                                },
                            ],
                        },
                        editing: {
                            // allowUpdating: vo.statusL,
                            allowDeleting: {{Auth::check()}},
                            useIcons: true,
                            mode: "popup",
                            popup: {
                                title: $("#jdlTabel").text(),
                                showTitle: true,
                                width: 800,
                                height: 400,
                            },
                        },
                        onRowRemoving: function (e) {
                            $.ajax({
                                url:  "{{ url('') }}/deleteUser",
                                method: "POST",
                                data: {
                                    id: e.data.id,
                                },
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                success: function (response) {
                                    vo.ShowTabel("user", "IsiTabel");
                                    // swal.fire(
                                    //     "Terhapus!",
                                    //     "Data sudah terhapus.",
                                    //     "success"
                                    // );
                                },
                            });
                        },
                    });
                    },
                });
            },
    
            
    
            
        },
    });
    
    
    </script>