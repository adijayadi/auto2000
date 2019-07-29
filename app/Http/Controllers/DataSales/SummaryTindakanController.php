<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use DataTables;
use Carbon\Carbon;

class SummaryTindakanController extends Controller
{
	public function summary_tindakan(){
		return view('data_sales.summary_tindakan.summary_tindakan');
	}

    public function all(){
        $all = DB::table('d_resultfu')
                ->join('d_customer','c_order' , 'rf_cid')
                ->leftJoin('m_vehicle','v_code','c_plate')
                ->where('rf_cstaff',Auth::user()->u_code)
                ->groupBy('rf_cid')
                ->get();
        $fu = DB::table('d_followup')
                ->join('d_customer','c_order' , 'fu_cid')
                ->leftJoin('m_vehicle','v_code','c_plate')
                ->where('fu_cstaff',Auth::user()->u_code)
                ->where('d_followup.status_data','re')
                ->groupBy('fu_id')
                ->get();
                $data =[];
                if ($all != '[]') {
                    foreach ($all as $row) {
                        $arr = array(
                            'c_dateservice' => $row->c_dateservice,
                            'v_owner' => $row->v_owner,
                            'c_plate' => $row->c_plate,
                            'rf_csummary' => $row->rf_csummary,
                        );
                        array_push($data,$arr);
                    }
                }

                if ($fu != '[]') {
                    foreach ($fu as $row) {
                        $arrr = array(
                            'c_dateservice' => $row->c_dateservice,
                            'v_owner' => $row->v_owner,
                            'c_plate' => $row->c_plate,
                            'fu_status' => $row->fu_status,
                        );
                        array_push($data,$arrr);
                    }
                }
        setlocale(LC_TIME, 'IND');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('tanggal',function($data){
             return Carbon::parse($data['c_dateservice'])->formatLocalized('%d %B %Y');
        })
        ->addColumn('nama',function($data){
            if ($data['v_owner'] != null) {
                return $data['v_owner'];
            }else{
                return '';
            }
        })
        ->addColumn('status',function($data){
            if ($data['rf_csummary'] == '1') {
                return 'Sudah Di Service';
            }else if($data['rf_csummary'] == '2'){
                return 'Harus Di follow up';
            }else if($data['rf_csummary'] == '3'){
                return 'Menolak';
            }else if($data['rf_csummary'] == '4'){
                return 'Bersedia Sudah Booking';
            }else if($data['rf_csummary'] == '5'){
                return 'Bersedia Belum Booking';
            }
            else{
                return '';
            }
        })
        ->rawColumns(['tanggal','nama','status'])
        ->make(true);
    }

	public function booking(){
		$booking = DB::table('d_resultfu')
                ->join('d_customer','c_order' , 'rf_cid')
                ->leftJoin('m_vehicle','v_code','c_plate')
                ->where('rf_cstaff',Auth::user()->u_code)
                ->where('rf_csummary','4')
                ->groupBy('rf_cid')
                ->get();
    	setlocale(LC_TIME, 'IND');

    	return DataTables::of($booking)
        ->addIndexColumn()
    	->addColumn('tanggal',function($booking){
    		 return Carbon::parse($booking->c_dateservice)->formatLocalized('%d %B %Y');
    	})
        ->addColumn('nama',function($booking){
            if ($booking->v_owner != null) {
                return $booking->v_owner;
            }else{
                return '';
            }
        })
    	->rawColumns(['tanggal','nama'])
    	->make(true);
	}

	public function notbooking(){
		$notbooking = DB::table('d_resultfu')
                ->join('d_customer','c_order' , 'rf_cid')
                ->leftJoin('m_vehicle','v_code','c_plate')
                ->where('rf_cstaff',Auth::user()->u_code)
                ->where('rf_csummary','5')
                ->groupBy('rf_cid')
                ->get();
    	setlocale(LC_TIME, 'IND');

    	return DataTables::of($notbooking)
        ->addIndexColumn()
    	->addColumn('tanggal',function($notbooking){
    		 return Carbon::parse($notbooking->c_dateservice)->formatLocalized('%d %B %Y');
    	})
        ->addColumn('nama',function($notbooking){
            if ($notbooking->v_owner != null) {
                return $notbooking->v_owner;
            }else{
                return '';
            }
        })
    	->rawColumns(['tanggal','nama'])
    	->make(true);
	}

