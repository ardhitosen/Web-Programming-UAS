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
        Schema::create('doctor_patient_reservation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');
            $table->dateTime('reserved_at');
            $table->text('review')->nullable();
            $table->text('keluhan');
            $table->text('status');
            $table->timestamps();
        
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_patient_reservation');
    }
};