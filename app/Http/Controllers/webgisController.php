<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use File;

class webgisController extends Controller
{
    public function GeomToJson($layer,$gid){
        $SQLL ='select ST_AsGeoJSON(st_transform(geom,4326)) as geomspatial from "' .$layer .'" where gid=' . $gid;
        $result=  DB::select($SQLL);
        $gjson=$result[0]->geomspatial;
        $hasil='{ "type": "FeatureCollection", "features": [ {"type": "Feature", "geometry": ' .$gjson . ', "properties": {"gid":"' .$gid .'"}}]}';
        return $hasil;
    }

    //Mengambil Field dari tabel
    public function NamaField($tabel){

        $data1=DB::table('information_schema.columns')
                    ->select('column_name')
                    ->where('table_name',$tabel)
                    ->get();
        
        $nmField=array();            
        foreach ($data1 as $record) {
            array_push($nmField,$record->column_name);
        };
        // dd($nmField);
        return $nmField;
    }  

    // Mengambil type Field
    public function NamaFieldType($tabel){
        $data=array();

        $data1=DB::table('information_schema.columns')
            ->select('column_name','data_type')
            ->where('table_name',$tabel)
            ->get();
        
        // dd($data1);

        $columnTabel=array();
        foreach($data1 as $record){
            $column_name=$record->column_name;
            if($column_name!="geom"){
                $data_type=$record->data_type;
                switch ($data_type) {
                    case 'integer' :
                    case 'smallint' :
                    case 'bigint':
                        $fieldTabel=["dataField"=>"$column_name","dataType"=>"number","format"=>["precision"=>0]];
                        break;
                    case 'double precision':
                    case 'real':
                    case 'numeric':
                        $fieldTabel=["dataField"=>"$column_name","dataType"=>"number","format"=>["precision"=>3]];
                        break;
                    case 'character':
                    case 'character varying':
                        $fieldTabel=["dataField"=>"$column_name","dataType"=>"string"];
                        break;  
                    case 'timestamp without time zone':
                    case 'date':
                        $data_type="date";
                        $fieldTabel=["dataField"=>"$column_name","dataType"=>"date","format"=>"yyyy/MM/dd"];
                        break; 
                    default:
                        $data_type=$data_type;
                        $fieldTabel=["dataField"=>"$column_name","dataType"=>"$data_type"];
                        break;
                };
                if($column_name==="gid"){
                    $fieldTabel=["dataField"=>"$column_name","dataType"=>"number","allowEditing"=> 0];
                };
                if($column_name==="TypeData"){
                    $fieldTabel=["dataField"=>"$column_name","dataType"=>"$data_type","allowEditing"=> 0];
                };
                if($column_name==="x_awal" || $column_name==="y_awal" || $column_name==="x_akhir" || $column_name==="y_akhir"){
                    $fieldTabel=["dataField"=>"$column_name","dataType"=>"number","format"=>["precision"=>8],"validationRules"=>[["type"=>"required"]]];
                };
                if($column_name=="gid_fungsi_jalan" || $column_name=="gid_kondisi_jalan"){
                    $fieldTabel=["dataField"=>"$column_name","dataType"=>"number","allowEditing"=>0];
                };
                array_push($columnTabel,$fieldTabel);
            };
            
        };
        // dd($columnTabel);
        return $columnTabel;    
    }
    
    public function getDataByGid($gid,$layerAktif){
        $nmField=$this->NamaFieldType($layerAktif);
        $nmF=$this->NamaField($layerAktif);
        $nmF=array_diff($nmF, ['geom']);
        $data=DB::table($layerAktif)
            ->select($nmF)
            ->where('gid',$gid)
            ->get();
        // dd($layerAktif);
        $length_nmF=count($nmF);
        $data=DB::table($layerAktif)
            ->select($nmF)
            ->where('gid',$gid)
            ->first();
            
        $hasil=['nmfield'=>$nmF,'data'=>$data,'strukturField'=>$nmField,'jmlField'=>$length_nmF];
        
        return $hasil;    
    }

    //Mengambil data tabel
    public function ShowTabel($nmTabel){
        $nmField=$this->NamaFieldType($nmTabel);
        $nmF=$this->NamaField($nmTabel);
        $nmF=array_diff($nmF, ['geom']);
        $data=DB::table($nmTabel)
            ->select($nmF)
            ->orderBy('gid','asc')
            ->get();
        $hasil=['nmfield'=>$nmField,'data'=>$data];
        //dd($hasil);
        return $hasil;    
    }

