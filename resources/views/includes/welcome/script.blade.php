<script src="assets/ace/assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='assets/ace/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/ace/assets/js/bootstrap.min.js"></script>
<script src="assets/ace/assets/js/ace-elements.min.js"></script>
<script src="assets/ace/assets/js/ace.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script> 
<script>
    const sun=document.querySelector('.sun');
    const body=document.querySelector('body');
    sun.onclick=function(){
        body.classList.toggle('dark');
    }
    jQuery(function($) {
        $(document).on('click', '.toolbar a[data-target]', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
            
            $('#email').val('');
            $('#password').val('');
        });
    });

    $(document).ready(function(){
        $('#email').val('');
        $('#password').val('');
    });

    $.validator.setDefaults({
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('#frmLogin').validate({
        rules:{
            email:{email:true, required:true},
            password:{required:true}
        },
        messages:{
            email:{email:'Penulisan email tidak benar', required:'Email harus diisi' },
            password:{required:'Password harus diisi'}
        },
        submitHandler:function(form){
            var email=$('#email').val();
            var form=$('#frmLogin');
            var datastring=form.serialize();
            var formAction=form.attr('action');

            $.ajax({
                type: 'POST',
                url: formAction,
                data: datastring,
                async:true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    window.location.replace(window.location.origin + "/si-djkm/public" + data);
                    // console.log(data);

                }
            });
        }
    });
</script>