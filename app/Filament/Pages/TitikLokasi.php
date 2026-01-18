<?php

namespace App\Filament\Pages;

use App\Models\Pendaftaran;
use Filament\Pages\Page;
use BackedEnum;
use Illuminate\Support\Facades\Schema;

class TitikLokasi extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Titik Lokasi';
    protected static ?string $title = 'Titik Lokasi';
    protected static ?string $slug = 'titik-lokasi';

    protected string $view = 'filament.pages.titik-lokasi';

    public array $locations = [];

    public function mount(): void
    {
        $this->locations = Pendaftaran::query()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get([
                'id',
                'nama_lengkap',
                'email',
                'alamat_asal_phone',
                'alamat_di_malang_phone',
                'divisi_yang_diinginkan',
                'latitude',
                'longitude',
            ])
            ->map(function ($p) {
                $divisi = [];
                $arr = is_array($p->divisi_yang_diinginkan)
                    ? $p->divisi_yang_diinginkan
                    : json_decode($p->divisi_yang_diinginkan ?? '[]', true);
                if (is_array($arr)) {
                    foreach ($arr as $item) {
                        if (!empty($item['divisi_1'])) {
                            $divisi[] = $item['divisi_1'];
                        }
                        if (!empty($item['divisi_2'])) {
                            $divisi[] = $item['divisi_2'];
                        }
                    }
                }
                $phone = $p->alamat_di_malang_phone ?: $p->alamat_asal_phone;
                return [
                    'id' => $p->id,
                    'nama' => $p->nama_lengkap,
                    'email' => $p->email,
                    'phone' => $phone,
                    'divisi' => implode(', ', array_unique(array_filter($divisi))),
                    'lat' => (float) $p->latitude,
                    'lng' => (float) $p->longitude,
                ];
            })
            ->values()
            ->toArray();
    }
}
