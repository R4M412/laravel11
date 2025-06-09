<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WisataResource\Pages;
use App\Filament\Resources\WisataResource\RelationManagers\HotelPricingsRelationManager; // Persiapan untuk nanti
use App\Models\Wisata;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class WisataResource extends Resource
{
    protected static ?string $model = Wisata::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Paket Wisata';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Form Paket Wisata')->tabs([
                    
                    Tabs\Tab::make('Informasi Umum')->schema([
                        Grid::make(3)->schema([
                            Section::make('Detail Utama')->columnSpan(2)->schema([
                                TextInput::make('judul')->required()->live(onBlur: true)->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')->required()->unique(Wisata::class, 'slug', ignoreRecord: true),
                                Forms\Components\Select::make('kota_destinasi_id')->relationship('kotaDestinasi', 'judul')->required()->label('Pilih Kota Destinasi'),
                                Textarea::make('deskripsi')->label('Deskripsi Singkat (untuk card)')->rows(3),
                            ]),
                            Section::make('Gambar')->columnSpan(1)->schema([
                                FileUpload::make('gambar')->label('Gambar Utama Paket')->image()->directory('wisata-images'),
                            ]),
                        ]),
                        Section::make('Overview Lengkap Paket')->schema([
                             RichEditor::make('overview'),
                        ]),
                    ]),

                    Tabs\Tab::make('Destinasi & Itinerary')->schema([
                        Section::make('Daftar Destinasi Dalam Paket')->schema([
                            Repeater::make('destinations')->label('')->schema([
                                FileUpload::make('image')->label('Gambar Destinasi')->required(),
                                TextInput::make('title')->label('Judul Destinasi')->required(),
                            ])->grid(2)->addActionLabel('Tambah Destinasi'),
                        ]),
                        Section::make('Rencana Perjalanan (Itinerary)')->schema([
                            Builder::make('itinerary')->label('')->blocks([
                                Builder\Block::make('hari_kegiatan_deskripsi')->label('Hari Kegiatan (Format Deskripsi)')->schema([
                                    TextInput::make('judul_hari')->required(),
                                    RichEditor::make('deskripsi_kegiatan')->required(),
                                ]),
                                Builder\Block::make('hari_kegiatan_checklist')->label('Hari Kegiatan (Format Checklist)')->schema([
                                    TextInput::make('judul_hari')->required(),
                                    Textarea::make('aturan_pilihan')->placeholder('Contoh: Boleh checklist 2 aja dari 4 pilihan'),
                                    Repeater::make('item_checklist')->schema([TextInput::make('item')]),
                                ]),
                            ])->addActionLabel('Tambah Hari Itinerary'),
                        ]),
                    ]),

                    Tabs\Tab::make('Harga, Fasilitas & Catatan')->schema([
                        Grid::make(2)->schema([
                            Section::make('Harga Domestik (Rupiah)')->schema([
                                TextInput::make('price_without_hotel')->label('Harga Tanpa Hotel (Per Pax)')->numeric()->prefix('Rp'),
                                // Harga dengan hotel akan kita buat sebagai Relation Manager nanti agar lebih rapi
                            ]),
                            Section::make('Harga Turis Asing (USD)')->schema([
                                Repeater::make('foreign_prices')->schema([
                                    TextInput::make('pax_info')->label('Keterangan Pax')->placeholder('Contoh: 2-5 Pax'),
                                    TextInput::make('price')->label('Harga per Pax')->numeric()->prefix('$'),
                                ])->columns(2)->addActionLabel('Tambah Harga Asing'),
                            ]),
                        ]),
                        Grid::make(2)->schema([
                            Section::make('Fasilitas')->schema([
                                Repeater::make('facilities_include')->label('Termasuk (Include)')->schema([TextInput::make('item')]),
                                Repeater::make('facilities_exclude')->label('Tidak Termasuk (Exclude)')->schema([TextInput::make('item')]),
                            ]),
                            Section::make('Catatan Tambahan')->schema([
                                RichEditor::make('remarks')->label('Remarks'),
                            ]),
                        ]),
                    ]),

                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar'),
                Tables\Columns\TextColumn::make('judul')->searchable(),
                Tables\Columns\TextColumn::make('kotaDestinasi.judul')->label('Kota')->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kotaDestinasi')->relationship('kotaDestinasi', 'judul'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
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