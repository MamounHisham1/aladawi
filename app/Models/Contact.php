<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'type',
        'is_read',
        'is_replied',
        'admin_reply',
        'replied_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_replied' => 'boolean',
        'replied_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeUnreplied($query)
    {
        return $query->where('is_replied', false);
    }

    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    public function markAsReplied($reply = null)
    {
        $this->update([
            'is_replied' => true,
            'admin_reply' => $reply,
            'replied_at' => now(),
        ]);
    }
}
