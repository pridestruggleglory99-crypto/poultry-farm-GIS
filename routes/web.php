<?php

use Illuminate\Support\Facades\Route;
use App\Imports\FarmsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\FarmController;
use App\Imports\MeasurementImport;
use App\Http\Controllers\DatabankController;

Route::get('/import', function () {

    Excel::import(
        new FarmsImport,
        public_path('peternakan_ayam_bandung.xlsx')
    );

    return 'Import berhasil';
});


Route::get('/', [FarmController::class, 'index']);

Route::get(
    '/farm/{id}/analyze',
    [FarmController::class, 'analyze']
);

Route::get('/import-measurement', function () {

    Excel::import(
        new MeasurementImport,
        storage_path('app/hasil_ai.xlsx')
    );

    return 'Import selesai';
});

Route::get(
    '/farm/{id}/measurement',
    [FarmController::class, 'measurement']
);

Route::get('/databank', [DatabankController::class, 'index'])->name('databank.index');

Route::get('/databank/farms', [DatabankController::class, 'farms'])->name('databank.farms');

Route::get('/databank/original-images', [DatabankController::class, 'originalImages'])->name('databank.original');

Route::get('/databank/measurement-images', [DatabankController::class, 'measurementImages'])->name('databank.measurement');

Route::get(
    '/databank/farms/download',
    [DatabankController::class, 'downloadFarms']
)->name('databank.farms.download');

Route::get(
    '/databank/original/download-all',
    [DatabankController::class, 'downloadAllOriginal']
)->name('databank.original.downloadAll');

Route::get(
    '/databank/measurement/download-images',
    [DatabankController::class, 'downloadMeasurementImages']
)->name('databank.measurement.downloadImages');

Route::get(
    '/databank/measurement/download-data',
    [DatabankController::class, 'downloadMeasurementData']
)->name('databank.measurement.downloadData');