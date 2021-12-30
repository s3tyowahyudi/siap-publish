{{-- awal Gambar object --}}
<div id="wnewObject" class="easyui-window" title="Add Object" style="width:300px;height:175px;padding:10px" data-options="border:'thin',cls:'c6',closed:true,minimizable:false,maximizable:false,footer:'#wfAddObject'">
    <div>
        <label for="cmbLayer-addObject">Pilih Layer</label>
        <select v-model="layerAktif" id="cmbLayer-addObject" class="form-control">
            <option value=""></option>
            <option value="bangunan">Bangunan Titik</option>
            <option value="bangunan_garis">Bangunan Garis</option>
            <option value="sta">sta</option>
            <option value="sungai">sungai</option>
        </select>
    </div>
    
</div>{{-- akhir Gambar object --}}

{{-- awal footer Gambar object --}}
<div id="wfAddObject" style="padding:10px;" class="text-center">
    <button class="btn btn-sm btn-white btn-primary" onclick="vo.GambarNewObject();">
        Gambar
    </button>
    <button class="btn btn-sm btn-white btn-danger" onclick="ClearInfo();vo.kondisiNew=false">
        Batal
    </button>
</div>{{--Akhir footer Gambar object--}}

{{-- awal Isi Form new object --}}
<div id="wFormNewObject" class="easyui-window" title="Atribute Jalan" style="width:300px;height:350px;" data-options="border:'thin',cls:'c6',closed:true,minimizable:false,maximizable:false,footer:'#FooterFormAddObject'">
    <form action="{{ url('newObject') }}" id="frmNew" method="POST">
        <div class="widget-main">
                <div v-for="(item, index) in strukturTabel"  class="profile-user-info profile-user-info-striped" style="width: 100% !important">
                    {{-- nama --}}
                    <div class="profile-info-row">
                        {{-- <div class="profile-info-name" v-if="DataInfo[item.dataField]!=''" v-bind:for="'new_' + item.dataField" class="active">
                            @{{item.dataField}}
                        </div> --}}
                        <div class="profile-info-name" v-if="item.dataField=='Panjang'" v-bind:for="'new_' + item.dataField" class="active">
                            @{{item.dataField.replaceAll('_', ' ')}} (m)
                        </div>
                        <div class="profile-info-name" v-else v-bind:for="'new_' + item.dataField">
                            @{{item.dataField.replaceAll('_', ' ')}}
                        </div>

                        <div class="profile-info-value">
                            <input v-if="item.dataField=='gid'" 
                                type="hidden" 
                                v-bind:id="'new_' + item.dataField"  
                                v-bind:name="item.dataField" 
                                readonly style="width: 100%">
                            
                            <input v-else-if="item.dataField=='Koordinat_Awal_Ruas_long'"
                                type="text"
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField"
                                v-bind:value="koordinatAwalRuas[0]"
                                style="width: 100%" readonly>

                            <input v-else-if="item.dataField=='Koordinat_Awal_Ruas_lat'"
                                type="text"
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField"
                                v-bind:value="koordinatAwalRuas[1]"
                                style="width: 100%" readonly>

                            <input v-else-if="item.dataField=='Koordinat_Akhir_Ruas_long'"
                                type="text"
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField"
                                v-bind:value="koordinatAkhirRuas[0]"
                                style="width: 100%" readonly>

                            <input v-else-if="item.dataField=='Koordinat_Akhir_Ruas_lat'"
                                type="text"
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField"
                                v-bind:value="koordinatAkhirRuas[1]"
                                style="width: 100%" readonly>
                            
                            <input v-else-if="item.dataField=='panjang'"
                                type="text"
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField"
                                v-bind:value="panjangRuas"
                                style="width: 100%">

                            <select v-else-if="item.dataField=='fungsi'" 
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField" style="width: 100%">
                                <option v-for="(opt,key) in valFungsi" :value="key">
                                    @{{opt}}
                                </option>
                            </select>

                            <select v-else-if="item.dataField=='kondisi'" 
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField" style="width: 100%">
                                <option v-for="(optKondisi,key) in valKondisi" :value="key">
                                    @{{optKondisi}}
                                </option>
                            </select>

                            <select v-else-if="item.dataField=='tipe_perkerasan'" 
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField" style="width: 100%">
                                <option v-for="(optPerkerasan,key) in valPerkerasan" :value="key">
                                    @{{optPerkerasan}}
                                </option>
                            </select>

                            <input v-else-if="item.dataType=='number'"
                                type="number" 
                                step='0.01'
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField" style="width: 100%">
                            <input v-else-if="item.dataType=='date'" 
                                type="date" 
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField" style="width: 100%">
                            <input v-else type="text" 
                                v-bind:id="'new_' + item.dataField"
                                v-bind:name="item.dataField" style="width: 100%">
                        </div>
                    </div>
                </div>
                <input id="geom" name="geom" type="hidden">
            
        </div>
        
    </form>
</div>{{-- akhir Gambar object --}}

<div id="FooterFormAddObject" style="padding:10px;" class="text-center">
    <button type="button" class="btn btn-sm btn-white btn-primary" id="cmdSimpan" onclick="vo.simpanNewObject()">Simpan</button>
    <button type="button" class="btn btn-sm btn-white btn-danger" id="cmdBatal" onclick="ClearInfo();vo.kondisiNew=false">Batal</button>
</div>