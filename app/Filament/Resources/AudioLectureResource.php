<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AudioLectureResource\Pages;
use App\Filament\Resources\AudioLectureResource\RelationManagers;
use App\Models\AudioLecture;
use App\Models\Category;
use App\Models\AudioSeries;
use App\Enums\UserRule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AudioLectureResource extends Resource
{
    protected static ?string $model = AudioLecture::class;

    protected static ?string $navigationIcon = 'heroicon-o-microphone';

    protected static ?string $navigationLabel = 'المحاضرات الصوتية';

    protected static ?string $navigationGroup = 'إدارة المحتوى';

    public static function canViewAny(): bool
    {
        return Auth::user()->canPerform('access-admin');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->canPerform('create-content');
    }

    public static function canEdit($record): bool
    {
        $user = Auth::user();
        return $user->canEditContent($record);
    }

    public static function canDelete($record): bool
    {
        $user = Auth::user();
        return $user->canDeleteContent($record);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        // Content moderators can only see their own content
        if ($user->getRole() === UserRule::CONTENT_MODERATOR) {
            $query->where('created_by', $user->id);
        }

        return $query;
    }

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
                            ->options(Category::where('type', 'audio')->pluck('name_ar', 'id'))
                            ->required(),
                        Forms\Components\Select::make('audio_series_id')
                            ->label('السلسلة الصوتية')
                            ->options(AudioSeries::pluck('title_ar', 'id'))
                            ->nullable(),
                        Forms\Components\Hidden::make('created_by')
                            ->default(Auth::id()),
                    ])->columns(2),

                Forms\Components\Section::make('الوصف والمحتوى')
                    ->schema([
                        Forms\Components\Textarea::make('excerpt_ar')
                            ->label('المقتطف بالعربية')
                            ->rows(3),
                        Forms\Components\Textarea::make('excerpt_en')
                            ->label('المقتطف بالإنجليزية')
                            ->rows(3),
                        Forms\Components\MarkdownEditor::make('description_ar')
                            ->label('الوصف بالعربية')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('description_en')
                            ->label('الوصف بالإنجليزية'),
                    ]),

                Forms\Components\Section::make('تفاصيل المحاضرة')
                    ->schema([
                        Forms\Components\DatePicker::make('lecture_date')
                            ->label('تاريخ المحاضرة'),
                        Forms\Components\TextInput::make('location')
                            ->label('المكان')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('duration_minutes')
                            ->label('المدة (بالدقائق)')
                            ->numeric(),
                        Forms\Components\Select::make('quality')
                            ->label('جودة التسجيل')
                            ->options([
                                'low' => 'منخفضة',
                                'medium' => 'متوسطة',
                                'high' => 'عالية',
                                'hd' => 'عالية الدقة',
                            ]),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TagsInput::make('tags')
                            ->label('الكلمات المفتاحية'),
                    ])->columns(3),

                Forms\Components\Section::make('الإعدادات')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('مميز')
                            ->default(false),
                        Forms\Components\Toggle::make('is_published')
                            ->label('منشور')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('الملف الصوتي')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('audio')
                            ->label('الملف الصوتي')
                            ->collection('audio')
                            ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav'])
                            ->required(),
                    ])->columns(1),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('عنوان SEO')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('وصف SEO')
                            ->rows(3),
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
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('المؤلف')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('audioSeries.title_ar')
                    ->label('السلسلة')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lecture_date')
                    ->label('تاريخ المحاضرة')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_minutes')
                    ->label('المدة')
                    ->suffix(' دقيقة'),
                Tables\Columns\BadgeColumn::make('quality')
                    ->label('الجودة')
                    ->colors([
                        'danger' => 'low',
                        'warning' => 'medium',
                        'success' => 'high',
                        'primary' => 'hd',
                    ]),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('مميز')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('منشور')
                    ->boolean(),
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
                Tables\Filters\SelectFilter::make('audio_series_id')
                    ->label('السلسلة')
                    ->relationship('audioSeries', 'title_ar'),
                Tables\Filters\SelectFilter::make('quality')
                    ->label('الجودة')
                    ->options([
                        'low' => 'منخفضة',
                        'medium' => 'متوسطة',
                        'high' => 'عالية',
                        'hd' => 'عالية الدقة',
                    ]),
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
            'index' => Pages\ListAudioLectures::route('/'),
            'create' => Pages\CreateAudioLecture::route('/create'),
            'view' => Pages\ViewAudioLecture::route('/{record}'),
            'edit' => Pages\EditAudioLecture::route('/{record}/edit'),
        ];
    }
}
