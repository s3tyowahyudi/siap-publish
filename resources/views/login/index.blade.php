@extends('master')

@section('css')
    @include('includes.login.style')
@endsection

@section('script')
    @include('includes.login.script')
@endsection

<div id="app">
    @section('content')
        @include('umum.navbar1')
        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content" style="height:100%">
                    <div class="container" style="margin-top: 45px">
                        <div class="row" style="margin-top: 10%">
                            <div class="col-sm-12 col-md-6 col-md-offset-3">
                                <div class="widget-box widget-color-blue2" style="margin-bottom: 20px">
                                    <div class="widget-header widget-header-small">
                                        <h6 class="widget-title">
                                            LOGIN
                                        </h6>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <form action="login" method="POST" id="frmLogin">
                                                @csrf
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="email" class="form-control" placeholder="Email" id="email" name="email"/>
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>
    
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" class="form-control" placeholder="Password" id="password"    name="password"/>
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>
    
                                                    <div class="space"></div>
                                                    
                                                    <div class="clearfix">
                                                        <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                            <i class="ace-icon fa fa-key"></i>
                                                            <span class="bigger-110">Login</span>
                                                        </button>
                                                    </div>
    
                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    @endsection
</div>