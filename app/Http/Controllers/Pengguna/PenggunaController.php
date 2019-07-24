<?php

namespace App\Http\Controllers\Pengguna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use DataTables;

class PenggunaController extends Controller
{
    public function pengguna(){
    	return view('pengguna.pengguna');
    }
    public function tambah_pengguna(){
    	return view('pengguna.tambah_pengguna');
    }
    public function editpage(Request $request){
        $id = $request->id;
        $data = DB::table('d_user')->where('u_id',$id)->get();
        return view('pengguna.edit_pengguna',array(
            'data' => $data,
        ));
    }

    public function table(){
    	$data = DB::table('d_user')->where('status_data','true')->get();

    	return DataTables::of($data)
        ->addColumn('action',function($data){
            return '<form action="'.route("editpage.pengguna").'" class="btn-group btn-group-sm" method="post">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <input type="hidden" name="id" value="'.$data->u_id.'">
            <button class="btn btn-warning" type="submit" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
                <button class="btn btn-danger delete" data-id="'.$data->u_id.'" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></button>
                </form>';
                
        })
    	->addColumn('hak',function($data){
    		if ($data->u_user == 'A') {
    			return 'Manajer';
    		}else if($data->u_user == 'S'){
    			return 'Staff Service Advisor';
    		}else{
                return 'Unknown';
            }
    	})
    	->addIndexColumn()
        ->rawColumns(['action','hak'])
    	->make(true);
    }

    public function delete(Request $request){
        $id = $request->id;
        DB::table('d_user')->where('u_id',$id)
        ->update([
            'u_user' => 'U',
        ]);
    }

    public function edit(Request $request){
        $id = $request->id;
        DB::table('d_user')->where('u_username',$id)
        ->update([
            'u_user' => $request->aksi,
        ]);
    }
}
