<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SellInquiryResource\Pages;
use App\Models\SellInquiry;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SellInquiryResource extends Resource
{
    protected static ?string $model           = SellInquiry::class;
    protected static ?string $navigationIcon  = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationLabel = 'Sell Inquiries';
    protected static ?string $navigationGroup = 'Leads';
    protected static ?int    $navigationSort  = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make('Seller Information')
                ->schema([
                    Infolists\Components\TextEntry::make('name')->label('Name'),
                    Infolists\Components\TextEntry::make('phone')->label('Nomor Telepon'),
                    Infolists\Components\TextEntry::make('created_at')->label('Received')->dateTime('d M Y, H:i'),
                    Infolists\Components\TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'new'       => 'warning',
                            'contacted' => 'info',
                            'closed'    => 'success',
                            default     => 'gray',
                        }),
                ])
                ->columns(2),

            Infolists\Components\Section::make('Vehicle Information')
                ->schema([
                    Infolists\Components\TextEntry::make('car_make')->label('Make'),
                    Infolists\Components\TextEntry::make('car_model')->label('Model/Type'),
                    Infolists\Components\TextEntry::make('year')->label('Year'),
                    Infolists\Components\TextEntry::make('mileage')
                        ->label('Mileage')
                        ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.') . ' KM'),
                    Infolists\Components\TextEntry::make('transmission')->label('Transmission'),
                    Infolists\Components\TextEntry::make('color')->label('Color'),
                    Infolists\Components\TextEntry::make('plate_number')->label('Plate No.'),
                    Infolists\Components\TextEntry::make('condition')->label('Condition'),
                ])
                ->columns(2),

            Infolists\Components\Section::make('Offer Details')
                ->schema([
                    Infolists\Components\TextEntry::make('asking_price')->label('Asking Price')->prefix('Rp '),
                    Infolists\Components\TextEntry::make('notes')->label('Notes')->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Seller')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Nomor Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('car_make')
                    ->label('Vehicle')
                    ->formatStateUsing(fn ($state, $record) => "{$record->car_make} {$record->car_model} ({$record->year})")
                    ->searchable(),

                Tables\Columns\TextColumn::make('mileage')
                    ->label('KM')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.') . ' KM'),

                Tables\Columns\TextColumn::make('asking_price')
                    ->label('Asking Price')
                    ->prefix('Rp '),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new'       => 'warning',
                        'contacted' => 'info',
                        'closed'    => 'success',
                        default     => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new'       => 'New',
                        'contacted' => 'Contacted',
                        'closed'    => 'Closed',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('contact_wa')
                    ->label('Contact via WA')
                    ->icon('heroicon-o-chat-bubble-oval-left')
                    ->color('success')
                    ->url(fn (SellInquiry $record) => $record->whatsapp_url)
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('mark_contacted')
                    ->label('Mark Contacted')
                    ->icon('heroicon-o-phone')
                    ->color('info')
                    ->action(fn (SellInquiry $record) => $record->update(['status' => 'contacted']))
                    ->visible(fn (SellInquiry $record) => $record->status === 'new'),
                Tables\Actions\Action::make('mark_closed')
                    ->label('Close')
                    ->icon('heroicon-o-check')
                    ->color('gray')
                    ->action(fn (SellInquiry $record) => $record->update(['status' => 'closed']))
                    ->visible(fn (SellInquiry $record) => $record->status !== 'closed'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSellInquiries::route('/'),
            'view'  => Pages\ViewSellInquiry::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'new')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }
}
