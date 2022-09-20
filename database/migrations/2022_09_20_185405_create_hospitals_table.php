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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        \App\Models\Hospital::create(['name' => 'Big hospital']);
        \App\Models\Hospital::create(['name' => 'Theme hospital (From the game)']);
        \App\Models\Hospital::create(['name' => 'The Blue place']);
        \App\Models\Hospital::create(['name' => 'Heal and rest hospital']);
        \App\Models\Hospital::create(['name' => 'Docker hospital']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospitals');
    }
};
