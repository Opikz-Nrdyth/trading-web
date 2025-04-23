<?php

namespace App\Filament\Resources\CriptoCurrencyResource\Pages;

use App\Filament\Resources\CriptoCurrencyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCriptoCurrency extends CreateRecord
{
    protected static string $resource = CriptoCurrencyResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
