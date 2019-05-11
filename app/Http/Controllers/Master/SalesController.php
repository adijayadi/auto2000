<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function sales()
    {
    	return view('master.sales.sales');
    }
    public function tambah_sales()
    {
    	return view('master.sales.tambah_sales');
    }
}

