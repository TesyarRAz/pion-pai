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

Route::get('/', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin')->name('postLogin');

Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/home', 'UserController@homeSeker')->name('user.homeSeker');
        Route::get('/riwayat', 'UserController@rwAbsensi')->name('user.rwAbsensi');
        Route::get('/informasi', 'UserController@informasi')->name('user.informasi');
        Route::get('/guru', 'UserController@guru')->name('user.guru');
        Route::get('/hapusguru/{inf_guru}', 'UserController@hapusguru')->name('user.hapusguru');
        Route::get('/tambahinf', 'UserController@tambahinf')->name('user.tambahinf');
        Route::post('/posttambahinf', 'UserController@posttambahinf')->name('user.posttambahinf');
        Route::get('/editinf/{inf_guru}', 'UserController@editinf')->name('user.editinf');
        Route::post('/posteditinf/{inf_guru}', 'UserController@posteditinf')->name('user.posteditinf');
        Route::post('/user/absensi', 'UserController@absensi')->name('user.absensi');
        Route::get('/user/rekap/{user}', 'UserController@rekapabsensi')->name('user.rekapabsensi');
    });

    Route::prefix('guru')->group(function () {
        Route::get('/homeguru', 'GuruController@homeguru')->name('guru.homeguru');
        Route::get('/guru', 'GuruController@guru')->name('guru.guru');
        Route::get('/tambahguru', 'GuruController@tambahguru')->name('guru.tambahguru');
        Route::post('/posttambahguru', 'GuruController@posttambahguru')->name('guru.posttambahguru');
        Route::get('/informasi', 'GuruController@informasi')->name('guru.informasi');
    });

    Route::prefix('osis')->group(function () {
        Route::get('/homeosis', 'OsisController@homeOsis')->name('osis.homeOsis');
        Route::post('/postcatatan', 'OsisController@postcatatan')->name('osis.postcatatan');
        Route::get('/hapuscatatan/{cat_kesalahan}', 'OsisController@hapuscatatan')->name('osis.hapuscatatan');
        Route::get('/riwayatcatatan', 'OsisController@riwayatcatatan')->name('osis.riwayatcatatan');
        Route::get('/rekapcatatan/{user}', 'OsisController@rekapcatatan')->name('osis.rekapcatatan');
    });


    Route::get('/member', 'AdminController@member')->name('admin.member');
    Route::get('/tambah', 'AdminController@tambah')->name('admin.tambah');
    Route::post('/posttambah', 'AdminController@posttambah')->name('admin.posttambah');
    Route::get('/edit/{user}', 'AdminController@edit')->name('admin.edit');
    Route::post('/postedit/{user}', 'AdminController@postedit')->name('admin.postedit');
    Route::get('/hapus/{user}', 'AdminController@hapus')->name('admin.hapus');
    Route::get('/absensi', 'AdminController@absensi')->name('admin.absensi');



    Route::get('logout', 'AuthController@logout')->name('logout');
});
