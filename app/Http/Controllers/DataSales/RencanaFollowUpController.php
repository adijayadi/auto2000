<?php

namespace App\Http\Controllers\DataSales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Auth;
use DataTables;

class RencanaFollowUpController extends Controller
{
    public function rencana_followup()
    {
        $alasan = DB::table('m_reason')->where('status_data','true')->get();
    	return view('data_sales.rencana_followup.rencana_followup',array(
            'alasan' => $alasan,
        ));
    }

    public function table()
    {
        $data = DB::table('d_followup')
            ->join('d_customer','c_order','fu_cid')
            ->leftJoin('m_vehicle','v_code','c_plate')
            ->where('fu_status','planned')
            ->where('fu_cstaff',Auth::user()->u_code)
            ->groupBy('fu_cid')
            ->get();
        setlocale(LC_TIME, 'IND');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('tanggal_rencana',function($data){
            return Carbon::parse($data->fu_plandate)->formatLocalized('%d %B %Y');
        })
        ->addColumn('status_service',function($data){
            if ($data->c_jobdesc != '') {
                return 'Sudah Pernah Service';
            }else{
                return 'Belum Pernah Service';
            }
        })
        ->addColumn('status',function($data){

            return 'Belum Di Follow up';
        })
        ->addColumn('action',function($data){
            return '<button type="button" class="btn btn-info ubah" data-id="'.$data->c_order.'" data-plate="'.$data->c_plate.'" data-toggle="modal" data-target="#detail_tindakan" title="Tindakan"><i class="fa fa-cog"></i></button>';
        })
        ->rawColumns(['tanggal_rencana','status_service','status','action'])
        ->make(true);

    }

    public function tablere()
    {
        $data = DB::table('d_followup')
            ->leftJoin('d_customer','c_order','fu_cid')
            ->LeftJoin('m_vehicle','v_code','c_plate')
            ->where('fu_status','refollowup')
            ->where('d_followup.status_data','re')
            ->where('fu_cstaff',Auth::user()->u_code)
            ->groupBy('fu_id')
            ->get();

        setlocale(LC_TIME, 'IND');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('tanggal_rencana',function($data){
            return Carbon::parse($data->fu_plandate)->formatLocalized('%d %B %Y') .' '. $data->fu_plantime;
        })
        ->addColumn('status_service',function($data){
            if ($data->c_jobdesc != '') {
                return 'Sudah Pernah Service';
            }else{
                return 'Belum Pernah Service';
            }
        })
        ->addColumn('status',function($data){

            return 'Mengulang Follow up';
        })
        ->addColumn('action',function($data){
            return '<button type="button" class="btn btn-info ubah2" data-id="'.$data->c_order.'" data-plate="'.$data->c_plate.'" data-toggle="modal" data-target="#detail_tindakan_2" title="Tindakan"><i class="fa fa-cog"></i></button>';
        })
        ->rawColumns(['tanggal_rencana','status_service','status','action'])
        ->make(true);

    }

