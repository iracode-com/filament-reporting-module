<?php

namespace Database\Seeders;

use BezhanSalleh\FilamentShield\FilamentShield;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        Model::unguard();

        DB::unprepared(File::get(database_path('sql/provinces.sql')));
        DB::unprepared(File::get(database_path('sql/cities.sql')));
        DB::unprepared(File::get(database_path('sql/countries.sql')));

    }
}
