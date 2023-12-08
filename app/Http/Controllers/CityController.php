<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Imports\CityImport;
use Illuminate\Http\Request;
use App\Jobs\ProcessCityData;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CityController extends Controller
{
    //

    public function city_upload(){
        return view('city.city_upload');
    }

    public function upload(Request $request){
        $request->validate([
            'dataset' => 'required|file|mimes:xlsx,xls',
        ]);
        
        $dataset = Excel::toArray(new CityImport, $request->file('dataset'));
       
        ProcessCityData::dispatch($dataset[0])->onQueue('default');

        return back()->with('success', 'Data processing started. Check back later for results.');
        
    }
    
}
