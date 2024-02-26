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
        Schema::create('medicament_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id')->nullable();
            $table->unsignedBigInteger('medicament_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamps();

            $table->index('record_id', 'medicament_records_record_idx');
            $table->index('medicament_id', 'medicament_records_medicament_idx');

            $table->foreign('record_id', 'medicament_records_record_fk')->on('records')->references('id');
            $table->foreign('medicament_id', 'medicament_records_medicament_fk')->on('medicaments')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicament_records');
    }
};
