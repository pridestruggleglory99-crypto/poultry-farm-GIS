<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FarmExport;
use App\Models\Measurement;
use illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\File;
use App\Exports\MeasurementExport;

class DatabankController extends Controller
{
    // ==========================================
    // MAIN PAGE
    // ==========================================

    public function index() { $farmsCount = Farm::count(); $originalCount = Farm::whereNotNull( 'screenshot' )->count(); $measurementCount = Measurement::count(); return view( 'databank.index', compact( 'farmsCount', 'originalCount', 'measurementCount' ) ); }

    // ==========================================
    // FARM TABLE
    // ==========================================

public function farms(Request $request)
{
    $search = $request->search;

    $farms = Farm::query()

        ->when($search, function ($query) use ($search) {

            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%');

        })

        ->latest()

        ->get();

    return view('databank.farms', compact(
        'farms',
        'search'
    ));
}

    // ==========================================
    // ORIGINAL IMAGES
    // ==========================================

    public function originalImages()
    {
        $farms = Farm::all();

        return view(
            'databank.original-images',
            compact('farms')
        );
    }

    // ==========================================
    // MEASUREMENT IMAGES
    // ==========================================

    public function measurementImages()
    {
        $farms = Farm::with('measurements')->get();

        return view(
            'databank.measurement-images',
            compact('farms')
        );
    }
    public function downloadFarms()
{
    return Excel::download(
        new FarmExport,
        'farm_data.xlsx'
    );
}

public function downloadAllOriginal()
{
    $zipFileName = 'original-images.zip';

    $zip = new ZipArchive;

    $zipPath = public_path($zipFileName);

    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {

        $files = File::files(
            public_path('screenshots')
        );

        foreach ($files as $file) {

            $zip->addFile(
                $file->getRealPath(),
                $file->getFilename()
            );
        }

        $zip->close();
    }

    return response()->download($zipPath)->deleteFileAfterSend(true);
}

public function downloadMeasurementImages()
{
    $zipFileName = 'measurement-images.zip';

    $zipPath = public_path($zipFileName);

    $zip = new ZipArchive;

    if (
        $zip->open(
            $zipPath,
            ZipArchive::CREATE | ZipArchive::OVERWRITE
        )
    ) {

        $files = File::files(
            public_path('measurement')
        );

        foreach ($files as $file) {

            $zip->addFile(
                $file->getRealPath(),
                $file->getFilename()
            );
        }

        $zip->close();
    }

    return response()
        ->download($zipPath)
        ->deleteFileAfterSend(true);
}

public function downloadMeasurementData()
{
    return Excel::download(
        new MeasurementExport,
        'measurement-data.xlsx'
    );
}
}