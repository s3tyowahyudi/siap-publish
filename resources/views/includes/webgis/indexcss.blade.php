<script type="text/javascript">
    var colorbox_params = {
        rel: 'colorbox',
        reposition:true,
        scalePhotos:true,
        scrolling:false,
        previous:'<i class="ace-icon fa fa-arrow-left"></i>',
        next:'<i class="ace-icon fa fa-arrow-right"></i>',
        close:'&times;',
        current:'{current} of {total}',
        maxWidth:'100%',
        maxHeight:'100%',
        onOpen:function(){
            $overflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
        },
        onClosed:function(){
            document.body.style.overflow = $overflow;
        },
        onComplete:function(){
            $.colorbox.resize();
        }
    };

    // $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
    $('[data-rel="colorbox"]').colorbox(colorbox_params);
    $( document ).ready(function() {
        if($(window).width()>=992){
            $("#wLegenda").window('open');
            $("#wLegenda").window('move',{
                top: 50,
                left:$(window).width()-325,
            });

            // $("#wInformasi").window('open');
            $('#wInformasi').window('move',{
                top: 50,
                left:$(window).width()-640,
            });
        }

    });
</script>