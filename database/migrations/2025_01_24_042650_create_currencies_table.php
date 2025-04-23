<?php

use App\Models\currency;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('currency_code');
            $table->string('currency_name');
            $table->string('currency_logo');
            $table->timestamps();
        });

        $currencyExists = currency::where('currency_code', 'SGD')->exists();

        if (!$currencyExists) {
            DB::table('currencies')->insert([
                'currency_code' => 'SGD',
                'currency_name' => 'Singapure Dollar',
                'currency_logo' => '/images/singapore.png',
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
        Schema::dropIfExists('currencies');
    }
};
