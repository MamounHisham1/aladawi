<?php

namespace App\Filament\Resources;

use App\Enums\UserRule;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'المستخدمون';

    protected static ?string $navigationGroup = 'إدارة النظام';

    public static function canViewAny(): bool
    {
        return Auth::user()->canPerform('manage-users');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->canPerform('manage-users');
    }

    public static function canEdit($record): bool
    {
        $user = Auth::user();

        // Super admins can edit anyone
        if ($user->hasRole(UserRule::SUPER_ADMIN)) {
            return true;
        }

        // Admins can edit users with lower roles
        if ($user->hasRole(UserRule::ADMIN)) {
            return ! in_array($record->getRole(), [UserRule::SUPER_ADMIN, UserRule::ADMIN]);
        }

        return false;
    }

    public static function canDelete($record): bool
    {
        $user = Auth::user();

        // Can't delete yourself
        if ($user->id === $record->id) {
            return false;
        }

        // Super admins can delete anyone except other super admins
        if ($user->hasRole(UserRule::SUPER_ADMIN)) {
            return ! $record->hasRole(UserRule::SUPER_ADMIN);
        }

        // Admins can delete users with lower roles
        if ($user->hasRole(UserRule::ADMIN)) {
            return ! in_array($record->getRole(), [UserRule::SUPER_ADMIN, UserRule::ADMIN]);
        }

        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات المستخدم')
                    ->description('المعلومات الأساسية للمستخدم')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('الاسم')
                            ->helperText('الاسم الكامل للمستخدم (مطلوب)')
                            ->placeholder('أحمد محمد علي')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->helperText('عنوان البريد الإلكتروني للمستخدم (مطلوب وفريد)')
                            ->placeholder('user@example.com')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('password')
                            ->label('كلمة المرور')
                            ->helperText('كلمة مرور قوية للمستخدم (مطلوبة عند الإنشاء فقط)')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                    ])->columns(2),

                Forms\Components\Section::make('الصلاحيات')
                    ->description('دور المستخدم وصلاحياته في النظام')
                    ->schema([
                        Forms\Components\Select::make('rule')
                            ->label('الدور')
                            ->helperText('اختر دور المستخدم في النظام - كل دور له صلاحيات مختلفة')
                            ->options(function () {
                                $user = Auth::user();
                                $options = [];

                                foreach (UserRule::cases() as $role) {
                                    // Show roles that current user can assign
                                    if (in_array($role, $user->getRole()->getAssignableRoles()) || $user->hasRole(UserRule::SUPER_ADMIN)) {
                                        $options[$role->value] = $role->getDisplayName().' - '.$role->getDescription();
                                    }
                                }

                                return $options;
                            })
                            ->required()
                            ->default(UserRule::USER->value),
                    ])->columns(1),
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
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('rule')
                    ->label('الدور')
                    ->formatStateUsing(fn (UserRule $state): string => $state->getDisplayName())
                    ->colors([
                        'danger' => UserRule::SUPER_ADMIN->value,
                        'warning' => UserRule::ADMIN->value,
                        'success' => UserRule::SUPER_MODERATOR->value,
                        'primary' => UserRule::MODERATOR->value,
                        'info' => UserRule::CONTENT_MODERATOR->value,
                        'secondary' => UserRule::USER->value,
                    ]),
                Tables\Columns\TextColumn::make('fatwas_count')
                    ->label('الفتاوى')
                    ->counts('fatwas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('audioLectures_count')
                    ->label('المحاضرات')
                    ->counts('audioLectures')
                    ->sortable(),
                Tables\Columns\TextColumn::make('books_count')
                    ->label('الكتب')
                    ->counts('books')
                    ->sortable(),
                Tables\Columns\TextColumn::make('articles_count')
                    ->label('المقالات')
                    ->counts('articles')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rule')
                    ->label('الدور')
                    ->options([
                        UserRule::SUPER_ADMIN->value => UserRule::SUPER_ADMIN->getDisplayName(),
                        UserRule::ADMIN->value => UserRule::ADMIN->getDisplayName(),
                        UserRule::SUPER_MODERATOR->value => UserRule::SUPER_MODERATOR->getDisplayName(),
                        UserRule::MODERATOR->value => UserRule::MODERATOR->getDisplayName(),
                        UserRule::CONTENT_MODERATOR->value => UserRule::CONTENT_MODERATOR->getDisplayName(),
                        UserRule::USER->value => UserRule::USER->getDisplayName(),
                    ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
