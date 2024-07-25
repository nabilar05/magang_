<?php

namespace App\Filament\Resources\ModulesResource\Pages;

use App\Filament\Resources\ModulesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModules extends CreateRecord
{
    protected static string $resource = ModulesResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
