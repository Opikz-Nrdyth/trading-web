<?php

use App\Models\setting;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_logo');
            $table->decimal('min_wd', 15, 2);
            $table->decimal('min_tf', 15, 2);
            $table->decimal('fee', 15, 2);
            $table->string("telegram");
            $table->string("phone_number")->nullable();
            $table->string("email")->nullable();
            $table->text("address")->nullable();
            $table->timestamps();
        });

        // Check if admin user exists
        $adminExists = setting::where('id', '1')->exists();

        if (!$adminExists) {
            DB::table('settings')->insert([
                'company_name' => 'Opik Studio',
                'company_logo' => '/images/logo.png',
                'min_wd' => 100000,
                'min_tf' => 100000,
                'fee' => 2,
                'telegram' => "",
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
        Schema::dropIfExists('settings');
    }
};
