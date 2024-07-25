<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class assignedticketsChart extends ChartWidget
{
    protected static ?string $heading = 'Assigned Tickets';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
