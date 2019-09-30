<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Carbon\Carbon;
use App\d_user;
use File;

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
    	$data = DB::table('m_sales')->get();
    	return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function($data){
    		if ($data->status_data === 'true') {
	    		return '
                <form action="'.route("editpage.sales").'" class="btn-group btn-group-sm" method="POST">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="id" value="'.$data->s_id.'">
	    		          <button class="btn btn-warning edit" type="submit" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
	    		          <button class="btn btn-danger delete" type="button" data-id="'.$data->s_id.'" data-toggle="tooltip" data-placement="top" title="Non Aktifkan"><i class="fa fa-times"></i></button>
                </form>';	
    		}else{
    			return '
                <form action="'.route("editpage.sales").'" class="btn-group btn-group-sm" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="id" value="'.$data->s_id.'">
    			            <button class="btn btn-warning edit"  type="submit" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
    			            <button class="btn btn-success active" data-id="'.$data->s_id.'" type="button" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-check"></i></button>
                </form>';
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
    	$code = 'S'.$urutan;
        $check2 = DB::table('d_user')->where('u_username',$request->username)->count(); 
        $check = DB::table('m_sales')->where('s_username',$request->username)->count();
        if ($check == 0 && $check2 == 0) {
            if ($request->gambar != null) {
          
              $image = $request->gambar;
              $image = str_replace('data:image/png;base64,', '', $image);
              $image = str_replace(' ', '+', $image);
              $imageName = str_random(10).'.'.'png';
              File::put(storage_path().'/image/master/sales/' . $imageName, base64_decode($image));
            }else{
                $imageName = 0;
            }
        	DB::table('m_sales')
        		->insert([
        			's_name' => $request->name,
        			's_email' => $request->email,
        			's_nphone' => $request->phone,
        			's_address' => $request->address,
        			's_username' => $request->username,
        			'password' => bcrypt($request->password),
                    's_path' => $imageName,
        			's_code' => $code,
        			'status_data' => 'true',
        		]);

            d_user::create([
                'u_name' => $request->name,
                'u_username' => $request->username,
                'u_email' => $request->email,
                'password' => bcrypt($request->password),
                'u_user' => 'S',
                'u_path' => $imageName,
                'u_code' => $code,
                'status_data' =>'true',
            ]);   

              return redirect()->back();
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

    public function active(Request $request){
        $id = $request->id;
        DB::table('m_sales')->where('s_id',$id)
            ->update([
                'status_data' => 'true',
            ]);
    }

    public function edit(Request $request){
        $id = $request->id;
        if ($request->gambar != null) {

            File::delete(storage_path().'/image/master/sales/'.$request->path);
                $image = $request->gambar;
              $image = str_replace('data:image/png;base64,', '', $image);
              $image = str_replace(' ', '+', $image);
              $imageName = str_random(10).'.'.'png';
              File::put(storage_path().'/image/master/sales/' . $imageName, base64_decode($image));
            }else{
                $imageName = $request->path;
            }

        DB::table('m_sales')->where('s_code',$id)
            ->update([
                's_name' => $request->name,
                's_email' => $request->email,
                's_nphone' => $request->phone,
                's_address' => $request->address,
                's_path' => $imageName,
                's_username' => $request->username,
                'password' => bcrypt($request->password),
        ]);

        DB::table('d_user')->where('u_code',$id)
                ->update([
                    'u_name' => $request->name,
                    'u_email' => $request->email,
                    'u_username' => $request->username,
                    'u_path' => $imageName,
                    'password' => bcrypt($request->password),
            ]);
    }
}

