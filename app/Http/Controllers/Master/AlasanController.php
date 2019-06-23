<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use DataTables;

class AlasanController extends Controller
{
	public function alasan(){
		return view('master.alasan.alasan');
	}
	public function tambah_alasan(){
		return view('master.alasan.tambah_alasan');
	}

	public function table(Request $request){
		$data = DB::table('m_reason')->get();
		return DataTables::of($data)
		->addIndexColumn()
		->addcolumn('action',function($data){
			return '<div class="btn-group btn-group-sm">
                      <button class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-alt"></i></button>
                      <button class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></button>
                    </div>';
		})
		->rawColumns(['action'])
		->make(true);

	}

	public function add(Request $request){
		$urutan = DB::table('m_reason')->count();
		$code = $urutan . Carbon::now()->format('s');
		$group = 'G'.$urutan . Carbon::now()->format('s');
		DB::table('m_reason')->insert([
			'r_reason' => $request->alasan,
			'r_code' => $code,
			'r_group' => $group,
			'status_data' => 'true',
		]);


	}
}