    public function update(Request $request)
    {
        $id = $request->id;
        $id2 = $request->id2;
        $alasan = $request->alasan;
        $tindakan = $request->tindakan;
        if ($id != null) {
            if ($tindakan === 'ya' && $request->tanggalbooking != null) {

                DB::table('d_customer')
                ->where('c_order',$id)->update([
                    'status_data' => 'true',
                    'c_dateservice' => Carbon::parse($request->tanggalbooking)->format('Y,m,d'),
                    'c_dateplan' => Carbon::parse($request->tanggalbooking)->addMonths(3)->format('Y,m,d'),
                ]);

                DB::table('d_followup')
                ->where('fu_cid',$id)->update([
                    'fu_updatedate' => Carbon::now('Asia/Jakarta'),
                    'fu_updatetime' => Carbon::now('Asia/Jakarta'),
                    'fu_bookingdate' => Carbon::parse($request->tanggalbooking)->format('Y,m,d'),
                    'fu_status' => 'success',
                    'status_data' => 'false',
                ]);

                DB::table('d_resultfu')->insert([
                    'rf_csummary' => '4',
                    'rf_cid' => $id,
                    'rf_cstaff' => Auth::user()->u_code,
                    'rf_reason' => 'Bersedia Melakukan Service',
                    'rf_date' => Carbon::now('Asia/Jakarta'),
                    'status_data' => 'true',
                ]);

                return response()->json(['success' => 'berhasil Melakukan Booking']);

            } else if($tindakan === 'ntar'){
                DB::table('d_followup')
                ->where('fu_cid',$id)->update([
                    'fu_plandate' => Carbon::parse($request->tanggalrefollowup)->format('Y,m,d'),
                    'fu_plantime' =>    $request->timerefollowup,
                    'fu_updatedate' => Carbon::now(),
                    'fu_updatetime' => Carbon::now(),
                    'fu_status' => 'refollowup',
                    'status_data' => 're',
                ]);

                DB::table('d_customer')->where('c_order',$id)->update([
                    'status_data' => 're',
                ]);

                return response()->json(['success' => 'Memasukkan Data Refollowup']);

            } else if($tindakan === 'tidak'){
                DB::table('d_followup')
                ->where('fu_cid',$id)->update([
                    'fu_updatedate' => Carbon::now('Asia/Jakarta'),
                    'fu_updatetime' => Carbon::now('Asia/Jakarta'),
                    'fu_date' => Carbon::now('Asia/Jakarta')->addMonth(),
                    'fu_time' => Carbon::now('Asia/Jakarta'),
                    'fu_status' => 'planning',
                    'status_data' => 'true',
                ]);

                DB::table('d_resultfu')->insert([
                    'rf_csummary' => '3',
                    'rf_cid' => $id,
                    'rf_cstaff' => Auth::user()->u_code,
                    'rf_date' => Carbon::now('Asia/Jakarta'),
                    'rf_reason' => $alasan,
                    'status_data' => 'true',
                ]);

                return response()->json(['success' => 'berhasil Mengubah Status']);
            }
            
            else if($tindakan === 'ya' && $request->tanggalbooking == null){
                return response()->json(['error' => 'tanggal booking masih kosong']);
            }

        }else if($id2 != null){

            if ($request->tanggalbooking2 != null) {

                DB::table('d_followup')
                ->where('fu_cid',$id2)->update([
                    'fu_updatedate' => Carbon::now(),
                    'fu_updatetime' => Carbon::now(),
                    'fu_bookingdate' => Carbon::parse($request->tanggalbooking2)->format('Y,m,d'),
                    'fu_status' => 'success',
                    'status_data' => 'false',
                ]);

                DB::table('d_resultfu')->insert([
                    'rf_csummary' => '4',
                    'rf_cid' => $id2,
                    'rf_cstaff' => Auth::user()->u_code,
                    'rf_reason' => 'Bersedia Melakukan Service',
                    'rf_date' => Carbon::now('Asia/Jakarta'),
                    'status_data' => 'true',
                ]);

                return response()->json(['success' => 'berhasil Melakukan Booking']);

            }else if($request->alasan2 != ''){
                DB::table('d_followup')
                ->where('fu_cid',$id2)->update([
                    'fu_updatedate' => Carbon::now(),
                    'fu_updatetime' => Carbon::now(),
                    'fu_date' => Carbon::now('Asia/Jakarta')->addMonth(),
                    'fu_time' => Carbon::now('Asia/Jakarta'),
                    'fu_status' => 'planning',
                    'status_data' => 'true',
                ]);

                DB::table('d_customer')
                ->where('c_order',$id2)->update([
                    'status_data' => 'true',
                    'c_dateplan' => Carbon::parse($request->tanggalbooking2)->addMonth()->format('Y,m,d'),
                ]);

                DB::table('d_resultfu')->insert([
                    'rf_csummary' => '3',
                    'rf_cid' => $id2,
                    'rf_cstaff' => Auth::user()->u_code,
                    'rf_date' => Carbon::now('Asia/Jakarta'),
                    'rf_reason' => $request->alasan2,
                    'status_data' => 'true',
                ]);

                return response()->json(['success' => 'berhasil Mengubah Status']);

            }else{
                return response()->json(['error' => 'tanggal booking masih kosong']);
            }
        }
    }
}
