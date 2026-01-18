<?php

namespace App\Filament\Resources\Pendaftarans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PendaftaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('nama_lengkap')->required()
                    ->label('Nama Lengkap'),
                    
                TextInput::make('nama_panggilan')->required()
                    ->label('Nama Panggilan'),
                TextInput::make('tempat_tanggal_lahir')->required()
                    ->label('Tempat/Tanggal Lahir'),
                Section::make('Alamat Asal')
                    ->schema([
                        TextInput::make('alamat_asal')
                            ->label('Alamat')
                            ->required(),

                        TextInput::make('alamat_asal_phone')
                            ->label('Tlp/Hp')
                            ->nullable(),
                    ])
                    ->columns(1),
                Section::make('Alamat di Malang')
                    ->schema([
                        TextInput::make('alamat_di_malang')
                            ->label('Alamat')
                            ->required(),

                        TextInput::make('alamat_di_malang_phone')
                            ->label('Tlp/Hp')
                            ->nullable(),
                    ])
                    ->columns(1),
                TextInput::make('email')->email()->unique(ignoreRecord: true)->required(),
                TextInput::make('motivasi')->required(),
                TextInput::make('pengalaman_berorganisasi')->required(),
                TextInput::make('pengalaman_kepanitiaan')->required(),
                TextInput::make('motto_hidup')->required(),
                Repeater::make('divisi_yang_diinginkan')
                    ->label('Divisi yang diinginkan')
                    ->schema([
                        TextInput::make('divisi_1')->label('Divisi 1')->required(),
                        TextInput::make('divisi_2')->label('Divisi 2')->nullable(),
                    ])
                    ->columns(1),
                Section::make('Koordinat Lokasi (Opsional)')
                    ->schema([
                        TextInput::make('latitude')
                            ->label('Latitude')
                            ->placeholder('Contoh : -7.250445')
                            ->nullable(),
                        TextInput::make('longitude')
                            ->label('Longitude')
                            ->placeholder('Contoh : 112.768845')
                            ->nullable(),
                    ])
                    ->columns(2),
                FileUpload::make('foto')
                    ->image()
                    ->directory('pendaftaran-foto'),
            ]);
    }
}
