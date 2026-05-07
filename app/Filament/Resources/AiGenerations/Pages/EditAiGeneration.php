<?php

namespace App\Filament\Resources\AiGenerations\Pages;

use App\Filament\Resources\AiGenerations\AiGenerationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAiGeneration extends EditRecord
{
    protected static string $resource = AiGenerationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
