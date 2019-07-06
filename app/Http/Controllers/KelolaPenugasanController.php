<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
use App\d_customer;
use App\d_followup;

class KelolaPenugasanController extends Controller
{
    public function kelola_penugasan()
    {
    	$advisor = DB::table('d_user')->where(['u_user' => 'S', 'status_data' => 'true'])->get();
    	return view('monitoring_kinerja.kelola_penugasan.kelola_penugasan',array(
    		'advisor' => $advisor,
    	));
    }

    public function table(){
    	return '0';
    }

    public function tablecustomer(Request $request){
      $sekarang = Carbon::now('Asia/Jakarta');
      $notservice = Carbon::now('Asia/Jakarta')->subMonth()->format('Y,m,d');
      $notserviceto = Carbon::now('Asia/Jakarta')->subMonths(5)->format('Y,m,d');
      $datain = Carbon::now('Asia/Jakarta')->subMonths(4)->format('Y,m,d');
      $datainto = Carbon::now('Asia/Jakarta')->subMonths(8)->format('Y,m,d');
    		$data = DB::table('d_customer')->where('status_data','true')
        ->whereBetween('c_dateservice', [$datainto, $datain])
        ->get();
    	return DataTables::of($data)
    	->addColumn('check',function($data){
    		return '<input type="checkbox" class="up" name="followup[]" value="'.$data->c_code.'"><input type="checkbox" hidden name="customer[]" value="'.$data->c_serviceadvisor.'"><input type="checkbox" hidden name="id[]" value="'.$data->c_id.'">';
    	})
    	->addColumn('serial',function($data){
    		return $data->c_serial.'<input type="checkbox" hidden name="serial[]" value="'.$data->c_serial.'">';
    	})
    	->rawColumns(['check','serial'])
    	->make(true);
    }

    public function filtertablecustomer(Request $request){
    	$data = DB::table('d_customer')->where('c_serviceadvisor',$request->serviceadv)->where('status_data','true')->get();
    	return DataTables::of($data)
    	->addColumn('check',function($data){
    		return '<input type="checkbox" class="up" name="followup[]" value="'.$data->c_code.'"><input type="checkbox" hidden name="customer[]" value="'.$data->c_serviceadvisor.'">';
    	})
    	->addColumn('serial',function($data){
    		return $data->c_serial.'<input type="hidden" name="serial[]" value="'.$data->c_serial.'">';
    	})
    	->rawColumns(['check','serial'])
    	->make(true);
    }

    public function updateserviceadv(Request $request){
    	if ($request->scount == NULL) {
    		return false;
    	}else{
    	for ($i=0; $i < $request->scount ; $i++) { 
           		DB::table('d_customer')
           		->where('c_serial',$request->serial[$i])
           		->where('c_serviceadvisor',$request->customer[$i])
           		->where('c_code',$request->followup[$i])
           		->update([
           			'c_serviceadvisor' => $request->newadvisor,
           		]);
            }
            }

    }

    public function addplan(Request $request){
    	if ($request->advisor_baru == '') {
    		return false;
    	}else if($request->pcount == NULL){
    		return false;
    	}else{
            $alldata = [];
            for ($i=0; $i < $request->pcount ; $i++) { 
            $arr = array(
               		'fu_cid' => $request->id[$i],
           			'fu_cstaff' => $request->advisor_baru,
           			'fu_date' => Carbon::parse($request->dateup)->format('Y,m,d'),
           			'fu_time' => Carbon::parse($request->timeup),
           			'fu_status' => 'Planning',
           			'status_data' =>'true',
                );
            DB::table('d_customer')->where('c_id',$request->id[$i])
            ->update([
            	'status_data' => 'plan',
            ]);
          array_push($alldata, $arr);
            }
         d_followup::insert($alldata);
            }

    }
}
