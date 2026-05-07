<?php

namespace App\Filament\Resources\AiGenerations\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AiGenerationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('type')
                    ->label('Tipe')
                    ->disabled(),
                TextInput::make('model')
                    ->label('Model')
                    ->disabled(),
                TextInput::make('tokens_used')
                    ->label('Token Digunakan')
                    ->disabled(),
                Textarea::make('prompt')
                    ->label('Prompt')
                    ->disabled()
                    ->rows(4)
                    ->columnSpanFull(),
                Textarea::make('result')
                    ->label('Hasil')
                    ->disabled()
                    ->rows(8)
                    ->columnSpanFull(),
            ]);
    }
}
