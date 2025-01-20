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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('uid', 37)->unique();
            $table->string('type', 50)->nullable();
            $table->string('name', 100);
            $table->string('description',500);
            $table->string('unit_uid', 13);
            $table->boolean('is_complete')->default(true);
            $table->boolean('is_saleable')->default(true);
            $table->string('entry_by', 13);
            $table->string('changes', 254);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
