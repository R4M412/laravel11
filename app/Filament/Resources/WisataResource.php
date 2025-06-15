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
                            TextInput::make('duration_text')
                                ->label('Durasi Paket (Teks)')
                                ->placeholder('Contoh: 2 Hari 1 Malam')
                                ->required(),
                            TextInput::make('duration_days')
                                ->label('Durasi Paket (Angka Hari)')
                                ->numeric()
                                ->minValue(1)
                                ->helperText('Isi dengan angka HARI-nya saja. Contoh: untuk 2D1N, isi 2.')
                                ->required(),
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
                    Section::make('Rencana Perjalanan Harian')
                        ->description('Gunakan Repeater untuk menambah hari, lalu gunakan Builder di dalamnya untuk menyusun konten per hari.')
                        ->schema([
                            Repeater::make('itinerary')
                                ->label('Hari Perjalanan')
                                ->addActionLabel('Tambah Hari Baru')
                                ->collapsible()
                                ->itemLabel(fn (array $state): ?string => $state['judul_hari'] ?? 'Hari Baru')
                                ->schema([
                                    TextInput::make('judul_hari')
                                        ->label('Judul Hari')
                                        ->placeholder('Contoh: Day 01 - Jakarta - Ciwidey Tour')
                                        ->required(),
                                    
                                    Builder::make('content_blocks')
                                        ->label('Susunan Konten untuk Hari Ini')
                                        ->addActionLabel('Tambah Blok Konten')
                                        ->blocks([
                                            Builder\Block::make('deskripsi')
                                                ->label('Blok Deskripsi / Paragraf')
                                                ->icon('heroicon-o-document-text')
                                                ->schema([
                                                    RichEditor::make('konten')
                                                        ->label('Isi Deskripsi')
                                                        ->required(),
                                                ]),
                                            
                                            Builder\Block::make('checklist')
                                                ->label('Blok Checklist Pilihan')
                                                ->icon('heroicon-o-check-circle')
                                                ->schema([
                                                    Textarea::make('aturan_pilihan')
                                                        ->label('Teks Aturan Pilihan')
                                                        ->placeholder('Contoh: Pilih 2 atraksi favorit dari daftar berikut')
                                                        ->rows(2),
                                                    Repeater::make('item_checklist')
                                                        ->label('Daftar Item untuk Checklist')
                                                        ->schema([
                                                            TextInput::make('item')->label('Nama Item')->required(),
                                                        ])
                                                        ->addActionLabel('Tambah Item Checklist'),
                                                ]),
                                        ]),
                                ]),
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
                        RichEditor::make('facilities_include_text')
                            ->label('Fasilitas Termasuk (Include)')
                            ->helperText('Masukkan semua fasilitas yang termasuk dalam paket.')
                            ->required(),

                        RichEditor::make('facilities_exclude_text')
                            ->label('Fasilitas Tidak Termasuk (Exclude)')
                            ->helperText('Masukkan semua fasilitas yang TIDAK termasuk dalam paket.')
                            ->required(),
                        ])->columns(1), // Ini biar editornya urut ke bawah, bukan nyamping
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