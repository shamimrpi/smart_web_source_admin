<?php

namespace App\Jobs;

use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessCityData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dataset;

    public function __construct($dataset)
    {
        $this->dataset = $dataset;
    }

    public function handle(): void
    {
        try {
            DB::beginTransaction();

            $array = [];
            $count = count($this->dataset[0]);

            for ($i = 0; $i < $count; $i++) {
                if (!empty($this->dataset[0][$i]['city'])) {
                    $array[] = [
                        'city' => $this->dataset[0][$i]['city'],
                        'city_ascii' => $this->dataset[0][$i]['city_ascii'],
                        'state_id' => $this->dataset[0][$i]['state_id'],
                        'state_name' => $this->dataset[0][$i]['state_name'],
                        'county_fips' => $this->dataset[0][$i]['county_fips'],
                        'county_name' => $this->dataset[0][$i]['county_name'],
                        'lat' => $this->dataset[0][$i]['lat'],
                        'lng' => $this->dataset[0][$i]['lng'],
                        'population' => $this->dataset[0][$i]['population'],
                        'density' => $this->dataset[0][$i]['density'],
                        'source' => $this->dataset[0][$i]['source'],
                        'military' => $this->dataset[0][$i]['military'] == true ? 1 : 0,
                        'incorporated' => $this->dataset[0][$i]['incorporated'] == true ? 1 : 0,
                        'timezone' => $this->dataset[0][$i]['timezone'],
                        'ranking' => $this->dataset[0][$i]['ranking'],
                        'zips' => $this->dataset[0][$i]['zips'] ?? null,
                    ];
                }
            }

            if (!empty($array)) {
                City::insert($array); // Insert all data into the City model
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
