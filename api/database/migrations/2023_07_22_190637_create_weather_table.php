<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->float('temp_celsius', 5, 1);
            $table->float('temp_fahrenheit', 8, 1);
            $table->string('condition_text')->nullable();
            $table->string('condition_icon')->nullable();
            $table->integer('humidity')->nullable();
            $table->string('location_name')->nullable();

            $table->string('location_region')->nullable();
            $table->string('location_country')->nullable();
            $table->string('location_timezone')->nullable();

            $table->float('wind_mph', 5, 1)->nullable();
            $table->float('wind_kph', 5, 1)->nullable();
            $table->string('wind_dir')->nullable();
            $table->integer('wind_degree')->nullable();
            
            $table->float('pressure_mb', 5, 1)->nullable();
            $table->float('pressure_in', 5, 1)->nullable();
            
            $table->float('precip_mm', 5, 1)->nullable();
            $table->float('precip_in', 5, 1)->nullable();

            $table->integer('cloud_percent')->nullable();
            $table->float('uv', 5, 1)->nullable();
            $table->dateTime('source_last_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
