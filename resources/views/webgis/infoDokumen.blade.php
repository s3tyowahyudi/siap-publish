<div id="wfoto" class="easyui-window" title="Info Foto dan Dokumen" style="width:50%; height:225px; overflow-x: hidden" data-options="border:'thin',cls:'c6',closed:true,minimizable:false,maximizable:false">
    <div class="row" style="margin: 10px" v-if="gidAktif!=null">
        <form id="frmUploadFileBangunan" >
            <div class="col-lg-5 col-10">
                <input id="inpFileFoto" type="file" name="inpFileFoto" accept="image/*">
            </div>
        </form>
        <div class="col-lg-2 col-2">
            <button class="btn btn-sm btn-primary btn-block" onclick="vo.uploadFoto();">Upload</button>
        </div>
    </div>
    <div class="row" v-show="fotos!=null" style="margin: 10px">
        <div class="col-12">
            <div style="padding: 5px">
                <ul class="ace-thumbnails clearfix">
                    <li v-for="foto in fotos">
                        <a v-bind:href="'storage/' + foto" title="Photo Title" data-rel="colorbox">
                            <img width="100" height="100" alt="100x100" v-bind:src="'storage/' + foto" />
                        </a>
    
                        <div class="tools" v-if="gidAktif!=null">
                            <a href="#" v-on:click="deleteFoto(foto)">
                                <i class="ace-icon fa fa-times red"></i>
                            </a>
                        </div>
                    </li>
                    
                    <li v-for="filePdf in fpdf">
                        <a href="#" title="Photo Title" v-on:click="$('#w-pdf').window('open');PDFObject.embed('storage/' + filePdf,'#show-pdf')">
                            <img width="100" height="100" alt="100x100" v-bind:src="'assets/img/img_pdf.png'" />
                        </a>
    
                        <div class="tools" v-if="gidAktif!=null">
                            <a href="#" v-on:click="deleteFoto(filePdf)">
                                <i class="ace-icon fa fa-times red"></i>
                            </a>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="w-pdf" class="easyui-window text-center" title="Dokumen PDF" data-options="iconCls:'far fa-file-pdf',minimizable:false, collapsible:false,border:'thin',cls:'c6',closed:true," style="width:50%;height:300px;padding:10px;">
    <div id="show-pdf" style="width: 100%; height:100%"></div>
</div>