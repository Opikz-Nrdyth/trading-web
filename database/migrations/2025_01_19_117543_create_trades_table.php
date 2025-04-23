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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string("market");
            $table->string("trx");
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->string("amount");
            $table->string("rate_stake");
            $table->string("rate_end");
            $table->enum("status", ["Success", "Pendding"]);
            $table->enum("win_lost", ["Win", "Lost"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
