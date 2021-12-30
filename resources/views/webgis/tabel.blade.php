{{-- awal jendela table --}}
<div id="wtabel" class="easyui-window" title="Tabel" style="height:350px;padding:10px;width: 50%;overflow-x: hidden;" data-options="border:'thin',cls:'c6',closed:true,minimizable:false,maximizable:true,shadow:true">
    <div class="row">
        <div class="widget-box widget-color-blue3" style="margin: 10px;" >
            <div class="widget-header" style="background-color:#1F637F">
                <div class="widget-title" id="jdlTabel">
                    Tabel Fungsi Jalan
                </div>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                </div>
                <div class="widget-toolbar no-border">
                    <button class="btn btn-xs btn-yellow bigger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Layer
                        <i class="ace-icon fa fa-chevron-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                        <li>
                            <a href="javascript:void(0)" onclick="vo.cmbTabel('bangunan')">Bangunan Titik</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="vo.cmbTabel('bangunan_garis')">Bangunan Garis</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="vo.cmbTabel('sta')">STA</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="vo.cmbTabel('sungai')">Sungai</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div id="tabelJalan"></div>
                </div>
            </div>
        </div>
    </div>
    
    
</div>{{-- akhir jencela table --}}