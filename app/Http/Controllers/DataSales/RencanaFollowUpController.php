<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class RencanaFollowUpController extends Controller
{
    public function rencana_followup()
    {
    	return view('data_sales.rencana_followup.rencana_followup');
    }

    public function table()
    {
    }

    public function add()
    {

    }
}
