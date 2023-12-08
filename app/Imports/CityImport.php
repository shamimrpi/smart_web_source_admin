<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\City;

class CityImport implements ToModel, WithHeadingRow
{
    /**
     * Create a model instance for the import.
     *
     * @param array $row
     * @return City|null
     */
    public function model(array $row)
    {
        // Remove empty values, trim spaces
        $filteredRow = array_filter(array_map('trim', $row));

        // Check if there are non-empty values in the row
        if (!empty($filteredRow)) {
          
            return new City([
                'city' => $filteredRow['city'] ?? null,
                'city_ascii' => $filteredRow['city_ascii'] ?? null,
                'state_id' => $filteredRow['state_id'] ?? null,
                'state_name' => $filteredRow['state_name'] ?? null,
                'county_fips' => $filteredRow['county_fips'] ?? null,
                'county_name' => $filteredRow['county_name'] ?? null,
                'lat' => $filteredRow['lat'] ?? null,
                'lng' => $filteredRow['lng'] ?? null,
                'population' => $filteredRow['population'] ?? null,
                'density' => $filteredRow['density'] ?? null,
                'source' => $filteredRow['source'] ?? null,
                'military' => $filteredRow['military'] == true ? 1 : 0,
                'incorporated' => $filteredRow['incorporated'] == true ? 1 : 0,
                'timezone' => $filteredRow['timezone'] ?? null,
                'ranking' => $filteredRow['ranking'] ?? null,
                'zips' => $filteredRow['zips'] ?? null,
                'city_id' => $filteredRow['id']
            ]);
        }

        // Return null for empty rows
        return null;
    }
}
