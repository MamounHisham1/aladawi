<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Fatwa;
use App\Models\AudioLecture;
use App\Models\Book;
use App\Models\Article;
use App\Enums\UserRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateUserRolesSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Update all existing users to have SUPER_ADMIN role if they don't have a role
        User::whereNull('rule')->update(['rule' => UserRule::SUPER_ADMIN->value]);

        // Get the first user (admin) to assign as creator of existing content
        $adminUser = User::first();
        
        if ($adminUser) {
            // Update existing content to have created_by set to admin user
            Fatwa::whereNull('created_by')->update(['created_by' => $adminUser->id]);
            AudioLecture::whereNull('created_by')->update(['created_by' => $adminUser->id]);
            Book::whereNull('created_by')->update(['created_by' => $adminUser->id]);
            Article::whereNull('created_by')->update(['created_by' => $adminUser->id]);
            
            $this->command->info('Updated existing content to be owned by admin user: ' . $adminUser->name);
        }
        
        $this->command->info('Updated user roles successfully.');
    }
}
