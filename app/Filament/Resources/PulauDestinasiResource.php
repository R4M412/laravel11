<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PulauDestinasiResource\Pages;
use App\Models\PulauDestinasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// TAMBAHAN: Import class yang dibutuhkan untuk slug otomatis
use Illuminate\Support\Str;
use Filament\Forms\Set;

class PulauDestinasiResource extends Resource
{
    protected static ?string $model = PulauDestinasi::class;

    // TAMBAHAN: Mengganti ikon dan memberi urutan di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Pulau Destinasi';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // TAMBAHAN: Mengelompokkan form menjadi 2 kolom agar lebih rapi
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Detail Konten')
                            ->schema([
                                Forms\Components\TextInput::make('judul')
                                    ->required()
                                    ->live(onBlur: true) // <-- Saat ngetik judul...
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))), // <-- slug otomatis terisi

                                Forms\Components\TextInput::make('slug') // <-- Field untuk menampilkan slug
                                    ->required()
                                    ->unique(PulauDestinasi::class, 'slug', ignoreRecord: true) // Memastikan slug unik
                                    ->helperText('Alamat URL unik untuk pulau ini.'),

                                Forms\Components\RichEditor::make('deskripsi') // <-- Diganti menjadi RichEditor
                                    ->label('Deskripsi')
                                    ->required()
                                    ->columnSpan('full'),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Gambar')
                            ->schema([
                                Forms\Components\FileUpload::make('gambar')
                                    ->label('Gambar Utama')
                                    ->image()
                                    ->directory('pulau-images'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')->label('Gambar'),
                Tables\Columns\TextColumn::make('judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->label('URL Slug')->searchable(),
                
                // TAMBAHAN: Menampilkan jumlah kota yang terhubung (butuh relasi di model)
                Tables\Columns\TextColumn::make('kotaDestinasis.count')
                    ->counts('kotaDestinasis')
                    ->label('Jumlah Kota'),
            ])
            ->filters([
                //
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
    
    // ... getPages() tidak perlu diubah
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPulauDestinasis::route('/'),
            'create' => Pages\CreatePulauDestinasi::route('/create'),
            'edit' => Pages\EditPulauDestinasi::route('/{record}/edit'),
        ];
    }    
}