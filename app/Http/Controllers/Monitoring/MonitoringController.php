<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    public function monitoring(){
    	return view('monitoring_kinerja.monitoring_kinerja.monitoring_kinerja');
    }

    public function table(){
    	$data = DB::table('d_user')
    	->leftJoin('d_customer','u_name','c_serviceadvisor')
    	->leftJoin('d_followup','fu_cid','c_id')
    	->where('u_user','S')
    	->groupBy('u_name')
    	->get();

    	return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function($data){
    		return '<button class="btn btn-info btn-sm list" type="button" data-nama="'.$data->u_name.'" data-serviceadv="'.$data->u_code.'" data-toggle="modal" data-target="#tindakan-detail" data-placement="top" title="Detail"><i class="fa fa-list"></i></button>';
    	})
    	->rawColumns(['action'])
    	->make(true);

    }

    public function tablelog(){
    	$data = DB::table('d_user')
    	->leftJoin('d_customer','u_name','c_serviceadvisor')
    	->leftJoin('d_followup','fu_cid','c_id')
    	->where('u_user','S')
    	->groupBy('u_name')
    	->get();
    	
        return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function($data){
    		return '<button class="btn btn-info btn-sm listlog" type="button" data-nama="'.$data->u_name.'" data-serviceadv="'.$data->u_code.'" data-toggle="modal" data-target="#log-detail" data-placement="top" title="Detail"><i class="fa fa-list"></i></button>';
    	})
    	->rawColumns(['action'])
    	->make(true);
    }

    public function datalog(){
    	$sales = $request->serviceadv;
    	$data = DB::table('d_followup')
    	->get();

    	return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function(){
    		return '<button class="btn btn-info log" type="button" data-toggle="modal" data-target="#tindakan-detail" data-placement="top" title="Detail"><i class="fa fa-list"></i></button>';
    	})
    	->rawColumns(['action'])
    	->make(true);
    }

    public function gdata(Request $request){
        $adv = $request->adv;
        $satu = DB::table('d_followup')
        ->join('d_resultfu','rf_cid','fu_cid')
        ->where('fu_cstaff',$adv)
        ->where('d_resultfu.status_data','true')
        ->whereBetween('fu_plandate',[Carbon::parse($request->tanggal1)->format('Y,m,d'),Carbon::parse($request->tanggal2)->format('Y,m,d')])
        ->where('rf_csummary','1')->count();
        $dua = DB::table('d_followup')
        ->where('fu_cstaff',$adv)
        ->where('status_data','true')
        ->whereBetween('fu_plandate',[Carbon::parse($request->tanggal1)->format('Y,m,d'),Carbon::parse($request->tanggal2)->format('Y,m,d')])
        ->where('fu_status','Planning')->count();
        $tiga = DB::table('d_followup')
        ->join('d_resultfu','rf_cid','fu_cid')
        ->where('fu_cstaff',$adv)
        ->where('d_resultfu.status_data','true')
        ->whereBetween('fu_plandate',[Carbon::parse($request->tanggal1)->format('Y,m,d'),Carbon::parse($request->tanggal2)->format('Y,m,d')])
        ->where('rf_csummary','3')->count();
        $empat = DB::table('d_followup')
        ->join('d_resultfu','rf_cid','fu_cid')
        ->where('fu_cstaff',$adv)
        ->where('d_resultfu.status_data','true')
        ->whereBetween('fu_plandate',[Carbon::parse($request->tanggal1)->format('Y,m,d'),Carbon::parse($request->tanggal2)->format('Y,m,d')])
        ->where('rf_csummary','4')->count();
        $lima = DB::table('d_followup')
        ->join('d_resultfu','rf_cid','fu_cid')
        ->where('fu_cstaff',$adv)
        ->where('d_resultfu.status_data','true')
        ->whereBetween('fu_plandate',[Carbon::parse($request->tanggal1)->format('Y,m,d'),Carbon::parse($request->tanggal2)->format('Y,m,d')])
        ->where('rf_csummary','5')->count();
        return response()->json(array(
            'satu' => $satu,
            'dua' => $dua,
            'tiga' => $tiga,
            'empat' => $empat,
            'lima' => $lima,
        ));
    }

    public function log(Request $request){
        $code = $request->code;
        $log = DB::table('d_resultfu')
        ->join('d_followup','fu_cid','rf_cid')
        ->join('d_customer','c_id','rf_cid')
        ->leftJoin('m_vehicle','v_code','c_plate')
        ->where('fu_cstaff',$code)
        ->groupBy('rf_id')
        ->get();
        setlocale(LC_TIME, 'IND');
        
        return DataTables::of($log)
        ->addIndexColumn()
        ->addColumn('tanggal',function($log){
            return Carbon::parse($log->fu_updatedate)->formatLocalized('%d %B %Y') . ' ' . $log->fu_updatetime;
        })
        ->addColumn('kendaraan',function($log){
            return $log->c_plate . ' - ' . $log->v_owner; 
        })
        ->rawColumns(['tanggal','kendaraan'])
        ->make(true);
    }
}
