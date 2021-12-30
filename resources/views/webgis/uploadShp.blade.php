{{-- Window Upload SHP --}}
<div class="easyui-window" title="Upload SHP"
    data-options="width:300,height:300,inline:false,border:'thin',cls:'c6',minimizable:false,maximizable:false,closed:true,footer:'#footer-uploadShp'"
    style="padding: 10px;overflow-x: hidden;" id="window-uploadShp">
    <form id="frmUploadShp" method="post" action="uploadSHP" enctype="multipart/form-data">
        @csrf
        <div style="margin-bottom:20px">
            <a class="link-btn link-disclaimer" id="show-disclaimer-shp" data-toggle="modal"
                data-target="#disclaimer-shp">
                <div class="icon-sm-custom border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                    style="float: right;
                    margin-bottom: -20px;">
                    <span class="iconify" data-icon="ant-design:question-circle-outlined" data-width="19"
                        data-height="19"></span>
                </div>
            </a>
            <input class="easyui-filebox" label="File Shp:" labelPosition="top"
                data-options="prompt:'File SHP',accept:'.shp'" style="width:100%" id="input-shp" name="shp">
        </div>
        <div style="margin-bottom:40px">
            <input class="easyui-filebox" label="File Dbf:" labelPosition="top"
                data-options="prompt:'File Dbf',accept:'.dbf'" style="width:100%" id="input-dbf" name="dbf">
        </div>
    </form>
</div>
<div id="footer-uploadShp">
    <div style="text-align:center;padding:2px 0">
        <a href="javascript:void(0)" class="btn btn-sm bg-danger text-white w-30 p-2" onclick="ReadShp()"
            style="width:80px">Next</a>
        <a href="javascript:void(0)" class="btn btn-sm bg-gray-custom text-white w-30 p-2"
            onclick="lyrUploadSource.clear();" style="width:80px">Clear</a>
    </div>
</div>{{-- Akhir upload file --}}

{{-- Awal jendela Synchronize shp dengan database --}}
<div class="easyui-window" title="Synchronization SHP to Database"
    data-options="width:600,height:300,inline:false,border:'thin',cls:'c6',minimizable:false,maximizable:false,closed:true,footer:'#footer-synchronize'"
    style="padding: 10px;z-index=1000;overflow-x: hidden;" id="window-synchronize">
    <div style="margin-bottom: 20px">
        <label for="cmbLayer-synchronize">Select Layer :</label>
        <div>
            <select class="form-control" name="layer" id="cmbLayer-synchronize" style="width:200px;">
                <option value=" "> </option>
                <option value="bangunan">Bangunan Titik</option>
                <option value="bangunan_garis">Bangunan Garis</option>
            </select>
        </div>
    </div>
    {{-- <div class="row" v-for="(nmfield, index) in nmFieldSource"> --}}
    <div id="tblSynchronize"></div>
    {{-- </div> --}}
</div>
<div id="footer-synchronize">
    <div style="text-align:center;padding:2px 0">
        <a href="javascript:void(0)" class="btn btn-sm bg-gray-custom text-white w-30 p-2"
            onclick="$('#window-synchronize').window('close');$('#window-uploadShp').window('open');"
            style="width:80px">Back</a>
        <a href="javascript:void(0)" class="btn btn-sm bg-danger text-white w-30 p-2" onclick="SimpanShpToDatabase();"
            style="width:80px">Save</a>
    </div>
</div>
{{-- Akhir Synchronize --}}