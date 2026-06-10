<?php

namespace App\Imports;

use App\Models\Farm;
use Maatwebsite\Excel\Concerns\ToModel;

class FarmsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Farm([

            'name' => $row[0],

            'address' => $row[1],

            'phone' => $row[2],

            'category' => $row[3],

            'latitude' => $row[4],

            'longitude' => $row[5],

            'google_maps' => $row[6],

            'screenshot' => $row[7],
        ]);
    }
}