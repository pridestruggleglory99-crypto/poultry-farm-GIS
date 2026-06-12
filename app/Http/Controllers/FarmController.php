<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    public function index(Request $request)
{
    $query = Farm::query();

    // SEARCH
    if ($request->search) {

        $query->where(function ($q) use ($request) {

            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('address', 'like', '%' . $request->search . '%');

        });

    }

    // FILTER DISTRICT
    if ($request->district) {

        $query->where('district', $request->district);

    }

    $farms = $query->get();

    // AMBIL SEMUA DISTRICT UNIK
    $districts = Farm::select('district')
        ->distinct()
        ->orderBy('district')
        ->pluck('district');

    return view('farms.index', compact(
        'farms',
        'districts'
    ));
}
    public function analyze($id)
    {
        $farm = Farm::findOrFail($id);

        $response = Http::timeout(300)
            ->post(
                'http://127.0.0.1:5000/analyze',
                [

                    'image' => public_path(
                        $farm->screenshot
                    )
                ]
            );

        return response()->json(
            $response->json()
        );
    }

    public function measurement($id)
{
    $farm = Farm::with('measurements')
        ->findOrFail($id);

    return response()->json([

        'image' => asset(
            'measurement/' .
            basename($farm->screenshot)
        ),

        'measurements' =>
            $farm->measurements
    ]);
}
}