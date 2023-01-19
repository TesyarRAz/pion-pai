<?php

use App\Http\Controllers\Guru\IzinController;
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
    Route::middleware('can:role_sekertaris')->prefix('user')->group(function () {
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

    Route::middleware('can:role_guru')->prefix('guru')->name('guru.')->group(function () {
        Route::get('/homeguru', 'GuruController@homeguru')->name('homeguru');
        Route::get('/guru', 'GuruController@guru')->name('guru');
        Route::get('/tambahguru', 'GuruController@tambahguru')->name('tambahguru');
        Route::post('/posttambahguru', 'GuruController@posttambahguru')->name('posttambahguru');
        Route::get('/hapusguru/{inf_tugas}', 'GuruController@hapusguru')->name('hapusguru');
        Route::get('/informasi', 'GuruController@informasi')->name('informasi');

        Route::namespace('Guru')->group(function() {        
            Route::get('/izin', 'IzinController@index')->name('izin.index');
            Route::post('/izin', 'IzinController@store')->name('izin.store');
            Route::get('/izin/{izin}/delete', 'IzinController@destroy')->name('izin.destroy');
        });
    });

    Route::middleware('can:role_osis')->prefix('osis')->group(function () {
        Route::get('/homeosis', 'OsisController@homeOsis')->name('osis.homeOsis');
        Route::post('/postcatatan', 'OsisController@postcatatan')->name('osis.postcatatan');
        Route::get('/hapuscatatan/{cat_kesalahan}', 'OsisController@hapuscatatan')->name('osis.hapuscatatan');
        Route::get('/riwayatcatatan', 'OsisController@riwayatcatatan')->name('osis.riwayatcatatan');
        Route::get('/rekapcatatan/{user}', 'OsisController@rekapcatatan')->name('osis.rekapcatatan');
    });

    Route::middleware('can:role_admin')->prefix('admin')->group(function () {
        Route::get('/member', 'AdminController@member')->name('admin.member');
        Route::get('/tambah', 'AdminController@tambah')->name('admin.tambah');
        Route::post('/posttambah', 'AdminController@posttambah')->name('admin.posttambah');
        Route::get('/edit/{user}', 'AdminController@edit')->name('admin.edit');
        Route::post('/postedit/{user}', 'AdminController@postedit')->name('admin.postedit');
        Route::get('/hapus/{user}', 'AdminController@hapus')->name('admin.hapus');
        Route::get('/absensi', 'AdminController@absensi')->name('admin.absensi');
        Route::post('/reset-absensi', 'AdminController@resetabsensi')->name('admin.resetabsensi');
        Route::post('/importsiswa', 'AdminController@importsiswa')->name('admin.importsiswa');

        Route::get('/mapel', 'MapelController@index')->name('admin.mapel.index');
        Route::get('/mapel/tambah', 'MapelController@create')->name('admin.mapel.create');
        Route::post('/mapel/store', 'MapelController@store')->name('admin.mapel.store');
        Route::get('/mapel/edit/{mapel}', 'MapelController@edit')->name('admin.mapel.edit');
        Route::post('/mapel/update/{mapel}', 'MapelController@update')->name('admin.mapel.update');
        Route::get('/mapel/hapus/{mapel}', 'MapelController@destroy')->name('admin.mapel.destroy');
        Route::post('/mapel/import', 'MapelController@import')->name('admin.mapel.import');

        Route::get('/informasi', 'AdminController@informasi')->name('admin.informasi.index');
        Route::get('/informasi/{inf_guru}/hapus', 'AdminController@destroyinformasi')->name('admin.informasi.destroy');
        Route::post('/informasi/{inf_guru}/update', 'AdminController@updateinformasi')->name('admin.informasi.update');
        Route::get('/informasi/{inf_guru}/edit', 'AdminController@editinformasi')->name('admin.informasi.edit');
    });

    Route::middleware('can:role_satpam')->prefix('satpam')->namespace('Satpam')->name('satpam.')->group(function () {
        Route::get('/izin', 'IzinController@index')->name('izin.index');
    });

    Route::get('logout', 'AuthController@logout')->name('logout');
});
