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
        Schema::create('create_explorers_tables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('idade');
            $table->float('longitude');
            $table->float('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_explorers_tables');
    }
};
