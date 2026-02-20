<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Card::make()->schema([
                // 1. Judul Halaman
                TextInput::make('title')
                    ->label('Judul / Slogan')
                    ->required()
                    ->placeholder('Misal: Lebih dari sekadar Kode & Pixel.'),

                // 2. Foto Profil
                FileUpload::make('image')
                    ->label('Foto Profil')
                    ->image()
                    ->disk('public')
                    ->directory('about'),

                // 3. Isi Cerita (Editor Lengkap)
                RichEditor::make('content')
                    ->label('Cerita Tentang Saya')
                    ->required()
                    ->columnSpan('full'), // Biar lebar editornya full
            ])
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
        'index' => Pages\ListAbouts::route('/'),
        'edit' => Pages\EditAbout::route('/{record}/edit'),
    ];
}

// Matikan tombol Create agar tidak ada duplikasi data
public static function canCreate(): bool
{
    return false;
}
}
