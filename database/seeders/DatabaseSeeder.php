<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use App\Models\Hospital;
use App\Models\MedicalPractice;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $countries = Country::all();
        foreach ($countries as $country) {
            Patient::factory()->count(10)
                ->for($country)
                ->has(MedicalPractice::factory()->count(3)->for(Hospital::inRandomOrder()->first()))
                ->create();
        }
    }
}
