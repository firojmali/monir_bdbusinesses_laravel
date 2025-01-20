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
        Schema::create('challan_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean("is_in");
            $table->string("product_uid",37);
            $table->integer("quantity_good");
            $table->integer("quantity_damaged");
            $table->string("challan_uid",37);
            $table->bigInteger('active_date_time')->comments("yyyymmddhhjjii");
            $table->text("remarks");
            $table->foreign('challan_uid')->references('uid')->on('challans');
            $table->foreign('product_uid')->references('uid')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challan_items');
    }
};
