<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name'          => 'Ardavan Shamroshan',
            'email'         => 'admin@admin.com',
            'role'          => 'admin',
            'national_code' => 1111111111,
            'status'        => true
        ]);

        User::factory()->count(5)->create();
    }
}
