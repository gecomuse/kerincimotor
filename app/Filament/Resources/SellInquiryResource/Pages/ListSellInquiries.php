<?php

namespace App\Filament\Resources\SellInquiryResource\Pages;

use App\Filament\Resources\SellInquiryResource;
use Filament\Resources\Pages\ListRecords;

class ListSellInquiries extends ListRecords
{
    protected static string $resource = SellInquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
