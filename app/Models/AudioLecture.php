<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AudioLecture extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'title_ar',
        'title_en',
        'slug',
        'description_ar',
        'description_en',
        'excerpt_ar',
        'excerpt_en',
        'category_id',
        'audio_series_id',
        'lecture_date',
        'location',
        'duration_minutes',
        'quality',
        'sort_order',
        'tags',
        'is_featured',
        'is_published',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'lecture_date' => 'date',
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('audio')
            ->singleFile()
            ->acceptsMimeTypes(['audio/mpeg', 'audio/mp3', 'audio/wav']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        // Audio conversions can be added here if needed
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function audioSeries()
    {
        return $this->belongsTo(AudioSeries::class);
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

    public function getAudioUrlAttribute()
    {
        return $this->getFirstMediaUrl('audio');
    }
}
