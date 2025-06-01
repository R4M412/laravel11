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
            Forms\Components\FileUpload::make('gambar_thumbnail')
                ->label('Gambar Thumbnail')
                ->directory('wisata-images')
                ->image()
                ->nullable(),

            Forms\Components\FileUpload::make('gambar_wisata')
                ->label('Gambar Wisata')
                ->directory('wisata-images')
                ->image()
                ->multiple()
                ->nullable(),

            Forms\Components\TextInput::make('judul')
                ->label('Judul')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->required()
                ->maxLength(1000),

            Forms\Components\TextInput::make('harga_paket')
                ->label('Harga Paket')
                ->numeric()
                ->required()
                ->step(0.01)
                ->suffix('Rp'),

            Forms\Components\TextInput::make('transportasi')
                ->label('Transportasi')
                ->maxLength(255),

            Forms\Components\TextInput::make('itenary')
                ->label('Itenary')
                ->maxLength(255),

            Forms\Components\Textarea::make('fasilitas')
                ->label('Fasilitas')
                ->rows(3),

            Forms\Components\TextInput::make('remarks')
                ->label('Remarks')
                ->maxLength(255),

            Forms\Components\TextInput::make('additional')
                ->label('Additional')
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\ImageColumn::make('gambar_thumbnail')->label('Gambar Thumbnail')->sortable(),
            Tables\Columns\TextColumn::make('gambar_wisata')->label('Gambar Wisata')->limit(30),
            Tables\Columns\TextColumn::make('judul')->label('Judul')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('deskripsi')->label('Deskripsi')->limit(30),
            Tables\Columns\TextColumn::make('harga_paket')->label('Harga Paket')->money('IDR'),
            Tables\Columns\TextColumn::make('transportasi')->label('Transportasi'),
            Tables\Columns\TextColumn::make('itenary')->label('Itenary'),
            Tables\Columns\TextColumn::make('fasilitas')->label('Fasilitas')->limit(30),
            Tables\Columns\TextColumn::make('remarks')->label('Remarks')->limit(30),
            Tables\Columns\TextColumn::make('additional')->label('Additional')->limit(30),
            Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime('d M Y'),
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
