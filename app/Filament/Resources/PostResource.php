<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon  = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $modelLabel      = 'Artikel';
    protected static ?string $pluralModelLabel = 'Artikel';
    protected static ?int    $navigationSort  = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Konten Artikel')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul Artikel')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($set, $state) {
                            $set('slug', Str::slug($state));
                            $wordCount = str_word_count(strip_tags($state ?? ''));
                            $set('read_time', max(1, (int) ceil($wordCount / 200)));
                        })
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('slug')
                        ->label('URL Slug')
                        ->required()
                        ->unique(Post::class, 'slug', ignoreRecord: true)
                        ->prefix('kerincimotor.com/artikel/')
                        ->helperText('Auto-generated dari judul. Edit manual jika perlu.')
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\Select::make('category')
                        ->label('Kategori')
                        ->options([
                            'Panduan'      => 'Panduan',
                            'Harga Pasar'  => 'Harga Pasar',
                            'Perbandingan' => 'Perbandingan',
                            'Kredit & DP'  => 'Kredit & DP',
                            'Rekomendasi'  => 'Rekomendasi',
                            'Tips Merawat' => 'Tips Merawat',
                            'Berita'       => 'Berita',
                        ])
                        ->required()
                        ->default('Panduan'),

                    Forms\Components\TextInput::make('read_time')
                        ->label('Estimasi Waktu Baca')
                        ->numeric()
                        ->suffix('menit')
                        ->default(5)
                        ->minValue(1)
                        ->maxValue(60),

                    Forms\Components\Textarea::make('excerpt')
                        ->label('Ringkasan (Excerpt)')
                        ->required()
                        ->maxLength(300)
                        ->rows(3)
                        ->helperText('Ditampilkan di card artikel dan sebagai fallback meta description. Maks 300 karakter.')
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('content')
                        ->label('Isi Artikel')
                        ->required()
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'codeBlock',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])
                        ->fileAttachmentsDirectory('posts/attachments')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Forms\Components\Section::make('Media — Thumbnail & Gambar Utama')
                ->description('Thumbnail digunakan di card artikel di homepage dan halaman daftar artikel. Meta Image digunakan saat artikel dibagikan di media sosial (WhatsApp, Instagram, Twitter).')
                ->schema([
                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail Artikel')
                        ->image()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeTargetWidth('800')
                        ->imageResizeTargetHeight('450')
                        ->directory('posts/thumbnails')
                        ->visibility('public')
                        ->helperText('Rasio 16:9. Otomatis di-resize ke 800×450px. Format: JPG, PNG, WebP.')
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('meta_image')
                        ->label('Meta Image (OG Image untuk Social Media)')
                        ->image()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('1200:630')
                        ->imageResizeTargetWidth('1200')
                        ->imageResizeTargetHeight('630')
                        ->directory('posts/meta-images')
                        ->visibility('public')
                        ->helperText('Ukuran ideal: 1200×630px. Muncul saat artikel dibagikan di WhatsApp, Facebook, Twitter. Jika kosong, thumbnail akan digunakan.')
                        ->columnSpanFull(),
                ])
                ->columns(1),

            Forms\Components\Section::make('SEO & Meta Tags')
                ->description('Isi bagian ini untuk mengoptimalkan artikel di mesin pencari (Google). Jika dikosongkan, sistem otomatis menggunakan judul dan excerpt artikel.')
                ->schema([
                    Forms\Components\TextInput::make('meta_title')
                        ->label('Meta Title')
                        ->maxLength(100)
                        ->helperText('Judul yang muncul di tab browser dan hasil pencarian Google. Idealnya 50–60 karakter. Contoh: "7 Tips Beli Mobil Bekas | Kerinci Motor Bekasi"')
                        ->placeholder('Kosongkan untuk menggunakan judul artikel secara otomatis')
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('meta_description')
                        ->label('Meta Description')
                        ->maxLength(160)
                        ->rows(3)
                        ->helperText('Deskripsi yang muncul di bawah judul di Google. Idealnya 120–160 karakter. Wajib mengandung keyword utama.')
                        ->placeholder('Kosongkan untuk menggunakan excerpt artikel secara otomatis')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('meta_keywords')
                        ->label('Meta Keywords')
                        ->maxLength(255)
                        ->helperText('Kata kunci dipisahkan koma. Contoh: mobil bekas bekasi, beli mobil bekas, honda jazz bekas')
                        ->placeholder('keyword1, keyword2, keyword3')
                        ->columnSpanFull(),
                ])
                ->columns(1)
                ->collapsible(),

            Forms\Components\Section::make('Publikasi')
                ->schema([
                    Forms\Components\Toggle::make('is_published')
                        ->label('Publikasikan Artikel')
                        ->helperText('Aktifkan untuk menampilkan artikel di website.')
                        ->live()
                        ->afterStateUpdated(function ($set, $state) {
                            if ($state) {
                                $set('published_at', now());
                            }
                        }),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Tanggal Publish')
                        ->nullable()
                        ->native(false),
                ])
                ->columns(2),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->width(80)
                    ->height(50)
                    ->defaultImageUrl(fn () => 'https://placehold.co/80x50/1a1a1a/666666?text=No+Image'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(45)
                    ->wrap(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Panduan'      => 'primary',
                        'Harga Pasar'  => 'success',
                        'Perbandingan' => 'warning',
                        'Kredit & DP'  => 'danger',
                        'Rekomendasi'  => 'gray',
                        default        => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('has_seo')
                    ->label('SEO')
                    ->boolean()
                    ->getStateUsing(fn ($record) => !empty($record->meta_title))
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->tooltip(fn ($record) => empty($record->meta_title) ? 'Meta title belum diisi' : 'SEO sudah diisi'),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Publish')
                    ->dateTime('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('read_time')
                    ->label('Baca')
                    ->suffix(' mnt')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publish')
                    ->trueLabel('Published')
                    ->falseLabel('Draft'),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Panduan'      => 'Panduan',
                        'Harga Pasar'  => 'Harga Pasar',
                        'Perbandingan' => 'Perbandingan',
                        'Kredit & DP'  => 'Kredit & DP',
                        'Rekomendasi'  => 'Rekomendasi',
                        'Tips Merawat' => 'Tips Merawat',
                        'Berita'       => 'Berita',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit'),
                Tables\Actions\Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Post $record): string => route('artikel.show', $record->slug))
                    ->openUrlInNewTab()
                    ->color('gray'),
                Tables\Actions\DeleteAction::make()->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Belum ada artikel')
            ->emptyStateDescription('Klik tombol "Buat Artikel" untuk membuat artikel pertama.')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Buat Artikel Pertama'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $drafts = static::getModel()::where('is_published', false)->count();
        return $drafts > 0 ? $drafts . ' draft' : null;
    }
}
