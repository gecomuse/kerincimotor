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

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Artikel';

    protected static ?string $pluralModelLabel = 'Artikel';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Artikel')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                            $set('slug', Str::slug($state))
                        ),

                    Forms\Components\TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(Post::class, 'slug', ignoreRecord: true),

                    Forms\Components\Select::make('category')
                        ->label('Kategori')
                        ->required()
                        ->options([
                            'Panduan'    => 'Panduan',
                            'Tips'       => 'Tips',
                            'Berita'     => 'Berita',
                            'Perawatan'  => 'Perawatan',
                        ])
                        ->default('Panduan'),

                    Forms\Components\TextInput::make('read_time')
                        ->label('Estimasi Baca (menit)')
                        ->numeric()
                        ->default(5)
                        ->minValue(1)
                        ->maxValue(60),
                ])
                ->columns(2),

            Forms\Components\Section::make('Konten')
                ->schema([
                    Forms\Components\Textarea::make('excerpt')
                        ->label('Ringkasan')
                        ->required()
                        ->rows(3)
                        ->maxLength(500)
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('content')
                        ->label('Isi Artikel')
                        ->required()
                        ->columnSpanFull()
                        ->toolbarButtons([
                            'bold', 'italic', 'underline', 'strike',
                            'h2', 'h3',
                            'bulletList', 'orderedList',
                            'blockquote', 'codeBlock',
                            'link',
                            'undo', 'redo',
                        ]),
                ]),

            Forms\Components\Section::make('Thumbnail & Publikasi')
                ->schema([
                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('blog')
                        ->imageEditor()
                        ->nullable(),

                    Forms\Components\Toggle::make('is_published')
                        ->label('Publikasikan')
                        ->default(false),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Tanggal Publikasi')
                        ->nullable(),
                ])
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->width(80)
                    ->height(60)
                    ->defaultImageUrl(asset('images/blog-placeholder.jpg')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Tips'      => 'info',
                        'Berita'    => 'warning',
                        'Perawatan' => 'success',
                        default     => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publikasi')
                    ->boolean(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tgl Publikasi')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('read_time')
                    ->label('Baca')
                    ->suffix(' mnt')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Panduan'    => 'Panduan',
                        'Tips'       => 'Tips',
                        'Berita'     => 'Berita',
                        'Perawatan'  => 'Perawatan',
                    ]),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publikasi'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
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
