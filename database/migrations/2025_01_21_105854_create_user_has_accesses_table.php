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
        Schema::create('user_has_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('user_uid', 64);
            $table->string('region_uid', 64);
            $table->integer('region_type')->comment('1: division, 2: district, 3: upazila, 4: union, 5: ward, 6:village, 7:citycorporation, 8: city, 9: area');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_has_accesses');
    }
};
