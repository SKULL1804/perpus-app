<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KetBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusBacaan = [
            ['status' => 'Mulai Baca'],
            ['status' => 'Belum Selesai Baca'],
            ['status' => 'Lanjutkan Baca'],
            ['status' => 'Sedang Baca'],
            ['status' => 'Belum Baca'],
        ];

        // Memasukkan data ke dalam tabel ket_buku
        DB::table('ket_buku')->insert($statusBacaan);
    }
}
