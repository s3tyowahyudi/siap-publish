<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\webgisController;
use App\Http\Controllers\dokumenController;
use App\Http\Controllers\userController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome.index');
});

Route::get('artisanClear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    Artisan::call('config:cache');
});

Route::get('artisanStorage', function(){
    Artisan::call('storage:link');
});

Route::get('webgis',function(){
    return view('webgis.index');
});

Route::get('getDataByGid/{gid}/{layerAktif}',[webgisController::class, 'getDataByGid']);
Route::get('ShowTabel/{nmtabel}',[webgisController::class,'ShowTabel']);
Route::get('getFeature/{layer}/{gid}',[webgisController::class,'GeomToJson']);
Route::get('NamaFieldTabel/{tabel}',[webgisController::class, 'NamaFieldType']);

Route::post('newObject',[webgisController::class,'simpanNewObject']);
Route::post('updateObject',[webgisController::class,'updateObject']);
Route::post('delete',[webgisController::class,'delete']);
Route::get('getFieldSynchronize',[webgisController::class,'getFieldSynchronize']);
Route::post('simpanNewObjectShp',[webgisController::class,'simpanNewObjectShp']);

Route::get('getDataChartFungsi',[dashboardController::class,'getDataChartFungsi']);
Route::get('ShowInfoDetail',[webgisController::class,'ShowInfoDetail']);
Route::post('simpanNewDetail',[webgisController::class,"simpanNewDetail"]);
Route::post('updateDatail',[webgisController::class,'updateDatail']);
Route::post('deleteDetail',[webgisController::class,'deleteDetail']);

Route::get('getFoto',[webgisController::class,'getFoto']);
route::post('uploadFoto',[webgisController::class,'uploadFoto']);
Route::post('HapusFileFoto',[webgisController::class,'HapusFileFoto']);

route::get('dokumen',function(){
    return view('dokumen.index');
});

route::get('showTabelFile',[dokumenController::class,'showTabelFIle']);
route::post('uploadDokumen',[dokumenController::class,'uploadDokumen']);
route::get('downloadDokumen',[dokumenController::class,'downloadDokumen']);

Route::get('login',function(){
    return view('login.index');
});
Route::post('login',[userController::class,'login']);
Route::get('settingUser',function(){
	if(Auth::check()){
		return view ('login.settingUser');
	}else{
		return redirect('/');
	}
});
Route::get('keluar',function(){
    Session::flush();
    return redirect('/');
});
Route::post('UpdateUser',[userController::class,'UpdateUser']);
Route::get('penggunaBaru',function(){
	if(Auth::check()){
		return view ('login.penggunaBaru');
	}else{
		return redirect('/');
	}
});
Route::post('addUser',[userController::class,'addUser']);
Route::get('KonfirmNewUser',function(){
    return view('login.KonfirmNewUser');
});
Route::get('dataUser', function(){
    return view('login.dataUser');
});
Route::get('ShowTabelUser',[userController::class,'ShowTabel']);
Route::post('deleteUser',[userController::class,'Delete']);
