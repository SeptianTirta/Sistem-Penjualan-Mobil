<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional tapi baik untuk berjaga-jaga)
    protected $table = 'tipes';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_tipe',
        'deskripsi',
    ];

    // Relasi: 1 Tipe punya Banyak Mobil
    public function mobils()
    {
        return $this->hasMany(Mobil::class, 'tipe_id');
    }
}