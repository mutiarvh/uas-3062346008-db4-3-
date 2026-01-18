<?php

namespace App\Filament\Admin\Resources\Pendaftarans;

use App\Filament\Admin\Resources\Pendaftarans\Pages\CreatePendaftaran;
use App\Filament\Admin\Resources\Pendaftarans\Pages\EditPendaftaran;
use App\Filament\Admin\Resources\Pendaftarans\Pages\ListPendaftarans;
use App\Filament\Admin\Resources\Pendaftarans\Pages\ViewPendaftaran;
use App\Filament\Admin\Resources\Pendaftarans\Schemas\PendaftaranForm;
use App\Filament\Admin\Resources\Pendaftarans\Tables\PendaftaransTable;
use App\Models\Pendaftaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry as InfolistTextEntry;
use Filament\Infolists\Components\ImageEntry as InfolistImageEntry;
use Filament\Tables\Table;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return PendaftaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PendaftaransTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPendaftarans::route('/'),
            'create' => CreatePendaftaran::route('/create'),
            'view' => ViewPendaftaran::route('/{record}'),
            'edit' => EditPendaftaran::route('/{record}/edit'),
        ];
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->schema([
            InfolistTextEntry::make('nama_lengkap')->label('Nama Lengkap'),
            InfolistTextEntry::make('nama_panggilan')->label('Nama Panggilan'),
            InfolistTextEntry::make('tempat_tanggal_lahir')->label('Tempat/Tanggal Lahir'),
            InfolistTextEntry::make('alamat_asal')->label('Alamat Asal'),
            InfolistTextEntry::make('alamat_asal_phone')->label('Tlp/Hp Alamat Asal'),
            InfolistTextEntry::make('alamat_di_malang')->label('Alamat di Malang'),
            InfolistTextEntry::make('alamat_di_malang_phone')->label('Tlp/Hp Alamat di Malang'),
            InfolistTextEntry::make('email')->label('Email'),
            InfolistTextEntry::make('motivasi')->label('Motivasi'),
            InfolistTextEntry::make('pengalaman_berorganisasi')->label('Pengalaman Berorganisasi'),
            InfolistTextEntry::make('pengalaman_kepanitiaan')->label('Pengalaman Kepanitiaan'),
            InfolistTextEntry::make('motto_hidup')->label('Motto Hidup'),
            InfolistTextEntry::make('divisi_yang_diinginkan_combined')
                ->label('Divisi Yang Diinginkan')
                ->state(function ($record) {
                    $parts = [];
                    if (!empty($record->program_studi1)) {
                        $parts[] = $record->program_studi1;
                    }
                    if (!empty($record->program_studi2)) {
                        $parts[] = $record->program_studi2;
                    }
                    if (!empty($record->divisi_yang_diinginkan)) {
                        $arr = is_array($record->divisi_yang_diinginkan)
                            ? $record->divisi_yang_diinginkan
                            : json_decode($record->divisi_yang_diinginkan, true);
                        if (is_array($arr)) {
                            foreach ($arr as $item) {
                                if (!empty($item['divisi_1'])) {
                                    $parts[] = $item['divisi_1'];
                                }
                                if (!empty($item['divisi_2'])) {
                                    $parts[] = $item['divisi_2'];
                                }
                            }
                        }
                    }
                    $parts = array_values(array_unique(array_filter($parts)));
                    return $parts ? implode(', ', $parts) : null;
                }),
            InfolistImageEntry::make('foto')->label('Foto')->height(160),
            InfolistTextEntry::make('created_at')->label('Dibuat'),
            InfolistTextEntry::make('updated_at')->label('Diubah'),
        ]);
    }
}
