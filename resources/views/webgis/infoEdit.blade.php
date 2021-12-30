{{-- Awal info edit --}}
<div class="easyui-window" id="window-infoEdit" style="width:300px;height:350px;padding:10px;" title="Edit Layer Jalan" data-options="border:'thin',cls:'c6',closed:true,minimizable:false,maximizable:false,footer:'#footerEditObject'">
    <form action="{{ url('updateObject') }}" id="frmEdit" method="post">
        <div v-for="(item, index) in strukturTabel"  class="profile-user-info profile-user-info-striped" style="width: 100% !important">
            <div class="profile-info-row">
                <div class="profile-info-name" v-if="DataInfo[item.dataField]!=''" v-bind:for='item.dataField' class="active">
                    @{{item.dataField.replaceAll('_', ' ')}}
                </div>
                <div class="profile-info-name" v-else v-bind:for='item.dataField'>
                    @{{item.dataField.replaceAll('_', ' ')}}
                </div>

                <div class="profile-info-value">
                    <input v-if="item.dataField=='gid'" 
                        type="number" 
                        v-bind:value="DataInfo['gid']"
                        v-bind:id='item.dataField'  
                        v-bind:name="item.dataField" 
                        readonly style="width: 100%">
                    <select v-else-if="item.dataField=='fungsi'" 
                        v-bind:value='DataInfo[item.dataField]'
                        v-bind:id='item.dataField'
                        v-bind:name="item.dataField" style="width: 100%">
                        <option v-for="(opt,key) in valFungsi" :value="key">
                            @{{opt}}
                        </option>
                    </select>
                    <input v-else-if="item.dataField=='Koordinat_Awal_Ruas_lat' || item.dataField=='Koordinat_Awal_Ruas_long' || item.dataField=='Koordinat_Akhir_Ruas_lat' || item.dataField=='Koordinat_Akhir_Ruas_long'"
                        v-bind:value="DataInfo[item.dataField]" 
                        type="number"
                        step='0.00000001'
                        v-bind:id='item.dataField'
                        v-bind:name="item.dataField" style="width: 100%">

                    <select v-else-if="item.dataField=='kondisi'" 
                        v-bind:value='DataInfo[item.dataField]'
                        v-bind:id='item.dataField'
                        v-bind:name="item.dataField" style="width: 100%">
                        <option v-for="(opt,key) in valKondisi" :value="key">
                            @{{opt}}
                        </option>
                    </select>
                    
                    <select v-else-if="item.dataField=='tipe_perkerasan'" 
                        v-bind:value='DataInfo[item.dataField]'
                        v-bind:id='item.dataField'
                        v-bind:name="item.dataField" style="width: 100%">
                        <option v-for="(opt,key) in valPerkerasan" :value="key">
                            @{{opt}}
                        </option>
                    </select>

                    <input v-else-if="item.dataType=='number'"
                        v-bind:value="DataInfo[item.dataField]" 
                        type="number" 
                        step='0.01'
                        v-bind:id='item.dataField'
                        v-bind:name="item.dataField" style="width: 100%">
                    <input v-else-if="item.dataType=='date' && DataInfo[item.dataField]!=0" 
                        v-bind:value="dateToYYYYMMDD(DataInfo[item.dataField])" 
                        type="date" 
                        v-bind:id='item.dataField'
                        v-bind:name="item.dataField" style="width: 100%">
                    <input v-else type="text" 
                        v-bind:value="DataInfo[item.dataField]" 
                        v-bind:id='item.dataField'
                        v-bind:name="item.dataField" style="width: 100%">
                </div>
            </div>
        </div>
        <input type="hidden" id="geom1" name="geom1" value=''>
    </form>
</div> {{-- AKhir info Edit --}}

{{-- awal footer Gambar object --}}
<div id="footerEditObject" style="padding:10px;" class="text-center">
    <button class="btn btn-sm btn-white btn-danger" id="cmdBatal" onclick="vo.cmdBatal_click();">
        Batal
    </button>
    <button class="btn btn-sm btn-white btn-primary" id="cmdUpdate" onclick="vo.simpanObject()">
        Update
    </button>
</div>{{--Akhir footer Gambar object--}}