<?php

namespace App\Filament\Widgets;

use App\Models\tickets;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {

        return [
            Stat::make('Resolved Tickets', '192.1k'),
            Stat::make('All Tickets', '192.1k'),
            Stat::make('Unresolved Tickets ', '3:12'),
        ];
    }
}
