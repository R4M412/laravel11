<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WisataResource\Pages;
use App\Models\Wisata;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class WisataResource extends Resource
{
    protected static ?string $model = Wisata::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_wisata')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('deskripsi')
                    ->maxLength(1000),

                Forms\Components\TextInput::make('alamat')
                    ->maxLength(255),

                Forms\Components\FileUpload::make('gambar')
                    ->directory('wisata-images')
                    ->image()
                    ->nullable(),

                Forms\Components\TextInput::make('harga_tiket')
                    ->numeric()
                    ->step(0.01)
                    ->suffix('Rp'),

                Forms\Components\TextInput::make('jam_buka')
                    ->placeholder('Contoh: 08:00 - 17:00'),

                Forms\Components\Textarea::make('fasilitas')
                    ->rows(3),

                Forms\Components\Select::make('kategori')
                    ->options([
                        'pantai' => 'Pantai',
                        'gunung' => 'Gunung',
                        'budaya' => 'Budaya',
                        'sejarah' => 'Sejarah',
                        'hiburan' => 'Hiburan',
                    ])
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_wisata')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('alamat')->limit(30),
                Tables\Columns\TextColumn::make('kategori')->badge(),
                Tables\Columns\TextColumn::make('harga_tiket')->money('IDR'),
                Tables\Columns\TextColumn::make('jam_buka'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWisatas::route('/'),
            'create' => Pages\CreateWisata::route('/create'),
            'edit' => Pages\EditWisata::route('/{record}/edit'),
        ];
    }
}
