<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            // Foreign key merujuk ke tabel tipes
            $table->foreignId('tipe_id')->constrained('tipes')->onDelete('cascade'); 
            
            $table->string('nama_mobil'); 
            $table->integer('tahun');
            $table->integer('stok');
            $table->string('warna');
            $table->bigInteger('harga');
            $table->integer('kapasitas');
            $table->string('gambar_mobil')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};