<?php

namespace App\Filament\Resources\Pendaftarans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PendaftaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->searchable(),
                TextColumn::make('nama_panggilan')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('no_telepon')
                    ->searchable(),
                TextColumn::make('jalur_masuk')
                    ->searchable(),
                TextColumn::make('divisi_yang_diinginkan_combined')
                    ->label('Divisi Yang Diinginkan')
                    ->getStateUsing(function ($record) {
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
                    })
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
