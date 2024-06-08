<?php

namespace Database\Seeders;

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
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.pe',
        ]);
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@admin.pe'
        ]);
        User::factory()->create([
            'name' => 'yfunes',
            'email' => 'yfunes@sales.pe'
        ]);
        User::factory(20)->create();
    }
}
