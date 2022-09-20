<?php

namespace Database\Factories;

use App\Models\MedicalPractice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalPractice>
 */
class MedicalPracticeFactory extends Factory
{

    protected $model = MedicalPractice::class;

    public function definition()
    {
        return [
            'name' => fake()->randomElement([
                'Appendectomy',
                'Cataract Surgery / Refractive Lens Exchange',
                'C-Section',
                'CT Scan',
                'Echocardiogram',
                'Heart Bypass Surgery',
                'Hip Replacement Surgery',
                'MRI',
                'Upper Endoscopy',
                'X-Ray',
            ]),
            'duration' => fake()->randomNumber(2, true) . ' mins',
        ];
    }
}
