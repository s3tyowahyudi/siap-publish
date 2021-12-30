@extends('master')

@section('css')
    @include('dashboard.style')
@endsection

@section('script')
    @include('dashboard.script')
@endsection

@section('content')
    @include('umum.navbar')
    <div class="main-container" id="top">
        {{-- awal layerslider --}}
        <section id="layerslider" style="width:100%;height:100vh;z-index:0;">
            {{-- slide 1 --}}
            <div class="ls-slide" data-ls="slidedelay:8000;transition3d:all">
                <img src="assets/images/slide/bg1.jpg" class="ls-bg" alt="Slide background"/>
                <img src="assets/images/slide/welcomeSijantan.png" id="img_selamat_datang" class="ls-l img-fluid" data-ls="offsetxin:0;durationin:4000;rotateyin:450;transformoriginin:right 50% 0;" alt="Responsive image">
            </div>
            {{-- slide 2 --}}
            <div class="ls-slide" data-ls="slidedelay: 8000; transition3d: all;">
                <img src="{{ URL::asset('assets/images/slide/bg2.jpg') }}" class="ls-bg" alt="Slide background" />
                <img src="assets/images/slide/kebutuhanInformasi.png" id="slide2_1" class="ls-l" data-ls="offsetxin:0;durationin:2500;delayin:500;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;" alt="Image layer">

                <img src="assets/images/slide/standarisasi.png" id="slide2_2" class="ls-l" data-ls="offsetxin:0;durationin:2500;delayin:1500;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;" alt="Image layer">

                <img src="assets/images/slide/Terkoneksi.png" id="slide2_3" class="ls-l" data-ls="offsetxin:0;durationin:2500;delayin:2000;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;" alt="Image layer">

                <img src="assets/images/slide/Partisipasi.png" id="slide2_4" class="ls-l" data-ls="offsetxin:0;durationin:2500;delayin:2500;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;" alt="Image layer">

                <img src="assets/images/slide/memujudkan.png" id="slide2_5" class="ls-l" data-ls="offsetxin:0;durationin:2500;delayin:3000;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;offsetxout:100;durationout:750;skewxout:60;" alt="Image layer">
            </div>
            {{-- slide 3 --}}
            <div class="ls-slide" data-ls="slidedelay: 8000; transition3d: all;">
                <img src="{{ URL::asset('assets/images/slide/bg3.jpg') }}" class="ls-bg" alt="Slide background" />
                <div class="ls-l"
                    id="slide3_1"
                    
                    data-ls="
                            offsetxin:0;durationin:3500;delayin:500;easingin:easeOutElastic;rotateyin:90;transformoriginin:left 50% 0;">
                    Provinsi Kalimantan Timur
                </div>
                <div class="ls-l"
                    id="slide3_2"
                    data-ls="
                            offsetxin:0;durationin:1500;delayin:1500;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;">
                    Ruhui
                </div>
                <div class="ls-l"
                    id="slide3_3"
                    data-ls="
                            offsetxin:0;durationin:1500;delayin:2000;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;">
                    Rahayu
                </div>
                <div class="ls-l"
                    id="slide3_4"
                    data-ls="
                            offsetxin:0;durationin:1500;delayin:2500;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;">
                    Keseimbangan sempurna di segala hal berkat rida Tuhan YME
                </div>
            </div>
        </section>
        {{-- akhir layerslider --}}

        {{-- awal Grafik/Chart --}}
        <section id="chart" class="section section-grey" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <h2 class="text-primary">Data Grafik</h2>
                        <div class="hr"></div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 15px">
                    <div class="col-xs-12 col-sm-6" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="400">
                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title">
                                    Panjang Jalan Berdasarkan Fungsi
                                </h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="chartFungsi" style="height: 440px">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-6" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="800">
                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title">
                                    Panjang Jalan Berdasarkan Tipe Perkerasan
                                </h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="chartJmlRumah" style="height: 440px">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="400">
                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title">
                                    Panjang Jalan Berdasarkan Kondisi
                                </h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="chartKondisi" style="height: 440px">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-6" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="800">
                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header widget-header-small">
                                <h6 class="widget-title">
                                    Panjang Jalan Berdasarkan Kondisi Mantap
                                </h6>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="chartJmlRumah" style="height: 440px">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> {{-- akhir Grafik/Chart--}}

        {{-- awal Alamat --}}
        <section id="contact" class="section" style="background-color: #05445E" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
            <div class="container">
                <div class="space-16"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-md-5 col-md-offset-2" style="color: white">
                                <h4>Kontak Kami</h4>
                                <h6>E-mail: *************@gmail.com</h6>
                                <h6>Phone : (0541)276236</h6>
                                <h6>Fax : ***********</h6>
                            </div>
                            <div class="col-md-5" style="color: white">
                                <h4>Alamat</h4>
                                <h6>Jalan Tengkawang, No.1</h6>
                                <h6>Kec. Sungai Kunjang, Samarinda</h6>
                                <h6>Kalimantan Timur - 75243</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> {{--akhir Alamat--}}

        <footer class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-left">
                        <span class="bigger-125 text-muted"><span class="blue bolder">SI-JANTAN</span> Prov. Kalimantan Timur &copy; 2021</span>
                    </div>
                    <div class="col-md-4 text-center"></div>
                    <div class="col-md-4 text-right">
                        Copyrights &copy; All Rights Reserver By Dinas PUPR
                    </div>
                </div>
            </div>
        </footer> 
        {{--Akhir Footer--}}
    </div>

@endsection