	public function refu(){
		$refu = DB::table('d_followup')
    			->join('d_customer','c_order' , 'fu_cid')
                ->leftJoin('m_vehicle','v_code','c_plate')
    			->where('fu_cstaff',Auth::user()->u_code)
                ->where('fu_status','refollowup')
            	->where('d_followup.status_data','re')
                ->groupBy('fu_id')
    			->get();
    	setlocale(LC_TIME, 'IND');

    	return DataTables::of($refu)
        ->addIndexColumn()
    	->addColumn('tanggal',function($refu){
    		 return Carbon::parse($refu->c_dateservice)->formatLocalized('%d %B %Y');
    	})
        ->addColumn('nama',function($refu){
            if ($refu->v_owner != null) {
                return $refu->v_owner;
            }else{
                return '';
            }
        })
    	->rawColumns(['tanggal','nama'])
    	->make(true);
	}

	public function denied(){
		$denied = DB::table('d_resultfu')
    			->join('d_customer','c_order' , 'rf_cid')
                ->leftJoin('m_vehicle','v_code','c_plate')
    			->where('rf_cstaff',Auth::user()->u_code)
                ->where('rf_csummary','3')
                ->groupBy('rf_cid')
    			->get();
    	setlocale(LC_TIME, 'IND');

    	return DataTables::of($denied)
        ->addIndexColumn()
    	->addColumn('tanggal',function($denied){
    		 return Carbon::parse($denied->c_dateservice)->formatLocalized('%d %B %Y');
    	})
        ->addColumn('nama',function($denied){
            if ($denied->v_owner != null) {
                return $denied->v_owner;
            }else{
                return '';
            }
        })
    	->rawColumns(['tanggal','nama'])
    	->make(true);
	}

	public function getcount(){
		$suspect = DB::table('d_followup')
    			->where('fu_cstaff',Auth::user()->u_code)
    			->leftJoin('d_customer','c_order' , 'fu_cid')
                ->where('fu_status','planning')
                ->groupBy('c_plate')
    			->get();

    	$done1 = DB::table('d_resultfu')
                ->leftJoin('d_customer','c_order' , 'rf_cid')
                ->where('rf_cstaff',Auth::user()->u_code)->count();

        $done2 = DB::table('d_followup')
                ->join('d_customer','c_order' , 'fu_cid')
                ->where('fu_cstaff',Auth::user()->u_code)
                ->Where('d_followup.status_data','re')->count();
                
        $done = $done1 + $done2;

        $booking = DB::table('d_resultfu')
    			->Leftjoin('d_customer','c_order' , 'rf_cid')
    			->where('rf_cstaff',Auth::user()->u_code)
                ->where('rf_csummary','4')
    			->count();

        $notbooking = DB::table('d_resultfu')
                ->Leftjoin('d_customer','c_order' , 'rf_cid')
                ->where('rf_cstaff',Auth::user()->u_code)
                ->where('rf_csummary','5')
                ->count();

        $refu = DB::table('d_followup')
    			->leftJoin('d_customer','c_order' , 'fu_cid')
    			->where('fu_cstaff',Auth::user()->u_code)
                ->where('fu_status','refollowup')
            	->where('d_followup.status_data','re')
    			->count();

        $denied = DB::table('d_resultfu')
                ->Leftjoin('d_customer','c_order' , 'rf_cid')
                ->where('rf_cstaff',Auth::user()->u_code)
                ->where('rf_csummary','3')
                ->count();

    			return response()->json(array(
    				'all' => count($suspect),
    				'done' =>  $done,
    				'booking' => $booking,
    				'notbooking' => $notbooking,
    				'refu' => $refu,
    				'denied' => $denied,
    			));

	}
}
