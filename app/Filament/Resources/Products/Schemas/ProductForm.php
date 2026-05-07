<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Services\GeminiService;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Produk')
                    ->schema([
                        Select::make('workspace_id')
                            ->label('Workspace')
                            ->relationship('workspace', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('name')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255),
                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Fashion' => 'Fashion',
                                'Kuliner' => 'Kuliner',
                                'Kecantikan' => 'Kecantikan',
                                'Elektronik' => 'Elektronik',
                                'Otomotif' => 'Otomotif',
                                'Properti' => 'Properti',
                                'Kesehatan' => 'Kesehatan',
                                'Lainnya' => 'Lainnya',
                            ]),
                        TextInput::make('price')
                            ->label('Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0),
                        TextInput::make('target_audience')
                            ->label('Target Audiens')
                            ->placeholder('Contoh: Wanita 25-35 tahun, ibu rumah tangga'),
                        Select::make('tone')
                            ->label('Tone')
                            ->options([
                                'engaging' => 'Engaging',
                                'professional' => 'Professional',
                                'casual' => 'Casual',
                                'humorous' => 'Humorous',
                                'inspirational' => 'Inspirational',
                            ])
                            ->default('engaging'),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Spesifikasi')
                    ->schema([
                        KeyValue::make('specifications')
                            ->label('Spesifikasi Produk')
                            ->keyLabel('Nama Spesifikasi')
                            ->valueLabel('Nilai')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Upload Foto Produk')
                    ->schema([
                        FileUpload::make('original_images')
                            ->label('Foto Produk')
                            ->multiple()
                            ->image()
                            ->maxFiles(5)
                            ->directory('products/images')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->columnSpanFull(),
                        Actions::make([
                            Action::make('analyze_gemini')
                                ->label('Analisis dengan Gemini')
                                ->icon('heroicon-o-sparkles')
                                ->color('warning')
                                ->action(function (Get $get, Set $set): void {
                                    $images = $get('original_images');

                                    if (empty($images)) {
                                        Notification::make()
                                            ->title('Tidak ada foto yang diupload')
                                            ->warning()
                                            ->send();

                                        return;
                                    }

                                    $firstImage = is_array($images) ? reset($images) : $images;
                                    $imagePath = Storage::disk('public')->path($firstImage);

                                    $result = app(GeminiService::class)->analyzeProductImage($imagePath);

                                    if (isset($result['error'])) {
                                        Notification::make()
                                            ->title('Analisis gagal: ' . $result['error'])
                                            ->danger()
                                            ->send();

                                        return;
                                    }

                                    $set('ai_analyzed_data', $result);

                                    Notification::make()
                                        ->title('Produk berhasil dianalisis')
                                        ->success()
                                        ->send();
                                }),
                        ]),
                    ]),

                Section::make('Hasil Analisis AI')
                    ->schema([
                        KeyValue::make('ai_analyzed_data')
                            ->label('Data Analisis')
                            ->disabled()
                            ->columnSpanFull(),
                    ])
                    ->visible(fn (Get $get): bool => filled($get('ai_analyzed_data')))
                    ->collapsible(),
            ]);
    }
}
