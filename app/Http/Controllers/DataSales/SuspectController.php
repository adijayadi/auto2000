<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use DataTables;

class SuspectController extends Controller
{
    public function data_suspect()
    {
    	return view('data_sales.data_suspect.data_suspect');
    }

    public function table()
    {

    	$data = DB::table('d_followup')
    			->join('d_customer','c_id' , 'fu_cid')
    			->where('fu_cstaff',Auth::user()->u_code)
    			->get();

    	return DataTables::of($data)
    	->addColumn('check',function($data){
    		return '
                        <input type="checkbox" name="centang-followup" value="'.$data->fu_cid.'">
                    ';
    	})
    	->rawColumns(['check'])
    	->make(true);
    }

    public function simpan(Request $request)
    {
    	$id = $erquest->id;
    	DB::table('d_followup')->where('fu_cid',$id);
    }
}
