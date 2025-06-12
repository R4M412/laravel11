<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaketRegulerResource\Pages;
use App\Models\PaketReguler;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class PaketRegulerResource extends Resource
{
    protected static ?string $model = PaketReguler::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Manajemen Wisata';
    protected static ?string $navigationLabel = 'Pesanan Reguler';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    Section::make('Detail Pesanan')->columnSpan(2)->schema([
                        Forms\Components\Select::make('wisata_id')
                            ->relationship('wisata', 'judul')->searchable()->preload()->required(),
                        Forms\Components\DatePicker::make('order_date')
                            ->label('Tanggal Perjalanan')->required(),
                        Forms\Components\TextInput::make('adults')
                            ->label('Jumlah Dewasa')->required()->numeric()->default(1),
                        Forms\Components\TextInput::make('children')
                            ->label('Jumlah Anak')->numeric()->default(0),
                    ]),
                    Section::make('Status & Harga')->columnSpan(1)->schema([
                        Forms\Components\Select::make('status')
                            ->options(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'cancelled' => 'Cancelled', 'completed' => 'Completed'])
                            ->required()->default('pending'),
                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')->numeric()->prefix('Rp'),
                    ]),
                ]),
                Section::make('Detail Pelanggan')->schema([
                    Forms\Components\TextInput::make('customer_name')
                        ->label('Nama Pelanggan')->required()->maxLength(255),
                    Forms\Components\TextInput::make('customer_email')
                        ->label('Email Pelanggan')->email()->required()->maxLength(255),
                    Forms\Components\TextInput::make('customer_phone')
                        ->label('Telepon Pelanggan')->tel()->required()->maxLength(255),
                ]),
                Section::make('Catatan Tambahan')->schema([
                    Forms\Components\Textarea::make('notes')
                        ->label('Catatan dari Pelanggan')->columnSpanFull(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('wisata.judul')->label('Paket Wisata')->limit(30)->searchable()->sortable(),
                Tables\Columns\TextColumn::make('customer_name')->label('Nama Pelanggan')->searchable(),
                Tables\Columns\TextColumn::make('order_date')->label('Tgl. Perjalanan')->date('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning', 'confirmed' => 'success',
                        'cancelled' => 'danger', 'completed' => 'primary',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Tgl. Pesan')->dateTime('d M Y, H:i')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'cancelled' => 'Cancelled', 'completed' => 'Completed']),
                Tables\Filters\SelectFilter::make('wisata')->relationship('wisata', 'judul')->searchable()
            ])
            ->actions([Tables\Actions\ViewAction::make(), Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at', 'desc');
    }
    
    public static function getRelations(): array { return []; }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaketRegulers::route('/'),
            'create' => Pages\CreatePaketReguler::route('/create'),
             'view' => Pages\ViewPaketReguler::route('/{record}'),
            'edit' => Pages\EditPaketReguler::route('/{record}/edit'),
        ];
    }    
}
