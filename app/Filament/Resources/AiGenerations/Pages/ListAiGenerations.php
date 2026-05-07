<?php

namespace App\Filament\Resources\AiGenerations\Pages;

use App\Filament\Resources\AiGenerations\AiGenerationResource;
use Filament\Resources\Pages\ListRecords;

class ListAiGenerations extends ListRecords
{
    protected static string $resource = AiGenerationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
