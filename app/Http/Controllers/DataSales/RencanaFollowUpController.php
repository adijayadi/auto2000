<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RencanaFollowUpController extends Controller
{
    public function rencana_followup()
    {
    	return view('data_sales.rencana_followup.rencana_followup');
    }
}
