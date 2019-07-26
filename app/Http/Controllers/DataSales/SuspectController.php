<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use DataTables;
use Carbon\Carbon;

class SuspectController extends Controller
{
    public function data_suspect()
    {
    	return view('data_sales.data_suspect.data_suspect');
    }

    public function table(Request $request )
    {
        if ($request->break != null) {
            $data = DB::table('d_followup')
                ->leftJoin('d_customer','c_order' , 'fu_cid')
                ->leftJoin('m_vehicle','v_code','c_plate')
                ->whereBetween('fu_date',[Carbon::now('Asia/Jakarta')->addMonth(),Carbon::now('Asia/Jakarta')->addMonths(7)])
                ->where('fu_cstaff',Auth::user()->u_code)
                ->where('fu_status','planning')
                ->get();
        }else{
    	$data = DB::table('d_followup')
    			->leftJoin('d_customer','c_order' , 'fu_cid')
                ->leftJoin('m_vehicle','v_code','c_plate')
                ->whereYear('fu_date',Carbon::now('Asia/Jakarta')->format('Y'))
                ->whereMonth('fu_date',Carbon::now('Asia/Jakarta')->format('m'))
    			->where('fu_cstaff',Auth::user()->u_code)
                ->where('fu_status','planning')
    			->get();
        }

    	return DataTables::of($data)
        ->addIndexColumn()
    	->addColumn('check',function($data){
    		return '<input class="count" type="checkbox" name="id[]" value="'.$data->fu_cid.'">';
    	})
        ->addColumn('nama',function($data){
            if ($data->v_owner != null) {
                return $data->v_owner;
            }else{
                return '';
            }
        })
    	->rawColumns(['check','nama'])
    	->make(true);
    }

    public function simpan(Request $request)
    {
        try { 
    	$id = $request->id;
        $count = $request->cout;
        
        for ($i=0; $i < count($id) ; $i++) {
    	   DB::table('d_followup')
                ->where('fu_cid',$request->id[$i])
                ->update([
                    'fu_status' => 'planned',
                    'fu_plandate' => Carbon::parse($request->rencanadate)->format('Y-m-d'),
                    'fu_plantime' => $request->rencanatime,
                ]);

            DB::table('d_customer')
            ->where('c_id',$id[$i])
            ->update([
                'status_data' => 'wait',
            ]);
        }
        } catch(\Illuminate\Database\QueryException $ex){
            return response()->json('error','Terjadi Error 400');
        }
    }

    public function sudahservice(Request $request){
        try { 
        $id = $request->id;
        $count = $request->cout;
        
        for ($i=0; $i < count($id) ; $i++) {
           
           DB::table('d_customer')
                ->where('c_order',$id[$i])->update([
                    'c_jobdesc' => $request->typejob,
                    'status_data' => 'true',
                    'c_dateservice' => Carbon::now('Asia/Jakarta')->format('Y,m,d'),
                    'c_dateplan' => Carbon::now('Asia/Jakarta')->addMonths(3)->format('Y,m,d'),
                ]);

                DB::table('d_followup')
                ->where('fu_cid',$id[$i])->update([
                    'fu_updatedate' => Carbon::now('Asia/Jakarta'),
                    'fu_updatetime' => Carbon::now('Asia/Jakarta'),
                    'fu_bookingdate' => Carbon::now('Asia/Jakarta')->format('Y,m,d'),
                    'fu_status' => 'success',
                    'status_data' => 'false',
                ]);

                DB::table('d_resultfu')->insert([
                    'rf_csummary' => '4',
                    'rf_cid' => $id[$i],
                    'rf_cstaff' => Auth::user()->u_code,
                    'rf_reason' => 'Bersedia Melakukan Service',
                    'rf_date' => Carbon::now('Asia/Jakarta'),
                    'status_data' => 'true',
                ]);

                DB::table('d_followup')->insert([
                    'fu_cid' => $id[$i],
                    'fu_cstaff' => Auth::user()->u_code,
                    'fu_date' => Carbon::now('Asia/Jakarta')->addMonths(3)->format('Y,m,d'),
                    'fu_time' =>  Carbon::now('Asia/Jakarta'),
                    'fu_status' => 'Planning',
                ]);
        }

        return response()->json(['success' => 'Berhasil Mengubah Status Service']);
        } catch(\Illuminate\Database\QueryException $ex){
            return response()->json('error','Terjadi Error 400');
        }
    }
}
