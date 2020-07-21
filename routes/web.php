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


Route::get('/Profile/{nid}', 'ProfileController@index')
    ->middleware('auth')
    ->name('profile');
Route::get('/Home', 'HomeController@index')
    ->middleware('auth')
    ->name('home');

Route::get('/Dashboard', 'DashboardController@index')->middleware('auth')
    ->name('dashboard');

Route::get('/DailyActivity/{id}', 'LaporanHarianController@index')->middleware('auth')
    ->name('lapgiatharian');

Route::get('/Perform/{id}', 'KinerjaController@index')->middleware('auth')
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
});
