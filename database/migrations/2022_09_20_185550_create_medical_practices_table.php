<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_practices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('duration');

            $table->unsignedInteger('hospital_id');
            $table->foreign('hospital_id')->references('id')->on('hospitals');

            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_practices');
    }
};
