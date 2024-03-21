<?php
use App\http\Controllers\HomeController;
use App\http\Controllers\CategoryController;
use App\http\Controllers\MenuController;
use App\http\Controllers\MejaController;
use App\http\Controllers\StokController;
use App\http\Controllers\ProdukController;
use App\http\Controllers\UserController;
use App\http\Controllers\TransaksiController;
use App\http\Controllers\JenisController;
use App\http\Controllers\PelangganController;
use App\http\Controllers\PemesananController;
use App\http\Controllers\ProdukTitipanController;
use App\http\Controllers\TitipanController;
use Illuminate\Support\Facades\Route;

//login
Route::get('/login',[UserController::class, 'index']) ->name('login');
Route::post('/login/cek',[UserController::class, 'cekLogin']) ->name('cekLogin');
Route::get('/logout',[UserController::class, 'logout']) ->name('logout');

Route::group(['middleware'=>'auth'], function(){
    Route::resource('/home', HomeController::class);
    Route::resource('/sejarah', HomeController::class);

    Route::group(['middleware'=>['cekUserLogin:1']], function(){
        Route::resource('/category', CategoryController::class);
        Route::resource('/meja', MejaController::class);
        Route::resource('/jenis', JenisController::class);
        Route::get('export/jenis',[JenisController::class, 'exportData'])->name('export-jenis');
        Route::post('jenis/import', [JenisController::class, 'importData'])->name('import-jenis');
        Route::resource('/menu', MenuController::class);
        Route::get('export/menu',[MenuController::class, 'exportData'])->name('export-menu');
        Route::post('menu/import', [MenuController::class, 'importData'])->name('import-menu');
        Route::resource('/stok', StokController::class);
        Route::get('export/stok',[StokController::class, 'exportData'])->name('export-stok');
        Route::post('stok/import', [StokController::class, 'importData'])->name('import-stok');
        //Route::resource('/category', CategoryController::class);
    });

    Route::group(['middleware'=>['cekUserLogin:2']], function(){
        Route::resource('/pelanggan', PelangganController::class);
        Route::resource('/pemesanan', PemesananController::class);
        Route::resource('/titipan', TitipanController::class);
        Route::get('export/titipan',[TitipanController::class, 'exportData'])->name('export-titipan');
        Route::post('titipan/import', [TitipanController::class, 'importData'])->name('import-excel');
        // Route::post('titipan/import', [ProductController::class, 'importData'])->name('import-titipan');
        Route::resource('/transaksi', TransaksiController::class);
        Route::get('nota/{nofaktur}', [TransaksiController::class,'faktur']);
        //Route::resource('/produk', ProdukController::class);
    });

    Route::group(['middleware'=>['cekUserLogin:3']], function(){
       
    });

});