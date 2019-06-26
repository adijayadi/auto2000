<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\d_user;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function index(){
    	return view('auth.register', array(
    	));
    }

    public function register(Request $request){
    	$urutan = DB::table('d_user')->count();
    	$code = 'SA'.$urutan.Carbon::now()->format('yhs');
    	d_user::create([
    		'u_name' => $request->name,
    		'u_username' => $request->username,
    		'u_email' => $request->email,
    		'password' => bcrypt($request->password),
    		'u_user' => $request->user,
    		'u_code' => $code,
            'status_data' =>'true',
    	]);    
        
       // $menu = user_menu::all()->count();
       //  $data= [];
       //  dd($menu);
       //  for($run=0;$run<$menu;$run++ ) {
       //      $arr= array(
       //          'ua_caccess' => $request->code_access[$run],
       //          'ua_cmaccess' => $request->menu[$run],
       //          'ua_cuser' => $request->code_pengguna[$run],
       //          'ua_read' => $request->view[$run],
       //          'ua_create' => $request->create[$run],
       //          'ua_delete' => $request->delete[$run],
       //          'ua_edit' => $request->update[$run],
       //          'ua_print' => $request->print[$run],
       //          'status_data' => 'true',
       //      );

       //  array_push($data,$arr);
       //  };
        // user_action::insert($data);
           
    }

    public function updateAccess(Request $request){
        $arr = array(
                'ua_create' => $request->create,
                'ua_delete' => $request->delete,
                'ua_edit' => $request->update,
                'ua_print' => $request->print,
            );

        
        $data= [];
        for($run=0;$run<$menu;$run++ ) {
            $arr= array(
                'ua_create' => $request->create[$run],
                'ua_delete' => $request->delete[$run],
                'ua_edit' => $request->update[$run],
                'ua_print' => $request->print[$run],
            );

        array_push($data,$arr);
        };
        $user = $request->code_user;
        user_action::where('ua_cuser',$user)
            ->update($data);


    }
}
