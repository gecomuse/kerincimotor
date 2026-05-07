<?php

namespace App\Filament\Resources\ContentPosts\Pages;

use App\Filament\Resources\ContentPosts\ContentPostResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContentPost extends CreateRecord
{
    protected static string $resource = ContentPostResource::class;
}
