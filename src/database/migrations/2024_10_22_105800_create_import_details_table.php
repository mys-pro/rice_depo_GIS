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
        Schema::create('import_details', function (Blueprint $table) {
            $table->unsignedInteger('import_id');
            $table->unsignedInteger('rice_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();
            
            $table->primary(['import_id', 'rice_id']);
            $table->foreign('import_id')->references('id')->on('imports');
            $table->foreign('rice_id')->references('id')->on('rice');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_details');
    }
};
