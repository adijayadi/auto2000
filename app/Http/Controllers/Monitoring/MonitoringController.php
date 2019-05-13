<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonitoringController extends Controller
{
    public function monitoring(){
    	return view('monitoring_kinerja.monitoring_kinerja.monitoring_kinerja');
    }
}
