<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('districts');
    }

    public function down(): void
    {
        Schema::create('districts', function ($table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
};