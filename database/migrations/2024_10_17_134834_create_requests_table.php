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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_item');
            $table->integer('total_request');
            $table->string('type');
            $table->unsignedBigInteger('rent_id')->nullable();
            $table->date('request_date');
            $table->string('status');
            $table->date('return_date');

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_item')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rent_id')->references('id')->on('lendings')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
