<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoResource\Pages;
use App\Filament\Resources\PhotoResource\RelationManagers;
use App\Models\Photo;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Select;

class PhotoResource extends Resource
{
    protected static ?string $model = Photo::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Card::make()->schema([
                // 1. Judul & Slug Otomatis
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->reactive() // Biar saat ngetik, slug ikut berubah
                    ->afterStateUpdated(function ($set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                 Select::make('category_id')
                    ->label('Album Kategori')
                    ->relationship('category', 'name') // Ambil data dari tabel category, tampilkan namanya
                    ->searchable()
                    ->preload()
                    ->createOptionForm([ // Fitur Pro: Bisa bikin kategori baru langsung dari sini!
                        TextInput::make('name')
                            ->required()
                            ->lazy()
                            ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')->required(),
                    ]),   
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true), // URL tidak boleh kembar

                // 2. Upload Gambar (PENTING)
                FileUpload::make('image_path')
                    ->label('Foto Utama')
                    ->image()
                    ->disk('public') // <--- TAMBAHKAN INI (Wajib)
                    ->directory('photos')
                    ->visibility('public') // <--- TAMBAHKAN INI (Biar aman)
                    ->required(),

                FileUpload::make('thumbnail_path')
                    ->label('Thumbnail (Kecil)')
                    ->image()
                    ->disk('public') // <--- INI JUGA DITAMBAH
                    ->directory('thumbnails')
                    ->visibility('public'), // <--- INI JUGA

                // 4. Detail Lainnya
                TextInput::make('alt_text')
                    ->label('Alt Text (SEO)')
                    ->placeholder('Misal: Pemandangan Gunung Bromo'),
                    
                Textarea::make('description')
                    ->rows(3),

                // 5. Pengaturan
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0) // Otomatis diisi 0
                    ->hiddenOn('create') // PENTING: Sembunyikan saat Tambah Baru (biar cepat)
                    ->label('Urutan Prioritas (Opsional)'),
                    
                Toggle::make('is_active')
                    ->label('Tampilkan Foto?')
                    ->default(true),
            ])
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                // 1. Kolom Foto
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto')
                    ->disk('public') // Pastikan mengambil dari disk public
                    ->square(), // Bentuk kotak

                // 2. Kolom Judul
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable() // Bisa dicari
                    ->sortable() // Bisa diurutkan
                    ->limit(50), // Potong jika terlalu panjang

                // 3. Kolom Status (Langsung Ubah ON/OFF)
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Tampil?'),

                // 4. Kolom Tanggal Upload
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y') // Format tanggal (misal: 19 Feb 2026)
                    ->sortable(),
            ])
            ->filters([
                // Filter untuk menampilkan yang aktif saja/tidak
                Tables\Filters\Filter::make('active')
                    ->query(fn ($query) => $query->where('is_active', true))
                    ->label('Hanya yang Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPhotos::route('/'),
            'create' => Pages\CreatePhoto::route('/create'),
            'edit' => Pages\EditPhoto::route('/{record}/edit'),
        ];
    }    
}
