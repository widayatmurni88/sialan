<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/base', function () {
    return view('layout.baseGuest');
});

Route::get('/', function(){
    return redirect('/Login');
});
Route::get('/home', function(){
    return redirect('/Home');
});

Route::get('/Login', 'LoginController@login')
    ->middleware('guest')//bisa diakses walopun belum login
    ->name('login');
Route::post('/Login', 'LoginController@cekLogin')->name('cekLogin');
Route::get('/Logout', 'LoginController@logout')
    ->middleware('auth')//cuma bisa diakses kalo dusah punya kredensial
    ->name('logout');

Route::prefix('ForgotPassword')->group(function(){
    Route::get('/', 'ForgotPassword@index')
        ->middleware('guest')
        ->name('forgotPwd');

    Route::post('/', 'ForgotPassword@postForgotPassword')
        ->middleware('guest')
        ->name('postForgotPassword');

    Route::get('/reset/{token}', 'ForgotPassword@resetPwd')
        ->middleware('guest')
        ->name('reset');

    Route::post('/setNewPassword','ForgotPassword@setNewPassword')
        ->middleware('guest')
        ->name('setNewPassword');
});


Route::prefix('Register')->group(function () {
    Route::get('/', 'RegisterController@index')->middleware('guest')->name('register');
    Route::post('/PostRegister', 'RegisterController@postRegister')->middleware('guest')->name('postregister');
});

Route::prefix('Profile')->group( function (){
    Route::get('/', 'ProfileController@index')->middleware('auth')
        ->name('profile');
        
    Route::post('/Update', 'ProfileController@updateProfile')->middleware('auth')
        ->name('updateUserProfil');
    
    Route::get('/Account', 'ProfileController@updateAkun')->middleware('auth')
        ->name('updateAkun');
    
    Route::post('/UpdatePhoto', 'ProfileController@uploadFoto')->middleware('auth')
        ->name('uploadFoto');

    Route::post('/AcountChange','ProfileController@postChangeAkun')->middleware('auth')
        ->name('postChangeAkun');
});

Route::get('/Home', 'HomeController@index')->middleware('auth')
    ->name('home');

Route::get('/Dashboard', 'DashboardController@index')->middleware('auth')
    ->name('dashboard');

Route::post('/Absen', 'AbsenKegiatanController@absensi')->middleware('auth')
    ->name('absensi');

Route::prefix('DailyActivity')->group(function(){
    Route::get('/Add/{idabsen}', 'LaporanHarianController@addKegiatanHarian')->middleware('auth')
        ->name('addKegiatanHarian');
    Route::post('/PostAddActivity', 'LaporanHarianController@postAddKegiatanHarian')->middleware('auth')
        ->name('postAddKegiatanHarian');
    Route::get('/Preview/{id}', 'LaporanHarianController@previewKegiatan')->middleware('auth')
        ->name('previewkegiatan');
    Route::get('/List/{id}', 'LaporanHarianController@previewListKegiatan')->middleware('auth')
        ->name('previewlistkegiatan');
    Route::get('/Edit/{id}','LaporanHarianController@editKegiatanHarian')->middleware('auth')
        ->name('editkegiatanharian');
    Route::post('/PostEdit','LaporanHarianController@postEditKegiatanHarian')->middleware('auth')
        ->name('posteditkegiatanharian');
    Route::get('/DeleteActivity/{idActivity}', 'LaporanHarianController@deleteKegiatan')->middleware('auth')
        ->name('deleteKegiatan');
    Route::get('/ReportPerMonth', 'LaporanHarianController@index')->middleware('auth')
        ->name('lapgiatharian');
    Route::get('/getReportAbsenPerMonth/{nid}', 'LaporanHarianController@getAbsenPerUser')->middleware('auth');
});


Route::get('/Perform', 'KinerjaController@index')->middleware('auth')
    ->name('kinerja');

//setting App
Route::prefix('setupHariLibur')->group(function(){
    Route::get('/{thn?}', 'AppSettingsController@setupHariLibur')
        ->middleware('auth')
        ->name('getHariLibur');

    Route::post('/', 'AppSettingsController@getHariLiburByTahun')
        ->middleware('auth')
        ->name('getHariLiburByTahun');

    Route::get('/{thn}/Add', 'AppSettingsController@addHariLibur')
        ->middleware('auth')
        ->name('addHariLibur');

    Route::get('/{thn}/Edit/{id}', 'AppSettingsController@editHariLibur')
        ->middleware('auth')
        ->name('editHariLibur');

    Route::put('/{thn}/Edit/{id}', 'AppSettingsController@postEditHariLibur')
        ->middleware('auth')
        ->name('postEditHariLibur');

    Route::get('/{thn}/delete/{id}', 'AppSettingsController@deleteHariLibur')
        ->middleware('auth')
        ->name('deleteLibur');
});

Route::post('/postHariLibur', 'AppSettingsController@postHariLibur')
    ->middleware('auth')
    ->name('postHariLibur');

//Admin Super
Route::prefix('Super')->group( function(){
    Route::get('/', 'Admin\DashboardController@index')->middleware('auth')->name('superDash');

    Route::prefix('MenageAcounts')->group(function(){
        Route::get('/', 'Admin\AcountsController@index')->middleware('auth')->name('manageAkun');
        Route::get('/Delete/{id}', 'Admin\AcountsController@deleteAkun')->middleware('auth')->name('deleteAkun');
    });

    Route::prefix('Ranks')->group( function () {
        Route::get('/', 'Admin\RankController@index')->middleware('auth')->name('setPangkat');
        Route::post('/', 'Admin\RankController@postRankSerach')->middleware('auth')->name('cariPangkat');
        Route::post('/postRank', 'Admin\RankController@postPangkat')->middleware('auth')->name('postPangkat');
        Route::get('/Add', 'Admin\RankController@tambahPangkat')->middleware('auth')->name('tambahPangkat');
        Route::get('/Edit/{id}', 'Admin\RankController@editPangkat')->middleware('auth')->name('editPangkat');
        Route::post('/Edit/PostRank', 'Admin\RankController@postEditPangkat')->middleware('auth')->name('postEditPangkat');
        Route::get('/Delete/{id}', 'Admin\RankController@deletePangkat')->middleware('auth')->name('deletePangkat');
    });

    Route::prefix('Departement')->group(function () {
        Route::get('/', 'Admin\InstansiController@index')->middleware('auth')
            ->name('instansi');
        Route::get('/Add', 'Admin\InstansiController@addInstansi')->middleware('auth')
            ->name('addinstansi');
        Route::post('/PostAdd', 'Admin\InstansiController@postAddInstansi')->middleware('auth')
            ->name('postaddinstansi');
        Route::get('/Edit/{id}', 'Admin\InstansiController@editInstansi')->middleware('auth')
            ->name('editinstansi');
        Route::post('/PostEdit', 'Admin\InstansiController@postEditInstansi')->middleware('auth')
            ->name('posteditinstansi');        
        Route::get('/Delete/{id}', 'Admin\InstansiController@deleteInstansi')->middleware('auth')
            ->name('deleteinstansi');
        Route::post('/Search', 'Admin\InstansiController@searchInstansi')->middleware('auth')
            ->name('searchinstansi');
    });
});
