<?php

namespace App\Models;

use App\Enums\UserRule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rule',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'rule' => UserRule::class,
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!isset($user->rule)) {
                $user->rule = UserRule::SUPER_ADMIN;
            }
        });
    }

    public function getRole(): UserRule
    {
        return $this->rule ?? UserRule::SUPER_ADMIN;
    }

    public function hasRole(UserRule $role): bool
    {
        return $this->getRole() === $role;
    }

    public function canPerform(string $ability): bool
    {
        $role = $this->getRole();
        
        return match($ability) {
            'manage-users' => $role->canManageUsers(),
            'create-content' => $role->canCreateContent(),
            'edit-content' => $role->canEditContent(),
            'edit-own-content' => $role->canEditOwnContent(),
            'delete-content' => $role->canDeleteContent(),
            'delete-own-content' => $role->canDeleteOwnContent(),
            'access-admin' => $role->canAccessAdmin(),
            'manage-settings' => $role->canManageSettings(),
            'moderate-comments' => $role->canModerateComments(),
            'manage-categories' => $role->canManageCategories(),
            default => false,
        };
    }

    public function ownsContent($content): bool
    {
        return $content->created_by === $this->id;
    }

    public function canEditContent($content): bool
    {
        $role = $this->getRole();
        
        if ($role->canEditContent()) {
            return true;
        }
        
        if ($role->canEditOwnContent() && $this->ownsContent($content)) {
            return true;
        }
        
        return false;
    }

    public function canDeleteContent($content): bool
    {
        $role = $this->getRole();
        
        if ($role->canDeleteContent()) {
            return true;
        }
        
        if ($role->canDeleteOwnContent() && $this->ownsContent($content)) {
            return true;
        }
        
        return false;
    }

    public function fatwas()
    {
        return $this->hasMany(Fatwa::class, 'created_by');
    }

    public function audioLectures()
    {
        return $this->hasMany(AudioLecture::class, 'created_by');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'created_by');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'created_by');
    }
}
