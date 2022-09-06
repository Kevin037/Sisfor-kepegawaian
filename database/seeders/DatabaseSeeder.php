<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Fungsional;
use App\Models\Divisi;
use App\Models\Absensi;
use App\Models\JenisIzin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        User::create([
            'no_pegawai' => '123456',
            'nama' => 'Kevin',
            'email' => 'ksatria@gmail.com',
            'fungsional_id' => '2',
            'divisi_id' => '2',
            'password' => bcrypt('test1234')
        ]);

        User::create([
            'no_pegawai' => '43523',
            'nama' => 'Satria',
            'email' => 'satria@gmail.com',
            'fungsional_id' => '3',
            'divisi_id' => '2',
            'password' => bcrypt('test1234')
        ]);

        User::create([
            'no_pegawai' => '8245',
            'nama' => 'Iqbal',
            'email' => 'iqbal@gmail.com',
            'fungsional_id' => '3',
            'divisi_id' => '2',
            'password' => bcrypt('test1234')
        ]);

        Fungsional::create([
            'nama_fungsional' => 'hrd',
        ]);        

        Fungsional::create([
            'nama_fungsional' => 'manajer',
        ]);  

        Fungsional::create([
            'nama_fungsional' => 'karyawan',
        ]);  

        Divisi::create([
            'nama_divisi' => 'produksi',
        ]);  

        Divisi::create([
            'nama_divisi' => 'it',
        ]);  

        JenisIzin::create([
            'nama_izin' => 'cuti',
        ]);  
        JenisIzin::create([
            'nama_izin' => 'sakit',
        ]); 
    }
}
