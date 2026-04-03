<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model           = Setting::class;
    protected static ?string $navigationIcon  = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Settings';
    protected static ?string $navigationGroup = 'Configuration';
    protected static ?int    $navigationSort  = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('key')
                ->required()
                ->disabled()
                ->maxLength(100),

            Forms\Components\TextInput::make('label')
                ->required()
                ->disabled()
                ->maxLength(150),

            Forms\Components\Select::make('type')
                ->options([
                    'text'     => 'Text',
                    'textarea' => 'Textarea',
                    'image'    => 'Image',
                ])
                ->disabled(),

            Forms\Components\Textarea::make('value')
                ->label('Value')
                ->rows(3)
                ->maxLength(65535)
                ->columnSpanFull()
                ->visible(fn (Forms\Get $get) => in_array($get('type'), ['text', 'textarea'])),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->width('200px'),

                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'text',
                        'success' => 'textarea',
                        'warning' => 'image',
                    ]),

                Tables\Columns\TextColumn::make('value')
                    ->limit(60)
                    ->tooltip(fn ($state) => $state),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit Value'),
            ])
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'edit'  => Pages\EditSetting::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }
}
