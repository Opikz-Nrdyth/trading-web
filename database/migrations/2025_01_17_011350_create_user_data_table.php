<?php

use App\Models\currency as ModelsCurrency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('referals')->nullable();
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

        $admin = DB::table('users')->where('email', 'admin@gmail.com')->first();
        $currency = ModelsCurrency::all()->first() ?? "";

        DB::table('user_data')->insert([
            'user_id' => $admin->id,
            'referals' => 1,
            'profile_image' => null,
            'username' => 'admin',
            'address' => '',
            'country' => 'Indonesia',
            'phone_number' => '',
            'bitcoin_address' => '',
            'bank_number' => '',
            'bank_name' => '',
            'type_currency' => $currency->currency_code,
            'members' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_data');
    }
};
