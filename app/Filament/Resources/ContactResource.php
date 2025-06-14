<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'رسائل التواصل';

    protected static ?string $navigationGroup = 'إدارة الموقع';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات المرسل')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('رقم الهاتف')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subject')
                            ->label('الموضوع')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->label('نوع الرسالة')
                            ->options([
                                'general' => 'عام',
                                'complaint' => 'شكوى',
                                'suggestion' => 'اقتراح',
                                'question' => 'استفسار',
                                'technical' => 'مشكلة تقنية',
                            ])
                            ->default('general'),
                    ])->columns(2),

                Forms\Components\Section::make('محتوى الرسالة')
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->label('الرسالة')
                            ->required()
                            ->rows(5),
                    ]),

                Forms\Components\Section::make('الرد الإداري')
                    ->schema([
                        Forms\Components\Textarea::make('admin_reply')
                            ->label('رد الإدارة')
                            ->rows(4),
                        Forms\Components\Toggle::make('is_read')
                            ->label('تم القراءة')
                            ->default(false),
                        Forms\Components\Toggle::make('is_replied')
                            ->label('تم الرد')
                            ->default(false),
                        Forms\Components\DateTimePicker::make('replied_at')
                            ->label('تاريخ الرد'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('البريد الإلكتروني')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('الموضوع')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('النوع')
                    ->colors([
                        'primary' => 'general',
                        'danger' => 'complaint',
                        'success' => 'suggestion',
                        'warning' => 'question',
                        'gray' => 'technical',
                    ]),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('مقروءة')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_replied')
                    ->label('تم الرد')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإرسال')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('replied_at')
                    ->label('تاريخ الرد')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('نوع الرسالة')
                    ->options([
                        'general' => 'عام',
                        'complaint' => 'شكوى',
                        'suggestion' => 'اقتراح',
                        'question' => 'استفسار',
                        'technical' => 'مشكلة تقنية',
                    ]),
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('مقروءة'),
                Tables\Filters\TernaryFilter::make('is_replied')
                    ->label('تم الرد'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('markAsRead')
                    ->label('تحديد كمقروءة')
                    ->icon('heroicon-o-eye')
                    ->action(fn (Contact $record) => $record->markAsRead())
                    ->visible(fn (Contact $record) => !$record->is_read),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('markAsRead')
                        ->label('تحديد كمقروءة')
                        ->icon('heroicon-o-eye')
                        ->action(fn ($records) => $records->each->markAsRead()),
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
            'index' => Pages\ListContacts::route('/'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
