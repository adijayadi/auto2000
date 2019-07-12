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

    public function table()
    {

    	$data = DB::table('d_followup')
    			->leftJoin('d_customer','c_id' , 'fu_cid')
    			->where('fu_cstaff',Auth::user()->u_code)
                ->where('fu_status','planning')
    			->get();

    	return DataTables::of($data)
    	->addColumn('check',function($data){
    		return '
                        <input class="count" type="checkbox" name="id[]" value="'.$data->fu_cid.'">
                    ';
    	})
    	->rawColumns(['check'])
    	->make(true);
    }

    public function simpan(Request $request)
    {
    	$id = $request->id;
        $count = $request->cout;
        
        for ($i=0; $i < $count ; $i++) {
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
    }
}
