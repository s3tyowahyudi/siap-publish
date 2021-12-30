<script type="text/javascript">
    var voChart=new Vue({
        el: "#chart",
        data:{

        },
        methods:{
            Awal: function(){
                this.showChart();
            },
            showChart: function(){
                $.ajax({
                    url: "{{ url('getDataChartFungsi')  }}",
                    type: "get",
                    success: function(msg){
                        $("#chartFungsi").dxPieChart({
                            type: "doughnut",
                            palette: "soft pastel",
                            dataSource:msg["data"],
                            legend: {
                                horizontalAlignment: "center",
                                verticalAlignment: "bottom"
                            },
                            "export": {
                                enabled: true
                            },
                            series: [{
                                argumentField: "fungsi",
                                valueField: "panjang",
                                label: {
                                    visible: true,
                                    format: "fixedPoint",
                                    customizeText: function (point) {
                                        return point.argumentText + ": " + point.valueText + " Km";
                                    },
                                    connector: {
                                        visible: true,
                                        width: 1
                                    }
                                }
                            }]
                        })
                    }
                });
                
            }
        }
    });
</script>