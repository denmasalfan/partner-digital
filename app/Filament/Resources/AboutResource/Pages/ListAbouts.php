<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use Filament\Resources\Pages\ListRecords;
use App\Models\About;

class ListAbouts extends ListRecords
{
    protected static string $resource = AboutResource::class;

    public function mount(): void
    {
        parent::mount();

        // Cari data About ID 1, jika tidak ada buatkan otomatis
        $record = About::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'Profil Partner Digital',
                'content' => 'Silakan isi deskripsi profil Anda di sini.',
            ]
        );

        // LANGSUNG LEMPAR KE HALAMAN EDIT
        redirect(AboutResource::getUrl('edit', ['record' => $record->id]));
    }
}