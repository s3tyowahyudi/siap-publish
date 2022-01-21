@extends('master')

@section('css')
    @include('includes.login.style')
@endsection

@section('script')
    @include('includes.login.script')
@endsection

<div id="appsimtaru">
    @section('content')
        @include('umum.navbar1')
        <div class="main-content">
            <div class="main-content">
                <div class="main-conten-inner">
                    <div class="page-content" style="height:80%">
                        <div class="container" style="margin-top: 45px">
                            <div class="row" style="margin-top: 10%">
                                <div class="col-lg-12">
                                    <div class="alert alert-success alert-dismissible">
                                        <h5>
                                            <i class="icon fas fa-check"></i>
                                            Terimakasih
                                        </h5>
                                        <p> Anda Sudah Berhasil Mendaftar di WEB GIS Sistem Informasi Aset Sungai Pamekasan (SIAP)</p>
                                        <p>Password telah dikirim ke email anda, <br> Login lah dan rubah password anda </p>
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

