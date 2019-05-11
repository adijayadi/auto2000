<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlasanController extends Controller
{
    public function alasan(){
    	return view('master.alasan.alasan');
    }
    public function tambah_alasan(){
    	return view('master.alasan.tambah_alasan');
    }
}
