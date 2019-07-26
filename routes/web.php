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





// Group wib-cpanel
Route::group(['middleware' => 'guest' ], function(){

	Route::get('/login','Account\loginController@view')->name('login');	
	Route::post('/login_process','Account\loginController@login')->name('login.sign');
});//End Route::Group wib-cpanel

//login
Route::post('/login_out','Account\loginController@logout')->name('logout');
Route::post('/alert','message@alertt')->name('alertt');

Route::group(['middleware' => 'auth' ], function(){
	//register
	Route::get('/daftar', 'Account\RegisterController@index')->name('daftar');
	Route::post('/register', 'Account\RegisterController@register')->name('register');


	Route::get('/', 'HomeController@index')->name('index');

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/home/getDataTable', 'HomeController@getDataTable')->name('home.getDataTable');

	// master
	Route::get('/master/sales/index', 'Master\SalesController@sales')->name('sales');
	Route::get('/master/sales/create', 'Master\SalesController@tambah_sales')->name('tambah_sales');
	Route::post('/master/sales/editpage', 'Master\SalesController@editpage')->name('editpage.sales');
	//system sales
	Route::post('/master/sales/input', 'Master\SalesController@addsales')->name('sales.input');
	Route::post('/master/sales/table', 'Master\SalesController@tablesales')->name('sales.table');
	Route::post('/master/sales/edit', 'Master\SalesController@edit')->name('sales.edit');
	Route::post('/master/sales/delete', 'Master\SalesController@delete')->name('sales.delete');
	Route::post('/master/sales/active', 'Master\SalesController@active')->name('sales.active');



	Route::get('/master/kendaraan/index', 'Master\KendaraanController@kendaraan')->name('kendaraan');
	Route::get('/master/kendaraan/create', 'Master\KendaraanController@tambah_kendaraan')->name('tambah_kendaraan');
	Route::post('/master/kendaraan/editpage', 'Master\KendaraanController@editpage')->name('editpage.kendaraan');
	//system kendaraan 
	Route::post('/master/kendaraan/table', 'Master\KendaraanController@table')->name('table.kendaraan');
	Route::post('/master/kendaraan/input', 'Master\KendaraanController@add')->name('input.kendaraan');
	Route::post('/master/kendaraan/edit', 'Master\KendaraanController@edit')->name('edit.kendaraan');
	Route::post('/master/kendaraan/delete', 'Master\KendaraanController@delete')->name('delete.kendaraan');

 
	Route::get('/master/alasan/index', 'Master\AlasanController@alasan')->name('alasan');
	Route::post('/master/alasan/editpage', 'Master\AlasanController@editpage')->name('editpage.alasan');
	Route::get('/master/alasan/create', 'Master\AlasanController@tambah_alasan')->name('tambah_alasan');
	//system alasan
	Route::post('/master/alasan/insert', 'Master\AlasanController@add')->name('alasan.input');
	Route::post('/master/alasan/table', 'Master\AlasanController@table')->name('alasan.table');
	Route::post('/master/alasan/edit', 'Master\AlasanController@edit')->name('edit.alasan');
	Route::post('/master/alasan/delete', 'Master\AlasanController@delete')->name('delete.alasan');


	// Manajemen Service Advisor

	Route::get('/data_sales/tindakan_sales/index', 'DataSales\TindakanSalesController@tindakan_sales')->name('tindakan_sales');

	Route::get('/data_sales/summary_tindakan/index', 'DataSales\SummaryTindakanController@summary_tindakan')->name('summary_tindakan');
	//get data
	Route::PUT('/data_sales/summary_tindakan/getcount', 'DataSales\SummaryTindakanController@getcount')->name('getcount.summary');
	//table
	Route::post('/data_sales/summary_tindakan/booking', 'DataSales\SummaryTindakanController@booking')->name('booking.summary');
	Route::post('/data_sales/summary_tindakan/notbooking', 'DataSales\SummaryTindakanController@notbooking')->name('notbooking.summary');
	Route::post('/data_sales/summary_tindakan/refu', 'DataSales\SummaryTindakanController@refu')->name('refu.summary');
	Route::post('/data_sales/summary_tindakan/denied', 'DataSales\SummaryTindakanController@denied')->name('denied.summary');
	Route::post('/data_sales/summary_tindakan/all', 'DataSales\SummaryTindakanController@all')->name('all.summary');


	Route::get('/data_sales/data_suspect/index', 'DataSales\SuspectController@data_suspect')->name('data_suspect');
	//table suspect
	Route::post('/data_sales/data_suspect/table', 'DataSales\SuspectController@table')->name('table.suspect');
	Route::post('/data_sales/data_suspect/rencana', 'DataSales\SuspectController@simpan')->name('rencana.suspect');
	Route::post('/data_sales/data_suspect/sudahservice', 'DataSales\SuspectController@sudahservice')->name('sudahservice.suspect');


	Route::get('/data_sales/rencana_followup/index', 'DataSales\RencanaFollowUpController@rencana_followup')->name('rencana_followup');
	// system rencana followup
	Route::post('/data_sales/rencana_followup/table', 'DataSales\RencanaFollowUpController@table')->name('table.follow');
	Route::post('/data_sales/rencana_followup/update', 'DataSales\RencanaFollowUpController@update')->name('update.follow');
	Route::post('/data_sales/rencana_followup/tablere', 'DataSales\RencanaFollowUpController@tablere')->name('tablere.follow');


	// Manajemen Data & Penugasan

	

	Route::get('/kinerja_sales/import_excel/index', 'DataSales\ImportController@import_excel')->name('import_excel');

	//system excel

	Route::post('/kinerja_sales/import_excel/input', 'DataSales\ImportController@storedata')->name('store.excel');
	Route::post('/kinerja_sales/import_excel/hinput', 'DataSales\ImportController@hstoredata')->name('hstore.excel');
	Route::post('/kinerja_sales/import_excel/delete', 'DataSales\ImportController@delete')->name('delete.excel');
	Route::post('/kinerja_sales/import_excel/table', 'DataSales\ImportController@table')->name('table.excel');
	Route::post('/kinerja_sales/import_excel/tablerekap', 'DataSales\ImportController@tablerekap')->name('table.rekap');
	Route::post('/kinerja_sales/import_excel/reset', 'DataSales\ImportController@reset')->name('table.reset');
	Route::post('/kinerja_sales/import_excel/rekap', 'DataSales\ImportController@rekap')->name('rekap.excel');

	Route::get('/kinerja_sales/kelola_penugasan/index', 'KelolaPenugasanController@kelola_penugasan')->name('kelola_penugasan');
	// system penugasan
	Route::post('/kinerja_sales/kelola_penugasan/tablec', 'KelolaPenugasanController@tablecustomer')->name('tablec.penugasan');
	Route::post('/kinerja_sales/kelola_penugasan/filtertablec', 'KelolaPenugasanController@filtertablecustomer')->name('filtertablec.penugasan');
	Route::post('/kinerja_sales/kelola_penugasan/addplan', 'KelolaPenugasanController@addplan')->name('addplan.penugasan');
	Route::post('/kinerja_sales/kelola_penugasan/updateservice', 'KelolaPenugasanController@updateserviceadv')->name('updateadv.penugasan');
	Route::post('/kinerja_sales/kelola_penugasan/tableganti', 'KelolaPenugasanController@tableganti')->name('tableganti.penugasan');



	// End Manajemen Data & Penugasan

	// Monitoring Tindakan Service Advisor
	Route::get('/monitoring_kinerja/index', 'Monitoring\MonitoringController@monitoring')->name('monitoring');
	// table
	Route::post('/monitoring_kinerja/table', 'Monitoring\MonitoringController@table')->name('table.monitoring');
	Route::post('/monitoring_kinerja/tablelog', 'Monitoring\MonitoringController@tablelog')->name('tablelog.monitoring');
	Route::post('/monitoring_kinerja/dataservice', 'Monitoring\MonitoringController@dataservice')->name('dataservice.monitoring');
	Route::post('/monitoring_kinerja/datalog', 'Monitoring\MonitoringController@datalog')->name('datalog.monitoring');
	Route::post('/monitoring_kinerja/log', 'Monitoring\MonitoringController@log')->name('log.monitoring');
	//get data
	Route::PUT('/monitoring_kinerja/get', 'Monitoring\MonitoringController@gdata')->name('gdata.monitoring');


	// pengguna

	Route::get('/pengguna/index', 'Pengguna\PenggunaController@pengguna')->name('pengguna');
	Route::get('/pengguna/create', 'Pengguna\PenggunaController@tambah_pengguna')->name('tambah_pengguna');
	Route::post('/pengguna/editpage', 'Pengguna\PenggunaController@editpage')->name('editpage.pengguna');
	//table
	Route::post('/pengguna/table', 'Pengguna\PenggunaController@table')->name('table.pengguna');
	Route::post('/pengguna/delete', 'Pengguna\PenggunaController@delete')->name('delete.pengguna');
	Route::post('/pengguna/edit', 'Pengguna\PenggunaController@edit')->name('edit.pengguna');

});