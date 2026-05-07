<?php

namespace App\Filament\Resources\ContentPosts\Tables;

use App\Models\ContentPost;
use App\Models\SocialAccount;
use App\Services\PublishingService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContentPostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('workspace.name')
                    ->label('Workspace')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'scheduled' => 'warning',
                        'published' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'scheduled' => 'Terjadwal',
                        'published' => 'Dipublikasi',
                        'failed' => 'Gagal',
                        default => $state,
                    }),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                Action::make('publish_now')
                    ->label('Publish Sekarang')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->form(fn (ContentPost $record): array => [
                        CheckboxList::make('account_ids')
                            ->label('Pilih Akun Sosial')
                            ->options(
                                SocialAccount::where('workspace_id', $record->workspace_id)
                                    ->where('is_active', true)
                                    ->get()
                                    ->mapWithKeys(fn (SocialAccount $account) => [
                                        $account->id => "{$account->account_name} ({$account->platform})",
                                    ])
                                    ->toArray()
                            )
                            ->required(),
                    ])
                    ->action(function (ContentPost $record, array $data): void {
                        $results = app(PublishingService::class)->publishNow($record, $data['account_ids']);

                        $succeeded = collect($results)->where('success', true)->count();
                        $failed = collect($results)->where('success', false)->count();

                        if ($failed === 0) {
                            Notification::make()
                                ->title("Berhasil dipublikasi ke {$succeeded} akun")
                                ->success()
                                ->send();
                        } elseif ($succeeded === 0) {
                            Notification::make()
                                ->title("Gagal dipublikasi ke semua akun")
                                ->body(collect($results)->pluck('error')->filter()->join(', '))
                                ->danger()
                                ->send();
                        } else {
                            Notification::make()
                                ->title("{$succeeded} berhasil, {$failed} gagal")
                                ->warning()
                                ->send();
                        }
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
