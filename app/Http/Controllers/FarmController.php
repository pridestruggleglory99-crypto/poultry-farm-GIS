<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Support\Facades\Http;

class FarmController extends Controller
{
    public function index()
    {
        $farms = Farm::all();

        return view(
            'farms.index',
            compact('farms')
        );
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