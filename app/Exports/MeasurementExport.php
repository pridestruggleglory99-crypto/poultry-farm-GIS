<?php

namespace App\Exports;

use App\Models\Measurement;
use Maatwebsite\Excel\Concerns\FromCollection;

class MeasurementExport implements FromCollection
{
    public function collection()
    {
        return Measurement::with('farm')
            ->get()
            ->map(function ($m) {

                return [

                    'Farm Name' =>
                        $m->farm->name ?? '-',

                    'Object Name' =>
                        $m->object_name,

                    'Length (m)' =>
                        $m->length,

                    'Width (m)' =>
                        $m->width,

                    'Area (m²)' =>
                        $m->area,

                ];
            });
    }
}