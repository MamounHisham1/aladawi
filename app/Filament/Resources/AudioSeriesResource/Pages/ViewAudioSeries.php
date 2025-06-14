<?php

namespace App\Filament\Resources\AudioSeriesResource\Pages;

use App\Filament\Resources\AudioSeriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAudioSeries extends ViewRecord
{
    protected static string $resource = AudioSeriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
} 