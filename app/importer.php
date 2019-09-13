<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use App\d_hcustommer;
use Carbon\Carbon;
use DB;

class importer implements ToModel 
{
	
    public function model(array $row)
    {
    	// if (!$row[4]) {
    		

  //   	$UNIX_DATE = ($row[4] - 25569) * 86400;
		// $result =  gmdate("d-m-Y H:i:s", $UNIX_DATE);

    	// if(empty($row[6])){
     //      $direct = 'R';
     //      }else{
     //      $direct = $row[6];
     //    }

    	// $urutan = d_hcustommer::all()->groupBy('cr_code')->count();
    	// $code = 'S'.$urutan.Carbon::now('Asia/Jakarta')->format('ds');
        return new d_hcustommer([
           'c_serial' => $row[0],
            'c_plate' => $row[1],
            'c_typecar' => $row[2],
            'c_jobdesc' => $row[3],
            'c_dateservice' => Carbon::now()->format('Y-m-d'),
            'c_dateplan' => Carbon::now('Asia/Jakarta')->format('y-m-d'),
            'c_serviceadvisor' => $row[5],
            'cr_direct' => '',
            'cr_code' => '',
            'status_data' => 'true',
        ]);
    	// }else{
    	// }
    }


    
}
