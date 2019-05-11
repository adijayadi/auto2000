<?php

namespace App\Http\Controllers\Pengguna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenggunaController extends Controller
{
    public function pengguna(){
    	return view('pengguna.pengguna');
    }
    public function tambah_pengguna(){
    	return view('pengguna.tambah_pengguna');
    }
}
