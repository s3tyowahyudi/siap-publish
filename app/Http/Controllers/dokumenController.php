<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use File;
class dokumenController extends Controller
{
    public function showTabelFile(){
        $data=DB::table("dokumen")
            ->orderBy('id','asc')
            ->get();
        $hasil=['data'=>$data];
        return $hasil;    
    }

    public function uploadDokumen(Request $request){
        $file = $request->file('file');
        $ekstensi=$request->file('file')->extension();
        $keterangan=$request->get('keterangan');
        $kategori=$request->get('kategori');
        $directory='dokumen/' . $kategori;
        $hasil=$file->storeAs($directory,$file->getClientOriginalName(),'public');

        DB::table("dokumen")->insert([
            'keterangan' => $keterangan,
            'namafile' => $file->getClientOriginalName(),
            'ekstensi' => $ekstensi,
            'kategori' =>$kategori,
        ]);
    }

    public function downloadDokumen (Request $request){
        // dd(storage_path($filename));
        return Storage::disk('public')->download('dokumen/' . $request->get('kategori') . "/" . $request->get('nmFile'),$request->get('nmFile'));
    }
}
