<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WisataResource\Pages;
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
use Filament\Forms\Components\Toggle;

class WisataResource extends Resource
{
    protected static ?string $model = Wisata::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Paket Wisata';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Form Paket Wisata')->tabs([

                Tabs\Tab::make('Informasi Umum')->schema([
                    Grid::make(3)->schema([
                        Section::make('Detail Utama')->columnSpan(2)->schema([
                            TextInput::make('judul')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->required()
                                ->unique(Wisata::class, 'slug', ignoreRecord: true),
                            TextInput::make('display_price')
                                ->label('Harga Tampil di Card (Start From)')
                                ->placeholder('Contoh: 750.000')
                                ->helperText('Teks harga ini akan tampil apa adanya di daftar paket.'),
                            Forms\Components\Select::make('kota_destinasi_id')
                                ->relationship('kotaDestinasi', 'judul')
                                ->required()
                                ->label('Pilih Kota Destinasi'),
                            Textarea::make('deskripsi')
                                ->label('Deskripsi Singkat (untuk card)')
                                ->rows(3)
                                ->helperText('Opsi: Teks singkat jika ingin ditampilkan di card.'),
                        ]),
                        Section::make('Gambar')->columnSpan(1)->schema([
                            FileUpload::make('gambar')
                                ->label('Gambar Utama Paket')
                                ->image()
                                ->imageEditor()
                                ->directory('wisata-images')
                                ->required(),
                        ]),
                    ]),
                    Section::make('Overview Lengkap Paket')->schema([
                        RichEditor::make('overview'),
                    ]),
                ]),

                Tabs\Tab::make('Daftar Destinasi')->schema([
                    Section::make('Daftar Destinasi Dalam Paket')->schema([
                        Repeater::make('destinations')
                            ->label('')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Gambar Destinasi')
                                    ->image()
                                    ->required()
                                    ->columnSpan(1),
                                Grid::make(1)->columnSpan(1)->schema([
                                    TextInput::make('title')
                                        ->label('Judul Destinasi')
                                        ->required(),
                                    Toggle::make('is_featured')
                                        ->label('Jadikan Gambar Unggulan?')
                                        ->helperText('Aktifkan jika gambar ini akan ditampilkan di galeri atas.')
                                        ->onColor('success')
                                        ->inline(false),
                                ]),
                            ])
                            ->columns(2)
                            ->addActionLabel('Tambah Destinasi'),
                    ]),
                ]),

                Tabs\Tab::make('Rencana Perjalanan (Itinerary)')->schema([
                    Section::make('Rencana Perjalanan Harian')->schema([
                        Builder::make('itinerary')->label('')->blocks([
                            Builder\Block::make('hari_kegiatan_deskripsi')->label('Hari Kegiatan (Format Deskripsi)')->schema([
                                TextInput::make('judul_hari')->required(),
                                RichEditor::make('deskripsi_kegiatan')->required(),
                            ]),
                            Builder\Block::make('hari_kegiatan_checklist')->label('Hari Kegiatan (Format Checklist)')->schema([
                                TextInput::make('judul_hari')->required(),
                                Textarea::make('aturan_pilihan')->placeholder('Contoh: Pilih 2 atraksi favorit dari daftar berikut'),
                                Repeater::make('item_checklist')->schema([
                                    TextInput::make('item')
                                ]),
                            ]),
                        ])->addActionLabel('Tambah Hari Itinerary'),
                    ]),
                ]),
                
                Tabs\Tab::make('Rincian Harga, Fasilitas & Catatan')->schema([
                    Section::make('Tabel Rincian Harga Paket (Untuk Halaman Detail)')->collapsible()->schema([
                        Section::make('Harga Tanpa Hotel (Land Tour Only)')->schema([
                            Repeater::make('land_tour_prices')->label('Daftar Harga Tanpa Hotel')->schema([
                                TextInput::make('pax_info')->label('Keterangan Pax')->placeholder('Contoh: 11-12 Pax')->required(),
                                TextInput::make('price')->label('Harga Perorang')->numeric()->prefix('Rp')->required(),
                            ])->columns(2)->addActionLabel('Tambah Baris Harga'),
                        ]),
                        Section::make('Harga Dengan Hotel')->schema([
                            Repeater::make('hotel_pricings')->label('Daftar Harga Per Hotel')->schema([
                                TextInput::make('hotel_name')->label('Nama Hotel / Tipe')->required()->columnSpanFull(),
                                TextInput::make('price_50_pax')->label('50 Pax')->numeric()->prefix('Rp'),
                                TextInput::make('price_11_12_pax')->label('11-12 Pax')->numeric()->prefix('Rp'),
                                TextInput::make('price_8_10_pax')->label('8-10 Pax')->numeric()->prefix('Rp'),
                                TextInput::make('price_6_7_pax')->label('6-7 Pax')->numeric()->prefix('Rp'),
                                TextInput::make('price_3_5_pax')->label('3-5 Pax')->numeric()->prefix('Rp'),
                                TextInput::make('price_2_pax')->label('2 Pax')->numeric()->prefix('Rp'),
                                TextInput::make('price_single_sup')->label('Single Sup')->numeric()->prefix('Rp'),
                            ])->columns(4)->addActionLabel('Tambah Opsi Hotel'),
                        ]),
                    ]),
                    Section::make('Biaya Tambahan Untuk Turis Asing')->collapsible()->schema([
                        Repeater::make('foreign_guest_surcharges')->label('Daftar Biaya Tambahan')->schema([
                            TextInput::make('attraction_name')->label('Nama Atraksi Wisata')->required(),
                            TextInput::make('weekday_price')->label('Harga Weekday')->numeric()->prefix('Rp'),
                            TextInput::make('weekend_price')->label('Harga Weekend')->numeric()->prefix('Rp'),
                        ])->columns(3)->addActionLabel('Tambah Biaya Atraksi'),
                    ]),
                    Grid::make(2)->schema([
                        Section::make('Fasilitas')->schema([
                            Repeater::make('facilities_include')->label('Termasuk (Include)')->schema([
                                TextInput::make('item')
                            ])->addActionLabel('Tambah Item'),
                            Repeater::make('facilities_exclude')->label('Tidak Termasuk (Exclude)')->schema([
                                TextInput::make('item')
                            ])->addActionLabel('Tambah Item'),
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
                Tables\Columns\TextColumn::make('judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('display_price')->label('Harga Card')->prefix('Rp ')->sortable(),
                Tables\Columns\TextColumn::make('kotaDestinasi.judul')->label('Kota')->searchable()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kotaDestinasi')->relationship('kotaDestinasi', 'judul'),
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
            'index' => Pages\ListWisatas::route('/'),
            'create' => Pages\CreateWisata::route('/create'),
            'edit' => Pages\EditWisata::route('/{record}/edit'),
        ];
    }
}