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
                                                Pengguna Baru
                                            </h6>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <form action="addUser" class="form-horizontal" role="form" id="frmAddUser" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="nama"> Nama </label>
                    
                                                        <div class="col-sm-9">
                                                            <input type="text" id="nama" name="nama" placeholder="Nama" class="form-control input-sm" />
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="email"> Email </label>
                    
                                                        <div class="col-sm-9">
                                                            <input type="email" id="email" name="email"  placeholder="Email" class="form-control input-sm" />
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="level"> Level </label>
                    
                                                        <div class="col-sm-9">
                                                            <select name="level" id="level" class="form-control">
                                                                <option value="Administrator" selected="selected">Administrasi</option>
                                                                <option value="Entry">Entry</option>
                                                            </select>
                                                        </div>
                                                    </div>
                    
                                                    <div class="clearfix form-actions">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button class="btn btn-info btn-sm" type="submit">
                                                                <i class="ace-icon fa fa-check"></i>
                                                                Submit
                                                            </button>
                    
                                                            &nbsp; &nbsp; &nbsp;
                                                            <button class="btn btn-sm" type="reset">
                                                                <i class="ace-icon fa fa-undo"></i>
                                                                Reset
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
