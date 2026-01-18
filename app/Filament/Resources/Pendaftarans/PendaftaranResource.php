<?php

namespace App\Filament\Resources\Pendaftarans;

use App\Filament\Resources\Pendaftarans\Pages;
use App\Models\Pendaftaran;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Infolists\Components\TextEntry as InfolistTextEntry;
use Filament\Infolists\Components\RepeatableEntry as InfolistRepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn as InfolistTableColumn;
use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Pendaftarans\Schemas\PendaftaranForm;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';

    // Gunakan schema terpisah supaya form konsisten dengan PendaftaranForm
    public static function form(Schema $schema): Schema
    {
        return PendaftaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('email'),
                \Filament\Tables\Columns\TextColumn::make('divisi_1')
                    ->label('Divisi 1')
                    ->getStateUsing(fn ($record) => ($record->divisi_yang_diinginkan ?? []) ? collect($record->divisi_yang_diinginkan)->pluck('divisi_1')->filter()->join(', ') : null),
                \Filament\Tables\Columns\TextColumn::make('divisi_2')
                    ->label('Divisi 2')
                    ->getStateUsing(fn ($record) => ($record->divisi_yang_diinginkan ?? []) ? collect($record->divisi_yang_diinginkan)->pluck('divisi_2')->filter()->join(', ') : null),
                \Filament\Tables\Columns\TextColumn::make('alamat_di_malang')
                    ->label('Alamat di Malang')
                    ->getStateUsing(fn ($record) => $record->alamat_di_malang ? $record->alamat_di_malang . '<br><small>' . ($record->alamat_di_malang_phone ?? '') . '</small>' : null)
                    ->html(),
            ])
            ->filters([])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->schema([
            InfolistTextEntry::make('nama_lengkap')
                ->label('Nama Lengkap'),

            InfolistRepeatableEntry::make('divisi_yang_diinginkan')
                ->table([
                    InfolistTableColumn::make('Divisi 1'),
                    InfolistTableColumn::make('Divisi 2'),
                ])
                ->schema([
                    InfolistTextEntry::make('divisi_1')->label('Divisi 1'),
                    InfolistTextEntry::make('divisi_2')->label('Divisi 2'),
                ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'view' => Pages\ViewPendaftaran::route('/{record}'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
