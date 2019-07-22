<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Carbon\Carbon;
use App\d_user;

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

    public function editpage(Request $request)
    {
        $id = $request->id;
        $data = DB::table('m_sales')->where('s_id',$id)->get();
        return view('master.sales.edit_sales',array(
            'data' => $data,
        ));
    }

    public function tablesales(Request $request){
    	$data = DB::table('m_sales')->where('status_data','true')->orWhere('status_data','no')->get();
    	return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function($data){
    		if ($data->status_data === 'true') {
	    		return '<div class="btn-group btn-group-sm">
                <form action="'.route("editpage.sales").'" method="POST">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="id" value="'.$data->s_id.'">
	    		          <button class="btn btn-warning edit" type="submit" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
                </form>
	    		          <button class="btn btn-danger delete" type="button" data-id="'.$data->s_id.'" data-toggle="tooltip" data-placement="top" title="Non Aktifkan"><i class="fa fa-times"></i></button>
	    		        </div>';	
    		}else{
    			return '<div class="btn-group btn-group-sm">
                <form action="'.route("editpage.sales").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="id" value="'.$data->s_id.'">
    			            <button class="btn btn-warning edit"  type="submit" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
                </form>
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
        $check2 = DB::table('d_user')->where('u_username',$request->username)->count(); 
        $check = DB::table('m_sales')->where('s_username',$request->username)->count();
        if ($check == 0 && $check2 == 0) {
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

            $urutan2 = DB::table('d_user')->count();
            $code2 = 'SA'.$urutan2.Carbon::now()->format('yhs');
            d_user::create([
                'u_name' => $request->name,
                'u_username' => $request->username,
                'u_email' => $request->email,
                'password' => bcrypt($request->password),
                'u_user' => 'S',
                'u_code' => $code2,
                'status_data' =>'true',
            ]);   
        }else{
            return $check2 .'   '. $check;
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

