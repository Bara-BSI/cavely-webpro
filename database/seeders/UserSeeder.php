<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        Country::truncate();
        Region::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        Region::create([
            'nama_region' => 'SEA'
        ]);
        Country::create([
            'nama_negara' => 'Indonesia',
            'regions_id' => Region::where(
                'nama_region',
                'SEA'
            )->first()->id
        ]);
        User::create([
            'nama' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => '0',
            'status' => 1,
            'password' => bcrypt('admin123'),
            'hp' => '081234567890',
            'tanggal_lahir' => '2000-01-01',
            'countries_id' => Country::where(
                'nama_negara',
                'Indonesia'
            )->first()->id
        ]);
        User::create([
            'nama' => 'bara',
            'email' => 'bara@gmail.com',
            'role' => '1',
            'status' => 1,
            'password' => bcrypt('bara123'),
            'hp' => '081234567890',
            'tanggal_lahir' => '2000-01-01',
            'countries_id' => Country::where(
                'nama_negara',
                'Indonesia'
            )->first()->id
        ]);
        User::create([
            'nama' => 'restu',
            'email' => 'restu@gmail.com',
            'role' => '2',
            'status' => 1,
            'password' => bcrypt('restu123'),
            'hp' => '081234567890',
            'tanggal_lahir' => '2000-01-01',
            'countries_id' => Country::where(
                'nama_negara',
                'Indonesia'
            )->first()->id
        ]);
        User::create([
            'nama' => 'chris',
            'email' => 'chris@gmail.com',
            'role' => '2',
            'status' => 0,
            'password' => bcrypt('chris123'),
            'hp' => '081234567890',
            'tanggal_lahir' => '2000-01-01',
            'countries_id' => Country::where(
                'nama_negara',
                'Indonesia'
            )->first()->id
        ]);
    }
}
