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
        Schema::create('machines', function (Blueprint $table) {
            $table->string('barcode_id')->primary();
            $table->string('name');
            $table->bigInteger('type_id');
            $table->bigInteger('brand_id');
            $table->enum('status', ['mesin_baru', 'mesin_dipakai', 'mesin_rusak', 'mesin_dijual']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
