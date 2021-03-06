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

Route::prefix('Absen')->group( function() {
    Route::post('/Checkin', 'AbsenKegiatanController@absensi')->middleware('auth')
        ->name('absensi');

    Route::post('/Checkout', 'AbsenKegiatanController@absenPulang')->middleware('auth')
        ->name('absen_pulang');

});


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
    Route::get('/getReportAbsenPerMonth/{nid}', 'LaporanHarianController@getAbsenPerUser')->middleware('auth')->name('getReportAbsenPerMonth');
});

Route::prefix('Report')->group( function(){

    Route::post('/KinerjaInstansi', 'LaporanKinerjaController@getAbsenPerInstansi')->middleware('auth')
    ->name('kinerjapegawaiinstansi');

    Route::post('/Kinerja', 'LaporanKinerjaController@getAbsen')->middleware('auth')
    ->name('kinerjapegawaiall');

    Route::get('/{data?}', 'LaporanKinerjaController@index')->middleware('auth')->name('kinerjapegawai');
    
    Route::get('/Print/{instansi}/{bulan}/{tahun}', 'LaporanKinerjaController@printLaporan')->middleware('auth')->name('printlaporan');

    Route::get('/Printst/{file}','LaporanKinerjaController@printSurattj')->middleware('auth')->name('printSurattj');
});

Route::prefix('Pernyataan')->group(function () {
    Route::get('/','PernyataanTanggungJawabController@index')->middleware('auth')->name('surattjs');

    Route::post('/','PernyataanTanggungJawabController@getPernyataanByTahun')->middleware('auth')->name('getPernyataanByTahun');

    Route::get('/Add/{tahun}','PernyataanTanggungJawabController@showFormTambahPernyataan')->middleware('auth')->name('showFormTambahPernyataan');
    
    Route::post('/Add','PernyataanTanggungJawabController@postPernyataan')->middleware('auth')->name('postPernyataan');
    
    Route::get('/Delete/{id}', 'PernyataanTanggungJawabController@deletePernyataan')->middleware('auth')->name('deletePernyataan');
    
    Route::get('/Edit/{tahun}/{id}', 'PernyataanTanggungJawabController@editPernyataan')->middleware('auth')->name('editPernyataan');
    
    Route::put('/EditPernyataan', 'PernyataanTanggungJawabController@postEditData')->middleware('auth')->name('postEditData');

    Route::post('/PernyataanPerInstasi', 'PernyataanTanggungJawabController@getPernyataanPernyaanPerInstansi')->middleware('auth')->name('getPernyataanPernyaanPerInstansi');
    
    Route::get('/{tahun}','PernyataanTanggungJawabController@getPernyataanBy')->where('tahun', '[0-9]+')->middleware('auth')->name('getPernyataanBy');
});

Route::prefix('Reference')->group( function(){
    Route::get('/', 'TtdReferenceController@index')->middleware('auth')->name('ttdreference');
    Route::post('/', 'TtdReferenceController@seveReference')->middleware('auth')->name('simpanreference');
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
    Route::get('/MyProfile', 'Admin\MyProfileController@index')->middleware('auth')->name('myprofile');
    Route::post('/UpdateMyProfile', 'Admin\MyProfileController@postUpdateMyProfile')->middleware('auth')->name('postupdatemyprofile');

    Route::prefix('MenageAcounts')->group(function(){
        Route::get('/', 'Admin\AcountsController@index')->middleware('auth')->name('manageAkun');
        
        Route::get('/Delete/{id}', 'Admin\AcountsController@deleteAkun')->middleware('auth')->name('deleteAkun');

        Route::get('/PreviewAccount/{id}', 'Admin\AcountsController@previewAccount')->middleware('auth')->name('previewakun');

        Route::get('/Resetpassword/{uid}', 'Admin\AcountsController@resetUserPassword')->middleware('auth')->name('resetuserpassword');

        Route::post('/{uid}/UpdateAccount', 'Admin\AcountsController@postUpdateAccount')->middleware('auth')->name('updateakunuser');

        Route::get('/AddAccount','Admin\AcountsController@addAccount')->middleware('auth')->name('adduserakun');

        Route::post('/PostAddAccount','Admin\AcountsController@postAddAccount')->middleware('auth')->name('postadduserakun');

        Route::post('/SearchAccount','Admin\AcountsController@searchAccount')->middleware('auth')->name('cariuserakun');
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

    Route::prefix('Holiday')->group(function(){
        
        Route::get('/{thn}/Add', 'Admin\HolidayController@tambahlibur')->middleware('auth')->name('tambahlibur');
        
        Route::get('/{thn?}', 'Admin\HolidayController@index')->middleware('auth')->name('getharilibur');

        Route::post('/','Admin\HolidayController@postSearchHoliday')->middleware('auth')->name('postsearchharilibur');

        Route::post('/postHoliday', 'Admin\HolidayController@postHoliday')->middleware('auth')->name('postharilibur');

        Route::get('/Delete/{id}', 'Admin\HolidayController@deleteHoliday')->middleware('auth')->name('deleteharilibur');
    });
});
