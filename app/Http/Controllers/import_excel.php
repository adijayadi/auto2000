<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\importer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class import_excel extends Controller
{

    public function storedata(Request $request) 
    {
    	// $nama = $request->file('excel')->getClientOriginalName();

        dd(Excel::import(new importer, request()->file('excel')));
        
        return redirect('/')->with('success', 'All good!');
    }
}
