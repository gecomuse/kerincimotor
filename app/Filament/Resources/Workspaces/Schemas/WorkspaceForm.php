<?php

namespace App\Filament\Resources\Workspaces\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class WorkspaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Workspace')
                    ->required()
                    ->maxLength(255),
                Select::make('industry')
                    ->label('Industri')
                    ->options([
                        'kuliner' => 'Kuliner',
                        'fashion' => 'Fashion',
                        'kecantikan' => 'Kecantikan',
                        'otomotif' => 'Otomotif',
                        'teknologi' => 'Teknologi',
                        'properti' => 'Properti',
                        'lainnya' => 'Lainnya',
                    ])
                    ->placeholder('Pilih industri'),
                Textarea::make('brand_voice')
                    ->label('Brand Voice')
                    ->hint('Deskripsikan tone brand, contoh: friendly dan informatif')
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->nullable(),
            ]);
    }
}
