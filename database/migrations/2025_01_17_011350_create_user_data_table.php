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
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('referals');
            $table->foreign('referals')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->text('profile_image')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('bitcoin_address')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('type_currency')->nullable();
            $table->string('members')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_data');
    }
};
