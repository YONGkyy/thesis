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
        Schema::create('thesis', function (Blueprint $table) {
            $table->id();
            $table->integer('Thesis_No')->unique();
            $table->integer('Thesis_Group')->nullable();
            $table->string('Academic_Year')->nullable();
            $table->string('Department')->nullable();
            $table->string('Major')->nullable();
            $table->string('Year')->nullable();
            $table->string('Batch')->nullable();
            $table->string('Session')->nullable();
            $table->string('Organizaition')->nullable();
            $table->string('Organization_Type')->nullable();
            $table->string('Location')->nullable();
            $table->string('Organization_Phone')->nullable();
            $table->string('Title')->nullable();
            $table->string('Title_Khmer')->nullable();
            $table->string('Objective')->nullable();
            $table->string('Objective_Khmer')->nullable();
            $table->string('Summary')->nullable();
            $table->string('Submit_Date')->nullable();
            $table->string('Teacher_id')->nullable();
            $table->string('Defend_Date')->nullable();
            $table->float('Book_Score')->nullable()->default(0);
            $table->string('Defend_time')->nullable();
            $table->string('Submit_book')->nullable();
            $table->string('Building')->nullable();
            $table->string('Room')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis');
    }
};
