<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Enums\UserRule;
use Illuminate\Console\Command;

class TestAdminAccess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:admin-access';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test admin access control for different user roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Admin Access Control');
        $this->info('================================');

        $users = User::all();

        foreach ($users as $user) {
            $this->newLine();
            $this->info("User: {$user->name} ({$user->email})");
            $this->info("Role: {$user->getRole()->getDisplayName()}");
            
            $canAccessAdmin = $user->canPerform('access-admin');
            $canCreateContent = $user->canPerform('create-content');
            $canEditContent = $user->canPerform('edit-content');
            $canDeleteContent = $user->canPerform('delete-content');
            $canManageUsers = $user->canPerform('manage-users');
            
            $this->table(
                ['Permission', 'Access'],
                [
                    ['Access Admin Panel', $canAccessAdmin ? '✅ Yes' : '❌ No'],
                    ['Create Content', $canCreateContent ? '✅ Yes' : '❌ No'],
                    ['Edit Any Content', $canEditContent ? '✅ Yes' : '❌ No'],
                    ['Delete Any Content', $canDeleteContent ? '✅ Yes' : '❌ No'],
                    ['Manage Users', $canManageUsers ? '✅ Yes' : '❌ No'],
                ]
            );
        }

        $this->newLine();
        $this->info('Access Control Summary:');
        $this->info('- Users with USER role should NOT have admin access');
        $this->info('- Users with CONTENT_MODERATOR role should have LIMITED admin access');
        $this->info('- Users with ADMIN/SUPER_ADMIN roles should have FULL admin access');
        
        return Command::SUCCESS;
    }
}
