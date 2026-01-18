<?php

namespace App\Filament\Admin\Resources\Pendaftarans\Pages;

use App\Filament\Admin\Resources\Pendaftarans\PendaftaranResource;
use Illuminate\Support\Facades\Schema;
use Filament\Resources\Pages\CreateRecord;

class CreatePendaftaran extends CreateRecord
{
    protected static string $resource = PendaftaranResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('view', ['record' => $this->record]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $divisi1 = $data['program_studi1'] ?? null;
        $divisi2 = $data['program_studi2'] ?? null;

        if ($divisi1 || $divisi2) {
            $data['divisi_yang_diinginkan'] = [
                [
                    'divisi_1' => $divisi1,
                    'divisi_2' => $divisi2,
                ],
            ];
        }

        if (! Schema::hasColumn('pendaftarans', 'latitude')) {
            unset($data['latitude']);
        }
        if (! Schema::hasColumn('pendaftarans', 'longitude')) {
            unset($data['longitude']);
        }

        unset($data['program_studi1'], $data['program_studi2']);
        return $data;
    }
}
