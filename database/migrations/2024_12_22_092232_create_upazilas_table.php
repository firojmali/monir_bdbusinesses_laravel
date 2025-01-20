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
        Schema::create('upazilas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('district_id');
            $table->bigInteger('district_code');
            $table->bigInteger('code')->comments('www.bangladesh.gov.bd->id');
            $table->string('bn_name',30);
            $table->string('en_name',30);
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('district_code')->references('code')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upazilas');
    }
};
