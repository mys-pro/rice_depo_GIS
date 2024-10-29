<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('export_details', function (Blueprint $table) {
            $table->unsignedInteger('export_id');
            $table->unsignedInteger('rice_id');
            $table->integer('weight');
            $table->integer('price');
            $table->timestamps();

            $table->primary(['export_id', 'rice_id']);
            $table->foreign('export_id')->references('id')->on('exports');
            $table->foreign('rice_id')->references('id')->on('rice');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_details');
    }
};
