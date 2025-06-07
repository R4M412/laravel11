<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourItineraryResource\Pages;
use App\Models\TourItinerary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TourItineraryResource extends Resource
{
    protected static ?string $model = TourItinerary::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Tour Itineraries';
    protected static ?string $pluralModelLabel = 'Tour Itineraries';
    protected static ?string $modelLabel = 'Tour Itinerary';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Basic fields
            Forms\Components\TextInput::make('day_number')
                ->label('Day Number')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('day_title')
                ->label('Day Title')
                ->required(),

            Forms\Components\TextInput::make('location')
                ->label('Location (optional)'),

            // Itinerary items repeater
            Forms\Components\Repeater::make('items')
                ->label('Itinerary Details')
                ->relationship('items')
                ->default([])
                ->schema([
                    Forms\Components\Select::make('type')
                        ->label('Tipe')
                        ->options([
                            'text' => 'Deskripsi Biasa',
                            'checklist' => 'Checklist Pilihan',
                        ])
                        ->required()
                        ->live(), // penting agar hidden() bereaksi saat tipe berubah

                    Forms\Components\Textarea::make('content')
                        ->label('Deskripsi atau Judul Checklist')
                        ->required(),

                    Forms\Components\Repeater::make('options')
                        ->label('Pilihan Checklist')
                        ->schema([
                            Forms\Components\TextInput::make('label')
                                ->label('Opsi'),
                        ])
                        ->default([])
                        ->hidden(fn ($get) => $get('../../type') !== 'checklist'), // akses tipe parent
                ])
                ->columnSpanFull()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('day_number')
                    ->label('Day')
                    ->sortable(),

                Tables\Columns\TextColumn::make('day_title')
                    ->label('Title'),

                Tables\Columns\TextColumn::make('location')
                    ->label('Location'),
            ])
            ->filters([]) // Tambahkan jika ada filter
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Kosongkan atau isi RelationManager jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTourItineraries::route('/'),
            'create' => Pages\CreateTourItinerary::route('/create'),
            'edit' => Pages\EditTourItinerary::route('/{record}/edit'),
        ];
    }
}
