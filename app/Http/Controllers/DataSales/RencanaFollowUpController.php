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
            ->join('d_customer','c_id','fu_cid')
            ->Join('m_vehicle','v_code','c_plate')
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
            return '<button type="button" class="btn btn-info ubah" data-id="'.$data->c_id.'" data-plate="'.$data->c_plate.'" data-toggle="modal" data-target="#detail_tindakan" title="Tindakan"><i class="fa fa-cog"></i></button>';
        })
        ->rawColumns(['tanggal_rencana','status_service','status','action'])
        ->make(true);

    }

    public function tablere()
    {
        $data = DB::table('d_followup')
            ->join('d_customer','c_id','fu_cid')
            ->Join('m_vehicle','v_code','c_plate')
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
            return '<button type="button" class="btn btn-info ubah" data-id="'.$data->c_id.'" data-plate="'.$data->c_plate.'" data-toggle="modal" data-target="#detail_tindakan" title="Tindakan"><i class="fa fa-cog"></i></button>';
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

                DB::table('d_followup')->where('fu_cid',$id)->update([
                    'fu_updatedate' => Carbon::now(),
                    'fu_updatetime' => Carbon::now(),
                    'fu_bookingdate' => Carbon::parse($request->tanggalbooking)->format('Y m h'),
                    'fu_status' => 'success',
                    'status_data' => 'false',
                ]);

                DB::table('d_resultfu')->insert([
                    'rf_csummary' => '4',
                    'rf_cid' => $id,
                    'rf_reason' => 'Bersedia Melakukan Service',
                    'status_data' => 'true',
                ]);

                DB::table('d_customer')->where('c_id',$id)->update([
                    'status_data' => 'done',
                ]);

            } else if($tindakan === 'ntar'){
                DB::table('d_followup')->where('fu_cid',$id)->update([
                    'fu_plandate' => Carbon::parse($request->tanggalrefollowup)->format('Y m h'),
                    'fu_plantime' => Carbon::parse($request->timerefollowup)->format('Y m h'),
                    'fu_updatedate' => Carbon::now(),
                    'fu_updatetime' => Carbon::now(),
                    'fu_status' => 'refollowup',
                    'status_data' => 're',
                ]);

                DB::table('d_customer')->where('c_id',$id)->update([
                    'status_data' => 'done',
                ]);

            } else if($tindakan === 'tidak'){
                DB::table('d_followup')->where('fu_cid',$id)->update([
                    'fu_updatedate' => Carbon::now(),
                    'fu_updatetime' => Carbon::now(),
                    'fu_status' => 'denied',
                    'status_data' => 'false',
                ]);

                DB::table('d_resultfu')->insert([
                    'rf_csummary' => '3',
                    'rf_cid' => $id,
                    'rf_reason' => $alasan,
                    'status_data' => 'true',
                ]);

                DB::table('d_customer')->where('c_id',$id)->update([
                    'status_data' => 'not',
                ]);
            }
            
            else if($tindakan === 'ya' && $request->tanggalbooking == null){
                DB::table('d_followup')->where('fu_cid',$id)->update([
                    'fu_updatedate' => Carbon::now(),
                    'fu_updatetime' => Carbon::now(),
                    'fu_status' => 'schedule',
                    'status_data' => 'false',
                ]);

                DB::table('d_resultfu')->insert([
                    'rf_csummary' => '4',
                    'rf_cid' => $id,
                    'rf_reason' => 'Bersedia Melakukan Service',
                    'status_data' => 'true',
                ]);

                DB::table('d_customer')->where('c_id',$id)->update([
                    'status_data' => 'done',
                ]);

            }

        }else if($id2 != null){
            if ($request->tanggalbooking != null) {

                DB::table('d_followup')->where('fu_cid',$id)->update([
                    'fu_updatedate' => Carbon::now(),
                    'fu_updatetime' => Carbon::now(),
                    'fu_bookingdate' => Carbon::parse($request->tanggalbooking)->format('Y m h'),
                    'fu_status' => 'success',
                    'status_data' => 'false',
                ]);

                DB::table('d_resultfu')->insert([
                    'rf_csummary' => '4',
                    'rf_cid' => $id,
                    'rf_reason' => 'Bersedia Melakukan Service',
                    'status_data' => 'true',
                ]);

                DB::table('d_customer')->where('c_id',$id)->update([
                    'status_data' => 'done',
                ]);

            }else if($tindakan === 'tidak'){
                DB::table('d_followup')->where('fu_cid',$id)->update([
                    'fu_updatedate' => Carbon::now(),
                    'fu_updatetime' => Carbon::now(),
                    'fu_status' => 'denied',
                    'status_data' => 'false',
                ]);

                DB::table('d_resultfu')->insert([
                    'rf_csummary' => '3',
                    'rf_cid' => $id,
                    'rf_reason' => $alasan,
                    'status_data' => 'true',
                ]);

                DB::table('d_customer')->where('c_id',$id)->update([
                    'status_data' => 'not',
                ]);
            }
        }
    }
}
