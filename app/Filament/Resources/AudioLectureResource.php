<?php

namespace App\Filament\Resources;

use App\Enums\UserRule;
use App\Filament\Resources\AudioLectureResource\Pages;
use App\Models\AudioLecture;
use App\Models\AudioSeries;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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
                    ->description('أدخل المعلومات الأساسية للمحاضرة الصوتية')
                    ->schema([
                        Forms\Components\TextInput::make('title_ar')
                            ->label('العنوان بالعربية')
                            ->helperText('اكتب عنوان المحاضرة باللغة العربية (مطلوب)')
                            ->placeholder('مثال: شرح كتاب التوحيد - الدرس الأول')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title_en')
                            ->label('العنوان بالإنجليزية')
                            ->helperText('اكتب عنوان المحاضرة باللغة الإنجليزية (اختياري)')
                            ->placeholder('Example: Explanation of Kitab At-Tawheed - Lesson 1')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('الرابط المختصر')
                            ->helperText('رابط مختصر للمحاضرة (سيتم إنشاؤه تلقائياً إذا تُرك فارغاً)')
                            ->placeholder('explanation-kitab-tawheed-lesson-1')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category_id')
                            ->label('التصنيف')
                            ->helperText('اختر التصنيف المناسب للمحاضرة (مطلوب)')
                            ->options(Category::where('type', 'audio')->pluck('name_ar', 'id'))
                            ->required(),
                        Forms\Components\Select::make('audio_series_id')
                            ->label('السلسلة الصوتية')
                            ->helperText('اختر السلسلة التي تنتمي إليها هذه المحاضرة (اختياري)')
                            ->options(AudioSeries::pluck('title_ar', 'id'))
                            ->nullable(),
                        Forms\Components\Hidden::make('created_by')
                            ->default(Auth::id()),
                    ])->columns(2),

                Forms\Components\Section::make('الوصف والمحتوى')
                    ->description('وصف المحاضرة ومحتواها - يمكن استخدام التنسيق المتقدم')
                    ->schema([
                        Forms\Components\Textarea::make('excerpt_ar')
                            ->label('المقتطف بالعربية')
                            ->helperText('ملخص قصير للمحاضرة يظهر في قوائم البحث (اختياري)')
                            ->placeholder('ملخص مختصر عن موضوع المحاضرة...')
                            ->rows(3),
                        Forms\Components\Textarea::make('excerpt_en')
                            ->label('المقتطف بالإنجليزية')
                            ->helperText('ملخص قصير للمحاضرة باللغة الإنجليزية (اختياري)')
                            ->placeholder('Brief summary of the lecture topic...')
                            ->rows(3),
                        Forms\Components\MarkdownEditor::make('description_ar')
                            ->label('الوصف بالعربية')
                            ->helperText('وصف مفصل للمحاضرة ومحتواها باللغة العربية (مطلوب)')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('description_en')
                            ->label('الوصف بالإنجليزية')
                            ->helperText('وصف مفصل للمحاضرة باللغة الإنجليزية (اختياري)'),
                    ]),

                Forms\Components\Section::make('تفاصيل المحاضرة')
                    ->description('معلومات إضافية عن المحاضرة مثل التاريخ والمكان')
                    ->schema([
                        Forms\Components\DatePicker::make('lecture_date')
                            ->label('تاريخ المحاضرة')
                            ->helperText('التاريخ الذي أُلقيت فيه المحاضرة')
                            ->placeholder('تاريخ المحاضرة'),
                        Forms\Components\TextInput::make('location')
                            ->label('المكان')
                            ->helperText('المكان الذي أُلقيت فيه المحاضرة')
                            ->placeholder('مسجد النور، القاهرة')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('duration_minutes')
                            ->label('المدة (بالدقائق)')
                            ->helperText('مدة المحاضرة بالدقائق')
                            ->placeholder('45')
                            ->numeric(),
                        Forms\Components\Select::make('quality')
                            ->label('جودة التسجيل')
                            ->helperText('جودة الملف الصوتي للمحاضرة')
                            ->options([
                                'low' => 'منخفضة',
                                'medium' => 'متوسطة',
                                'high' => 'عالية',
                                'hd' => 'عالية الدقة',
                            ]),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->helperText('رقم لترتيب المحاضرات (الأرقام الأصغر تظهر أولاً)')
                            ->placeholder('0')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TagsInput::make('tags')
                            ->label('الكلمات المفتاحية')
                            ->helperText('كلمات مفتاحية تساعد في البحث (اضغط Enter بعد كل كلمة)')
                            ->placeholder('توحيد، عقيدة، شرح'),
                    ])->columns(3),

                Forms\Components\Section::make('الإعدادات')
                    ->description('إعدادات النشر والعرض')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('مميز')
                            ->helperText('هل تريد إظهار هذه المحاضرة في القسم المميز؟')
                            ->default(false),
                        Forms\Components\Toggle::make('is_published')
                            ->label('منشور')
                            ->helperText('هل تريد نشر هذه المحاضرة على الموقع؟')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('الملف الصوتي')
                    ->description('رفع الملف الصوتي للمحاضرة')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('audio')
                            ->label('الملف الصوتي')
                            ->helperText('ارفع الملف الصوتي للمحاضرة (MP3, WAV) - الحد الأقصى 100 ميجابايت')
                            ->collection('audio')
                            ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav'])
                            ->required(),
                    ])->columns(1),

                Forms\Components\Section::make('SEO')
                    ->description('إعدادات تحسين محركات البحث')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('عنوان SEO')
                            ->helperText('عنوان مخصص لمحركات البحث (سيستخدم العنوان الأساسي إذا تُرك فارغاً)')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('وصف SEO')
                            ->helperText('وصف مختصر يظهر في نتائج البحث (160 حرف أو أقل)')
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
