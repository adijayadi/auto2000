<?php

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
    return view('home');
    // for enable login
    // return redirect('home');
});

Auth::routes([ 'register' => false ]);


// Group wib-cpanel
Route::group(['middleware' => 'guest' ], function(){

	Route::get('/home', 'HomeController@index')->name('home');

	// master
	Route::get('/master/sales/index', 'Master\SalesController@sales')->name('sales');
	Route::get('/master/sales/create', 'Master\SalesController@tambah_sales')->name('tambah_sales');

	Route::get('/master/kendaraan/index', 'Master\KendaraanController@kendaraan')->name('kendaraan');
	Route::get('/master/kendaraan/create', 'Master\KendaraanController@tambah_kendaraan')->name('tambah_kendaraan');
 
	Route::get('/master/alasan/index', 'Master\AlasanController@alasan')->name('alasan');
	Route::get('/master/alasan/create', 'Master\AlasanController@tambah_alasan')->name('tambah_alasan');

	// Data Sales
	Route::get('/data_sales/import_excel/index', 'DataSales\ImportController@import_excel')->name('import_excel');



	// Monitoring Sales Account

	Route::get('/kinerja_sales/monitoring_kinerja/index', 'Monitoring\MonitoringController@monitoring')->name('monitoring');

	// pengguna

	Route::get('/pengguna/index', 'Pengguna\PenggunaController@pengguna')->name('pengguna');
	Route::get('/pengguna/create', 'Pengguna\PenggunaController@tambah_pengguna')->name('tambah_pengguna');
});//End Route::Group wib-cpanel
