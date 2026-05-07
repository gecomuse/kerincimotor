<?php

namespace App\Filament\Resources\ContentPosts\Schemas;

use App\Models\Product;
use App\Services\DeepSeekService;
use App\Services\GeminiService;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ContentPostForm
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
                    ->required()
                    ->live(),
                Select::make('product_id')
                    ->label('Produk (opsional)')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->placeholder('Pilih produk terkait'),
                TextInput::make('title')
                    ->label('Judul')
                    ->maxLength(255),
                Textarea::make('caption')
                    ->label('Caption')
                    ->rows(6)
                    ->required()
                    ->columnSpanFull()
                    ->hintAction(
                        Action::make('generate_ai')
                            ->label('Generate dengan AI')
                            ->icon('heroicon-o-sparkles')
                            ->form([
                                TextInput::make('topic')
                                    ->label('Topik')
                                    ->required()
                                    ->placeholder('Contoh: promo diskon akhir tahun'),
                                Select::make('platform')
                                    ->label('Platform')
                                    ->options([
                                        'instagram' => 'Instagram',
                                        'facebook' => 'Facebook',
                                        'tiktok' => 'TikTok',
                                        'twitter' => 'Twitter / X',
                                        'linkedin' => 'LinkedIn',
                                        'youtube' => 'YouTube',
                                    ])
                                    ->required(),
                            ])
                            ->action(function (array $data, Set $set): void {
                                $caption = app(DeepSeekService::class)->generateCaption(
                                    topic: $data['topic'],
                                    platform: $data['platform'],
                                );
                                $set('caption', $caption);
                            })
                    )
                    ->hintActions([
                        Action::make('generate_from_product')
                            ->label('Generate dari Produk')
                            ->icon('heroicon-o-cube')
                            ->color('success')
                            ->form([
                                Select::make('platform')
                                    ->label('Platform')
                                    ->options([
                                        'instagram' => 'Instagram',
                                        'facebook' => 'Facebook',
                                        'tiktok' => 'TikTok',
                                        'twitter' => 'Twitter / X',
                                        'linkedin' => 'LinkedIn',
                                        'youtube' => 'YouTube',
                                    ])
                                    ->required(),
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
                            ])
                            ->action(function (array $data, Set $set, Get $get): void {
                                $productId = $get('product_id');

                                if (! $productId) {
                                    return;
                                }

                                $product = Product::find($productId);

                                if (! $product) {
                                    return;
                                }

                                $productData = array_filter([
                                    'name' => $product->name,
                                    'category' => $product->category,
                                    'description' => $product->description,
                                    'price' => $product->price,
                                    'target_audience' => $product->target_audience,
                                    'specifications' => $product->specifications,
                                    ...(array) ($product->ai_analyzed_data ?? []),
                                ]);

                                $caption = app(GeminiService::class)->generateProductCaption(
                                    productData: $productData,
                                    platform: $data['platform'],
                                    tone: $data['tone'] ?? 'engaging',
                                );

                                $set('caption', $caption);
                            }),
                    ]),
                CheckboxList::make('target_platforms')
                    ->label('Platform Target')
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
                    ->columnSpanFull(),
                Select::make('media_type')
                    ->label('Tipe Media')
                    ->options([
                        'image' => 'Gambar',
                        'video' => 'Video',
                        'carousel' => 'Carousel',
                    ])
                    ->default('image'),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'scheduled' => 'Terjadwal',
                        'published' => 'Dipublikasi',
                        'failed' => 'Gagal',
                    ])
                    ->default('draft'),
            ]);
    }
}
