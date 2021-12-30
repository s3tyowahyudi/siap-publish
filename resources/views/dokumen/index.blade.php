@extends('master')

@section('css')
    @include('includes.dokumen.style')
@endsection

@section('script')
    @include('includes.dokumen.script')
@endsection

{{-- <div id="appSimtaru"> --}}
@section('content')
    @include('umum.navbar1')
    <div class="container" style="margin-top: 60px">
        {{-- awal form upload file --}}
        {{-- @if(Auth::check()) --}}
            <div class="row">
                <div class="widget-box widget-color-blue2" style="margin-bottom: 20px">
                    <div class="widget-header widget-header-small">
                        <h6 class="widget-title">
                            Dokumen Baru
                        </h6>
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                            <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <form action="#" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="new-file" class="col-sm-3 control-label no-padding-right">
                                        File
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="file" id="new-file" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new-keterangan" class="col-sm-3 control-label no-padding-right">
                                        Kategori
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Kategori" id="new-kategori">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new-keterangan" class="col-sm-3 control-label no-padding-right">
                                        Keterangan
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Keterangan" id="new-keterangan">
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="widget-toolbox padding-8 clearfix">
                            <button class="btn btn-xs btn-primary pull-right" onclick="vo.uploadDokumen()">
                                <i class="ace-icon fa fa-upload"></i>
                                <span class="bigger-110">Upload</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>{{-- akhir form upload file --}}
        {{-- @endif --}}
        <div class="row">
            <div class="widget-box widget-color-blue2">
                <div class="widget-header widget-header-small">
                    <h6 class="widget-title">
                        Tabel File
                    </h6>
                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>
                        <a href="#" data-action="close">
                            <i class="ace-icon fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div>
                            <div id="isiTabelFile">
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <div id="photo-popup"></div>
        </div>

        <div id="w-pdf" class="easyui-window text-center" title="Dokumen PDF" data-options="iconCls:'far fa-file-pdf',minimizable:false, collapsible:false,border:'thin',cls:'c6',closed:true," style="width:50%;height:300px;padding:10px;">
            <div id="show-pdf" style="width: 100%; height:100%"></div>
        </div>

        <div id="w-foto" class="easyui-window text-center" title="Foto" data-options="iconCls:'far fa-file-pdf',minimizable:false, collapsible:false,border:'thin',cls:'c6',closed:true," style="width:50%;height:300px;padding:10px;">
            <img src="#" class="img-fluid" alt="Responsive image" id="img-foto" width="auto" height="100%">
        </div>
    </div>
    
@endsection
{{-- </div> --}}