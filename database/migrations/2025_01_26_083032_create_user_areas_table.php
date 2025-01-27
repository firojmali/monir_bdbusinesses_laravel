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
        Schema::create('user_areas', function (Blueprint $table) {
            $table->id();
            $table->string('user_uid', 64);
            $table->bigInteger('division_code')->nullable();
            $table->bigInteger('district_code')->nullable();
            $table->bigInteger('upazila_code')->nullable();
            $table->bigInteger('union_code')->nullable();
            $table->string('area_name')->nullable();
            $table->integer('region_type')->comment('1: division, 2: district, 3: upazila, 4: union, 5: ward, 6:village, 7:citycorporation, 8: city, 9: area');
            $table->string('created_by_user_uid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_areas');
    }
};
