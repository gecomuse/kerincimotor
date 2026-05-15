<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSettingResource\Pages;
use App\Models\Car;
use App\Models\HeroSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroSettingResource extends Resource
{
    protected static ?string $model           = HeroSetting::class;
    protected static ?string $navigationIcon  = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Hero Banner';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Link ke Unit')
                ->schema([
                    Forms\Components\Select::make('car_id')
                        ->label('Pilih Unit (opsional)')
                        ->options(fn () => Car::where('is_available', true)->orderBy('make_model')->pluck('make_model', 'id'))
                        ->searchable()
                        ->nullable()
                        ->live()
                        ->afterStateUpdated(function ($state, callable $set) {
                            if (! $state) return;
                            $car = Car::find($state);
                            if (! $car) return;
                            $set('card_name', $car->make_model . ' ' . $car->year);
                            $set('card_sub', strtoupper($car->transmission) . ' · ' . number_format($car->mileage, 0, ',', '.') . ' KM · Bebas Laka');
                            $set('card_price', (string) round($car->price / 1000000));
                            $thumb = $car->getFirstMediaUrl('car_images');
                            if ($thumb) $set('image_url', $thumb);
                        })
                        ->helperText('Memilih unit akan mengisi otomatis kolom di bawah.')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Hero Image')
                ->schema([
                    Forms\Components\TextInput::make('image_url')
                        ->label('Image URL')
                        ->url()
                        ->maxLength(2048)
                        ->columnSpanFull()
                        ->placeholder('https://...')
                        ->helperText('Full URL of the hero car image.'),
                ]),

            Forms\Components\Section::make('Car Card Overlay')
                ->schema([
                    Forms\Components\TextInput::make('card_name')
                        ->label('Car Name')
                        ->maxLength(120)
                        ->placeholder('e.g. Honda Brio Satya E CVT'),

                    Forms\Components\TextInput::make('card_sub')
                        ->label('Subtitle')
                        ->maxLength(200)
                        ->placeholder('e.g. 2023 · Automatic · 12.000 KM'),

                    Forms\Components\TextInput::make('card_price')
                        ->label('Price Label')
                        ->maxLength(50)
                        ->placeholder('e.g. 175'),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Active')
                        ->default(true)
                        ->helperText('Only the latest active hero will be displayed.'),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('card_name')
                    ->label('Car Name')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('card_price')
                    ->label('Price'),

                Tables\Columns\TextColumn::make('card_sub')
                    ->label('Subtitle')
                    ->limit(40),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListHeroSettings::route('/'),
            'create' => Pages\CreateHeroSetting::route('/create'),
            'edit'   => Pages\EditHeroSetting::route('/{record}/edit'),
        ];
    }
}
