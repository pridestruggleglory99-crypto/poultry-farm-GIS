<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farms', function (Blueprint $table) {

            // kalau ada foreign key
            $table->dropForeign(['district_id']);

            // hapus kolom
            $table->dropColumn('district_id');
        });
    }

    public function down(): void
    {
        Schema::table('farms', function (Blueprint $table) {

            $table->unsignedBigInteger('district_id')->nullable();

            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onDelete('cascade');
        });
    }
};