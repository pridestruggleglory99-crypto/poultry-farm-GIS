<?php

namespace App\Exports;

use App\Models\Farm;
use Maatwebsite\Excel\Concerns\FromCollection;

class FarmExport implements FromCollection
{
    public function collection()
    {
        return Farm::all();
    }
}