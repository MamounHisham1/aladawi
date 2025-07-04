<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create admin user
        User::factory()->create([
            'name' => 'الشيخ العدوي',
            'email' => 'admin@aladawi.com',
            'password' => bcrypt('password'),
        ]);

        // Run all content seeders
        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class,
            BookSeeder::class,
            FatwaSeeder::class,
            AudioLectureSeeder::class,
        ]);
    }
}
