<?php

namespace App\Exports;

use App\Models\Farm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FarmExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Farm::select(
            'name',
            'address',
            'phone',
            'district',
            'google_maps'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Address',
            'Phone',
            'Kecamatan',
            'Google Maps',
        ];
    }
}