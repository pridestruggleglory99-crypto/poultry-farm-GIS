<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('measurements', function (Blueprint $table) {

            $table->id();

            $table->foreignId('farm_id')
                ->constrained('farms')
                ->cascadeOnDelete();

            $table->string('object_name');

            $table->double('length')->nullable();

            $table->double('width')->nullable();

            $table->double('area')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};