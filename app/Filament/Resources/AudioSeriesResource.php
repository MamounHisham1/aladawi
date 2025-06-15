<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AudioSeriesResource\Pages;
use App\Models\AudioSeries;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AudioSeriesResource extends Resource
{
    protected static ?string $model = AudioSeries::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationLabel = 'السلاسل الصوتية';

    protected static ?string $navigationGroup = 'إدارة المحتوى';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('المعلومات الأساسية')
                    ->description('أدخل معلومات السلسلة الصوتية الجديدة')
                    ->schema([
                        Forms\Components\TextInput::make('name_ar')
                            ->label('الاسم بالعربية')
                            ->helperText('اكتب اسم السلسلة الصوتية باللغة العربية (مطلوب)')
                            ->placeholder('مثال: شرح كتاب التوحيد')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name_en')
                            ->label('الاسم بالإنجليزية')
                            ->helperText('اكتب اسم السلسلة الصوتية باللغة الإنجليزية (اختياري)')
                            ->placeholder('Example: Explanation of Kitab At-Tawheed')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('الرابط المختصر')
                            ->helperText('رابط مختصر للسلسلة (سيتم إنشاؤه تلقائياً إذا تُرك فارغاً)')
                            ->placeholder('explanation-kitab-tawheed')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                    ])->columns(2),

                Forms\Components\Section::make('الوصف')
                    ->description('وصف السلسلة الصوتية ومحتواها - يمكن استخدام التنسيق المتقدم')
                    ->schema([
                        Forms\Components\MarkdownEditor::make('description_ar')
                            ->label('الوصف بالعربية')
                            ->helperText('وصف مفصل للسلسلة الصوتية ومحتواها باللغة العربية (مطلوب)')
                            ->required(),
                        Forms\Components\MarkdownEditor::make('description_en')
                            ->label('الوصف بالإنجليزية')
                            ->helperText('وصف مفصل للسلسلة الصوتية باللغة الإنجليزية (اختياري)'),
                    ]),

                Forms\Components\Section::make('الإعدادات')
                    ->description('إعدادات العرض والتفعيل')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->helperText('رقم لترتيب السلاسل الصوتية (الأرقام الأصغر تظهر أولاً)')
                            ->placeholder('0')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('نشط')
                            ->helperText('هل تريد تفعيل هذه السلسلة لتظهر في الموقع؟')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_ar')
                    ->label('الاسم بالعربية')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name_en')
                    ->label('الاسم بالإنجليزية')
                    ->searchable(),
                Tables\Columns\TextColumn::make('audioLectures_count')
                    ->label('عدد المحاضرات')
                    ->counts('audioLectures')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('ترتيب العرض')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('نشط'),
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
            ->defaultSort('sort_order');
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
            'index' => Pages\ListAudioSeries::route('/'),
            'create' => Pages\CreateAudioSeries::route('/create'),
            'view' => Pages\ViewAudioSeries::route('/{record}'),
            'edit' => Pages\EditAudioSeries::route('/{record}/edit'),
        ];
    }
}
