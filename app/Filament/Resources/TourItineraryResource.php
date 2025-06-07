<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourItineraryResource\Pages;
use App\Models\TourItinerary;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get; // PENTING: Untuk form dinamis
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TourItineraryResource extends Resource
{
    protected static ?string $model = TourItinerary::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    TextInput::make('title')
                        ->label('Judul Tour')
                        ->required(),
                    TextInput::make('location')
                        ->label('Lokasi'),
                ]),

                // Repeater untuk mengelola Itinerary Items
                Repeater::make('items') // Nama relasi di model TourItinerary
                    ->relationship()
                    ->label('Jadwal Itinerary')
                    ->reorderableWithButtons()
                    ->collapsible()
                    ->cloneable()
                    ->schema([
                        TextInput::make('day')
                            ->label('Hari ke-')
                            ->numeric()
                            ->required(),
                        
                        Select::make('type')
                            ->label('Tipe Konten')
                            ->options([
                                'description' => 'Deskripsi / Paragraf',
                                'checklist' => 'Daftar Pilihan (Checklist)',
                            ])
                            ->default('description')
                            ->live() // ->live() akan memicu refresh saat diubah
                            ->required(),

                        // Field ini HANYA MUNCUL jika tipenya 'description'
                        Textarea::make('description')
                            ->label('Isi Deskripsi')
                            ->visible(fn (Get $get): bool => $get('type') === 'description'),

                        // Field-field ini HANYA MUNCUL jika tipenya 'checklist'
                        TextInput::make('title')
                            ->label('Judul / Instruksi Checklist')
                            ->placeholder('Contoh: Pilih 2 tempat wisata')
                            ->visible(fn (Get $get): bool => $get('type') === 'checklist'),

                        Repeater::make('options')
                            ->label('Opsi untuk Checklist')
                            ->schema([
                                TextInput::make('option_name')
                                    ->label('Nama Opsi')
                                    ->required(),
                            ])
                            ->visible(fn (Get $get): bool => $get('type') === 'checklist'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable(),
                TextColumn::make('location'),
                TextColumn::make('updated_at')->dateTime()->sortable(),
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
            'index' => Pages\ListTourItineraries::route('/'),
            'create' => Pages\CreateTourItinerary::route('/create'),
            'edit' => Pages\EditTourItinerary::route('/{record}/edit'),
        ];
    }
}