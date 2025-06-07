<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelCostDetailResource\Pages;
use App\Models\HotelCostDetail;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HotelCostDetailResource extends Resource
{
    protected static ?string $model = HotelCostDetail::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationLabel = 'Hotel Cost Details';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Utama Hotel')->schema([
                    // Field ini HARUS cocok dengan nama kolom di migrasi Anda
                    TextInput::make('name')
                        ->label('Hotel (Nama & Bintang)')
                        ->placeholder('Contoh: Citra Dream / Amaris *2')
                        ->required()
                        ->columnSpanFull(),

                    // Field ini HARUS cocok dengan nama kolom di migrasi Anda
                    TextInput::make('single_sup')
                        ->label('Single Supplement')
                        ->numeric()
                        ->prefix('IDR')
                        ->required(),
                ]),

                Section::make('Tingkatan Harga per Orang (Pax)')->schema([
                    // Repeater ini HARUS menunjuk ke NAMA RELASI di model Anda
                    Repeater::make('priceRules') // <--- NAMA RELASI
                        ->relationship() // <--- INI KUNCINYA
                        ->label('Aturan Harga')
                        ->schema([
                            // Field ini HARUS cocok dengan nama kolom di tabel price_rules
                            TextInput::make('min_pax')
                                ->label('Min Peserta')
                                ->numeric()
                                ->required(),
                            
                            // Field ini HARUS cocok dengan nama kolom di tabel price_rules
                            TextInput::make('max_pax')
                                ->label('Max Peserta')
                                ->numeric()
                                ->nullable(),
                            
                            // Field ini HARUS cocok dengan nama kolom di tabel price_rules
                            TextInput::make('price')
                                ->label('Harga Perorang')
                                ->numeric()
                                ->prefix('IDR')
                                ->required(),
                        ])
                        ->columns(3)
                        ->addActionLabel('Tambah Tingkatan Harga')
                        ->cloneable()
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom ini HARUS cocok dengan nama kolom di migrasi Anda
                TextColumn::make('name')
                    ->label('Hotel')
                    ->searchable()
                    ->sortable(),

                // Kolom kalkulasi untuk harga berdasarkan Pax
                TextColumn::make('harga_2_7_pax')
                    ->label('Harga 2-7 Pax')
                    ->state(function (HotelCostDetail $record): string {
                        $price = $record->getPriceForPax(2);
                        return !is_null($price) ? 'Rp ' . number_format($price, 0, ',', '.') : 'N/A';
                    })
                    ->sortable(false),

                TextColumn::make('harga_8_11_pax')
                    ->label('Harga 8-11 Pax')
                    ->state(function (HotelCostDetail $record): string {
                        $price = $record->getPriceForPax(8);
                        return !is_null($price) ? 'Rp ' . number_format($price, 0, ',', '.') : 'N/A';
                    })
                    ->sortable(false),

                // Kolom ini HARUS cocok dengan nama kolom di migrasi Anda
                TextColumn::make('single_sup')
                    ->label('Single Sup')
                    ->money('IDR')
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
                ]),
            ]);
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