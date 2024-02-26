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
        Schema::create('medicaments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('supply');
            $table->integer('product');
            $table->string('name');
            $table->date('date');
            $table->integer('quantity');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();

            $table->index('status_id', 'medicaments_status_idx');

            $table->foreign('status_id', 'medicaments_status_fk')->on('statuses')->references('id');
        });
        Schema::enableForeignKeyConstraints();
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicaments');
    }
};
