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

            // dd($array);
            if (!empty($this->dataset)) {
                City::insert($this->dataset); // Insert all data into the City model
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
