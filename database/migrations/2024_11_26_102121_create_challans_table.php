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
        Schema::create('challans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean("is_in");
            $table->text("party")->nullable();
            $table->string("uid",37);
            $table->string("challan_number",20);
            $table->date('challan_date');
            $table->bigInteger('active_date_time')->comments("yyyymmddhhjjii");
            $table->text("remarks");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challans');
    }
};
