<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class assignedIticketsChart extends ChartWidget
{
    protected static ?string $heading = 'Assigned I Tickets';

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
