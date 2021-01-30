<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggan')->insert([
            'nama' => 'budi', 
            'telp' => 012323,
            'email' => 'budi@gmail.com',
            'password' => Hash::make('123'),
            'tanggal_lahir' => NOW(),
            'alamat' => 'Perum Baru Oi',
            'gambar' => 'dx',
            'jenis_kelamin' => 'Laki-Laki', 
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);
    }
}
