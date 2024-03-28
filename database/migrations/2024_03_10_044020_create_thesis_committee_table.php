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
        Schema::create('thesis_committee', function (Blueprint $table) {
            $table->id();

            $table->string('Academic_Year');
            $table->string('Major');
            $table->string('Committee');
            $table->unique(['Academic_Year', 'Major', 'Committee']);

            $table->string('Department')->nullable();
            $table->string('Subject')->nullable();
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_committee');
    }
};
