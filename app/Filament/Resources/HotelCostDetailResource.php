<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelCostDetailResource\Pages;
use App\Filament\Resources\HotelCostDetailResource\RelationManagers;
use App\Models\HotelCostDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HotelCostDetailResource extends Resource
{
    protected static ?string $model = HotelCostDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('hotel_name')->required(),
            Forms\Components\TextInput::make('star_rating')->numeric()->required(),
            Forms\Components\TextInput::make('price_50_pax')->numeric()->required(),
            Forms\Components\TextInput::make('price_11_12_pax')->numeric()->required(),
            Forms\Components\TextInput::make('price_8_10_pax')->numeric()->required(),
            Forms\Components\TextInput::make('price_6_7_pax')->numeric()->required(),
            Forms\Components\TextInput::make('price_3_5_pax')->numeric()->required(),
            Forms\Components\TextInput::make('price_2_pax')->numeric()->required(),
            Forms\Components\TextInput::make('single_sup')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('hotel_name')->searchable(),
            Tables\Columns\TextColumn::make('star_rating'),
            Tables\Columns\TextColumn::make('price_50_pax'),
            Tables\Columns\TextColumn::make('price_11_12_pax'),
            Tables\Columns\TextColumn::make('price_8_10_pax'),
            Tables\Columns\TextColumn::make('price_6_7_pax'),
            Tables\Columns\TextColumn::make('price_3_5_pax'),
            Tables\Columns\TextColumn::make('price_2_pax'),
            Tables\Columns\TextColumn::make('single_sup'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
                ]),
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
            'index' => Pages\ListHotelCostDetails::route('/'),
            'create' => Pages\CreateHotelCostDetail::route('/create'),
            'edit' => Pages\EditHotelCostDetail::route('/{record}/edit'),
        ];
    }
}
