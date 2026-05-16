<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VideoResource extends Resource
{
    protected static ?string $model           = Video::class;
    protected static ?string $navigationIcon  = 'heroicon-o-play-circle';
    protected static ?string $navigationLabel = 'Videos';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int    $navigationSort  = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Toggle::make('is_featured')
                ->label('Featured — tampil di homepage dan halaman Video')
                ->helperText('Hanya 1 video featured yang tampil di bagian atas halaman Video.')
                ->columnSpanFull(),

            Forms\Components\Section::make('Info Video')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul Video')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('youtube_id')
                        ->label('YouTube Video ID')
                        ->required()
                        ->maxLength(50)
                        ->placeholder('e.g. -A3QvyQ9sP8')
                        ->helperText('ID di akhir URL YouTube: youtube.com/watch?v=ID_INI')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('price_label')
                        ->label('Harga Unit')
                        ->maxLength(50)
                        ->placeholder('175jt'),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),
                ])
                ->columns(2),

            Forms\Components\Section::make('Deskripsi')
                ->schema([
                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi Video')
                        ->rows(4)
                        ->maxLength(500)
                        ->helperText('Muncul di halaman utama featured video section dan halaman Video.')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Toggle::make('is_active')
                ->label('Aktif (tampilkan di website)')
                ->default(true)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->weight('bold')
                    ->limit(40),

                Tables\Columns\TextColumn::make('youtube_id')
                    ->label('YouTube ID')
                    ->searchable(),

                Tables\Columns\TextColumn::make('price_label')
                    ->label('Price'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->options(['1' => 'Active', '0' => 'Inactive']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit'   => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
