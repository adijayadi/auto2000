<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Carbon\Carbon;

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

    public function tablesales(Request $request){
    	$data = DB::table('m_sales')->get();
    	return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function($data){
    		if ($data->status_data === 'true') {
	    		return '<div class="btn-group btn-group-sm">
	    		          <button class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
	    		          <button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="Non Aktifkan"><i class="fa fa-times"></i></button>
	    		        </div>';	
    		}else{
    			return '<div class="btn-group btn-group-sm">
    			            <button class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
    			            <button class="btn btn-primary" type="button" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-check"></i></button>
    			        </div>';
    		}
    	})
    	->addColumn('status',function($data){
    		if ($data->status_data === 'true') {
    			return 'Aktif';
    		}else{
    			return 'Tidak Aktif';
    		}
    	})
    	->rawColumns(['action','status'])
    	->make(true);
    }

    public function addsales(Request $request){
    	$urutan = DB::table('m_sales')->get()->count()+ 1;
    	$code = 'S'.$urutan.Carbon::now()->format('hs');
    	DB::table('m_sales')
    		->insert([
    			's_name' => $request->name,
    			's_email' => $request->email,
    			's_nphone' => $request->phone,
    			's_address' => $request->address,
    			's_username' => $request->username,
    			'password' => bcrypt($request->password),
    			's_code' => $code,
    			'status_data' => 'true',
    		]);
    }
}

