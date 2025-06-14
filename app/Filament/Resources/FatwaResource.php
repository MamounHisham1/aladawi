<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FatwaResource\Pages;
use App\Filament\Resources\FatwaResource\RelationManagers;
use App\Models\Fatwa;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FatwaResource extends Resource
{
    protected static ?string $model = Fatwa::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'الفتاوى';

    protected static ?string $navigationGroup = 'إدارة المحتوى';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('المعلومات الأساسية')
                    ->schema([
                        Forms\Components\TextInput::make('title_ar')
                            ->label('العنوان بالعربية')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title_en')
                            ->label('العنوان بالإنجليزية')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('الرابط المختصر')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category_id')
                            ->label('التصنيف')
                            ->options(Category::where('type', 'fatwa')->pluck('name_ar', 'id'))
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('معلومات السائل')
                    ->schema([
                        Forms\Components\TextInput::make('questioner_name')
                            ->label('اسم السائل')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('questioner_location')
                            ->label('مكان السائل')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('fatwa_date')
                            ->label('تاريخ الفتوى'),
                    ])->columns(3),

                Forms\Components\Section::make('السؤال والجواب')
                    ->schema([
                        Forms\Components\Textarea::make('excerpt_ar')
                            ->label('المقتطف بالعربية')
                            ->rows(3),
                        Forms\Components\Textarea::make('excerpt_en')
                            ->label('المقتطف بالإنجليزية')
                            ->rows(3),
                        Forms\Components\MarkdownEditor::make('question_ar')
                            ->label('السؤال بالعربية')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('question_en')
                            ->label('السؤال بالإنجليزية'),
                        Forms\Components\MarkdownEditor::make('answer_ar')
                            ->label('الجواب بالعربية')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('answer_en')
                            ->label('الجواب بالإنجليزية'),
                    ]),

                Forms\Components\Section::make('الإعدادات')
                    ->schema([
                        Forms\Components\TagsInput::make('tags')
                            ->label('الكلمات المفتاحية'),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('مميز')
                            ->default(false),
                        Forms\Components\Toggle::make('is_published')
                            ->label('منشور')
                            ->default(true),
                    ])->columns(3),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('عنوان SEO')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('وصف SEO')
                            ->rows(3),
                        Forms\Components\TextInput::make('youtube_link')
                            ->label('رابط اليوتيوب')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->helperText('رابط فيديو اليوتيوب المرتبط بالفتوى (اختياري)')
                            ->unique(ignoreRecord: true),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_ar')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name_ar')
                    ->label('التصنيف')
                    ->sortable(),
                Tables\Columns\TextColumn::make('questioner_name')
                    ->label('السائل')
                    ->searchable(),
                Tables\Columns\TextColumn::make('questioner_location')
                    ->label('المكان'),
                Tables\Columns\TextColumn::make('fatwa_date')
                    ->label('تاريخ الفتوى')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('مميز')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('منشور')
                    ->boolean(),
                Tables\Columns\IconColumn::make('youtube_link')
                    ->label('يوتيوب')
                    ->boolean()
                    ->trueIcon('heroicon-o-play')
                    ->falseIcon('heroicon-o-minus')
                    ->getStateUsing(fn ($record) => !empty($record->youtube_link)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('التصنيف')
                    ->relationship('category', 'name_ar'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('مميز'),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('منشور'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFatwas::route('/'),
            'create' => Pages\CreateFatwa::route('/create'),
            'view' => Pages\ViewFatwa::route('/{record}'),
            'edit' => Pages\EditFatwa::route('/{record}/edit'),
        ];
    }
}
