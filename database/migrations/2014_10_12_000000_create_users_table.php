<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role')->default("User");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_view')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Check if admin user exists
        $adminExists = User::where('email', 'admin@gmail.com')->exists();

        // If admin doesn't exist, create it
        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin123'), // atau password_hash('Admin123', PASSWORD_DEFAULT)
                'password_view' => "Admin123",
                'role' => 'Admin',
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
        Schema::dropIfExists('users');
    }
};
