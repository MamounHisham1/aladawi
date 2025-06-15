<?php

namespace App\Filament\Resources\FatwaResource\Pages;

use App\Filament\Resources\FatwaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditFatwa extends EditRecord
{
    protected static string $resource = FatwaResource::class;

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
        if (! Auth::user()->canEditContent($this->record)) {
            abort(403, 'ليس لديك صلاحية لتعديل هذا المحتوى');
        }
    }
}
