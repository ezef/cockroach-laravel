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
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        \App\Models\Country::create(['name' => 'Argentine']);
        \App\Models\Country::create(['name' => 'Uruguay']);
        \App\Models\Country::create(['name' => 'United States']);
        \App\Models\Country::create(['name' => 'France']);
        \App\Models\Country::create(['name' => 'Germany']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
};
