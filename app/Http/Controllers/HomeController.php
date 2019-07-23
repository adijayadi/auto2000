<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\d_user;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = d_user::where('u_user', 'S')->get();

        $adv;

        foreach ($data as $key) {
            # code...
           $adv[] = $key->u_name;

            $service[] = DB::table('d_followup')
            ->join('d_resultfu','rf_cid','fu_cid')
            ->where('fu_cstaff',$key->u_code)
            ->where('d_resultfu.status_data','true')
            ->where('rf_csummary','1')->count();
            $followup[] = DB::table('d_followup')
            ->where('fu_cstaff',$key->u_code)
            ->where('status_data','true')
            ->where('fu_status','Planning')->count();
            $tidakbersedia[] = DB::table('d_followup')
            ->join('d_resultfu','rf_cid','fu_cid')
            ->where('fu_cstaff',$key->u_code)
            ->where('d_resultfu.status_data','true')
            ->where('rf_csummary','3')->count();
            $booking[] = DB::table('d_followup')
            ->join('d_resultfu','rf_cid','fu_cid')
            ->where('fu_cstaff',$key->u_code)
            ->where('d_resultfu.status_data','true')
            ->where('rf_csummary','4')->count();
            $tidakbooking[] = DB::table('d_followup')
            ->join('d_resultfu','rf_cid','fu_cid')
            ->where('fu_cstaff',$key->u_code)
            ->where('d_resultfu.status_data','true')
            ->where('rf_csummary','5')->count();
        }
        // return $adv;
       
        // return dd($adv, $satu, $dua, $tiga, $empat, $lima);

        return view('home', ['adv' => $adv, 'service' => $service, 'followup' => $followup, 'tidakbersedia' => $tidakbersedia, 'booking' => $booking, 'tidakbooking' => $tidakbooking]);
    }

    public function getDataTable()
    {
        $data = d_user::whereNotIn('u_id', [1])->get();

        return DataTables::of($data)
        ->addColumn('summary', function($data){
            $adv = $data->u_code;
            $satu = DB::table('d_followup')
            ->join('d_resultfu','rf_cid','fu_cid')
            ->where('fu_cstaff',$adv)
            ->where('d_resultfu.status_data','true')
            ->where('rf_csummary','1')->count();
            $dua = DB::table('d_followup')
            ->where('fu_cstaff',$adv)
            ->where('status_data','true')
            ->where('fu_status','Planning')->count();
            $tiga = DB::table('d_followup')
            ->join('d_resultfu','rf_cid','fu_cid')
            ->where('fu_cstaff',$adv)
            ->where('d_resultfu.status_data','true')
            ->where('rf_csummary','3')->count();
            $empat = DB::table('d_followup')
            ->join('d_resultfu','rf_cid','fu_cid')
            ->where('fu_cstaff',$adv)
            ->where('d_resultfu.status_data','true')
            ->where('rf_csummary','4')->count();
            $lima = DB::table('d_followup')
            ->join('d_resultfu','rf_cid','fu_cid')
            ->where('fu_cstaff',$adv)
            ->where('d_resultfu.status_data','true')
            ->where('rf_csummary','5')->count();

            return '<table class="table table-striped m-0 transparent" width="100%">
                        <tbody>
                            <tr>
                                <td>Kendaraan Telah Melakukan Service</td>
                                <td width="1%">'.$satu.'</td>
                            </tr>
                            <tr>
                                <td>Kendaraan Yang Harus Di Follow Up</td>
                                <td>'.$dua.'</td>
                            </tr>
                            <tr>
                                <td>Kendaraan Yang Telah Di Follow Up Dan Tidak Bersedia</td>
                                <td>'.$tiga.'</td>
                            </tr>
                            <tr>
                                <td>Kendaraan Yang Telah Di Follow Up Dan Bersedia Service dan Telah Melakukan Booking</td>
                                <td>'.$empat.'</td>
                            </tr>
                            <tr>
                                <td>Kendaraan Yang Telah Di Follow Up Dan Bersedia Service dan Belum Melakukan Booking</td>
                                <td>'.$lima.'</td>
                            </tr>
                        </tbody>
                    </table>';

        })
        ->rawColumns(['summary'])
        ->make(true);
    }
}
