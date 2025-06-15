<?php

namespace App\Filament\Resources;

use App\Enums\UserRule;
use App\Filament\Resources\FatwaResource\Pages;
use App\Models\Category;
use App\Models\Fatwa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class FatwaResource extends Resource
{
    protected static ?string $model = Fatwa::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'الفتاوى';

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
                    ->description('أدخل المعلومات الأساسية للفتوى مثل العنوان والتصنيف')
                    ->schema([
                        Forms\Components\TextInput::make('title_ar')
                            ->label('العنوان بالعربية')
                            ->helperText('اكتب عنوان الفتوى باللغة العربية (مطلوب)')
                            ->placeholder('مثال: حكم الصلاة في المسجد الحرام')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title_en')
                            ->label('العنوان بالإنجليزية')
                            ->helperText('اكتب عنوان الفتوى باللغة الإنجليزية (اختياري)')
                            ->placeholder('Example: Ruling on praying in the Grand Mosque')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('الرابط المختصر')
                            ->helperText('رابط مختصر للفتوى (سيتم إنشاؤه تلقائياً إذا تُرك فارغاً)')
                            ->placeholder('ruling-on-prayer-in-grand-mosque')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category_id')
                            ->label('التصنيف')
                            ->helperText('اختر التصنيف المناسب للفتوى (مطلوب)')
                            ->options(Category::where('type', 'fatwa')->pluck('name_ar', 'id'))
                            ->required(),
                        Forms\Components\Hidden::make('created_by')
                            ->default(Auth::id()),
                    ])->columns(2),

                Forms\Components\Section::make('معلومات السائل')
                    ->description('معلومات الشخص الذي طرح السؤال (جميع الحقول اختيارية)')
                    ->schema([
                        Forms\Components\TextInput::make('questioner_name')
                            ->label('اسم السائل')
                            ->helperText('اسم الشخص الذي طرح السؤال')
                            ->placeholder('أحمد محمد')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('questioner_location')
                            ->label('مكان السائل')
                            ->helperText('المدينة أو البلد الذي يقيم فيه السائل')
                            ->placeholder('القاهرة، مصر')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('fatwa_date')
                            ->label('تاريخ الفتوى')
                            ->helperText('التاريخ الذي أُجيب فيه على السؤال'),
                    ])->columns(3),

                Forms\Components\Section::make('السؤال والجواب')
                    ->description('محتوى السؤال والإجابة - يمكن استخدام التنسيق المتقدم')
                    ->schema([
                        Forms\Components\Textarea::make('excerpt_ar')
                            ->label('المقتطف بالعربية')
                            ->helperText('ملخص قصير للفتوى يظهر في قوائم البحث (اختياري)')
                            ->placeholder('ملخص مختصر عن موضوع الفتوى...')
                            ->rows(3),
                        Forms\Components\Textarea::make('excerpt_en')
                            ->label('المقتطف بالإنجليزية')
                            ->helperText('ملخص قصير للفتوى باللغة الإنجليزية (اختياري)')
                            ->placeholder('Brief summary of the fatwa topic...')
                            ->rows(3),
                        Forms\Components\MarkdownEditor::make('question_ar')
                            ->label('السؤال بالعربية')
                            ->helperText('نص السؤال كاملاً باللغة العربية (مطلوب)')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('question_en')
                            ->label('السؤال بالإنجليزية')
                            ->helperText('نص السؤال باللغة الإنجليزية (اختياري)'),
                        Forms\Components\MarkdownEditor::make('answer_ar')
                            ->label('الجواب بالعربية')
                            ->helperText('الإجابة الكاملة على السؤال باللغة العربية (مطلوب)')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('answer_en')
                            ->label('الجواب بالإنجليزية')
                            ->helperText('الإجابة باللغة الإنجليزية (اختياري)'),
                    ]),

                Forms\Components\Section::make('الإعدادات')
                    ->description('إعدادات النشر والعرض')
                    ->schema([
                        Forms\Components\TagsInput::make('tags')
                            ->label('الكلمات المفتاحية')
                            ->helperText('كلمات مفتاحية تساعد في البحث (اضغط Enter بعد كل كلمة)')
                            ->placeholder('صلاة، حج، زكاة'),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('مميز')
                            ->helperText('هل تريد إظهار هذه الفتوى في القسم المميز؟')
                            ->default(false),
                        Forms\Components\Toggle::make('is_published')
                            ->label('منشور')
                            ->helperText('هل تريد نشر هذه الفتوى على الموقع؟')
                            ->default(true),
                    ])->columns(3),

                Forms\Components\Section::make('SEO وفيديو يوتيوب')
                    ->description('إعدادات تحسين محركات البحث ورابط فيديو يوتيوب')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('عنوان SEO')
                            ->helperText('عنوان مخصص لمحركات البحث (سيستخدم العنوان الأساسي إذا تُرك فارغاً)')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('وصف SEO')
                            ->helperText('وصف مختصر يظهر في نتائج البحث (160 حرف أو أقل)')
                            ->rows(3),
                        Forms\Components\TextInput::make('youtube_link')
                            ->label('رابط اليوتيوب')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->helperText('رابط فيديو اليوتيوب المرتبط بالفتوى (اختياري) - انسخ الرابط كاملاً من يوتيوب')
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
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('المؤلف')
                    ->sortable()
                    ->toggleable(),
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
                    ->getStateUsing(fn ($record) => ! empty($record->youtube_link)),
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
