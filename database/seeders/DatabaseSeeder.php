<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call ArticleSeeder
        $this->call(ArticleSeeder::class);

        // Create Admin User if not exists
        if (!User::where('email', 'admin@fzannews.com')->exists()) {
            User::create([
                'name' => 'Admin FZAN NEWS',
                'email' => 'admin@fzannews.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
