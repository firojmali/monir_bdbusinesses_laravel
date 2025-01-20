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
        Schema::create('unions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('upazila_id');
            $table->bigInteger('upazila_code');
            $table->bigInteger('code')->comments('www.bangladesh.gov.bd->id');
            $table->string('bn_name',30);
            $table->string('en_name',30);
            $table->foreign('upazila_id')->references('id')->on('upazilas');
            $table->foreign('upazila_code')->references('code')->on('upazilas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unions');
    }
};
