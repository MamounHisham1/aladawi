<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Book;
use App\Models\AudioLecture;
use App\Models\Fatwa;
use App\Models\Contact;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي المقالات', Article::count())
                ->description('المقالات المنشورة: ' . Article::where('is_published', true)->count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('إجمالي الكتب', Book::count())
                ->description('الكتب المنشورة: ' . Book::where('is_published', true)->count())
                ->descriptionIcon('heroicon-m-book-open')
                ->color('info'),
            
            Stat::make('المحاضرات الصوتية', AudioLecture::count())
                ->description('المحاضرات المنشورة: ' . AudioLecture::where('is_published', true)->count())
                ->descriptionIcon('heroicon-m-microphone')
                ->color('warning'),
            
            Stat::make('الفتاوى', Fatwa::count())
                ->description('الفتاوى المنشورة: ' . Fatwa::where('is_published', true)->count())
                ->descriptionIcon('heroicon-m-question-mark-circle')
                ->color('primary'),
            
            Stat::make('رسائل التواصل', Contact::count())
                ->description('غير مقروءة: ' . Contact::where('is_read', false)->count())
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
            
            Stat::make('المحتوى المميز', 
                Article::where('is_featured', true)->count() + 
                Book::where('is_featured', true)->count() + 
                AudioLecture::where('is_featured', true)->count() + 
                Fatwa::where('is_featured', true)->count()
            )
                ->description('المحتوى المميز عبر جميع الأقسام')
                ->descriptionIcon('heroicon-m-star')
                ->color('success'),
        ];
    }
} 