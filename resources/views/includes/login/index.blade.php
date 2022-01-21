<script type="text/javascript">
    $(document).ready(function(){
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
                        console.log(data);
                        var base_url="{{ url('') }}";
                        base_url=base_url+ data;
                        window.location.replace(base_url);

                    }
                });
            }
        });

        vo.Awal();
    });
</script>