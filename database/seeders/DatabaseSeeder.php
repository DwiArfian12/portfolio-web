<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Dwi Arfian',
            'email' => 'admin@dwiarfian.com',
            'password' => bcrypt('password123'),
        ]);

        // Create portfolio data
        $this->call(PortfolioSeeder::class);
    }
}
