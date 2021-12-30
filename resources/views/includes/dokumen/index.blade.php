<script type="text/javascript">
    $(document).ready(function(){
        $('#new-file').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:false //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });

        $("#photo-popup").dxPopup({
            maxHeight: 600,
            closeOnOutsideClick: true,
            onContentReady: function(e) {
                var $contentElement = e.component.content();  
                $contentElement.addClass("photo-popup-content");
            }
        });

        vo.Awal();

    });
</script>