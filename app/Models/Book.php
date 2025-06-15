<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Book extends Model implements HasMedia
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
        'author_ar',
        'author_en',
        'publisher_ar',
        'publisher_en',
        'publication_year',
        'isbn',
        'pages',
        'language',
        'download_count',
        'sort_order',
        'tags',
        'is_featured',
        'is_published',
        'meta_title',
        'meta_description',
        'created_by'
    ];

    protected $casts = [
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
        $this->addMediaCollection('book_files')
            ->acceptsMimeTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);

        $this->addMediaCollection('cover_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(400)
            ->sharpen(10)
            ->performOnCollections('cover_image');
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

    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }

    public function getCoverImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('cover_image');
    }

    public function getCoverImageThumbUrlAttribute()
    {
        return $this->getFirstMediaUrl('cover_image', 'thumb');
    }

    public function getBookFilesAttribute()
    {
        return $this->getMedia('book_files');
    }
}
