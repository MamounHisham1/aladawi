<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create a regular user (should not have admin access)
        User::create([
            'name' => 'Regular User',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
            'rule' => UserRule::USER,
        ]);

        // Create a content moderator (should have limited admin access)
        User::create([
            'name' => 'Content Moderator',
            'email' => 'moderator@test.com',
            'password' => Hash::make('password'),
            'rule' => UserRule::CONTENT_MODERATOR,
        ]);

        // Create an admin user (should have full admin access)
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'rule' => UserRule::ADMIN,
        ]);

        $this->command->info('Test users created successfully:');
        $this->command->info('- Regular User: user@test.com / password (no admin access)');
        $this->command->info('- Content Moderator: moderator@test.com / password (limited admin access)');
        $this->command->info('- Admin User: admin@test.com / password (full admin access)');
    }
}