    public function ShowInfoDetail(Request $request){
        $layerAktif=$request->get('layerAktif');
        $nmTabel="detail_" . $layerAktif;
        $nmField=$this->NamaFieldType($nmTabel);
        $nmF=$this->NamaField($nmTabel);
        $gidAktif=$request->get('gidAktif');
        $data=DB::table($nmTabel)
            ->select($nmF)
            ->where("gid_" . $layerAktif,$gidAktif)
            ->orderBy('tanggal', 'desc')
            ->get();
        $hasil=['nmfield'=>$nmField,'data'=>$data];
        return $hasil;
    }
    
    public function simpanNewObject(Request $request){
        unset($request["_token"]);
        unset($request["gid"]);
        unset($request["__KEY__"]);
        // dd($request->all());
        $layerAktif=$request["layerAktif"];
        unset($request["layerAktif"]);
        
        if($request->get('geom')<>""){
            $isigeom = $request->get("geom");
            $geom="ST_GeomFromText('" .$isigeom ."',4326)";
            $request["geom"]=DB::raw($geom);
        }else{
            $isigeom="POINT(" .$request["long"]. " " .$request["lat"] .")";
            $geom="ST_GeomFromText('" .$isigeom ."',4326)";
            $request["geom"]=DB::raw($geom);
        };

        // dd($request->all());
        DB::table($layerAktif)->insert($request->all());
    }

    public function simpanNewObjectShp(Request $request){
        $layerAktif=$request["layerAktif"];
        unset($request["layerAktif"]);
        $dataString=$request->get('dataString');

        foreach($dataString as $data){
            $isigeom= $data["geom"];
            $geom="ST_GeomFromText('" .$isigeom ."',4326)";
            $data["geom"]=DB::raw($geom);
            DB::table($layerAktif)->insert($data);
        }
    }

    public function updateObject(Request $request){
        // dd($request->all());
        $gid=$request->get('gid');
        if($request->get('geom1')<>""){
            $isigeom = $request->get("geom1");
            $geom="ST_GeomFromText('" .$isigeom ."',4326)";
            $request["geom"]=DB::raw($geom);
        }
        unset($request["geom1"]);
        unset($request["_token"]);
        $layerAktif=$request["layerAktif"];
        unset($request["layerAktif"]);
        $hasil=DB::table($layerAktif)->where('gid',$gid)->update($request->all());
        return $hasil;
    }

    public function delete(Request $request){
        $gid=$request->get('gid');
        $tt=DB::table($request->get('layerAktif'))->where('gid','=',$gid)->delete();
    }

    public function NamaFieldTypeUseSHP($tabel){
        $data=array();

        $data1=DB::table('information_schema.columns')
            ->select('column_name','data_type')
            ->where('table_name',$tabel)
            ->get();
        
        // dd($data1);

        $columnTabel=array();
        $fieldTabel=["dataField"=>"","dataType"=>""];
        array_push($columnTabel,$fieldTabel);
        foreach($data1 as $record){
            $column_name=$record->column_name;
            if($column_name!="geom" && $column_name!="gid" && $column_name!="id_perusahaan" && $column_name!="id" && $column_name!="pinjam_pakai" && $column_name!="kerjasama_pengelolaan" && $column_name!="sewa" && $column_name!="create_at" && $column_name!="delete_at" && $column_name!="statusDelete" && $column_name!="update_at" && $column_name!="iduser"){
                $data_type=$record->data_type;
                switch ($data_type) {
                    case 'integer' :
                    case 'bigint' :
                    case 'smallint' :
                        $fieldTabel=["dataField"=>"$column_name","dataType"=>"number","format"=>["precision"=>0]];
                        break;
                    case 'double precision':
                    case 'real':
                    case 'numeric':
                        $fieldTabel=["dataField"=>"$column_name","dataType"=>"number","format"=>["precision"=>3]];
                        break;
                    case 'character':
                    case 'character varying':
                        $fieldTabel=["dataField"=>"$column_name","dataType"=>"string"];
                        break;  
                    case 'timestamp without time zone':
                    case 'date':
                        $data_type="date";
                        $fieldTabel=["dataField"=>"$column_name","dataType"=>"date","format"=>"yyyy/MM/dd HH:mm:ss"];
                        break; 
                    default:
                        $data_type=$data_type;
                        $fieldTabel=["dataField"=>"$column_name","dataType"=>"$data_type"];
                        break;
                };
                if($column_name==="gid"){
                    $fieldTabel=["dataField"=>"$column_name","dataType"=>"number","allowEditing"=> 0];
                };
                if($column_name==="TypeData"){
                    $fieldTabel=["dataField"=>"$column_name","dataType"=>"$data_type","allowEditing"=> 0];
                };
                if($column_name==="x_awal" || $column_name==="y_awal" || $column_name==="x_akhir" || $column_name==="y_akhir"){
                    $fieldTabel=["dataField"=>"$column_name","dataType"=>"number","format"=>["precision"=>8],"validationRules"=>[["type"=>"required"]]];
                };
                
                array_push($columnTabel,$fieldTabel);
            };
            
        };
        // dd($columnTabel);
        return $columnTabel;    
    }

