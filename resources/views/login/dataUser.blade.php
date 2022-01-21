@extends('master')

@section('css')
    @include('includes.login.style')
@endsection

@section('script')
    @include('includes.login.script')
@endsection

{{-- <div class="appsimtaru"> --}}

    @section('content')
        @include('umum.navbar1')
        <div class="container" style="margin-top: 60px">
            <div class="row">
                <div class="col-sm-12">
                    <div class="widget-box widget-color-blue2" style="margin-bottom: 20px">
                        <div class="widget-header widget-header-small">
                            <h6 class="widget-title">
                                Daftar Pengguna
                            </h6>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="appsimtaru">
                                    <div id="IsiTabel" class="text-center">
                                        Mohon ditunggu
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        {{-- Awal footer --}}
        <footer class="section">
            {{-- awal Alamat --}}
            {{-- <section id="contact" class="section" style="background-color: #05445E" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <div class="container">
                    <div class="space-16"></div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-5 col-md-offset-2" style="color: white">
                                    <h4>Kontak Kami</h4>
                                    <h6>E-mail: dinaspupr.banjarmasin@gmail.com</h6>
                                    <h6>Phone : 05113300197</h6>
                                    <h6>Fax : 05113300097</h6>
                                </div>
                                <div class="col-md-5" style="color: white">
                                    <h4>Alamat</h4>
                                    <h6>Jalan Brigjen H. Hasan Basri No. 82</h6>
                                    <h6>Kec. Banjarmasin Utara, Kota Banjarmasin</h6>
                                    <h6>Kalimantan Selatan - 70124</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>  --}}
            {{--akhir Alamat--}}
            {{-- <div class="container">
                <div class="row">
                    <div class="col-md-4 text-left">
                        <span class="bigger-150 text-muted"><span class="blue bolder">SIMTARU</span> Banjarmasin &copy; 2021</span>
                    </div>
                    <div class="col-md-4 text-center"></div>
                    <div class="col-md-4 text-right">
                        Copyrights &copy; All Rights Reserver By Dinas PUPR
                    </div>
                </div>
            </div> --}}
        </footer> 
        {{--Akhir Footer--}}
    @endsection
{{-- </div> --}}
