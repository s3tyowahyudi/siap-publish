@extends('master')

@section('css')
    @include('includes.webgis.style')
@endsection

@section('script')
    @include('includes.webgis.script')
    @include('includes.webgis.indexcss')
@endsection

@section('content')
    <div id="map" class="map"></div>
    <div id="mouseposisi" class="text-center"></div>
    <div id="scale-line" class="scale-line"></div>
    <input name="latitude" id="latitude" placeholder="Latitude"/>
    <input name="longitude" id="longitude" placeholder="Longitude"/>
    <button class="btn1" onclick="pencariankoordinat1()" id="cmdGo" type="button">Go!!</button>
    <button class="btn1" onclick="clearvector1();" id="cmdClear">Clear</button>
    <input class="search_input" type="text" name="" placeholder="Google Search Map" id="nav-search">
    
    <img src="assets/images/logo_map.png" alt="" id="logoMap">

    <div id="user">
        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
            <img class="ace-nav nav-user-photo" src="assets/ace/assets/avatars/user.jpg" alt="Jason's Photo"/>
            <span class="user-info" style="color: black">
                <small>Welcome,</small>
                Jason
            </span>

            <i class="ace-icon fa fa-caret-down"></i>
        </a>

        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
            <li>
                <a href="#">
                    <i class="ace-icon fa fa-cog"></i>
                    Settings
                </a>
            </li>

            <li>
                <a href="profile.html">
                    <i class="ace-icon fa fa-user"></i>
                    Profile
                </a>
            </li>

            <li class="divider"></li>

            <li>
                <a href="#">
                    <i class="ace-icon fa fa-power-off"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>

    <div id="toolbar">
        <div>
            <a href="{{ url('/')  }}" class="btnMap text-center" id="btnBeranda">
                <span class="iconify-inline" data-icon="ant-design:home-outlined" data-width="19" data-height="19"></span>
            </a>
            <div id="tooltipsBeranda">Beranda</div>
        </div>
        <div>
            <button class="btnMap text-center" id="btnZoomIn" onclick="view.setZoom(view.getZoom()+1);">
                <span class="iconify-inline" data-icon="ant-design:zoom-in-outlined" data-width="19" data-height="19"></span>
            </button>
            <div id="tooltipsZoomIn">Zoom In</div>
        </div>
        <div>
            <button class="btnMap text-center" id="btnZoomOut" onclick="view.setZoom(view.getZoom()-1);">
                <span class="iconify-inline" data-icon="ant-design:zoom-out-outlined" data-width="19" data-height="19"></span>
            </button>
            <div id="tooltipsZoomOut">Zoom Out</div>
        </div>
        <div>
            <button class="btnMap" id="btnZoomExtent" onclick="view.setZoom(13);view.setCenter([113.51638568200048, -7.119952122710566])">
                <span class="iconify-inline" data-icon="bx:bx-globe" data-width="19" data-height="19"></span>
            </button>
            <div id="tooltipsZoomExtent">Zoom Default</div>
        </div>
        <div>
            <button class="btnMap" id="btnLegenda" onclick="$('#wLegenda').window('open');">
                <span class="iconify-inline" data-icon="gis:layer-alt-poi" data-width="19" data-height="19"></span>
            </button>
            <div id="tooltipsLegenda">Layer & Legenda</div>
        </div>
        <div>
            <button class="btnMap" id="btnBasemap" onclick="$('#wBasemap').window('open');">
                <span class="iconify-inline" data-icon="gis:world-map-alt" data-width="19" data-height="19"></span>
            </button>
            <div id="tooltipsBasemap">Base Map</div>
        </div>
        <div>
            <button class="btnMap" id="btnTabular" onclick="$('#wtabel').window('open');vo.ShowTabel('bangunan','tabelJalan');">
                <span class="iconify-inline" data-icon="mdi:table-search" data-width="19" data-height="19"></span>
            </button>
            <div id="tooltipsTabular">Tabular & Pencarian</div>
        </div>
        <div>
            <button class="btnMap" id="btnRuler" onclick="$('#w-JarakLuas').dialog('open');">
                <span class="iconify-inline" data-icon="fa-solid:pencil-ruler" data-width="19" data-height="19"></span>
            </button>
            <div id="tooltipsRuler">Ruler</div>
        </div>
        <div>
            <button class="btnMap" id="btnClear" onclick="ClearInfo();vo.idGeomTerpilih = [];">
                <span class="iconify" data-icon="ic:baseline-layers-clear" data-width="19" data-height="19"></span>
            </button>
            <div id="tooltipsClear">Clear Selected</div>
        </div>
        <div>
            <button class="btnMap" id="btnNewObject" onclick="$('#wnewObject').window('open')">
                <span class="iconify" data-icon="ci:add-to-queue" data-width="19" data-height="19"></span>
            </button>
            <div id="tooltipsNewObject">Add Object</div>
        </div>
        <div>
            <button class="btnMap" id="btnUploadShp" onclick="$('#window-uploadShp').window('open')">
                <span class="iconify" data-icon="icon-park-outline:upload-three" data-width="19" data-height="19"></span>
            </button>
            <div id="tooltipsUploadShp">Upload SHP</div>
        </div>
    </div>

    <div id="appSimtaru">
        
        {{--awal jendela jarak --}}
        <div id="w-JarakLuas" class="easyui-window" title="Ruler" style="width:250px;height:250px;padding:10px" 
            data-options="onClose:function(){BersihJarak()},inline:false,border:'thin',cls:'c6',closed:true,minimizable:false,maximizable:false,footer:'#footerWJarak'">
            <div style="padding-bottom: 20px">
                <select class="easyui-combobox" name="typeMeasure" label="Pilih Metode:" style="width: 100%;height: 100%;margin-left: 5%;" id="typeMeasure" labelPosition="top">
                    <option value="length">Length</option>
                    <option value="area">Area</option>
                </select>
            </div>
            <div class="text-center text-white p-4 mt-4 mb-3 w-100" style="border-radius: 5px;box-shadow: 0 6px 12px rgba(0, 0, 0, .3); height: 55px; padding-bottom:20px" id="alertHasilJarak"> </div>
            
        </div>
        <div id="footerWJarak" style="padding:5px;" class="text-center">
            <button class="btn btn-sm bg-gray" onclick="BersihJarak();">
                Clear
            </button>
            <button class="btn btn-sm btn-primary" onclick="statusClick='measure';map.removeInteraction(draw);addInteraction();">
                Start
            </button>
        </div>{{--Akhir jendela jarak--}}

        {{-- awal jendela basemap --}}
        <div id="wBasemap" class="easyui-window" title="Base Map" style="width:300px;height:350px;padding:10px;overflow-x: hidden;" data-options="inline:false,border:'thin',cls:'c6',closed:true,minimizable:false,maximizable:false">
            @include('umum.basemap')
        </div>{{--akhir jendela basemap--}}

        @include('webgis.legenda')
        @include('webgis.infoDetail')
        @include('webgis.info')
        @include('webgis.infoEdit')
        @include('webgis.tabel')
        @include('webgis.infoNew')
        @include('webgis.uploadShp')
        @include('webgis.infoDokumen')
        
        
    </div>

@endsection