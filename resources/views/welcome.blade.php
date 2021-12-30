@extends('master')

@section('css')
    @include('includes.welcome.style')
@endsection

@section('script')
    @include('includes.welcome.script')
@endsection

@section('content')
<section class="scene">
    <div class="sun"></div>
    <div class="bg">
        <img src="assets/img/mobil1.png" class="car1">
        <img src="assets/img/mobil2.png" class="car2">
    </div>
    <div>
        <img src="assets/img/si-jantan.png" id="si-jantan">
    </div>
    <div>
        <img src="assets/img/dinas.png" id="dinas">
    </div>
    <div id="rwFormLogin">
        <div class="widget-box widget-color-blue" id="widget-box-3">
            <div class="widget-header widget-header-small">
                <h6 class="widget-title">
                    <i class="fas fa-key"></i>
                    Login
                </h6>
            </div>

            <div class="widget-body">
                <form action="login" method="POST" id="frmLogin">
                    @csrf
                    <div class="widget-main">
                        <div style="margin-bottom:20px;margin-top:20px">
                            <input class="easyui-textbox" type="email" style="width:100%;height:34px;padding:10px;" id="email" name="email" placeholder="Email">
                        </div>
                        <div style="margin-bottom:20px">
                            <input class="easyui-passwordbox" type="password" style="width:100%;height:34px;padding:10px" id="password" name="password" placeholder="Password">
                        </div>
    
                        <div class="clearfix form-actions" style="margin: 0px">
                            <div class="text-center">
                                <a class="btn btn-sm btn-primary" href="webgis">
                                    <i class="ace-icon fa fa-sign-in-alt bigger-110"></i>
                                    Login
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection