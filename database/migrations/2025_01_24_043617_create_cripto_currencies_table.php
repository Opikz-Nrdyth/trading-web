<?php

use App\Models\cripto_currency;
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
        Schema::create('cripto_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('currency_code');
            $table->string('currency_name');
            $table->string('currency_logo');
            $table->timestamps();
        });

        $currencyExists = cripto_currency::where('currency_code', 'BTC')->exists();

        if (!$currencyExists) {
            DB::table('cripto_currencies')->insert([
                'currency_code' => 'BTC',
                'currency_name' => 'BITCOIN',
                'currency_logo' => '/images/bitcoin.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cripto_currencies');
    }
};