    public function getFieldSynchronize(Request $request){
        $nmTabel=$request->get('tabel');

        $nmField=$this->NamaFieldTypeUseSHP($nmTabel);
        return $nmField;
    }

    public function simpanNewDetail(Request $request){
        $data=$request["data"];
        $pjgTgl=strlen($data["tanggal"]);
        if($pjgTgl>=15){
            $tanggalPanjang=$data["tanggal"];
            $tanggal=$this->changeTgl($tanggalPanjang);
            $data['tanggal']=$tanggal;
        }
        // dd($data);
        $nmTabel='detail_' . $request["layerAktif"];
        unset($data["__KEY__"]);
        DB::table($nmTabel)->insert($data);
    }

    public function changeTgl($tglPanjang){
        $explode=explode(" ",$tglPanjang);
        $thn=$explode[3];
        $tgl=$explode[2];
        $strBulan=$explode[1];
        $jam=$explode[4];
        $mnths = [
            "Jan"=> "01",
            "Feb"=> "02",
            "Mar"=> "03",
            "Apr"=> "04",
            "May"=> "05",
            "Jun"=> "06",
            "Jul"=> "07",
            "Aug"=> "08",
            "Sep"=> "09",
            "Oct"=> "10",
            "Nov"=> "11",
            "Dec"=> "12"
        ];
        $bulan=$mnths[$strBulan];
        $hasil=$thn . "-" .$bulan. "-" .$tgl;
        return $hasil;
    }

    public function updateDatail(Request $request){
        // dd($request->all());
        $newData=$request['newData'];
        $oldData=$request['oldData'];
        $gid=$oldData['gid'];
        $nmTabel='detail_' . $request["layerAktif"];
        $hasil=DB::table($nmTabel)->where('gid',$gid)->update($newData);

    }

    public function deleteDetail(Request $request){
        $data=$request['data'];
        $gid=$data['gid'];
        $nmTabel='detail_' . $request["layerAktif"];
        $hasil=DB::table($nmTabel)->where('gid','=',$gid)->delete();
    }

    public function getFoto(Request $request){
        $gid=$request->gid;
        $layerAktif=$request->layerAktif;
        $gidObjek=$request->gidObjek;
        $directory=Storage::disk('public')->files('foto/' .$layerAktif .'/' .$gid );
        $fImage=[];
        $fPdf=[];
        foreach($directory as $item){
            $ext=File::extension($item);
            if($ext=="pdf"){
                array_push($fPdf,$item);
            }else{
                array_push($fImage,$item);
            }
        };
        $hasil=['fImage'=>$fImage,'fPdf'=>$fPdf];
        return $hasil;
    }

    public function uploadFoto(Request $request){
        $file = $request->file('file');
        $gid=$request->gid;
        $layerAktif=$request->layerAktif;
        $tujuan_upload = 'foto/' .$layerAktif .'/' .$gid ;
        $hasil=$file->storeAs($tujuan_upload,$file->getClientOriginalName(),'public');
    }

    public function HapusFileFoto(Request $request){
        // dd($request->get('nmfile'));
        Storage::disk('public')->delete($request->get('nmfile'));
    }

}
