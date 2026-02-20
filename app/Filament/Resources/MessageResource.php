<?php

namespace App\App\Filament\Resources; // Pastikan namespace sesuai folder Bapak

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Forms; // WAJIB ADA
use Filament\Resources\Form; // WAJIB ADA
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;
    protected static ?string $navigationIcon = 'heroicon-o-mail';
    protected static ?string $navigationLabel = 'Inbox Pesan';

    public static function canCreate(): bool { return false; }

    // --- TAMBAHKAN FUNGSI INI AGAR MODAL VIEW TIDAK ERROR ---
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Pengirim'),
                        Forms\Components\TextInput::make('email')
                            ->label('Email'),
                        Forms\Components\Textarea::make('content')
                            ->label('Isi Pesan')
                            ->rows(8), // Agar pesan terlihat luas
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Waktu Kirim')
                            ->content(fn ($record): string => $record->created_at->format('d M Y, H:i')),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Pengirim')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->copyable(),
                Tables\Columns\TextColumn::make('content')->label('Pesan')->limit(50),
                Tables\Columns\BadgeColumn::make('created_at')
                    ->label('Diterima')
                    ->dateTime('d M Y, H:i'),
            ])
            ->actions([
    // KODE BARU UNTUK VIEW ACTION
                    Tables\Actions\ViewAction::make()
                        ->mutateRecordDataUsing(function (array $data, $record): array {
                            // Paksa update ke database saat pesan dilihat
                            $record->update(['is_read' => true]);
                            return $data;
                        }),
                        
                    Tables\Actions\DeleteAction::make(),
                ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
        ];
    }
}