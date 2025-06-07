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
             Forms\Components\TextInput::make('hotel_name')
                ->label('Hotel Name')
                ->required(),
            Forms\Components\TextInput::make('star_rating')
                ->label('Star Rating')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('price_50_pax')
                ->label('Price 50 pax')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('price_11_12_pax')
                ->label('Price 11–12 pax')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('price_8_10_pax')
                ->label('Price 8–10 pax')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('price_6_7_pax')
                ->label('Price 6–7 pax')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('price_3_5_pax')
                ->label('Price 3–5 pax')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('price_2_pax')
                ->label('Price 2 pax')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('single_sup')
                ->label('Single Sup')
                ->numeric()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('hotel_name')->label('Hotel Name')->searchable(),
            Tables\Columns\TextColumn::make('star_rating')->label('Star Rating'),
            Tables\Columns\TextColumn::make('price_50_pax')->label('Price 50 pax'),
            Tables\Columns\TextColumn::make('price_11_12_pax')->label('Price 11–12 pax'),
            Tables\Columns\TextColumn::make('price_8_10_pax')->label('Price 8–10 pax'),
            Tables\Columns\TextColumn::make('price_6_7_pax')->label('Price 6–7 pax'),
            Tables\Columns\TextColumn::make('price_3_5_pax')->label('Price 3–5 pax'),
            Tables\Columns\TextColumn::make('price_2_pax')->label('Price 2 pax'),
            Tables\Columns\TextColumn::make('single_sup')->label('Single Sup'),
            Tables\Columns\TextColumn::make('created_at')->label('Created')->dateTime(),
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
