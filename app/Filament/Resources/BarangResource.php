<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\form;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('kode_barang')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('nama_barang')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('jumlah')
                        ->numeric()
                        ->required(),
                    Forms\Components\Select::make('satuan')
                        ->options([
                            'pcs' => 'PCS',
                            'box' => 'BOX',
                            'pak' => 'PAK',
                            'rol' => 'ROL',
                            'm' => 'METER',
                        ])
                        ->default('pcs')
                        ->required(),
                    Forms\Components\TextInput::make('harga_jual')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('harga_beli')
                        ->numeric()
                        ->required(),
                    Forms\Components\RichEditor::make('keterangan')
                        ->maxLength(65535),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_barang')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_barang')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('satuan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ActionGroup::make([
                        Tables\Actions\Action::make('Export')
                            ->action(function (array $records) {
                                // Perform export action
                            }),
                    ])->label('Export'),
                    Tables\Actions\ActionGroup::make([
                        Tables\Actions\Action::make('Import')
                            ->action(function () {
                                // Perform import action
                            }),
                    ])->label('Import'),
                    Tables\Actions\ActionGroup::make([
                        Tables\Actions\Action::make('Print')
                            ->action(function () {
                                // Perform print action
                            }),
                    ])->label('Print'),
                    Tables\Actions\ActionGroup::make([
                        Tables\Actions\Action::make('Export to PDF')
                            ->action(function () {
                                // Perform export to PDF action
                            }),
                    ])->label('Export to PDF'),
                    Tables\Actions\ActionGroup::make([
                        Tables\Actions\Action::make('Export to Excel')
                            ->action(function () {
                                // Perform export to Excel action
                            }),
                    ])->label('Export to Excel'),
                    Tables\Actions\ActionGroup::make([
                        Tables\Actions\Action::make('Export to CSV')
                            ->action(function () {
                                // Perform export to CSV action
                            }),
                    ])->label('Export to CSV'),
                ])->label('Bulk Actions'),
                    ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
