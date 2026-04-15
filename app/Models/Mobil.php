<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobils';

    // Kolom yang boleh diisi secara massal (sesuaikan dengan migration baru)
    protected $fillable = [
        'tipe_id',
        'nama_mobil',
        'tahun',
        'stok',
        'warna',
        'harga',
        'kapasitas',
        'gambar_mobil',
    ];

    // Relasi: 1 Mobil dimiliki oleh 1 Tipe
    public function tipe()
    {
        return $this->belongsTo(Tipe::class, 'tipe_id');
    }
}