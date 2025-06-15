<?php

namespace App\Filament\Resources\AudioLectureResource\Pages;

use App\Filament\Resources\AudioLectureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditAudioLecture extends EditRecord
{
    protected static string $resource = AudioLectureResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];
        
        if (Auth::user()->canDeleteContent($this->record)) {
            $actions[] = Actions\DeleteAction::make();
        }
        
        return $actions;
    }

    protected function authorizeAccess(): void
    {
        if (!Auth::user()->canEditContent($this->record)) {
            abort(403, 'ليس لديك صلاحية لتعديل هذا المحتوى');
        }
    }
}
