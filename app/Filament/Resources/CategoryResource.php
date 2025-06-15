<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'التصنيفات';

    protected static ?string $navigationGroup = 'إدارة المحتوى';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات التصنيف')
                    ->description('أدخل معلومات التصنيف الجديد - التصنيفات تساعد في تنظيم المحتوى')
                    ->schema([
                        Forms\Components\TextInput::make('name_ar')
                            ->label('الاسم بالعربية')
                            ->helperText('اسم التصنيف باللغة العربية (مطلوب)')
                            ->placeholder('مثال: الفقه، العقيدة، السيرة')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name_en')
                            ->label('الاسم بالإنجليزية')
                            ->helperText('اسم التصنيف باللغة الإنجليزية (اختياري)')
                            ->placeholder('Example: Fiqh, Aqeedah, Biography')
                            ->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->label('النوع')
                            ->helperText('نوع المحتوى الذي سيندرج تحت هذا التصنيف (مطلوب)')
                            ->options([
                                'general' => 'عام',
                                'fatwa' => 'فتاوى',
                                'audio' => 'صوتيات',
                                'book' => 'كتب',
                                'article' => 'مقالات',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('description_ar')
                            ->label('الوصف بالعربية')
                            ->helperText('وصف مختصر للتصنيف باللغة العربية (اختياري)')
                            ->placeholder('وصف ما يحتويه هذا التصنيف...')
                            ->rows(3),
                        Forms\Components\Textarea::make('description_en')
                            ->label('الوصف بالإنجليزية')
                            ->helperText('وصف مختصر للتصنيف باللغة الإنجليزية (اختياري)')
                            ->placeholder('Description of what this category contains...')
                            ->rows(3),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->helperText('رقم لترتيب التصنيفات (الأرقام الأصغر تظهر أولاً)')
                            ->placeholder('0')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('نشط')
                            ->helperText('هل تريد تفعيل هذا التصنيف ليظهر في الموقع؟')
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_en')
                    ->label('الاسم بالإنجليزية')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('النوع')
                    ->colors([
                        'primary' => 'general',
                        'success' => 'fatwa',
                        'warning' => 'audio',
                        'danger' => 'book',
                        'gray' => 'article',
                    ]),
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
                Tables\Filters\SelectFilter::make('type')
                    ->label('النوع')
                    ->options([
                        'general' => 'عام',
                        'fatwa' => 'فتاوى',
                        'audio' => 'صوتيات',
                        'book' => 'كتب',
                        'article' => 'مقالات',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('نشط'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
