<?php

namespace App\Filament\Admin\Resources\Pendaftarans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PendaftaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)
                    ->schema([
                        TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->required(),
                        TextInput::make('nama_panggilan')
                            ->label('Nama Panggilan')
                            ->required(),
                        TextInput::make('tempat_tanggal_lahir')
                            ->label('Tempat/Tanggal Lahir')
                            ->required(),
                        Section::make('Alamat Asal')
                            ->schema([
                                Textarea::make('alamat_asal')
                                    ->label('Alamat')
                                    ->default(null),
                                TextInput::make('alamat_asal_phone')
                                    ->label('Tlp/Hp')
                                    ->tel()
                                    ->default(null),
                            ])
                            ->columns(1),
                        Section::make('Alamat di Malang')
                            ->schema([
                                Textarea::make('alamat_di_malang')
                                    ->label('Alamat')
                                    ->default(null),
                                TextInput::make('alamat_di_malang_phone')
                                    ->label('Tlp/Hp')
                                    ->tel()
                                    ->default(null),
                            ])
                            ->columns(1),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required(),
                        TextInput::make('motivasi')
                            ->label('Motivasi')
                            ->required(),
                        TextInput::make('pengalaman_berorganisasi')
                            ->label('Pengalaman Berorganisasi')
                            ->required(),
                        TextInput::make('pengalaman_kepanitiaan')
                            ->label('Pengalaman Kepanitiaan')
                            ->required(),
                        TextInput::make('motto_hidup')
                            ->label('Motto Hidup')
                            ->required(),
                        Section::make('Divisi Yang Diinginkan')
                            ->schema([
                                TextInput::make('program_studi1')
                                    ->label('Divisi 1')
                                    ->default(null),
                                TextInput::make('program_studi2')
                                    ->label('Divisi 2')
                                    ->default(null),
                            ])
                            ->columns(1),
                        Section::make('Koordinat Lokasi')
                            ->schema([
                                TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->placeholder('Contoh : -7.250445')
                                    ->numeric()
                                    ->step(0.00000001)
                                    ->minValue(-90)
                                    ->maxValue(90)
                                    ->nullable(),
                                TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->placeholder('Contoh : 112.768845')
                                    ->numeric()
                                    ->step(0.00000001)
                                    ->minValue(-180)
                                    ->maxValue(180)
                                    ->nullable(),
                            ])
                            ->columns(2),
                        FileUpload::make('foto')
                            ->label('Foto')
                            ->image()
                            ->directory('pendaftaran-foto'),
                    ]),
            ]);
    }
}
