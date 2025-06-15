<?php

namespace App\Filament\Resources;

use App\Enums\UserRule;
use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'المقالات';

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
                    ->description('أدخل المعلومات الأساسية للمقال مثل العنوان والتصنيف')
                    ->schema([
                        Forms\Components\TextInput::make('title_ar')
                            ->label('العنوان بالعربية')
                            ->helperText('اكتب عنوان المقال باللغة العربية (مطلوب)')
                            ->placeholder('مثال: آداب طلب العلم في الإسلام')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title_en')
                            ->label('العنوان بالإنجليزية')
                            ->helperText('اكتب عنوان المقال باللغة الإنجليزية (اختياري)')
                            ->placeholder('Example: Etiquette of Seeking Knowledge in Islam')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('الرابط المختصر')
                            ->helperText('رابط مختصر للمقال (سيتم إنشاؤه تلقائياً إذا تُرك فارغاً)')
                            ->placeholder('etiquette-seeking-knowledge-islam')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category_id')
                            ->label('التصنيف')
                            ->helperText('اختر التصنيف المناسب للمقال (مطلوب)')
                            ->options(Category::where('type', 'article')->pluck('name_ar', 'id'))
                            ->required(),
                        Forms\Components\TextInput::make('author_name')
                            ->label('اسم الكاتب')
                            ->helperText('اسم كاتب المقال (إذا كان غير المستخدم الحالي)')
                            ->placeholder('الشيخ مصطفى العدوي')
                            ->maxLength(255),
                        Forms\Components\Hidden::make('created_by')
                            ->default(Auth::id()),
                    ])->columns(2),

                Forms\Components\Section::make('المحتوى')
                    ->description('محتوى المقال - يمكن استخدام التنسيق المتقدم')
                    ->schema([
                        Forms\Components\Textarea::make('excerpt_ar')
                            ->label('المقتطف بالعربية')
                            ->helperText('ملخص قصير للمقال يظهر في قوائم البحث (اختياري)')
                            ->placeholder('ملخص مختصر عن موضوع المقال...')
                            ->rows(3),
                        Forms\Components\Textarea::make('excerpt_en')
                            ->label('المقتطف بالإنجليزية')
                            ->helperText('ملخص قصير للمقال باللغة الإنجليزية (اختياري)')
                            ->placeholder('Brief summary of the article topic...')
                            ->rows(3),
                        Forms\Components\MarkdownEditor::make('content_ar')
                            ->label('المحتوى بالعربية')
                            ->helperText('النص الكامل للمقال باللغة العربية (مطلوب)')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('content_en')
                            ->label('المحتوى بالإنجليزية')
                            ->helperText('النص الكامل للمقال باللغة الإنجليزية (اختياري)'),
                    ]),

                Forms\Components\Section::make('الإعدادات')
                    ->description('إعدادات النشر والعرض')
                    ->schema([
                        Forms\Components\DatePicker::make('published_at')
                            ->label('تاريخ النشر')
                            ->helperText('التاريخ الذي تريد نشر المقال فيه (اتركه فارغاً للنشر الفوري)'),
                        Forms\Components\TextInput::make('reading_time')
                            ->label('وقت القراءة (بالدقائق)')
                            ->helperText('الوقت المتوقع لقراءة المقال بالدقائق')
                            ->placeholder('5')
                            ->numeric(),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->helperText('رقم لترتيب المقالات (الأرقام الأصغر تظهر أولاً)')
                            ->placeholder('0')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TagsInput::make('tags')
                            ->label('الكلمات المفتاحية')
                            ->helperText('كلمات مفتاحية تساعد في البحث (اضغط Enter بعد كل كلمة)')
                            ->placeholder('علم، آداب، إسلام'),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('مميز')
                            ->helperText('هل تريد إظهار هذا المقال في القسم المميز؟')
                            ->default(false),
                        Forms\Components\Toggle::make('is_published')
                            ->label('منشور')
                            ->helperText('هل تريد نشر هذا المقال على الموقع؟')
                            ->default(true),
                    ])->columns(3),

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
                    ->label('المنشئ')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('author_name')
                    ->label('الكاتب')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reading_time')
                    ->label('وقت القراءة')
                    ->suffix(' دقيقة'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('مميز')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('منشور')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('تاريخ النشر')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
