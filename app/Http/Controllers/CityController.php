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
    //backend methods start

    public function city_upload(){
        return view('city.city_upload');
    }

    public function upload(Request $request){
        $request->validate([
            'dataset' => 'required|file|mimes:xlsx,xls',
        ], [
            'dataset.required' => 'Please upload a file.',
            'dataset.file' => 'The uploaded file is invalid.',
            'dataset.mimes' => 'The file must be a valid Excel file (xlsx, xls).',
        ]);

        try {
            $dataset = Excel::toArray(new CityImport, $request->file('dataset'));
            $count = count($dataset[0]);

            for ($i = 0; $i < $count; $i++) {
                if (!empty($dataset[0][$i]['city'])) {
                    $data = [
                        'city' => $dataset[0][$i]['city'],
                        'city_ascii' => $dataset[0][$i]['city_ascii'],
                        'state_id' => $dataset[0][$i]['state_id'],
                        'state_name' => $dataset[0][$i]['state_name'],
                        'county_fips' => $dataset[0][$i]['county_fips'],
                        'county_name' => $dataset[0][$i]['county_name'],
                        'lat' => $dataset[0][$i]['lat'],
                        'lng' => $dataset[0][$i]['lng'],
                        'population' => $dataset[0][$i]['population'],
                        'density' => $dataset[0][$i]['density'],
                        'source' => $dataset[0][$i]['source'],
                        'military' => $dataset[0][$i]['military'] == true ? 1 : 0,
                        'incorporated' => $dataset[0][$i]['incorporated'] == true ? 1 : 0,
                        'timezone' => $dataset[0][$i]['timezone'],
                        'ranking' => $dataset[0][$i]['ranking'],
                        'zips' => $dataset[0][$i]['zips'] ?? null,
                        'city_id' => $dataset[0][$i]['id']
                    ];
                    ProcessCityData::dispatch($data)->onQueue('default');
                }
            }
            // dd($array);
           

            return back()->with('success', 'Data processing started. Check back later for results.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
        
        
    }

    public function city_list(Request $request){
        $view = $request->ajax() ? 'city._city_list' : 'city.city_list';
        $search = $request->search;
        $dataset = City::where('state_name', 'like', '%' . $search . '%')
        ->orWhere('county_name', 'like', '%' . $search . '%')
        ->paginate(20);
        return view($view, [
            'dataset'  => $dataset,
        ]);
    }

    public function show($id){
        $data = City::find($id);
        return view('city._details',compact('data'));
    }
    //backend methods start
    // api city methods start
    public function get_city_list(Request $request){
        $search = $request->search;
        $dataset = City::where('state_name', 'like', '%' . $search . '%')
        ->orWhere('city', 'like', '%' . $search . '%')
        ->orWhere('county_name', 'like', '%' . $search . '%')
        ->paginate(20); // default pagination no 20 
       return response()->json(['city_list' => $dataset]);
    }

    // api city methods end
    
}
