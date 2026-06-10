<?php

namespace App\Imports;

use App\Models\Farm;
use App\Models\Measurement;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MeasurementImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $farm = Farm::where('name', trim($row['farm_name']))->first();

        if (!$farm) {
            return null;
        }

        return new Measurement([
            'farm_id'     => $farm->id,
            'object_name' => $row['object'],
            'length'      => (float) $row['length'],
            'width'       => (float) $row['width'],
            'area'        => (float) $row['area'],
        ]);
    }
}