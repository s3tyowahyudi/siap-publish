@extends('master')

@section('css')
    @include('welcome.style')
@endsection

@section('script')
    @include('welcome.script')
@endsection

@section('content')
    @include('umum.navbar')
    <div class="main-container" id="top">
        {{-- awal layerslider --}}
        <section id="layerslider" style="width:100%;height:100vh;z-index:0;">
            {{-- slide 1 --}}
            <div class="ls-slide" data-ls="slidedelay:8000;transition3d:all">
                <img src="assets/images/slide/bg1.jpg" class="ls-bg" alt="Slide background"/>
                <img src="assets/images/slide/welcomeSIAP.png" id="img_selamat_datang" class="ls-l img-fluid" data-ls="offsetxin:0;durationin:4000;rotateyin:450;transformoriginin:right 50% 0;" alt="Responsive image">
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
                    Kabupaten Pamekasan
                </div>
                <div class="ls-l"
                    id="slide3_2"
                    data-ls="
                            offsetxin:0;durationin:1500;delayin:1500;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;">
                    Irigasi Teratur
                </div>
                <div class="ls-l"
                    id="slide3_3"
                    data-ls="
                            offsetxin:0;durationin:1500;delayin:2000;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;">
                    Sawah Subur
                </div>
                <div class="ls-l"
                    id="slide3_4"
                    data-ls="
                            offsetxin:0;durationin:1500;delayin:2500;rotateyin:90;skewxin:60;transformoriginin:25% 50% 0;">
                    Rakyat Makmur
                </div>
            </div>
        </section>
        {{-- akhir layerslider --}}

        

    </div>
@endsection