<?php

namespace App\Filament\Admin\Resources\Pendaftarans\Pages;

use App\Filament\Admin\Resources\Pendaftarans\PendaftaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPendaftarans extends ListRecords
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
