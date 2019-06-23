<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Validator;
use Carbon\Carbon;

class loginController extends Controller
{
 	public function view(){
 		return view('auth.login');
 	}   

 	public function login(Request $request){

 		$this->validate($request,[
    		'username' => 'required',
    		'password' => 'required',
    	]);
       
    	$data = ([
    		'u_username' => $request->get('username'),
    		'password' => $request->get('password') 
    	]);

    	if (Auth::attempt($data)) {
            DB::table('d_user')
                ->where('u_username', '=', $request->username)
                ->update([
                    'u_lastlogin' => Carbon::now('Asia/Jakarta')
                ]);
            return redirect()->route('home')->with(['berhasil' => 'berhasil']);
        } else {
            return redirect()->route('login')->with(['gagal' => 'gagal']);
        }
 	}

 	public function logout(){
 		DB::table('d_user')
            ->where('u_username', '=', Auth::user()->u_username)
            ->update([
                'u_lastlogout' => Carbon::now('Asia/Jakarta')
            ]);
        Auth::logout();
        return redirect()->route('login');
 	}
}
