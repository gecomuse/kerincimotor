<?php

namespace App\Filament\Resources\SocialAccounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SocialAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('workspace_id')
                    ->label('Workspace')
                    ->relationship('workspace', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('platform')
                    ->label('Platform')
                    ->options([
                        'instagram' => 'Instagram',
                        'facebook' => 'Facebook',
                        'tiktok' => 'TikTok',
                        'twitter' => 'Twitter / X',
                        'linkedin' => 'LinkedIn',
                        'youtube' => 'YouTube',
                        'meta_ads' => 'Meta Ads',
                        'google_ads' => 'Google Ads',
                    ])
                    ->required(),
                TextInput::make('account_name')
                    ->label('Nama Akun')
                    ->required()
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
