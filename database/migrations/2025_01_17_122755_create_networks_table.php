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
        Schema::create('networks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child');
            $table->foreign('child')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('mother');
            $table->foreignId('mother_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string("join_date");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('networks');
    }
};
