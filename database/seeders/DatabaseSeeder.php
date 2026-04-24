<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mobil;
use App\Models\Tipe;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==========================================
        //  1. SEED DATA USER (STRUKTUR ORGANISASI)
        // ==========================================

        // SUPER ADMIN (Role 1)
        User::create([
            'nama'     => 'Admin SIGMA',
            'email'    => 'superadmin@gmail.com',
            'role'     => 1,
            'status'   => 1,
            'no_hp'    => '081234567890',
            'alamat'   => 'Kantor Pusat SIGMA',
            'password' => bcrypt('password'),
        ]);

        // ADMIN (Role 0) - Urutan: Ichwan di atas Andre
        User::create([
            'nama'     => 'Ichwan Fauzan',
            'email'    => 'ichwan@gmail.com',
            'role'     => 0,
            'status'   => 1,
            'no_hp'    => '081211112222',
            'alamat'   => 'Jakarta',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'nama'     => 'Andre Septian Tirta',
            'email'    => 'andre@gmail.com',
            'role'     => 0,
            'status'   => 1,
            'no_hp'    => '081233334444',
            'alamat'   => 'Bandung',
            'password' => bcrypt('password'),
        ]);

        // PELANGGAN / USER (Role 2)
        User::create([
            'nama'     => 'Rangga Sholeh',
            'email'    => 'rangga@gmail.com',
            'role'     => 2,
            'status'   => 1,
            'no_hp'    => '081255556666',
            'alamat'   => 'Surabaya',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'nama'     => 'Mario Cahya Eka',
            'email'    => 'mario@gmail.com',
            'role'     => 2,
            'status'   => 1,
            'no_hp'    => '081277778888',
            'alamat'   => 'Jakarta Pusat',
            'password' => bcrypt('password'),
        ]);

        // ==========================================
        //  2. SEED DATA TIPE
        // ==========================================
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

        // ==========================================
        //  3. SEED DATA MOBIL (DENGAN GAMBAR)
        // ==========================================
        // Pastikan file gambar sudah ada di public/storage/img_mobil/

        Mobil::create([
            'tipe_id'    => $tipeMpv->id,
            'nama_mobil' => 'Suzuki All New Ertiga Hybrid',
            'tahun'      => 2024,
            'stok'       => 12,
            'warna'      => 'Putih Mutiara',
            'harga'      => 295000000,
            'kapasitas'  => 7,
            'gambar_mobil' => '1776262817_2023 Suzuki Ertiga.jpg',
        ]);

        Mobil::create([
            'tipe_id'    => $tipeSuv->id,
            'nama_mobil' => 'Suzuki XL7 Alpha',
            'tahun'      => 2024,
            'stok'       => 8,
            'warna'      => 'Hitam',
            'harga'      => 305000000,
            'kapasitas'  => 7,
            'gambar_mobil' => '1776262883_Suzuki XL7 2022 Tuning.jpg',
        ]);

        Mobil::create([
            'tipe_id'    => $tipeSuv->id,
            'nama_mobil' => 'Suzuki Jimny 5-Door',
            'tahun'      => 2024,
            'stok'       => 2,
            'warna'      => 'Kuning',
            'harga'      => 462000000,
            'kapasitas'  => 4,
            'gambar_mobil' => '1776262942_Maruti Suzuki Jimny 5-Door 2025 – Complete Review, Specs & Price in India.jpg',
        ]);

        Mobil::create([
            'tipe_id'    => $tipeHatchback->id,
            'nama_mobil' => 'Suzuki Baleno',
            'tahun'      => 2023,
            'stok'       => 5,
            'warna'      => 'Biru',
            'harga'      => 281000000,
            'kapasitas'  => 5,
            'gambar_mobil' => '1776262983_New 2022 Maruti Suzuki Baleno makes world debut in India _ AUTOBICS.jpg',
        ]);
    }
}
