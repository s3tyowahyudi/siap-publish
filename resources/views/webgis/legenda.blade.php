{{-- awal jendela Legenda --}}
<div id="wLegenda" class="easyui-window" title="Legenda" style="width:300px;height:400px;padding:10px;overflow-x: hidden;" data-options="border:'thin',cls:'c6',closed:true,minimizable:false,maximizable:false">
    {{-- legenda Bangunan --}}
    <div class="row">
        <div style="margin: 10px;" class="widget-box widget-color-blue3" >
            <div class="widget-header widget-header-small" id="head-lgd-Polaruang" style="background-color: #1F637F">
                <div class="widget-title">
                    Bangunan Titik
                </div>
                <div class="widget-toolbar">
                    <label>
                        <input type="checkbox" class="ace ace-switch ace-switch-3" onclick="lyrBangunan.setVisible(this.checked);" checked/>
                        <span class="lbl middle"></span>
                    </label>
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
        
            <div id="body-lgd-Polaruang" class="widget-body" >
                <div class="widget-main" style="padding:5px;">
                    <div>
                        <label>Transparant</label>
                        <input class="border-0" type="range" min="0" max="100" value="100"  oninput="lyrBangunan.setOpacity(this.value/100);"/>
                    </div>
                    <hr />
                    <div>
                        <label>Legenda</label>
                        <p>
                            <img src="http://123.100.226.201:8080/geoserver/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=siap:bangunan">
                        </p>
                        
                    </div>
                </div>     
            </div>
        </div>
    </div>{{--Akhir legenda Bangunan --}}

    {{-- legenda Bangunan garis--}}
    <div class="row">
        <div style="margin: 10px;" class="widget-box widget-color-blue3 collapsed" >
            <div class="widget-header widget-header-small" id="head-lgd-Polaruang" style="background-color: #1F637F">
                <div class="widget-title">
                    Bangunan Garis
                </div>
                <div class="widget-toolbar">
                    <label>
                        <input type="checkbox" class="ace ace-switch ace-switch-3" onclick="lyrBangunan_garis.setVisible(this.checked);" checked/>
                        <span class="lbl middle"></span>
                    </label>
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
        
            <div id="body-lgd-Polaruang" class="widget-body" >
                <div class="widget-main" style="padding:5px;">
                    <div>
                        <label>Transparant</label>
                        <input class="border-0" type="range" min="0" max="100" value="100"  oninput="lyrBangunan_garis.setOpacity(this.value/100);"/>
                    </div>
                    <hr />
                    <div>
                        <label>Legenda</label>
                        <p>
                            <img src="http://123.100.226.201:8080/geoserver/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=siap:bangunan_garis">
                        </p>
                        
                    </div>
                </div>     
            </div>
        </div>
    </div>{{--Akhir legenda Bangunan garis--}}

    {{-- legenda sta --}}
    <div class="row">
        <div style="margin: 10px;" class="widget-box widget-color-blue3 collapsed" >
            <div class="widget-header widget-header-small" style="background-color: #1F637F">
                <div class="widget-title">
                    STA
                </div>
                <div class="widget-toolbar">
                    <label>
                        <input type="checkbox" class="ace ace-switch ace-switch-3" onclick="lyrSta.setVisible(this.checked);"/>
                        <span class="lbl middle"></span>
                    </label>
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
        
            <div class="widget-body" >
                <div class="widget-main" style="padding:5px;">
                    <div>
                        <label>Transparant</label>
                        <input class="border-0" type="range" min="0" max="100" value="100"  oninput="lyrSta.setOpacity(this.value/100);"/>
                    </div>
                    <hr />
                    <div>
                        <label>Legenda</label>
                        <p>
                            <img src="http://123.100.226.201:8080/geoserver/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=siap:sta">
                        </p>
                        
                    </div>
                </div>     
            </div>
        </div>
    </div>{{--Akhir legenda sta --}}

    {{-- legenda sungai --}}
    <div class="row">
        <div style="margin: 10px;" class="widget-box widget-color-blue3 collapsed" >
            <div class="widget-header widget-header-small" style="background-color: #1F637F">
                <div class="widget-title">
                    Sungai
                </div>
                <div class="widget-toolbar">
                    <label>
                        <input type="checkbox" class="ace ace-switch ace-switch-3" onclick="lyrSungai.setVisible(this.checked);" checked/>
                        <span class="lbl middle"></span>
                    </label>
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
        
            <div class="widget-body" >
                <div class="widget-main" style="padding:5px;">
                    <div>
                        <label>Transparant</label>
                        <input class="border-0" type="range" min="0" max="100" value="100"  oninput="lyrSungai.setOpacity(this.value/100);"/>
                    </div>
                    <hr />
                    <div>
                        <label>Legenda</label>
                        <p>
                            <img src="http://123.100.226.201:8080/geoserver/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=siap:sungai">
                        </p>
                        
                    </div>
                </div>     
            </div>
        </div>
    </div>{{--Akhir legenda Sungai --}}

    {{-- legenda batas desa--}}
    <div class="row">
        <div style="margin: 10px;" class="widget-box widget-color-blue3 collapsed" >
            <div class="widget-header widget-header-small" style="background-color: #1F637F">
                <div class="widget-title">
                    Batas Desa
                </div>
                <div class="widget-toolbar">
                    <label>
                        <input type="checkbox" class="ace ace-switch ace-switch-3" onclick="lyrBatasDesa.setVisible(this.checked);" />
                        <span class="lbl middle"></span>
                    </label>
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>
        
            <div class="widget-body" >
                <div class="widget-main" style="padding:5px;">
                    <div>
                        <label>Transparant</label>
                        <input class="border-0" type="range" min="0" max="100" value="100"  oninput="lyrBatasDesa.setOpacity(this.value/100);"/>
                    </div>
                    <hr />
                    <div>
                        <label>Legenda</label>
                        <p>
                            <img src="http://202.157.187.108:8080/geoserver/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=siap:admin_desa">
                        </p>
                        
                    </div>
                </div>     
            </div>
        </div>
    </div>{{--Akhir batas desa --}}

</div>{{--akhir Jendela Legenda--}}