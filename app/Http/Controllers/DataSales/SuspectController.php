<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuspectController extends Controller
{
    public function data_suspect()
    {
    	return view('data_sales.data_suspect.data_suspect');
    }
}
