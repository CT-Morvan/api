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
        Schema::create('bioimpedances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users');
            $table->datetime('exam_date');
            $table->float('weight');
            $table->float('imc');
            $table->float('fat_percentage');
            $table->float('muscle_percentage');
            $table->float('basal_metabolism');
            $table->float('metabolic_age');
            $table->float('visceral_fat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bioimpedances');
    }
};
