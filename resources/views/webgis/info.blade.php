{{-- awal jendela Informasi --}}
<div id="wInformasi" class="easyui-window" title="Informasi" style="width:300px;height:350px;padding:10px;overflow-x: hidden" data-options="border:'thin',cls:'c6',closed:true,minimizable:false,maximizable:false,footer:'#wfInformasi'">
    <div class="row">
        <div class="widget-box widget-color-blue3" style="margin:10px">
            <div class="widget-header widget-header-small text-center" style="background-color: #1F637F">
                <div class="widget-title">
                    Layer Terpilih
                </div>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form style="padding: 10px">
                        <div class="form-check" v-for="(rs, index) in idGeomTerpilih">
                            <input type="radio" 
                                class="form-check-input" 
                                v-bind:id="'chk_' + index" 
                                v-bind:name="'chk_' + index"
                                v-on:click="ShowInformasi(index)"
                                :checked="index == indeks">
                            <label class="form-check-label" v-bind:for="'chk_' + index" >@{{ rs.getId().split('.')[0] + "." + rs.get('gid') }}</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="row">
        <div class="widget-box widget-color-blue3" id="widget-infoterpilih" style="margin: 10px">
            <div class="widget-header widget-header-small text-center" id="head-acrd-infoterpilih" style="background-color: #1F637F">
                <div class="widget-title">
                    Informasi
                </div>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div v-for="(item, index) in kunci">
                        <div class="info-label">
                            @{{ item.replaceAll('_', ' ') }}
                        </div>
                        <div class="info-value" v-if="DataInfo[item]!=null">
                            @{{ DataInfo[item] }}
                        </div>
                        <div class="info-value"  v-else>
                            -
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>{{--akhir jendela Informasi--}}

{{-- awal footer untuk informasi --}}
<div id="wfInformasi" class="text-center">
    <button class="btn btn-sm btn-white btn-danger" id="cmdDelete" onclick="vo.deleteObject();">
        Delete
    </button>
    <button class="btn btn-sm btn-white btn-primary" id="cmdEdit" onclick="vo.cmdEdit_click()">
        Edit
    </button>
    <button class="btn btn-sm btn-white btn-primary" id="cmdinfo_detail" onclick="$('#wfoto').window('open');vo.getFoto();">
        Foto
    </button>
    
</div>
{{-- akhir footer untuk informasi --}}