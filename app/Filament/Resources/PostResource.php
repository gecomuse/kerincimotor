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
    protected static ?int    $navigationSort  = 1;
    protected static ?string $modelLabel      = 'Artikel';
    protected static ?string $pluralModelLabel = 'Artikel';

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
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                            $set('slug', Str::slug($state));
                            $wordCount = str_word_count(strip_tags($state ?? ''));
                            $set('read_time', max(1, (int) ceil($wordCount / 200)));
                        })
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('slug')
                        ->label('URL Slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(Post::class, 'slug', ignoreRecord: true)
                        ->prefix('kerincimotor.com/artikel/')
                        ->helperText('Auto-generated dari judul. Edit jika perlu.')
                        ->columnSpanFull(),

                    Forms\Components\Select::make('category')
                        ->label('Kategori')
                        ->required()
                        ->options([
                            'Panduan'      => 'Panduan',
                            'Harga Pasar'  => 'Harga Pasar',
                            'Perbandingan' => 'Perbandingan',
                            'Kredit & DP'  => 'Kredit & DP',
                            'Rekomendasi'  => 'Rekomendasi',
                            'Tips Merawat' => 'Tips Merawat',
                            'Berita'       => 'Berita',
                        ])
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
                        ->helperText('Ditampilkan di card artikel dan sebagai fallback meta description. Maks 300 karakter.')
                        ->required()
                        ->maxLength(300)
                        ->rows(3)
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('content')
                        ->label('Isi Artikel')
                        ->required()
                        ->columnSpanFull()
                        ->toolbarButtons([
                            'bold', 'italic', 'underline', 'strike',
                            'h2', 'h3',
                            'bulletList', 'orderedList',
                            'blockquote', 'link',
                            'attachFiles', 'codeBlock',
                            'redo', 'undo',
                        ])
                        ->fileAttachmentsDirectory('posts/attachments'),
                ])
                ->columns(2),

            Forms\Components\Section::make('Thumbnail')
                ->schema([
                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail Artikel')
                        ->image()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeTargetWidth('800')
                        ->imageResizeTargetHeight('450')
                        ->directory('posts/thumbnails')
                        ->helperText('Rasio 16:9. Otomatis di-resize ke 800×450px.')
                        ->nullable()
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('SEO & Meta Tags')
                ->description('Isi bagian ini untuk mengoptimalkan artikel di mesin pencari (Google, Bing). Jika dikosongkan, sistem akan menggunakan judul dan excerpt artikel secara otomatis.')
                ->schema([
                    Forms\Components\TextInput::make('meta_title')
                        ->label('Meta Title')
                        ->maxLength(60)
                        ->helperText('Judul yang muncul di tab browser dan hasil pencarian Google. Idealnya 50–60 karakter.')
                        ->placeholder('Kosongkan untuk menggunakan judul artikel secara otomatis')
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('meta_description')
                        ->label('Meta Description')
                        ->maxLength(160)
                        ->rows(3)
                        ->helperText('Deskripsi singkat yang muncul di bawah judul di hasil pencarian. Idealnya 120–160 karakter.')
                        ->placeholder('Kosongkan untuk menggunakan excerpt artikel secara otomatis')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('meta_keywords')
                        ->label('Meta Keywords')
                        ->maxLength(255)
                        ->helperText('Kata kunci dipisahkan koma. Contoh: mobil bekas bekasi, beli mobil bekas, honda jazz bekas')
                        ->placeholder('keyword1, keyword2, keyword3')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Publikasi')
                ->schema([
                    Forms\Components\Toggle::make('is_published')
                        ->label('Publikasikan Artikel')
                        ->helperText('Aktifkan untuk menampilkan artikel di website.')
                        ->live()
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
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
                    ->defaultImageUrl(asset('images/blog-placeholder.jpg')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('seo_filled')
                    ->label('SEO')
                    ->boolean()
                    ->getStateUsing(fn ($record) => !empty($record->meta_title)),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publikasi')
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Post $record) => route('artikel.show', $record->slug))
                    ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
