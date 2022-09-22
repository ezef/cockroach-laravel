<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/patients', [\App\Http\Controllers\ProofOfConceptController::class, 'getAllPatients']);
Route::get('/patients/with-practices', [\App\Http\Controllers\ProofOfConceptController::class, 'getAllPatientsWithMedicalPractices']);

Route::get('/eu/patients', [\App\Http\Controllers\ProofOfConceptController::class, 'getEUPatients']);
Route::get('/eu/patients/with-practices', [\App\Http\Controllers\ProofOfConceptController::class, 'getEUPatientsWithMedicalPractices']);

Route::get('/non-eu/patients', [\App\Http\Controllers\ProofOfConceptController::class, 'getNonEUPatients']);
Route::get('/non-eu/patients/with-practices', [\App\Http\Controllers\ProofOfConceptController::class, 'getNonEUPatientsWithMedicalPractices']);

Route::get('/medical-practices', [\App\Http\Controllers\ProofOfConceptController::class, 'getMedicalPractices']);

Route::get('/countries', [\App\Http\Controllers\ProofOfConceptController::class, 'getCountries']);
