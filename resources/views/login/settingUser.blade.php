@extends('master')

@section('css')
    @include('includes.login.style')
@endsection

@section('script')
    @include('includes.login.script')
@endsection

<div class="appsimtaru">
    @section('content')
        @include('umum.navbar1')
        <div class="main-content">
            <div class="main-content">
                <div class="main-conten-inner">
                    <div class="page-content" style="height:100%">
                        <div class="container" style="margin-top: 45px">
                            <div class="row" style="margin-top: 10%">
                                <div class="col-sm-12 col-md-6 col-md-offset-3">
                                    <div class="widget-box widget-color-blue2" style="margin-bottom: 20px">
                                        <div class="widget-header widget-header-small">
                                            <h6 class="widget-title">
                                                SETTING PENGGUNA
                                            </h6>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <form action="UpdateUser" class="form-horizontal" role="form" id="frmSettingUser" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label no-padding-right" for="nama"> Nama </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="nama" name="nama" value="{{Auth::user()->nama}}" class="form-control input-sm"/>
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label no-padding-right" for="email"> Email </label>
                                                        <div class="col-sm-8">
                                                            <input type="email" id="email" name="email"  placeholder="Email" class="form-control input-sm" value="{{Auth::user()->email}}" disabled/>
                                                        </div>
                                                    </div>
                
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label no-padding-right" for="level"> Level </label>
                                                        <div class="col-sm-8">
                                                            <input type="email" id="level" name="level"  class="form-control input-sm" value="{{Auth::user()->level}}" disabled/>
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label no-padding-right" for="password"> Password Baru </label>
                                                        <div class="col-sm-8">
                                                            <input type="password" id="password" name="password"  class="form-control input-sm" />
                                                        </div>
                                                    </div>
                
                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label no-padding-right" for="password1"> Ketik Ulang Password Baru </label>
                                                        <div class="col-sm-8">
                                                            <input type="password" id="password1" name="password1"  class="form-control input-sm" />
                                                        </div>
                                                    </div>
                    
                                                    <div class="clearfix form-actions">
                                                        <div class="center">
                                                            <button class="btn btn-info btn-sm" type="submit">
                                                                <i class="ace-icon fa fa-check"></i>
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                {{-- @include('umum.footer') --}}
            </div>
        </div>
@endsection
</div>
