<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'لوحة التحكم';

    protected static ?string $title = 'لوحة التحكم الرئيسية';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    public function getTitle(): string
    {
        return 'لوحة التحكم الرئيسية';
    }

    public function getHeading(): string
    {
        return 'مرحباً بك في لوحة التحكم';
    }
}
