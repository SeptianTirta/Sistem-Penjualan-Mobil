<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('email')->unique();

            // Role user
            $table->tinyInteger('role')->default(2); 
            // 1 = Super Admin, 0 = Admin, 2 = User

            $table->boolean('status')->default(true);

            $table->string('password');

            // Lebih aman pakai string tanpa batas terlalu ketat
            $table->string('no_hp')->nullable();

            $table->text('alamat')->nullable();

            // Tambahan Laravel default (recommended)
            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};