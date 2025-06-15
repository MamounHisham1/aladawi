<?php

namespace App\Filament\Resources\AudioLectureResource\Pages;

use App\Filament\Resources\AudioLectureResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateAudioLecture extends CreateRecord
{
    protected static string $resource = AudioLectureResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();

        return $data;
    }
}
