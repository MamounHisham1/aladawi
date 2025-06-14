<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Book;
use App\Models\AudioLecture;
use App\Models\Fatwa;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class RecentContentWidget extends BaseWidget
{
    protected static ?string $heading = 'المحتوى المضاف حديثاً';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        // Get recent content from all models
        $articles = Article::select('id', 'title_ar as title', 'created_at', DB::raw("'مقال' as type"), DB::raw("'articles' as resource"))
            ->latest()
            ->limit(3);

        $books = Book::select('id', 'title_ar as title', 'created_at', DB::raw("'كتاب' as type"), DB::raw("'books' as resource"))
            ->latest()
            ->limit(3);

        $audioLectures = AudioLecture::select('id', 'title_ar as title', 'created_at', DB::raw("'محاضرة صوتية' as type"), DB::raw("'audio-lectures' as resource"))
            ->latest()
            ->limit(3);

        $fatwas = Fatwa::select('id', 'title_ar as title', 'created_at', DB::raw("'فتوى' as type"), DB::raw("'fatwas' as resource"))
            ->latest()
            ->limit(3);

        return $table
            ->query(
                $articles->union($books)->union($audioLectures)->union($fatwas)->orderBy('created_at', 'desc')->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->limit(50),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('النوع')
                    ->colors([
                        'success' => 'مقال',
                        'info' => 'كتاب',
                        'warning' => 'محاضرة صوتية',
                        'primary' => 'فتوى',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime()
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('عرض')
                    ->icon('heroicon-o-eye')
                    ->url(function ($record): string {
                        $resourceMap = [
                            'articles' => 'articles',
                            'books' => 'books',
                            'audio-lectures' => 'audio-lectures',
                            'fatwas' => 'fatwas',
                        ];
                        
                        $resource = $resourceMap[$record->resource] ?? 'articles';
                        return route("filament.admin.resources.{$resource}.view", $record->id);
                    }),
            ]);
    }
} 