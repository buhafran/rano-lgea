<?php

use Illuminate\Support\Facades\Route;
use App\Services\ReportExportService;


use App\Http\Controllers\ResultCheckerController;

Route::get('/result-checker', [ResultCheckerController::class, 'form'])->name('result-checker.form');
Route::post('/result-checker', [ResultCheckerController::class, 'check'])->name('result-checker.check');
Route::get('/exports/inventory', function (ReportExportService $service) {
    return response()->json($service->schoolInventorySummary());
});

Route::get('/exports/indicators', function (ReportExportService $service) {
    return response()->json($service->indicatorSummary());
});

Route::get('/exports/results', function (ReportExportService $service) {
    return response()->json($service->resultSummary());
});


Route::get('/', function () {
    return view('welcome');
});
