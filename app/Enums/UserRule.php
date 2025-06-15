<?php

namespace App\Enums;

enum UserRule: string
{
    /**
     * SUPER_ADMIN - Highest level access
     * Can do everything:
     * - Full system administration
     * - Manage all users and their roles
     * - Create, edit, delete all content (fatwas, audio, books, articles)
     * - Access admin panel and all settings
     * - Manage categories and tags
     * - View analytics and reports
     * - System configuration and maintenance
     * - Backup and restore operations
     */
    case SUPER_ADMIN = 'super_admin';

    /**
     * ADMIN - High level administrative access
     * Can do most administrative tasks:
     * - Manage users (except other admins/super admins)
     * - Create, edit, delete all content
     * - Access admin panel
     * - Manage categories and tags
     * - View reports and analytics
     * - Moderate comments and user submissions
     * - Cannot change system settings or manage other admins
     */
    case ADMIN = 'admin';

    /**
     * SUPER_MODERATOR - Advanced content management
     * Can manage all content with advanced permissions:
     * - Create, edit, delete all content types
     * - Publish/unpublish content
     * - Manage content categories and tags
     * - Moderate user comments and submissions
     * - Access content management sections of admin panel
     * - View content analytics
     * - Cannot manage users or system settings
     */
    case SUPER_MODERATOR = 'super_moderator';

    /**
     * MODERATOR - Content editing and moderation
     * Can edit content and moderate submissions:
     * - Edit existing content (fatwas, audio, books, articles)
     * - Moderate user comments
     * - Review and approve user submissions
     * - Access basic content management features
     * - Cannot create new content or delete existing content
     * - Cannot manage users or categories
     */
    case MODERATOR = 'moderator';

    /**
     * CONTENT_MODERATOR - Limited content creator/editor
     * Can only manage content they created:
     * - Create new content (fatwas, audio, books, articles)
     * - Edit only their own content
     * - Delete only their own content
     * - Cannot edit content created by others
     * - Cannot moderate comments or user submissions
     * - Cannot manage categories or tags
     * - Cannot manage users
     * - Limited access to admin panel (only their content)
     */
    case CONTENT_MODERATOR = 'content_moderator';

    /**
     * USER - Basic user access (default role)
     * Read-only access to public content:
     * - View published fatwas, audio lectures, books, and articles
     * - Search and browse content
     * - Contact form submission
     * - Download available books and audio files
     * - Cannot access admin panel
     * - Cannot create, edit, or delete any content
     * - Cannot moderate or manage anything
     */
    case USER = 'user';

    /**
     * Get user role display name in Arabic
     */
    public function getDisplayName(): string
    {
        return match($this) {
            self::SUPER_ADMIN => 'مدير عام',
            self::ADMIN => 'مدير',
            self::SUPER_MODERATOR => 'مشرف عام',
            self::MODERATOR => 'مشرف',
            self::CONTENT_MODERATOR => 'مشرف محتوى',
            self::USER => 'مستخدم',
        };
    }

    /**
     * Get user role description in Arabic
     */
    public function getDescription(): string
    {
        return match($this) {
            self::SUPER_ADMIN => 'صلاحيات كاملة لإدارة النظام والمحتوى والمستخدمين',
            self::ADMIN => 'صلاحيات إدارية لإدارة المحتوى والمستخدمين',
            self::SUPER_MODERATOR => 'صلاحيات متقدمة لإدارة جميع أنواع المحتوى',
            self::MODERATOR => 'صلاحيات تحرير المحتوى والإشراف على التعليقات',
            self::CONTENT_MODERATOR => 'صلاحيات إنشاء وتحرير المحتوى الخاص بهم فقط',
            self::USER => 'صلاحيات أساسية لعرض المحتوى فقط',
        };
    }

    /**
     * Check if role can manage users
     */
    public function canManageUsers(): bool
    {
        return in_array($this, [self::SUPER_ADMIN, self::ADMIN]);
    }

    /**
     * Check if role can create content
     */
    public function canCreateContent(): bool
    {
        return in_array($this, [self::SUPER_ADMIN, self::ADMIN, self::SUPER_MODERATOR, self::CONTENT_MODERATOR]);
    }

    /**
     * Check if role can edit content (any content)
     */
    public function canEditContent(): bool
    {
        return in_array($this, [self::SUPER_ADMIN, self::ADMIN, self::SUPER_MODERATOR, self::MODERATOR]);
    }

    /**
     * Check if role can edit only their own content
     */
    public function canEditOwnContent(): bool
    {
        return in_array($this, [self::SUPER_ADMIN, self::ADMIN, self::SUPER_MODERATOR, self::MODERATOR, self::CONTENT_MODERATOR]);
    }

    /**
     * Check if role can delete content (any content)
     */
    public function canDeleteContent(): bool
    {
        return in_array($this, [self::SUPER_ADMIN, self::ADMIN, self::SUPER_MODERATOR]);
    }

    /**
     * Check if role can delete only their own content
     */
    public function canDeleteOwnContent(): bool
    {
        return in_array($this, [self::SUPER_ADMIN, self::ADMIN, self::SUPER_MODERATOR, self::CONTENT_MODERATOR]);
    }

    /**
     * Check if role can access admin panel
     */
    public function canAccessAdmin(): bool
    {
        return in_array($this, [self::SUPER_ADMIN, self::ADMIN, self::SUPER_MODERATOR, self::MODERATOR, self::CONTENT_MODERATOR]);
    }

    /**
     * Check if role can manage system settings
     */
    public function canManageSettings(): bool
    {
        return $this === self::SUPER_ADMIN;
    }

    /**
     * Check if role can moderate comments
     */
    public function canModerateComments(): bool
    {
        return in_array($this, [self::SUPER_ADMIN, self::ADMIN, self::SUPER_MODERATOR, self::MODERATOR]);
    }

    /**
     * Check if role can manage categories
     */
    public function canManageCategories(): bool
    {
        return in_array($this, [self::SUPER_ADMIN, self::ADMIN, self::SUPER_MODERATOR]);
    }

    /**
     * Get all roles that can be assigned by this role
     */
    public function getAssignableRoles(): array
    {
        return match($this) {
            self::SUPER_ADMIN => [self::ADMIN, self::SUPER_MODERATOR, self::MODERATOR, self::CONTENT_MODERATOR, self::USER],
            self::ADMIN => [self::SUPER_MODERATOR, self::MODERATOR, self::CONTENT_MODERATOR, self::USER],
            self::SUPER_MODERATOR => [self::MODERATOR, self::CONTENT_MODERATOR, self::USER],
            default => [],
        };
    }
} 