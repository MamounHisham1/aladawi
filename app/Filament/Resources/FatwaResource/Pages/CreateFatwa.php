<?php

namespace App\Filament\Resources\FatwaResource\Pages;

use App\Filament\Resources\FatwaResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateFatwa extends CreateRecord
{
    protected static string $resource = FatwaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();

        return $data;
    }
}
