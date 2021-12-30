<div id="wInfoDetail" class="easyui-window" title="Info Detail" data-options="border:'thin',cls:'c6',closed:true,minimizable:false,maximizable:true,shadow:true" style="height:450px;padding:10px;width: 50%;overflow-x: hidden;">
    <div class="easyui-layout" data-options="fit:true">
        <div data-options="region:'west',split:true" style="width:300px;">
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
                                        v-on:click="ShowInformasi(index);showTabelInfoDetail()"
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
        </div>

        <div data-options="region:'center'" style="padding:10px;">
            <div id="tblInfoDetail"></div>
        </div>
        <div data-options="region:'south',split:true,hideCollapsedContent:false,collapsed:true" title="Foto" style="padding:5px 0 0;height:100px">
            <div id="IsiFoto" class="text-center">
                @include('webgis.infoFoto')
            </div>
        </div>
    </div>
    
</div>