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
        Schema::create('thesis_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('Thesis_No');
            $table->string('Student_ID');
            $table->string('Phone')->nullable();
            $table->string('Defend')->nullable();
            $table->string('Pass_State')->nullable();
            $table->string('Issue_Tem_Certificate')->nullable();
            $table->string('Other')->nullable();
            $table->float('Hardwork')->nullable()->default(0);
            $table->float('Charateristic')->nullable()->default(0);
            $table->string('Remark')->nullable();
            $table->string('Result')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_detail');
    }
};
