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
            Forms\Components\Toggle::make('is_active')
                ->label('Aktif (tampilkan di homepage)')
                ->default(true)
                ->columnSpanFull(),

            Forms\Components\Section::make('Unit yang Ditampilkan di Hero Banner')
                ->description('Pilih unit — data kartu terisi otomatis. Bisa diedit manual di bawah.')
                ->schema([
                    Forms\Components\Select::make('car_id')
                        ->label('Pilih Unit')
                        ->options(fn () => Car::where('is_available', true)
                            ->orderBy('make_model')
                            ->get()
                            ->mapWithKeys(fn ($car) => [
                                $car->id => $car->make_model . ' ' . $car->year . ' — Rp ' . round($car->price / 1000000) . 'jt',
                            ])
                            ->toArray())
                        ->searchable()
                        ->nullable()
                        ->live()
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                            if (! $state) return;
                            $car = Car::find($state);
                            if (! $car) return;
                            $set('card_name', $car->make_model . ' ' . $car->year);
                            $set('card_sub', strtoupper($car->transmission) . ' · ' . number_format($car->mileage, 0, ',', '.') . ' KM · Bebas Laka');
                            $set('card_price', 'Rp ' . round($car->price / 1000000) . 'jt');
                            $thumb = $car->getFirstMediaUrl('car_images');
                            $set('image_url', $thumb ?: '');
                        })
                        ->helperText('Memilih unit mengisi otomatis nama, sub, harga, dan gambar.')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Override Manual (opsional)')
                ->description('Edit langsung jika ingin teks atau gambar berbeda dari data unit.')
                ->schema([
                    Forms\Components\TextInput::make('image_url')
                        ->label('URL Gambar Hero')
                        ->nullable()
                        ->maxLength(2048)
                        ->columnSpanFull()
                        ->placeholder('https://... atau kosongkan jika pakai gambar unit'),

                    Forms\Components\TextInput::make('card_name')
                        ->label('Nama Unit di Kartu')
                        ->maxLength(120)
                        ->nullable()
                        ->placeholder('e.g. Honda Brio Satya E CVT 2022'),

                    Forms\Components\TextInput::make('card_sub')
                        ->label('Sub-teks')
                        ->maxLength(200)
                        ->nullable()
                        ->placeholder('e.g. AUTOMATIC · 18.500 KM · Bebas Laka'),

                    Forms\Components\TextInput::make('card_price')
                        ->label('Harga')
                        ->maxLength(50)
                        ->nullable()
                        ->placeholder('e.g. Rp 175jt'),
                ])
                ->columns(2),

            Forms\Components\Section::make('Simulasi Cicilan — Unit Unggulan')
                ->description('Unit ini ditampilkan di kalkulator kredit dan harganya terisi otomatis.')
                ->schema([
                    Forms\Components\Select::make('financing_car_id')
                        ->label('Unit untuk Simulasi Cicilan')
                        ->options(fn () => Car::where('is_available', true)
                            ->orderBy('make_model')
                            ->get()
                            ->mapWithKeys(fn ($car) => [
                                $car->id => $car->make_model . ' ' . $car->year . ' — Rp ' . round($car->price / 1000000) . 'jt',
                            ])
                            ->toArray())
                        ->searchable()
                        ->nullable()
                        ->helperText('Kosongkan untuk tampilkan form cicilan generik.')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('card_name')
                    ->label('Unit')
                    ->searchable()
                    ->weight('bold')
                    ->default('—'),

                Tables\Columns\TextColumn::make('card_price')
                    ->label('Harga')
                    ->default('—'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->since()
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
