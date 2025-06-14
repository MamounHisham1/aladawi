<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Fatwa extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title_ar',
        'title_en',
        'slug',
        'question_ar',
        'question_en',
        'answer_ar',
        'answer_en',
        'excerpt_ar',
        'excerpt_en',
        'questioner_name',
        'questioner_location',
        'fatwa_date',
        'category_id',
        'tags',
        'is_featured',
        'is_published',
        'meta_title',
        'meta_description',
        'youtube_link'
    ];

    protected $casts = [
        'fatwa_date' => 'date',
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
}
