<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use Filament\Resources\Pages\EditRecord;

class EditAbout extends EditRecord
{
    protected static string $resource = AboutResource::class;

    protected function getActions(): array
    {
        return []; // Hapus tombol Delete
    }

    // Setelah simpan, tetap di sini agar tidak kembali ke tabel kosong
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}