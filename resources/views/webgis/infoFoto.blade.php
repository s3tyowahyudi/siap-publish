<div class="row" style="margin-bottom: 10px" v-if="gidAktif!=null && statusFoto==1">
    <form id="frmUploadFile" >
        <div class="col-lg-5 col-10">
            <input style="width:100%" id="inpFileFoto" type="file" name="inpFileFoto">
            @csrf
        </div>
    </form>
    <div class="col-lg-2 col-2">
        <button class="btn btn-sm btn-primary btn-block" onclick="vo.uploadFoto();">Upload</button>
    </div>
</div>
<div class="row" v-show="fotos!=null">
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

                
            </ul>
        </div>
    </div>
</div>