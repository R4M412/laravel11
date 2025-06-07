<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandTourOnlyCostResource\Pages;
use App\Models\LandTourOnlyCost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LandTourOnlyCostResource extends Resource
{
    protected static ?string $model = LandTourOnlyCost::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Harga Land Tour Only';
    protected static ?string $pluralModelLabel = 'Harga Land Tour Only';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('participant_range')
                    ->required()
                    ->label('Jumlah Peserta'),
                Forms\Components\TextInput::make('price_per_person')
                    ->required()
                    ->numeric()
                    ->label('Harga Perorang'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('participant_range')
                    ->label('Jumlah Peserta'),
                Tables\Columns\TextColumn::make('price_per_person')
                    ->label('Harga Perorang')
                    ->money('IDR', true), // Bisa ganti ke false kalau mau tanpa format
            ])
            ->filters([
                // Tambah filter jika dibutuhkan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('price_per_person', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLandTourOnlyCosts::route('/'),
            'create' => Pages\CreateLandTourOnlyCost::route('/create'),
            'edit' => Pages\EditLandTourOnlyCost::route('/{record}/edit'),
        ];
    }
}
