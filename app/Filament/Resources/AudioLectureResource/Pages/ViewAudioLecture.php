<?php

namespace App\Filament\Resources\AudioLectureResource\Pages;

use App\Filament\Resources\AudioLectureResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAudioLecture extends ViewRecord
{
    protected static string $resource = AudioLectureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
} 