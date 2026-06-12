<?php

namespace App\Exports;

use App\Models\Measurement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MeasurementExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Measurement::with('farm')
            ->get()
            ->map(function ($m) {

                return [

                    $m->farm->name ?? '-',

                    $m->object_name,

                    $m->length . ' m',

                    $m->width . ' m',

                    $m->area . ' m²',

                ];

            });
    }

    public function headings(): array
    {
        return [

            'Farm Name',

            'Object Name',

            'Length',

            'Width',

            'Area',

        ];
    }
}