<?php

namespace App\Filament\Resources\PhotoResource\Pages;

use App\Filament\Resources\PhotoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePhoto extends CreateRecord
{
    protected static string $resource = PhotoResource::class;
    protected function getRedirectUrl(): string
    {
        // Setelah sukses simpan, kembalikan ke halaman tabel (index)
        return $this->getResource()::getUrl('index');
    }
}
