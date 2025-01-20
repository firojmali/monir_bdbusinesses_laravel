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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('division_id');
            $table->bigInteger('division_code');
            $table->bigInteger('code')->comments('www.bangladesh.gov.bd->id');
            $table->string('bn_name',30);
            $table->string('en_name',30);
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('division_code')->references('code')->on('divisions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
