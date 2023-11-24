<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;

class createseedersblog extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::transaction(function () {
            Blog::create([
                'uuid' => 'c56ecf01-82c0-4d18-a4e6-639c303a07f0',
                'title' => 'Berita Terkini Aktual 1',
                'description' => 'Terjadi sebuah kejadian yang sangat mengharukan',
                'image' => 'testing.jpg',
            ]);
            Blog::create([
                'uuid' => 'd867376e-2340-401c-8b5e-d4ddaadc9352',
                'title' => 'Berita Terkini Aktual 2',
                'description' => 'Terjadi sebuah kejadian yang sangat mengharukan',
                'image' => 'testing.jpg',
            ]);
        });
    }
}
