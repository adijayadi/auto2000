<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;

class MonitoringController extends Controller
{
    public function monitoring(){
    	return view('monitoring_kinerja.monitoring_kinerja.monitoring_kinerja');
    }

    public function table(){
    	$data = DB::table('d_user')
    	->join('d_customer','u_name','c_serviceadvisor')
    	->join('d_followup','fu_cid','c_id')
    	->where('u_user','S')
    	->groupBy('u_name')
    	->get();

    	return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function($data){
    		return '<button class="btn btn-info list" type="button" data-serviceadv="'.$data->u_name.'" data-toggle="modal" data-target="#tindakan-detail" data-placement="top" title="Detail"><i class="fa fa-list"></i></button>';
    	})
    	->rawColumns(['action'])
    	->make(true);

    }

    public function tablelog(){
    	$data = DB::table('d_user')
    	->join('d_customer','u_name','c_serviceadvisor')
    	->join('d_followup','fu_cid','c_id')
    	->where('u_user','S')
    	->groupBy('u_name')
    	->get();

    	return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function($data){
    		return '<button class="btn btn-info listlog" type="button" data-serviceadv="'.$data->u_name.'" data-toggle="modal" data-target="#log-detail" data-placement="top" title="Detail"><i class="fa fa-list"></i></button>';
    	})
    	->rawColumns(['action'])
    	->make(true);
    }

    public function dataservice(Request $request){
    	$sales = $request->serviceadv;
    	$data = DB::table('m_summary')
    	->get();
    	// ->join('d_resultfu','rf_csummary','s_code')
    	// ->join('d_followup','fu_cid','rf_cid')
    	// ->join('d_user','u_code','fu_cstaff');
    	// ->where('fu_cstaff',$sales)
    	// ->groupBy('s_name');
    	

    	return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function($data){
    		return '<button class="btn btn-info" type="button" data-toggle="modal" data-target="#tindakan-detail" data-placement="top" title="Detail"><i class="fa fa-list"></i></button>';
    	})
    	->addColumn('tindakan',function($data){
    		return '<span>'.$data->s_name.'</span>';
    	})
    	// ->addColumn('jumlah',function($data){
    		// if ($data->where('rf_cid') == '1') {
    		// 	return $data->where('rf_cid','1')->count();
    		// }else if($data->where('rf_cid') == '2'){
    		// 	return $data->where('rf_cid','2')->count();
    		// }else if($data->where('rf_cid') == '3'){
    		// 	return $data->where('rf_cid','3')->count();
    		// }else if($data->where('rf_cid') == '4'){
    		// 	return $data->where('rf_cid','4')->count();
    		// }else if($data->where('rf_cid') == '5'){
    		// 	return $data->where('rf_cid','5')->count();
    		// }
    	// })
    	->rawColumns(['action','tindakan'])
    	->make(true);
    }

    public function datalog(){
    	$sales = $request->serviceadv;
    	$data = DB::table('d_followup')
    	->get();

    	return DataTables::of($data)
    	->addIndexColumn()
    	->addColumn('action',function(){
    		return '<button class="btn btn-info" type="button" data-toggle="modal" data-target="#tindakan-detail" data-placement="top" title="Detail"><i class="fa fa-list"></i></button>';
    	})
    	->rawColumns(['action'])
    	->make(true);
    }
}
