<?php

namespace App\Filament\Resources\AiGenerations;

use App\Filament\Resources\AiGenerations\Pages\ListAiGenerations;
use App\Filament\Resources\AiGenerations\Pages\ViewAiGeneration;
use App\Filament\Resources\AiGenerations\Schemas\AiGenerationForm;
use App\Filament\Resources\AiGenerations\Tables\AiGenerationsTable;
use App\Models\AiGeneration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AiGenerationResource extends Resource
{
    protected static ?string $model = AiGeneration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Log AI';

    protected static ?string $modelLabel = 'Generasi AI';

    protected static ?string $pluralModelLabel = 'Log Generasi AI';

    public static function form(Schema $schema): Schema
    {
        return AiGenerationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AiGenerationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAiGenerations::route('/'),
            'view' => ViewAiGeneration::route('/{record}'),
        ];
    }
}
