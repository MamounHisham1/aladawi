<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title_ar',
        'title_en',
        'slug',
        'content_ar',
        'content_en',
        'excerpt_ar',
        'excerpt_en',
        'category_id',
        'published_at',
        'author_name',
        'reading_time',
        'sort_order',
        'tags',
        'is_featured',
        'is_published',
        'meta_title',
        'meta_description',
        'created_by',
    ];

    protected $casts = [
        'published_at' => 'date',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_ar')
            ->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getContentArHtmlAttribute()
    {
        $converter = new CommonMarkConverter;

        return $converter->convertToHtml($this->content_ar);
    }

    public function getContentEnHtmlAttribute()
    {
        if ($this->content_en) {
            $converter = new CommonMarkConverter;

            return $converter->convertToHtml($this->content_en);
        }

        return '';
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($article) {
            if ($article->content_ar) {
                // Estimate reading time (average 200 words per minute for Arabic)
                $wordCount = str_word_count(strip_tags($article->content_ar));
                $article->reading_time = max(1, ceil($wordCount / 200));
            }
        });
    }
}
