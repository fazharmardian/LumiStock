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
        Schema::create('lendings', function (Blueprint $table) {
            $table->id(); // Automatically creates an `id` field with auto-increment
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_item');
            $table->integer('total_request');
            $table->date('lend_date');
            $table->date('return_date');
            $table->date('actual_return_date')->nullable();
            $table->string('status', 50);

            // Foreign key constraints
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_item')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lendings');
    }
};
