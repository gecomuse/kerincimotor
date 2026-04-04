<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;
    protected static ?string $navigationIcon  = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Vehicles';
    protected static ?string $navigationGroup = 'Inventory';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Vehicle Information')
                ->schema([
                    Forms\Components\TextInput::make('make_model')
                        ->label('Make & Model')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('e.g. Honda Jazz RS')
                        ->columnSpanFull(),

                    Forms\Components\Select::make('body_type')
                        ->label('Body Type')
                        ->required()
                        ->options([
                            'sedan'     => 'Sedan',
                            'suv'       => 'SUV',
                            'mpv'       => 'MPV',
                            'city_car'  => 'City Car',
                            'hatchback' => 'Hatchback',
                            'pickup'    => 'Pickup',
                            'minibus'   => 'Minibus',
                            'jeep'      => 'Jeep',
                            'van'       => 'Van',
                        ]),

                    Forms\Components\TextInput::make('year')
                        ->label('Production Year')
                        ->required()
                        ->numeric()
                        ->minValue(1990)
                        ->maxValue(date('Y') + 1),

                    Forms\Components\TextInput::make('price')
                        ->label('Price (IDR)')
                        ->required()
                        ->numeric()
                        ->prefix('Rp')
                        ->placeholder('145000000'),

                    Forms\Components\TextInput::make('mileage')
                        ->label('Mileage (KM)')
                        ->required()
                        ->numeric()
                        ->suffix('KM'),

                    Forms\Components\Select::make('transmission')
                        ->label('Transmission')
                        ->required()
                        ->options([
                            'manual'    => 'Manual',
                            'automatic' => 'Automatic',
                        ]),

                    Forms\Components\Select::make('fuel_type')
                        ->label('Fuel Type')
                        ->required()
                        ->options([
                            'petrol'   => 'Petrol (Bensin)',
                            'diesel'   => 'Diesel (Solar)',
                            'hybrid'   => 'Hybrid',
                            'electric' => 'Electric',
                        ]),

                    Forms\Components\TextInput::make('color')
                        ->label('Color')
                        ->required()
                        ->maxLength(100)
                        ->placeholder('e.g. Pearl White'),

                    Forms\Components\TextInput::make('tax_status')
                        ->label('Tax Status')
                        ->maxLength(50)
                        ->placeholder('e.g. Active Tax 2025'),
                ])
                ->columns(2),

            Forms\Components\Section::make('Description & Notes')
                ->schema([
                    Forms\Components\RichEditor::make('description')
                        ->label('Vehicle Description')
                        ->toolbarButtons([
                            'bold', 'italic', 'bulletList', 'orderedList', 'undo', 'redo',
                        ])
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('condition_notes')
                        ->label('Condition Notes')
                        ->rows(3)
                        ->maxLength(65535)
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('whatsapp_message')
                        ->label('Custom WhatsApp Message (optional)')
                        ->helperText('Leave empty to use the default message.')
                        ->rows(3)
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Photos')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('car_images')
                        ->collection('car_images')
                        ->multiple()
                        ->maxFiles(16)
                        ->image()
                        ->imageEditor()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->maxSize(5120)
                        ->helperText('Upload up to 16 photos. Max 5MB each. JPG/PNG/WebP only.')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Display Settings')
                ->schema([
                    Forms\Components\Toggle::make('is_available')
                        ->label('Available for Sale')
                        ->default(true),

                    Forms\Components\Toggle::make('is_featured')
                        ->label('Featured Unit')
                        ->helperText('Featured units appear at the top of the catalog.'),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Sort Order')
                        ->numeric()
                        ->nullable()
                        ->helperText('Lower numbers appear first.'),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('car_images')
                    ->collection('car_images')
                    ->label('Photo')
                    ->conversion('thumb')
                    ->size(60)
                    ->circular(false),

                Tables\Columns\TextColumn::make('make_model')
                    ->label('Vehicle')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('year')
                    ->label('Year')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('mileage')
                    ->label('KM')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.') . ' KM')
                    ->sortable(),

                Tables\Columns\TextColumn::make('transmission')
                    ->label('Trans.')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'manual'    => 'warning',
                        'automatic' => 'success',
                        default     => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_available')
                    ->label('Available')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_available')
                    ->label('Status')
                    ->options([
                        '1' => 'Available',
                        '0' => 'Sold',
                    ]),
                Tables\Filters\SelectFilter::make('is_featured')
                    ->label('Featured')
                    ->options([
                        '1' => 'Featured',
                        '0' => 'Not Featured',
                    ]),
                Tables\Filters\SelectFilter::make('body_type')
                    ->label('Body Type')
                    ->options([
                        'sedan'     => 'Sedan',
                        'suv'       => 'SUV',
                        'mpv'       => 'MPV',
                        'city_car'  => 'City Car',
                        'hatchback' => 'Hatchback',
                    ]),
                Tables\Filters\SelectFilter::make('transmission')
                    ->label('Transmission')
                    ->options([
                        'manual'    => 'Manual',
                        'automatic' => 'Automatic',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Car $record) => url("/catalog/{$record->slug}"))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('mark_available')
                        ->label('Mark as Available')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn ($records) => $records->each->update(['is_available' => true]))
                        ->requiresConfirmation(),
                    Tables\Actions\BulkAction::make('mark_sold')
                        ->label('Mark as Sold')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update(['is_available' => false]))
                        ->requiresConfirmation(),
                    Tables\Actions\BulkAction::make('mark_featured')
                        ->label('Mark as Featured')
                        ->icon('heroicon-o-star')
                        ->color('warning')
                        ->action(fn ($records) => $records->each->update(['is_featured' => true])),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit'   => Pages\EditCar::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_available', true)->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }
}
