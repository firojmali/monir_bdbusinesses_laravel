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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("product_uid",37);
            $table->integer("quantity_good");
            $table->integer("quantity_damaged");
            $table->integer("opening_quantity_good");
            $table->integer("opening_quantity_damaged");
            $table->text("challan_uids");
            $table->bigInteger('opening_date')->comments("yyyymmdd");
            $table->text("remarks");
            $table->foreign('product_uid')->references('uid')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
