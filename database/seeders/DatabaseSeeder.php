<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mobil;
use App\Models\Tipe; // Pastikan kita panggil model Tipe, bukan Merk lagi

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ===============================
        //  1. SEED DATA USER
        // ===============================
        User::create([
            'nama'     => 'Ambaminstrator',
            'email'    => 'superadmin@gmail.com',
            'role'     => 1, // 1 = Super Admin
            'status'   => 1,
            'no_hp'    => '0812345678901',
            'alamat'   => 'Saranjana',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama'     => 'Andrea Minstaf',
            'email'    => 'andrea@gmail.com',
            'role'     => 0, // 0 = Admin
            'status'   => 1,
            'no_hp'    => '08557635131',
            'alamat'   => 'Bandung',
            'password' => bcrypt('P@55word'),
        ]);

        //  2. SEED DATA TIPE
        // ===============================
        // Kita simpan ke dalam variabel agar ID-nya bisa dipakai oleh Mobil
        $tipeMpv = Tipe::create([
            'nama_tipe' => 'MPV (Multi Purpose Vehicle)',
            'deskripsi' => 'Mobil keluarga dengan kapasitas kabin luas dan nyaman.'
        ]);

        $tipeSuv = Tipe::create([
            'nama_tipe' => 'SUV (Sport Utility Vehicle)',
            'deskripsi' => 'Mobil tangguh dengan ground clearance tinggi, cocok untuk berbagai medan.'
        ]);

        $tipeHatchback = Tipe::create([
            'nama_tipe' => 'Hatchback / City Car',
            'deskripsi' => 'Mobil compact yang lincah dan irit untuk penggunaan perkotaan.'
        ]);

        // ===============================
        //  3. SEED DATA MOBIL (SUZUKI)
        // ===============================
        Mobil::create([
            'tipe_id'    => $tipeMpv->id, // Menyambungkan ke tipe MPV
            'nama_mobil' => 'Suzuki All New Ertiga Hybrid',
            'tahun'      => 2024,
            'stok'       => 12,
            'warna'      => 'Putih Mutiara',
            'harga'      => 295000000,
            'kapasitas'  => 7,
        ]);

        Mobil::create([
            'tipe_id'    => $tipeSuv->id, // Menyambungkan ke tipe SUV
            'nama_mobil' => 'Suzuki XL7 Alpha',
            'tahun'      => 2024,
            'stok'       => 8,
            'warna'      => 'Hitam',
            'harga'      => 305000000,
            'kapasitas'  => 7,
        ]);

        Mobil::create([
            'tipe_id'    => $tipeSuv->id, // Menyambungkan ke tipe SUV
            'nama_mobil' => 'Suzuki Jimny 5-Door',
            'tahun'      => 2024,
            'stok'       => 2,
            'warna'      => 'Kuning',
            'harga'      => 462000000,
            'kapasitas'  => 4,
        ]);

        Mobil::create([
            'tipe_id'    => $tipeHatchback->id, // Menyambungkan ke tipe Hatchback
            'nama_mobil' => 'Suzuki Baleno',
            'tahun'      => 2023,
            'stok'       => 5,
            'warna'      => 'Biru',
            'harga'      => 281000000,
            'kapasitas'  => 5,
        ]);
    }
}