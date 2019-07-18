<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class message extends Controller
{
    static function alertt(){
    	$data = DB::table('d_followup')->where('fu_cstaff',Auth::user()->u_code)->where('fu_status','planning')->count();

    	return $data;
    }

    static function planned(){
    	$data = DB::table('d_followup')->where('fu_cstaff',Auth::user()->u_code)->where('fu_status','planned')->count();
        $data2 =DB::table('d_followup')->where('fu_cstaff',Auth::user()->u_code)->Where('fu_status','refollowup')->count();

    	return $data + $data2;
    }

    static function hasil(){
    	$data = DB::table('d_followup')->join('d_resultfu','rf_cid','fu_cid')->where('fu_cstaff',Auth::user()->u_code)->count();

    	return $data;
    }

    static function customer(){
    	$customer = DB::table('d_customer')->where('status_data','true')->count();

    	return $customer;
    }
}
