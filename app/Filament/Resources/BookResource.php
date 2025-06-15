<?php

namespace App\Filament\Resources;

use App\Enums\UserRule;
use App\Filament\Resources\BookResource\Pages;
use App\Models\Book;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'الكتب';

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
                    ->description('أدخل المعلومات الأساسية للكتاب مثل العنوان والتصنيف')
                    ->schema([
                        Forms\Components\TextInput::make('title_ar')
                            ->label('العنوان بالعربية')
                            ->helperText('اكتب عنوان الكتاب باللغة العربية (مطلوب)')
                            ->placeholder('مثال: الجامع لأحكام النساء')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title_en')
                            ->label('العنوان بالإنجليزية')
                            ->helperText('اكتب عنوان الكتاب باللغة الإنجليزية (اختياري)')
                            ->placeholder('Example: Comprehensive Guide to Women\'s Rulings')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('الرابط المختصر')
                            ->helperText('رابط مختصر للكتاب (سيتم إنشاؤه تلقائياً إذا تُرك فارغاً)')
                            ->placeholder('comprehensive-guide-womens-rulings')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category_id')
                            ->label('التصنيف')
                            ->helperText('اختر التصنيف المناسب للكتاب (مطلوب)')
                            ->options(Category::where('type', 'book')->pluck('name_ar', 'id'))
                            ->required(),
                        Forms\Components\Hidden::make('created_by')
                            ->default(Auth::id()),
                    ])->columns(2),

                Forms\Components\Section::make('معلومات المؤلف والناشر')
                    ->description('معلومات المؤلف ودار النشر (جميع الحقول اختيارية)')
                    ->schema([
                        Forms\Components\TextInput::make('author_ar')
                            ->label('المؤلف بالعربية')
                            ->helperText('اسم مؤلف الكتاب باللغة العربية')
                            ->placeholder('الشيخ مصطفى العدوي')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('author_en')
                            ->label('المؤلف بالإنجليزية')
                            ->helperText('اسم مؤلف الكتاب باللغة الإنجليزية')
                            ->placeholder('Sheikh Mustafa Al-Adawi')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('publisher_ar')
                            ->label('الناشر بالعربية')
                            ->helperText('اسم دار النشر باللغة العربية')
                            ->placeholder('دار الكتاب والسنة')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('publisher_en')
                            ->label('الناشر بالإنجليزية')
                            ->helperText('اسم دار النشر باللغة الإنجليزية')
                            ->placeholder('Dar Al-Kitab wa As-Sunnah')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('publication_year')
                            ->label('سنة النشر')
                            ->helperText('السنة التي نُشر فيها الكتاب')
                            ->placeholder('2023')
                            ->numeric(),
                        Forms\Components\TextInput::make('isbn')
                            ->label('ISBN')
                            ->helperText('الرقم الدولي المعياري للكتاب (إن وُجد)')
                            ->placeholder('978-977-123-456-7')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('الوصف والمحتوى')
                    ->description('وصف الكتاب ومحتواه - يمكن استخدام التنسيق المتقدم')
                    ->schema([
                        Forms\Components\Textarea::make('excerpt_ar')
                            ->label('المقتطف بالعربية')
                            ->helperText('ملخص قصير للكتاب يظهر في قوائم البحث (اختياري)')
                            ->placeholder('ملخص مختصر عن محتوى الكتاب...')
                            ->rows(3),
                        Forms\Components\Textarea::make('excerpt_en')
                            ->label('المقتطف بالإنجليزية')
                            ->helperText('ملخص قصير للكتاب باللغة الإنجليزية (اختياري)')
                            ->placeholder('Brief summary of the book content...')
                            ->rows(3),
                        Forms\Components\MarkdownEditor::make('description_ar')
                            ->label('الوصف بالعربية')
                            ->helperText('وصف مفصل للكتاب ومحتواه باللغة العربية (مطلوب)')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('description_en')
                            ->label('الوصف بالإنجليزية')
                            ->helperText('وصف مفصل للكتاب باللغة الإنجليزية (اختياري)'),
                    ]),

                Forms\Components\Section::make('تفاصيل إضافية')
                    ->description('معلومات إضافية عن الكتاب')
                    ->schema([
                        Forms\Components\TextInput::make('pages')
                            ->label('عدد الصفحات')
                            ->helperText('العدد الإجمالي لصفحات الكتاب')
                            ->placeholder('350')
                            ->numeric(),
                        Forms\Components\Select::make('language')
                            ->label('اللغة')
                            ->helperText('لغة الكتاب الأساسية')
                            ->options([
                                'ar' => 'العربية',
                                'en' => 'الإنجليزية',
                                'both' => 'العربية والإنجليزية',
                            ]),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->helperText('رقم لترتيب الكتب (الأرقام الأصغر تظهر أولاً)')
                            ->placeholder('0')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TagsInput::make('tags')
                            ->label('الكلمات المفتاحية')
                            ->helperText('كلمات مفتاحية تساعد في البحث (اضغط Enter بعد كل كلمة)')
                            ->placeholder('فقه، أحكام، نساء'),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('مميز')
                            ->helperText('هل تريد إظهار هذا الكتاب في القسم المميز؟')
                            ->default(false),
                        Forms\Components\Toggle::make('is_published')
                            ->label('منشور')
                            ->helperText('هل تريد نشر هذا الكتاب على الموقع؟')
                            ->default(true),
                    ])->columns(3),

                Forms\Components\Section::make('الملفات والصور')
                    ->description('رفع صورة الغلاف وملفات الكتاب')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('cover_image')
                            ->label('صورة الغلاف')
                            ->helperText('ارفع صورة غلاف الكتاب (JPG, PNG) - الحد الأقصى 2 ميجابايت')
                            ->collection('cover_image')
                            ->image()
                            ->imageEditor(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('book_files')
                            ->label('ملفات الكتاب')
                            ->helperText('ارفع ملفات الكتاب (PDF, DOC, DOCX) - يمكن رفع عدة ملفات')
                            ->collection('book_files')
                            ->multiple()
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']),
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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover_image')
                    ->label('الغلاف')
                    ->collection('cover_image')
                    ->conversion('thumb'),
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
                Tables\Columns\TextColumn::make('author_ar')
                    ->label('المؤلف')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_year')
                    ->label('سنة النشر')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pages')
                    ->label('الصفحات'),
                Tables\Columns\TextColumn::make('download_count')
                    ->label('التحميلات')
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('language')
                    ->label('اللغة')
                    ->options([
                        'ar' => 'العربية',
                        'en' => 'الإنجليزية',
                        'both' => 'العربية والإنجليزية',
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'view' => Pages\ViewBook::route('/{record}'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
