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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('record')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->timestamps();

            $table->index('doctor_id', 'records_doctor_idx');
            $table->index('user_id', 'records_user_idx');

            $table->foreign('doctor_id', 'doctor_user_doctor_fk')->on('doctors')->references('id');
            $table->foreign('user_id', 'doctor_user_user_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
