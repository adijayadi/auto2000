<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaPenugasanController extends Controller
{
    public function kelola_penugasan()
    {
    	return view('monitoring_kinerja.kelola_penugasan.kelola_penugasan');
    }
}
