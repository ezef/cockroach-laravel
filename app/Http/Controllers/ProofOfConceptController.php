<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\MedicalPractice;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class ProofOfConceptController extends Controller
{
    public function getAllPatients()
    {
        Log::info(__FUNCTION__);
        return Patient::all();
    }

    public function getAllPatientsWithMedicalPractices()
    {
        Log::info(__FUNCTION__);
        return Patient::with('medicalPractices')->get();
    }

    public function getEUPatients()
    {
        Log::info(__FUNCTION__);

        return Patient::whereHas('country', function (Builder $query) {
            $query->whereIn('name', ['France', 'Germany']);
        })->get();
    }

    public function getEUPatientsWithMedicalPractices()
    {
        Log::info(__FUNCTION__);

        return Patient::whereHas('country', function (Builder $query) {
            $query->whereIn('name', ['France', 'Germany']);
        })->with('medicalPractices')->get();
    }

    public function getNonEUPatients()
    {
        return Patient::whereHas('country', function (Builder $query) {
            $query->whereNotIn('name', ['France', 'Germany']);
        })->get();
    }

    public function getNonEUPatientsWithMedicalPractices()
    {
        return Patient::whereHas('country', function (Builder $query) {
            $query->whereNotIn('name', ['France', 'Germany']);
        })->with('medicalPractices')->get();
    }

    public function getMedicalPractices()
    {
        return MedicalPractice::all();
    }

    public function getCountries()
    {
        return Country::all();
    }
}
