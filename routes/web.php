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
	Route::get('/login','Account\loginController@view')->name('login');	
});//End Route::Group wib-cpanel

//login
Route::post('/login_process','Account\loginController@login')->name('login.sign');
Route::post('/login_out','Account\loginController@logout')->name('logout');

Route::group(['middleware' => 'auth' ], function(){

	Route::get('/home', 'HomeController@index')->name('home');

	// master
	Route::get('/master/sales/index', 'Master\SalesController@sales')->name('sales');
	Route::get('/master/sales/create', 'Master\SalesController@tambah_sales')->name('tambah_sales');
	//system sales
	Route::post('/master/sales/input', 'Master\SalesController@addsales')->name('sales.input');
	Route::post('/master/sales/table', 'Master\SalesController@tablesales')->name('sales.table');



	Route::get('/master/kendaraan/index', 'Master\KendaraanController@kendaraan')->name('kendaraan');
	Route::get('/master/kendaraan/create', 'Master\KendaraanController@tambah_kendaraan')->name('tambah_kendaraan');
 
	Route::get('/master/alasan/index', 'Master\AlasanController@alasan')->name('alasan');
	Route::get('/master/alasan/create', 'Master\AlasanController@tambah_alasan')->name('tambah_alasan');
	//system alasan
	Route::post('/master/alasan/insert', 'Master\AlasanController@add')->name('alasan.input');
	Route::post('/master/alasan/table', 'Master\AlasanController@table')->name('alasan.table');


	// Manajemen Service Advisor

	Route::get('/data_sales/tindakan_sales/index', 'DataSales\TindakanSalesController@tindakan_sales')->name('tindakan_sales');

	Route::get('/data_sales/summary_tindakan/index', 'DataSales\SummaryTindakanController@summary_tindakan')->name('summary_tindakan');

	Route::get('/data_sales/data_suspect/index', 'DataSales\SuspectController@data_suspect')->name('data_suspect');

	Route::get('/data_sales/rencana_followup/index', 'DataSales\RencanaFollowUpController@rencana_followup')->name('rencana_followup');

	// Manajemen Data & Penugasan

	

	Route::get('/kinerja_sales/import_excel/index', 'DataSales\ImportController@import_excel')->name('import_excel');

	//system excel

	Route::post('/kinerja_sales/import_excel/input', 'DataSales\ImportController@storedata')->name('store.excel');

	Route::get('/kinerja_sales/kelola_penugasan/index', 'KelolaPenugasanController@kelola_penugasan')->name('kelola_penugasan');



	// End Manajemen Data & Penugasan

	// Monitoring Tindakan Service Advisor
	Route::get('/monitoring_kinerja/index', 'Monitoring\MonitoringController@monitoring')->name('monitoring');

	// pengguna

	Route::get('/pengguna/index', 'Pengguna\PenggunaController@pengguna')->name('pengguna');
	Route::get('/pengguna/create', 'Pengguna\PenggunaController@tambah_pengguna')->name('tambah_pengguna');
});