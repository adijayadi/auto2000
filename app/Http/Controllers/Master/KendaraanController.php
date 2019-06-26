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

    public function table(){
        $data = DB::table('m_vehicle')->get();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action',function($data){
            return '<div class="btn-group btn-group-sm">
                        <button class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
                        <button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></button>
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
    		'v_address' => $request->nkendaraan,
    		'v_plate' => $request->namekendaraan,
    		'v_namecar' => $request->address,
    		'v_code' => $code,
            'status_data' => 'true',
    	]);
    }
}
