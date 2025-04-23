<?php

namespace App\Filament\Resources\CriptoCurrencyResource\Pages;

use App\Filament\Resources\CriptoCurrencyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCriptoCurrency extends EditRecord
{
    protected static string $resource = CriptoCurrencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
