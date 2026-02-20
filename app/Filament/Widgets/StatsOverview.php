<?php

namespace App\Filament\Widgets;

use App\Models\Message;
use App\Models\Photo;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            // Statistik Total Foto
            Card::make('Total Koleksi Foto', Photo::count())
                ->description('Foto yang dipajang di galeri')
                ->descriptionIcon('heroicon-s-photograph')
                ->color('primary'),

            // Statistik Total Pesan Masuk
            Card::make('Total Pesan', Message::count())
                ->description('Pesan dari pengunjung')
                ->descriptionIcon('heroicon-s-mail')
                ->color('success'),

            // Statistik Pesan Belum Dibaca
            Card::make('Pesan Belum Dibaca', Message::where('is_read', false)->count())
                ->description('Segera respon pesan klien')
                ->descriptionIcon('heroicon-s-bell')
                ->color('danger'),
        ];
    }
}