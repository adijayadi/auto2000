<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TindakanSalesController extends Controller
{
    public function tindakan_sales(){
		return view('data_sales.tindakan_sales.tindakan_sales');
	}
	
}
