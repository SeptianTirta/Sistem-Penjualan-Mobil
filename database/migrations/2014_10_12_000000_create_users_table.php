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
        // Pastikan namanya 'users' (pakai 's') agar sesuai standar Laravel
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                      // Nama pengguna
            $table->string('email')->unique();           // Email login
            
            // Cukup gunakan tinyInteger untuk Role (masukkan ke dalam blok ini)
            $table->tinyInteger('role')->default(2);     // 1 = Super Admin, 0 = Admin, 2 = User/Customer
            
            $table->boolean('status')->default(1);       // 1 = aktif, 0 = nonaktif
            $table->string('password');                  // Kata sandi
            $table->string('no_hp', 15);                 // Nomor HP (saya ubah 15 jaga-jaga digit lebih panjang)
            $table->text('alamat')->nullable();          // Alamat customer / dealer (pakai text agar muat panjang)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};