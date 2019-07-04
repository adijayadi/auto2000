<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use DataTables;

class KendaraanController extends Controller
{
    public function kendaraan(){
    	return view('master.kendaraan.kendaraan');
    }
    public function tambah_kendaraan(){
    	return view('master.kendaraan.tambah_kendaraan');
    }

    public function editpage(Request $request){
    	$id = $request->id;
    	$data = DB::table('m_vehicle')->where('v_id',$id)->get();
    	return view('master.kendaraan.edit_kendaraan',array(
    		'data' => $data,
    	));
    }

    public function table(){
        $data = DB::table('m_vehicle')->where('status_data','true')->get();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action',function($data){
            return '<form action="'.route("editpage.kendaraan").'" method="POST"><div class="btn-group btn-group-sm">
            			<input type="hidden" name="_token" value="'.csrf_token().'">
            			<input type="hidden" name="id" value="'.$data->v_id.'" >
                        <button class="btn btn-warning" type="submit" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
                        </form>
                        <button class="btn btn-danger delete" data-id="'.$data->v_id.'" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></button>
                    </div>';
        })
        ->make(true);
    }

    public function add(Request $request){
        $code = DB::table('m_vehicle')->count().Carbon::now()->format('mhs');
    	DB::table('m_vehicle')->insert([
    		'v_owner' => $request->name, 
    		'v_nphone' => $request->nphone,
    		'v_email' => $request->email,
    		'v_address' => $request->address,
    		'v_plate' => $request->nkendaraan,
    		'v_namecar' => $request->namekendaraan,
    		'v_code' => $request->nkendaraan,
            'status_data' => 'true',
    	]);
    }

    public function delete(Request $request){
        $id = $request->id;
        DB::table('m_vehicle')->where('v_id',$id)
            ->update([
                'status_data' => 'false',
            ]);
    }

    public function edit(Request $request){
        $id = $request->id;
        DB::table('m_vehicle')->where('v_id',$id)
        ->update([
            'v_owner' => $request->name, 
            'v_nphone' => $request->nphone,
            'v_email' => $request->email,
            'v_address' => $request->address,
            'v_plate' => $request->nkendaraan,
            'v_namecar' => $request->namekendaraan,
            'v_code' => $request->nkendaraan,
        ]);
    }
}
