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

Route::prefix('MenageAcounts')->group(function(){
    Route::get('/', 'AcountsController@index')->middleware('auth')->name('menageAcounts');
    Route::get('/Delete/{id}', 'AcountsController@deleteAcount')->middleware('auth')->name('deleteUser');
});

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


Route::get('/Register', 'RegisterController@index')
    ->middleware('guest')
    ->name('register');
Route::post('/Register', 'RegisterController@postRegister')->name('postregister');
Route::get('/Profile/{id}', 'ProfileController@index')
    ->middleware('auth')
    ->name('profile');
Route::get('/Home', 'HomeController@index')
    ->middleware('auth')
    ->name('home');


//setting App
Route::prefix('setupHariLibur')->group(function(){
    Route::get('/{thn?}', 'AppSettingsController@setupHariLibur')
        ->middleware('auth')
        ->name('getHariLibur');

    Route::post('/', 'AppSettingsController@getHariLiburByTahun')
        ->middleware('auth')
        ->name('getHariLiburByTahun');

    Route::any('/{thn}/Add', 'AppSettingsController@addHariLibur')
        ->middleware('auth')
        ->name('addHariLibur');

    Route::any('/{thn}/Edit/{id}', 'AppSettingsController@editHariLibur')
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
