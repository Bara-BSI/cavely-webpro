<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data User
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('P@55word')
        ]);
        User::create([
            'nama' => 'Bara Rifki Annajib',
            'email' => '19230480@bsi.ac.id',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('baraword')
        ]);
        User::create([
            'nama' => 'Christina Yuli Anggita',
            'email' => '19230947@bsi.ac.id',
            'role' => '2',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('chrisword')
        ]);
        User::create([
            'nama' => 'Restu Ardi Putranto',
            'email' => '19232150@bsi.ac.id',
            'role' => '0',
            'status' => 0,
            'hp' => '081234567892',
            'password' => bcrypt('restuword')
        ]);

        // Data Kategori
        Kategori::create([
            'nama_kategori' => 'Brownies',
        ]);
        Kategori::create([
            'nama_kategori' => 'Combro',
        ]);
        Kategori::create([
            'nama_kategori' => 'Dawet',
        ]);
        Kategori::create([
            'nama_kategori' => 'Mochi',
        ]);
        Kategori::create([
            'nama_kategori' => 'Wingko',
        ]);
    }
}
