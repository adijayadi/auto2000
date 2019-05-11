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

	Route::get('/master/sales/index', 'Master\SalesController@sales')->name('sales');
	Route::get('/master/sales/create', 'Master\SalesController@tambah_sales')->name('tambah_sales');

 
});//End Route::Group wib-cpanel
