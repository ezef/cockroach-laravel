<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone'];

    public function medicalPractices()
    {
        return $this->HasMany(MedicalPractice::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
