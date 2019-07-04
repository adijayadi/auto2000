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
    	$data = DB::table('m_sales')->where('status_data','true')->orWhere('status_data','no')->get();
    	return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function($data){
    		if ($data->status_data === 'true') {
	    		return '<div class="btn-group btn-group-sm">
	    		          <button class="btn btn-warning edit" data-id="'.$data->s_id.'" type="button" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
	    		          <button class="btn btn-danger delete" type="button" data-id="'.$data->s_id.'" data-toggle="tooltip" data-placement="top" title="Non Aktifkan"><i class="fa fa-times"></i></button>
	    		        </div>';	
    		}else{
    			return '<div class="btn-group btn-group-sm">
    			            <button class="btn btn-warning edit" data-id="'.$data->s_id.'" type="button" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
    			            <button class="btn btn-primary delete" data-id="'.$data->s_id.'" type="button" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-check"></i></button>
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
        $check = DB::table('m_sales')->where('s_username',$request->username)->count();
        if ($check == 0) {
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
        }else{
            return false;
        }
    }

    public function delete(Request $request){
        $id = $request->id;
        DB::table('m_sales')->where('s_id',$id)
            ->update([
                'status_data' => 'false',
            ]);
    }

    public function edit(Request $request){
        $id = $request->id;
        DB::table('m_sales')->where('s_id',$id)
            ->update([
                's_name' => $request->name,
                's_email' => $request->email,
                's_nphone' => $request->phone,
                's_address' => $request->address,
                's_username' => $request->username,
                'password' => bcrypt($request->password),
        ]);
    }
}

