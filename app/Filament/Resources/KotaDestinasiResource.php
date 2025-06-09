<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KotaDestinasiResource\Pages;
use App\Models\KotaDestinasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Set;

class KotaDestinasiResource extends Resource
{
    protected static ?string $model = KotaDestinasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Kota Destinasi';
    protected static ?int $navigationSort = 2; // Urutan ke-2 di sidebar, setelah Pulau

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Detail Konten')
                            ->schema([
                                // INI KUNCINYA: Dropdown untuk memilih Induk (Pulau)
                                Forms\Components\Select::make('pulau_destinasi_id')
                                    ->relationship('pulauDestinasi', 'judul')
                                    ->searchable()
                                    ->required()
                                    ->label('Pilih Pulau Induk'),

                                Forms\Components\TextInput::make('judul')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(KotaDestinasi::class, 'slug', ignoreRecord: true),
                                
                                Forms\Components\RichEditor::make('deskripsi')
                                    ->required()
                                    ->columnSpan('full'),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Gambar')
                            ->schema([
                                Forms\Components\FileUpload::make('gambar')
                                    ->image()
                                    ->directory('kota-images'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar'),
                Tables\Columns\TextColumn::make('judul')->searchable(),
                
                // INI KUNCINYA: Menampilkan nama Pulau Induk di tabel
                Tables\Columns\TextColumn::make('pulauDestinasi.judul')
                    ->label('Pulau Induk')
                    ->searchable()
                    ->sortable(),

                // Persiapan untuk nanti: Menampilkan jumlah paket wisata
                Tables\Columns\TextColumn::make('wisatas.count')
                    ->counts('wisatas')
                    ->label('Jumlah Paket'),
            ])
            ->filters([
                // INI KUNCINYA: Filter berdasarkan Pulau Induk
                Tables\Filters\SelectFilter::make('pulauDestinasi')
                    ->relationship('pulauDestinasi', 'judul')
                    ->label('Filter Berdasarkan Pulau')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListKotaDestinasis::route('/'),
            'create' => Pages\CreateKotaDestinasi::route('/create'),
            'edit' => Pages\EditKotaDestinasi::route('/{record}/edit'),
        ];
    }    
}